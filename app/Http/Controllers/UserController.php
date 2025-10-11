<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Transcription;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard(Request $request){
        $transcriptions = Transcription::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        $languages =  DB::table('languages')->orderBy('name','ASC')->pluck('name')->toArray();
        return view('user.dashboard', compact('transcriptions','languages'));
    }

    public function logout(){
        Auth::guard('web')->logout();
        alert()->success('SuccessAlert', 'Successfully Logged Out');
        return to_route('login');
    }

    //for date filter 
    public function transaction(Request $request)
    {
        $query = Transaction::where('user_id', auth()->user()->id);

        //filter by the date range
        if ($request->from && $request->to && $request->from <= $request->to) {
            $from = date('Y-m-d', strtotime($request->from));
            $to = date('Y-m-d', strtotime($request->to));
            $query->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
        }

        $transactions = $query->paginate(10);
        return view('user.user-transaction', compact('transactions'));
    }

}
