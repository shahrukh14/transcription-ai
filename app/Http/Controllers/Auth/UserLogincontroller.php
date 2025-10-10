<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Carbon\carbon;
use App\Models\User;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserLogincontroller extends Controller
{
    public function signIn()
    {
        return view('user.sign_in');
    }
    
    public function loginDetailsSubmit(Request $request)
    {
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return to_route('user.dashboard');
        } else {
            alert()->warning('Error', 'Incorrect Credentials');
            return redirect()->back();
        }
    }

    public function signUp(){
        return view('user.sign_up');
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'password.required' => 'Password is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email field must be email address.'
        ]);
        try {
            //get free package
            $package = Package::first();

            $user              = new User();
            $user->first_name  = $request->first_name;
            $user->last_name   = $request->last_name;
            $user->email       = $request->email;
            $user->password    = Hash::make($request->password);
            $user->package_id  = $package->id;
            $user->save();

            //Login the user after registaion 
            Auth::login($user);
            
            //Free plan has no expiry date , so here for expiry date we adding 100 years from today
            $expiry_date = Carbon::now()->addYears(100)->toDateString();

            //Subscribe the free package for the new user
            $userSubscription               = new UserSubscription();
            $userSubscription->user_id      = $user->id;
            $userSubscription->package_id   = $package->id;
            $userSubscription->amount       = $package->amount;
            $userSubscription->expiry_date  = $expiry_date; 
            $userSubscription->save();

            alert()->success('Success', 'Registration Successful');
            return redirect()->route('user.dashboard');
        } catch (\Exception $exception) {
            alert()->error('Error', $exception->getMessage());
            return redirect()->back();
        }
    }
    

}
