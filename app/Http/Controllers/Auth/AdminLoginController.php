<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Mail\AdminForgotPasswordOTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{

  public function login(){
    return view('admin.login');
  }
  public function loginDetailsSubmit(Request $request)
  {
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
          return to_route('admin.dashboard');
      } else {
          alert()->warning('WarningAlert', 'Incorrect Credentials');
          return redirect()->back();
      }
  }
  public function forgotPasswordForm()
  {
      return view('admin.forgot_password');
  }

  public function sendOtp(Request $request)
  {
      $admin =  Admin ::where('email', $request->email)->first();
      $otp = rand(100000, 999999);
      if ($admin) {
          $admin->login_otp = $otp;
          $admin->save();

          $mailData = [
              'title' => 'Verification Code',
              'body' => 'Use this code ' . $otp . ' for verification and reset your password'
          ];

          Mail ::to($admin->email)->send(new AdminForgotPasswordOTP($mailData));
          Session ::flash('message', 'OTP successfully sent to your E-mail');
          Session::flash('alert-class', 'alert-success');
          return view('admin.otp_verification', compact('admin'));
      } else {
          Session::flash('message', 'No User Found');
          Session::flash('alert-class', 'alert-danger');
          return redirect()->back();
      }
  }

  public function otpVerification(Request $request)
  {
      $admin =  Admin::where('id', $request->admin_id)->first();
      if ($admin->login_otp == $request->otp) {
          session()->put('admin', $admin);
          Session::flash('message', 'OTP Matched');
          Session::flash('alert-class', 'alert-success');
          return to_route('admin.reset.password');
      } else {
          Session::flash('message', 'Invalid OTP');
          Session::flash('alert-class', 'alert-danger');
          return view('admin.otp_verification', compact('admin'));
      }
  }

  public function resetPasswordform()
  {
      $admin = session('admin');
      return view('admin.reset_password', compact('admin'));
  }

  public function resetPassword(Request $request)
  {

      $this->validate($request, [
          'password' => 'required|confirmed|',
          'password_confirmation' => 'required'
      ], [
          'password.confirmed' => 'Password And confirm password does not matched'
      ]);

      $admin =  Admin::where('id', $request->admin_id)->first();
      $admin->password = Hash::make($request->password);
      $admin->save();
      session()->forget('admin');
      Session::flash('message', 'Password Reset Successfully');
      Session::flash('alert-class', 'alert-success');
      return view('admin.login');
  }
  public function logout()
  {
      session()->flush();
      Auth::guard('admin')->logout();
      alert()->success('SuccessAlert', 'Successfully Logged Out');
      return to_route('admin.login');
  }
}
