<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Transcription;
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

}
