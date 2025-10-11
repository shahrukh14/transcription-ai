<?php

namespace App\Http\Controllers;

use Session;
use Exception;
use Razorpay\Api\Api;
use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\UserSubscription;


class PaymentController extends Controller
{
    public function subscription($id){

        $package = Package::find($id); // Get the paclageby id
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $amount = $package->amount;
        $order = $api->order->create([
            'receipt'         => 'rcptid_' . rand(1000, 9999),
            'amount'          => $amount * 100, // in paisa
            'currency'        => 'INR'
        ]);

        return view('user.checkout', [
            'package' =>$package,
            'order'  => $order,
            'amount' => $amount,
            'key'    => env('RAZORPAY_KEY')
        ]);
    }

    public function paymentSuccess(Request $request)
    {
        try {
            $payment_id = $request->payment_id;
            $order_id = $request->order_id;
            $signature = $request->signature;
            $package_id = $request->package_id;
            $user = auth()->user();
            $package = Package::find($package_id);
    
            // Calculate Expiry Date
            if($package->type == "monthly"){
                $expiry_date = \Carbon\Carbon::now()->addMonths(1)->toDateString();
            }else{
                $expiry_date = \Carbon\Carbon::now()->addYears(1)->toDateString();
            }
    
            // Fetch Payment Details from Razorpay API
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payment = $api->payment->fetch($payment_id);
    
    
            //Subscribe the free package for the new user
            $userSubscription               = new UserSubscription();
            $userSubscription->user_id      = $user->id;
            $userSubscription->package_id   = $package_id;
            $userSubscription->amount       = ($payment->amount / 100); // convert from paisa to rupees
            $userSubscription->expiry_date  = $expiry_date; 
            $userSubscription->save();
    
            //Save Transaction into database
            Transaction::create([
                'user_id'    => $user->id,
                'package_id' => $package_id,
                'payment_id' => $payment_id,
                'order_id'   => $order_id,
                'signature'  => $signature,
                'amount'     => $payment->amount / 100, // convert from paisa to rupees
                'currency'   => $payment->currency,
            ]);

            //Update user packge in users table
            $user->package_id  = $package->id;
            $user->save();
            Session::flash('success', 'Package Purchased Successfully');
            return response()->json(['status' => 'success' , 'message' => 'Payment successful']);
        } catch (\Exception $ex) {
            return response()->json(['status' => 'error' , 'message' => $ex->getMessage()]);
        }
    }
}
