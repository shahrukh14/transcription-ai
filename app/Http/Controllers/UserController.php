<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Task;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Transcription;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

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

    //for date filter from transaction table
    public function transaction(Request $request)
    {
        $query = Transaction::where('user_id', auth()->user()->id);

        //filter by the date range
        if ($request->from && $request->to && $request->from <= $request->to) {
            $from = date('Y-m-d', strtotime($request->from));
            $to = date('Y-m-d', strtotime($request->to));
            $query->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
        }

        $transactions = $query->paginate(10);
        return view('user.user-transaction', compact('transactions'));
    }
    //for user task table listing 
    public function proofReading(Request $request)
    {
        $query = Task::with('transcription');
        $query->whereHas('transcription', function ($q){
            $q->where(function ($query) {
                $query->where('user_id', auth()->user()->id);
            });
        });
        
        //filter by audio name
        if ($request->has('search') && !empty($request->search)){
            $searchTerms = explode(' ', $request->search);
            $query->whereHas('transcription', function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->where(function ($query) use ($term) {
                        $query->where('user_id', auth()->user()->id);
                        $query->where('audio_file_original_name', 'LIKE', '%' . $term . '%');
                    });
                }
            });
        }
        $tasks = $query->paginate(10);
        return view('user.task-listing', compact('tasks'));
    }

    public function proofReadingView($id){   
        $task = Task::find($id);
        if($task->transcription->user_id != auth()->user()->id){
            alert()->error('error', 'You do not have access for this view this task');
            return redirect()->route('user.proof.reading');
        }

        if($task->payment != "Paid"){
            alert()->error('error', 'You have to pay the proof reading amount to view this proof reading');
            return redirect()->route('user.proof.reading');
        }

        $allSpeakers = []; 
        $speakerCounter = 1;
        $transcription_segments =  $task->transcription_segments;
        foreach(json_decode($transcription_segments)??[] as $segment){
            if (!isset($allSpeakers[$segment->speaker])) {
                $allSpeakers[$segment->speaker] = 'Speaker ' . $speakerCounter++;
            }
        }
        return view('user.task_view', compact('task','allSpeakers'));
    }

    public function proofReadingCancel($id){ 
        //mark task as cancelled
        $task = Task::find($id);
        $task->status = "Cancelled";
        $task->save();

        //Update in Transcription
        $transcription = Transcription::find($task->transcription_id);
        $transcription->add_to_proofreading = 0;
        $transcription->save();

        alert()->success('success', 'Proof Reading Request Cancelled');
        return redirect()->back();
    }

    public function proofReadingPdfDownload(Request $request, $id){
        $task = Task::find($id); 
        $pdf = Pdf::loadView('user.proofreading_pdf', compact('task','request'));
        $fileName = $task->transcription->audio_file_original_name.".pdf";
        return $pdf->download($fileName);
    }

    public function proofReadingDocxDownload(Request $request, $id){
        $task = Task::find($id); 
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Add audio file name
        $section->addText("File Name: " . $task->transcription->audio_file_original_name, [
            'bold' => true,
            'size' => 14
        ]);

        // Prepare speaker map and counter
        $speakerMap = [];
        $speakerCounter = 1;

        $segments = json_decode($task->transcription_segments);

        if (!empty($segments)) {
            foreach ($segments as $segment) {
                $line = '';

                // Speaker mapping
                if (!isset($speakerMap[$segment->speaker])) {
                    $speakerMap[$segment->speaker] = 'Speaker ' . $speakerCounter++;
                }

                // Format timestamp
                $timeInSeconds = $segment->start;
                $minutes = floor($timeInSeconds / 60);
                $seconds = round($timeInSeconds % 60);
                $formattedTime = sprintf("%02d:%02d", $minutes, $seconds);

                // Build speaker + timestamp line if applicable
                if ($request->speaker == "true") {
                    $line .= $speakerMap[$segment->speaker];
                }

                if ($request->timestamp == "true") {
                    $line .= ($line ? ' ' : '') . "($formattedTime)";
                }

                // Add the speaker+timestamp line if it's not empty
                if (!empty($line)) {
                    $section->addText($line, ['bold' => true, 'color' => '333333']);
                }

                // Always add the actual spoken text
                $section->addText($segment->text, ['size' => 12]);
            }
        }

        // Save and download
        $fileName = $task->transcription->audio_file_original_name . '.docx';
        $path = public_path($fileName);

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($path);

        return response()->download($path)->deleteFileAfterSend(true);
    }

    //user profile update
    public function profile()
    {
        $users = Auth::user();
        return view('user.profile',compact("users"));
    }
    //update data
    public function profileUpdate(Request $request)
    {
        $users = Auth::user();
         //password
         if($request->password != ""){
            $password = Hash::make($request->password);
        }else{
            $password = $users->password;
        }
        //Image Upload 
        if ($request->hasFile('image')) {
            $folder_path = public_path('user/');
            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0777, true, true);
            }
            $imageName = date('Ymd') . '_' . rand() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move($folder_path, $imageName);
        }else{
            $imageName = $users->image;
        }
        $users->first_name =  $request->first_name;
        $users->last_name  =  $request->last_name;
        $users->email      =  $request->email;
        $users->mobile     =  $request->mobile;
        $users->image     =  $imageName;
        $users->password  =  $password;
        $users->save();
        alert()->success('success', 'Profile Updated Sucessfully');
        return redirect()->route('user.dashboard');
    }
    public function transactionInvoice($id){
        $transaction = Transaction::find($id);
        // return view('user.transaction_invoice', compact('transaction'));
        $pdf = Pdf::loadView('user.transaction_invoice', compact('transaction'));
        return $pdf->download('invoice.pdf');
    }

}
