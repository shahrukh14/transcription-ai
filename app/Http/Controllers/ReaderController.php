<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReaderController extends Controller
{
    public function dashboard(){
        return view('proofReader.dashboard');
    }

    public function login(Request $request){
        return view('proofReader.login');
    }

    public function loginSubmit(Request $request){
        if (Auth::guard('reader')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('proof-reader.dashboard');
        } else {
            alert()->error('Error', 'Incorrect Credentials');
            return redirect()->back();
        }
    }

    public function logout(){
        Auth::guard('reader')->logout();
        alert()->success('Success', 'Successfully Logged Out');
        return to_route('proof-reader.login');
    }
}
