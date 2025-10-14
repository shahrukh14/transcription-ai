<?php

namespace App\Http\Controllers;

use DB;
use getID3;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AssessmentTest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;


class ProofReaderAssessmentsController extends Controller
{
    public function list(){
        $languages = DB::table('languages')->orderBy('name','ASC')->pluck('name')->toArray();
        return view('admin.proofReaders.assessments.list', compact('languages'));
    }

    public function get(){
        $tests = AssessmentTest::get();
        return view('admin.proofReaders.assessments.table', compact('tests'));
    }

    public function getAudioTranscription(){
        try {
            // Get all the data which is not transcribed yet
            $tests = AssessmentTest::where('transcription_status', 0)->get();
            foreach ($tests as $test) {
                // Generate public URL for the audio file
                $fileUrl = route('audio.download', ['path'=>'admin/assessments/audios/','filename' => $test->audio_file]);
                $min_speakers = 2;
                $max_speakers = 8;
                $authorizationToken = "Bearer ".env('WISHPER_API_KEY');

                // Check if the user wants to transcribe to English
                if($transcript->transcribe_to_english == 1){
                    $transcribe_to_english = true; 
                }else{
                    $transcribe_to_english = false;
                }
    
                // API request to lemonfox for speech-to-text transcription
                $response = Http::withHeaders([
                    'Authorization' => $authorizationToken,
                ])->timeout(300)->post('https://api.lemonfox.ai/v1/audio/transcriptions', [
                    'file'           => $fileUrl, // Send the audio file URL
                    'language'       => $test->language,
                    'speaker_labels' => true,
                    'translate'      => $transcribe_to_english,
                    'min_speakers'   => $min_speakers, 
                    'max_speakers'   => $max_speakers, 
                    'response_format'=> 'verbose_json',
                ]);

                $data = $response->json();
                //Update transcript in table
                $test->transcription_text              = $data['text'];
                $test->transcription_segments          = json_encode($data['segments'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                $test->transcription_original_segments = json_encode($data['segments'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                $test->transcription_status            = 1;
                $test->save();
            }
    
            return response()->json([
                'success' => true,
                'message' => "Transcription successfull",
            ]);
    
        } catch (\Exception $ex) {
            return response()->json([
                'error' => true,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function add(Request $request){
        try {
            //Create Folder if not exsits
            $folderPath = public_path('admin/assessments/audios');
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0777, true, true);
            }

            if ($request->hasFile('audio')) {
                $originalName = pathinfo($request->audio->getClientOriginalName(), PATHINFO_FILENAME);// Get file original name 
                $cleanedName = str_replace('_', ' ', $originalName); //For saving in table to show the user
                $audioName = Str::slug($originalName, '_') . '_' . date('Ymdhis') . '.' . $request->audio->getClientOriginalExtension();
                // Move the file to public folder
                $request->file('audio')->move($folderPath, $audioName);

                // Get the duration of the audio file in seconds
                $audioPath = $folderPath . '/' . $audioName;
                $getID3 = new \getID3;
                $fileInfo = $getID3->analyze($audioPath);
                $duration = isset($fileInfo['playtime_seconds']) ? round($fileInfo['playtime_seconds']) : 0;

                //Store in table
                $assessmentTest                             = new AssessmentTest();
                $assessmentTest->name                       = $request->name;
                $assessmentTest->audio_file                 = $audioName;
                $assessmentTest->test_duration              = $request->test_duration;
                $assessmentTest->audio_duration             = $duration;
                $assessmentTest->audio_language             = $request->audio_language;
                $assessmentTest->audio_file_original_name   = $cleanedName;
                $assessmentTest->assessment_type            = $request->assessment_type;
                $assessmentTest->save();
            }else{
                alert()->error('Audio Requied', 'Please select an audio file before submiting');
                return redirect()->back();
            }

            alert()->success('Success', 'Assessment test added successfully');
            return redirect()->route('admin.proof-reader.assessments.list');
        } catch (\Exception $ex) {
            alert()->error('Audio Requied', $ex->getMessage());
            return redirect()->back();
        }
        
    }
}
