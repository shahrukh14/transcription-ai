<?php

namespace App\Http\Controllers;

use App\Models\UserSubscription;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function list(Request $request)
    {
        $query = UserSubscription::query();
        if ($request->has('search') && !empty($request->search)) {
            $searchTerms = explode(' ', $request->search); 
            $query->whereHas('getUser', function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->where(function ($query) use ($term) {
                        $query->where('first_name', 'LIKE', '%' . $term . '%')
                              ->orWhere('last_name', 'LIKE', '%' . $term . '%');
                    });
                }
            });
        }
        if ($request->from && $request->to && $request->from <= $request->to) {
            $from = date('Y-m-d', strtotime($request->from));
            $to = date('Y-m-d', strtotime($request->to));
            $query->whereDate('expiry_date', '>=', $from)->whereDate('expiry_date', '<=', $to);
        }
        if ($request->has('status') && in_array($request->status, ['active', 'expired'])) {
            if ($request->status == 'active') {
                $query->whereHas('getPackage', function ($q) {
                    $q->whereDate('expiry_date', '>=', now());
                });
            } elseif ($request->status == 'expired') {
                $query->whereHas('getPackage', function ($q) {
                    $q->whereDate('expiry_date', '<', now());
                });
            }
        }
        $subscriptions = $query->paginate(10);
        return view('admin.subscription.list', compact('subscriptions'));
    }
    
   public function details($id)
    {
        $detail = UserSubscription::with('getUser','getPackage')->find($id); 
        return view('admin.subscription.detail', compact('detail'));
    }

}
