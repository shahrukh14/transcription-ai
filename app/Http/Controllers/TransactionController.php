<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    //for date filter 
    public function list(Request $request)
    {
        $query = Transaction::query();

        //filter by the date range
        if ($request->from && $request->to && $request->from <= $request->to) {
            $from = date('Y-m-d', strtotime($request->from));
            $to = date('Y-m-d', strtotime($request->to));
            $query->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to);
        }

        //filter by payment_id
        if ($request->has('search') && !empty($request->search))
        {
            $searchTerms = explode(' ', $request->search);

            //for each term add a WHERE payment_id LIKE '%term%'
            $query->where(function($q) use ($searchTerms){
                foreach($searchTerms as $term){
                    $q->orWhere('payment_id','LIKE','%'. $term . '%');
                }
            });
        }

        $transactions = $query->paginate(10);
        return view('admin.Transaction.list', compact('transactions'));
    }
}
