<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Task;
use App\Models\ProofReader;
use Illuminate\Http\Request;
use App\Models\AssessmentTest;
use App\Models\ProofReaderTest;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProofReaderEmailVerification;


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

    public function pdfDownload(Request $request, $id){
        $task = Task::find($id); 
        $pdf = Pdf::loadView('user.proofreading_pdf', compact('task','request'));
        $fileName = $task->transcription->audio_file_original_name.".pdf";
        return $pdf->download($fileName);
    }

    public function docxDownload(Request $request, $id){
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

    public function login(Request $request){
        return view('proofReader.login');
    }

    public function loginSubmit(Request $request){
        if (Auth::guard('reader')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if(auth()->guard('reader')->user()->email_verified){
                if(auth()->guard('reader')->user()->status){
                    return redirect()->route('proof-reader.dashboard');
                }else{
                    return redirect()->route('proof-reader.assessment');
                }
            }else{
                Auth::guard('reader')->logout();
                alert()->error('Verification Required', 'Your email is not verified yet. Click on the link you get in email');
                return redirect()->back();
            }
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

    public function signUp(){
        return view('proofReader.sign_up');
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'mobile'     => 'required',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:8',
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required'  => 'Last name is required.',
            'mobile.required'     => 'Mobile number is required.',
            'password.required'   => 'Password is required.',
            'email.required'      => 'Email is required.',
            'email.email'         => 'Email field must be email address.'
        ]);
        try {
            $otp = rand(100000, 999999);
            $proofReader              = new ProofReader();
            $proofReader->first_name  = $request->first_name;
            $proofReader->last_name   = $request->last_name;
            $proofReader->email       = $request->email;
            $proofReader->mobile      = $request->mobile;
            $proofReader->password    = Hash::make($request->password);
            $proofReader->login_otp   = $otp;
            $proofReader->save();

            //Email verification mail send
            $params = [
                'email'   => $proofReader->email ,
                '_token' => base64_encode($otp) ,
            ];
            $mailData = [
                'title'     => 'Email Verification',
                'message'   => 'Click on the link below and verify your email',
                'link'      =>  route('proof-reader.email.verification', $params),
            ];
            Mail::to($proofReader->email)->send(new ProofReaderEmailVerification($mailData));

            alert()->success('Success', 'Registration Successful');
            return redirect()->route('proof-reader.register.success');
        } catch (\Exception $exception) {
            alert()->error('Error', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function registerSuccess(){
        return view('proofReader.register_success');
    }

    public function emailVerification(Request $request){
        try {
            $proofReader = ProofReader::where('email', $request->email)
                            ->where('login_otp', base64_decode($request->_token))
                            ->where('email_verified', 0)
                            ->first();
            if($proofReader){
                $proofReader->login_otp = null;
                $proofReader->email_verified = 1;
                $proofReader->save();
                alert()->success('Verification Successful', 'Now you can login to your account');
                return redirect()->route('proof-reader.login');
            }else{
                alert()->error('Invalid Link', 'The link has been expired or invalid');
                return redirect()->route('proof-reader.login');
            }
        } catch (\Exception $exception) {
            alert()->error('Error', $exception->getMessage());
            return redirect()->back();
        }
    }


    public function assessment(){
        $tests = AssessmentTest::get();
        return view('proofReader.assessment', compact('tests')); 
    }

    public function assessmentTest($id){
        $assessmentTest = AssessmentTest::find($id);
        $test = ProofReaderTest::where('user_id', auth()->guard('reader')->user()->id)->where('assessment_tests_id', $id)->first();
        if(!$test){
            $test                           = new ProofReaderTest();
            $test->user_id                  = auth()->guard('reader')->user()->id;
            $test->assessment_tests_id      = $id;
            $test->start_time               = \Carbon\Carbon::now();
            $test->transcription_segments   = $assessmentTest->transcription_segments;
            $test->save();
        }
        $allSpeakers = []; 
        $speakerCounter = 1;
        $transcription_segments =  $test->transcription_segments;
        foreach(json_decode($transcription_segments)??[] as $segment){
            if (!isset($allSpeakers[$segment->speaker])) {
                $allSpeakers[$segment->speaker] = 'Speaker ' . $speakerCounter++;
            }
        }
        return view('proofReader.assessment_test', compact('assessmentTest','test','allSpeakers')); 
    }

    public function assessmentTestSegmentUpdate(Request $request, $id){
        $proofReaderTest = ProofReaderTest::find($id);
        // Decode existing segments
        $segments = json_decode($proofReaderTest->transcription_segments, true); // decode as associative array

        // Find and update the segment
        foreach ($segments as &$segment) {
            if ($segment['id'] == $request->segment_id) {
                $segment['text'] = $request->text;
                $segment['speaker'] = $request->speaker;
                break;
            }
        }
        // Save the updated segments back
        $proofReaderTest->transcription_segments = json_encode($segments, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $proofReaderTest->save();
        return response()->json([
            'status' =>'success',
            'message' =>'Transcription Segment updated successfully',
        ]);
    }

    public function assessmentTestFinalSubmit(Request $request, $id){
        try{
            $proofReaderTest = ProofReaderTest::find($id);
            if ($request->hasFile('attachments')) {
                $folder_path = public_path('admin/assessments/test/documents');
                if (!File::exists($folder_path)) {
                    File::makeDirectory($folder_path, 0777, true, true);
                }
                $filename = 'Document'. '_' . rand() . '.' . $request->attachments->getClientOriginalExtension();
                $request->attachments->move($folder_path, $filename);
            }else{
                $filename = null;
            }
            $proofReaderTest->submit_time = \Carbon\Carbon::now();
            $proofReaderTest->attachments = $filename;
            $proofReaderTest->save();
       
            alert()->success('Success', 'Test Submitted successfully');
            return redirect()->route('proof-reader.assessment');
        } catch (\Exception $exception){
            alert()->error('Error', $exception->getMessage());
            return redirect()->back();
        }
    }
}
