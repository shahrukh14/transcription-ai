<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Wallet;
use Razorpay\Api\Api;

class WalletController extends Controller
{
    public function wallet(){
        $wallets = Wallet::where('user_id', auth()->user()->id)->get();
        return view('user.wallet', compact('wallets'));
    }

    public function initiatePayment(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => uniqid(),
            'amount' => $request->amount * 100, // in paise
            'currency' => 'INR',
            'payment_capture' => 1
        ]);

        return response()->json([
            'order_id' => $order['id'],
            'amount' => $order['amount'],
            'key' => env('RAZORPAY_KEY')
        ]);
    }

    public function paymentSuccess(Request $request){
        $payment_id = $request->razorpay_payment_id;
        $order_id   = $request->razorpay_order_id;
        $signature  = $request->razorpay_signature;

        //Store in wallet table
        $wallet          =  new Wallet();
        $wallet->user_id = auth()->id();
        $wallet->amount  = $request->amount;
        $wallet->type    = "credit";
        $wallet->save();

        // Add Money To users Balance
        $user = auth()->user();
        $user->balance += (int)$request->amount;
        $user->save();

        // Fetch Payment Details from Razorpay API
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($payment_id);
        
        //Save Transaction into database
        Transaction::create([
            'user_id'           => auth()->id(),
            'wallet_id'         => $wallet->id,
            'payment_id'        => $payment_id,
            'order_id'          => $order_id,
            'signature'         => $signature,
            'transaction_for'   => 'wallet',
            'amount'            => $payment->amount / 100, // convert from paisa to rupees
            'currency'          => $payment->currency,
            'remark'            => 'Add to Wallet',
        ]);

        return response()->json(['status' => 'success']);
    }
}
