<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Mail\AdminForgotPasswordOTP;
use App\Models\CreditDebit;
use App\Models\LifejacketSubscription;
use App\Models\MatrixDownline;
use App\Models\Notification;
use App\Models\Policy;
use App\Models\Ticket;
use App\Models\TicketChat;
use App\Models\UserRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Mail;
use App\Exports\LevelIncomeExport;
use App\Exports\ROIIncomeExport;
use App\Exports\TransactionExport;
use App\Models\giftTourismClaim;
use stdClass;
use Excel;

use function Laravel\Prompts\search;

class UserController extends Controller
{
    public function dashboard(Request $request)
    {
      return view('user.dashboard');
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        alert()->success('SuccessAlert', 'Successfully Logged Out');
        return to_route('login');
    }

}
