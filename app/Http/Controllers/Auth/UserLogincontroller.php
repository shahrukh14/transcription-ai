<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLogincontroller extends Controller
{
  public function loginDetailsSubmit(Request $request)
  {
    if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
        return to_route('user.dashboard');
    } else {
        alert()->warning('Error', 'Incorrect Credentials');
        return redirect()->back();
    }
  }

}
