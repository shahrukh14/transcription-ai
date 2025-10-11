<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class ReaderController extends Controller
{
    public function dashboard(){
        return view('proofReader.dashboard');
    }

    public function profile(){
        $reader = auth()->guard('reader')->user();
        return view('proofReader.profile', compact('reader'));
    }

    public function profileUpdate(Request $request){
        try {
            $reader = auth()->guard('reader')->user();
            //password
            if($request->password != ""){
                $password = Hash::make($request->password);
            }else{
                $password = $reader->password;
            }
            //Image Upload 
            if ($request->hasFile('image')) {
                $folder_path = public_path('admin/proofreaders/');
                if (!File::exists($folder_path)) {
                    File::makeDirectory($folder_path, 0777, true, true);
                }
                $imageName = date('Ymd') . '_' . rand() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($folder_path, $imageName);
            }else{
                $imageName = $reader->image;
            }
            $reader->first_name  = $request->first_name;
            $reader->last_name   = $request->last_name;
            $reader->mobile      = $request->mobile;
            $reader->password    = $password;
            $reader->image       = $imageName;
            $reader->save();

            alert()->success('success', 'Profile Updated Sucessfully');
            return redirect()->back();
        } catch (\Exception $ex) {
            alert()->error('error', $ex->getMessage());
            return redirect()->back();
        }
       
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
