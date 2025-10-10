<?php

namespace App\Http\Controllers;

use getID3;
use Illuminate\Http\Request;
use App\Models\Transcription;
use PhpOffice\PhpWord\PhpWord;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;


class TranscriptionController extends Controller
{
    public function audioUpload(Request $request) {
        try {
            $folderPath = public_path('user/audios');
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0777, true, true);
            }
            
            if ($request->hasFile('audio')) {
                $originalName = pathinfo($request->audio->getClientOriginalName(), PATHINFO_FILENAME);
                $audioName = $originalName . '_' . date('Ymdhis') . '.' . $request->audio->getClientOriginalExtension();
                // Move the file to public folder
                $request->file('audio')->move($folderPath, $audioName);

                // Get the duration of the audio file in seconds
                $audioPath = $folderPath . '/' . $audioName;
                $getID3 = new \getID3;
                $fileInfo = $getID3->analyze($audioPath);
                $duration = isset($fileInfo['playtime_seconds']) ? round($fileInfo['playtime_seconds']) : 0;

                $subscription = auth()->user()->currentSubscription; // Get the current subscription of the user

                // Check if user has reached the audio time limit
                $subscriptionAudioTimeLimit = ($subscription->audio_time_limit * 60); // convert to seconds
                $audioDurationWithCurrentPackage = auth()->user()->audioDurationWithCurrentPackage(); // in seconds
                $remainingDuration = $subscriptionAudioTimeLimit - $audioDurationWithCurrentPackage;
                if($remainingDuration < $duration){
                    // Delete the audio file from public path
                    File::delete($audioPath);
                    return response()->json([
                        'error' => true,
                        'message' => 'You have reached your audio time limit. Please upgrade your package to continue.',
                    ]);
                }

                //transcription limit validation
                if ($subscription->transcription_limit != 0) {// if transcription limit is set as 0 then its inlimited
                    $audioTrascriptionWithCurrentPackage = auth()->user()->audioTrascriptionWithCurrentPackage();
                    $remianingTranscription = $subscription->transcription_limit - $audioTrascriptionWithCurrentPackage;
                    if($remianingTranscription < 1){// Check if user has reached the transcription limit
                        // Delete the audio file from public path
                        File::delete($audioPath);
                        return response()->json([
                            'error' => true,
                            'message' => 'You have reached your transcription limit. Please upgrade your package to continue.',
                        ]);
                    }
                }
                
                // Store in database
                $transcription                           = new Transcription();
                $transcription->user_id                  = auth()->user()->id;
                $transcription->language                 = $request->language;
                $transcription->speakers                 = $request->speakers;
                $transcription->audio_file_name          = $audioName;
                $transcription->audio_file_duration      = $duration;
                $transcription->transcribe_with_package  = auth()->user()->currentSubscription->id;
                $transcription->save();
        
                return response()->json([
                    'success' => true,
                    'message' => 'Audio uploaded successfully',
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'No Audio file Found',
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'error' => true,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function renderTranscriptionTable(){
        try {
            //Get all the data
            $transcriptions = Transcription::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
            return view('user.transcription_table_body', compact('transcriptions'));
        } catch (\Exception $ex) {
            return response()->json([
                'error' => true,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function getTranscription(){
        try {
            // Get all the data which is not transcribed yet
            $transcriptions = Transcription::where('user_id', auth()->user()->id)->where('status', 0)->get();
            foreach ($transcriptions as $transcript) {
                // Generate public URL for the audio file
                $fileUrl = asset('user/audios/' . $transcript->audio_file_name);
                $min_speakers = (int)$transcript->speakers;
                $max_speakers = (int)$transcript->speakers + 1;
                $authorizationToken = "Bearer ".env('WISHPER_API_KEY');
    
                // API request to lemonfox for speech-to-text transcription
                // $response = Http::withHeaders([
                //     'Authorization' => $authorizationToken,
                // ])->timeout(300)->post('https://api.lemonfox.ai/v1/audio/transcriptions', [
                //     'file'           => $fileUrl, // Send the audio file URL
                //     'language'       => $transcript->language, // Dynamic language from DB
                //     'speaker_labels' => true, // Dynamic speakers from DB
                //     'min_speakers'   => $min_speakers, 
                //     'max_speakers'   => $max_speakers, 
                //     'response_format'=> 'verbose_json',
                // ]);

                $audioPath = public_path('user/audios/' . $transcript->audio_file_name); // Update if path is different
                $response = Http::withHeaders([
                    'Authorization' => "Bearer " . env('WISHPER_API_KEY'),
                ])->timeout(300)->attach(
                    'file', file_get_contents($audioPath), $transcript->audio_file_name
                )->post('https://api.lemonfox.ai/v1/audio/transcriptions', [
                    'language'       => $transcript->language,
                    'speaker_labels' => true,
                    'min_speakers'   => (int)$transcript->speakers,
                    'max_speakers'   => (int)$transcript->speakers + 1,
                    'response_format'=> 'verbose_json',
                ]);

    
                $data = $response->json();
                //Update transcript in table
                $transcript->transcription_from_api  = $data['text'];
                $transcript->status = 1;
                $transcript->save();
    
            }
    
            return response()->json([
                'success' => true,
                'message' => "Transcription request submitted successfully",
            ]);
    
        } catch (\Exception $ex) {
            return response()->json([
                'error' => true,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function transcriptionCallback(Request $request) {
        try {
            \Log::info('Transcription Callback Data:', $request->all());
            $transcription = Transcription::find($request->id);
            if (!$transcription) {
                return response()->json(['error' => true, 'message' => 'Transcription not found'], 404);
            }
    
            if ($request->status == 1) {
                // Successful transcription
                $transcription->transcription_from_api = $request->text;
                $transcription->status = 1;
            } else {
                // Error in transcription
                $transcription->status = 2; // Mark as failed
            }
    
            $transcription->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Transcription updated successfully',
            ]);
    
        } catch (\Exception $ex) {
            return response()->json([
                'error' => true,
                'message' => $ex->getMessage(),
            ]);
        }
    }
    
    

    public function editTranscription(Transcription $transcription){
        if($transcription->user_id != auth()->user()->id){
            alert()->error('error', 'You can not edit this Transcriptions');
            return redirect()->route('user.dashboard');
        }
        return view('user.transcription_edit', compact('transcription'));
    }

    public function updateTranscription(Request $request, $id) {
        $transcription = Transcription::find($id);

        if($transcription->user_id != auth()->user()->id){
            return redirect()->route('user.dashboard');
        }
        
        $transcription->transcription_from_api = $request->transcription_from_api;
        $transcription->save();
        alert()->success('Success', 'Transcription updated successfully');
        return redirect()->route('user.dashboard');
    }

    public function deleteTranscription(Transcription $transcription){
        if($transcription->user_id != auth()->user()->id){
            alert()->error('error', 'You can not delete this Transcriptions');
            return redirect()->route('user.dashboard');
        }
       
        $audioPath = public_path('user/audios/').$transcription->audio_file_name;
        File::delete($audioPath);
        $transcription->delete();
        return redirect()->route('user.dashboard');
    }

    public function transcriptionPDFdownload(Transcription $transcription){
        $pdf = Pdf::loadView('user.transcription_pdf', compact('transcription'));
        return $pdf->download("transcription.pdf");
    }

    public function transcriptionDOCXdownload(Transcription $transcription){
        $phpWord = new PhpWord();

        // Add a section
        $section = $phpWord->addSection();

        // Add audio file name to the section
        $section->addText("File Name : ".$transcription->audio_file_name, ['bold' => true]);

        // Add more content
        $section->addText($transcription->transcription_from_api);

        // Save to a file in public path
        $fileName = $transcription->audio_file_name.'.docx';
        $path = public_path($fileName);

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($path);

        // Download the file
        return response()->download($path)->deleteFileAfterSend(true);
    }
    
}
