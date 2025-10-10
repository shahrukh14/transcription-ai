<?php

namespace App\Http\Controllers;

use App\Models\Task;
use getID3;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Transcription;
use PhpOffice\PhpWord\PhpWord;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Date;
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
                $cleanedName = str_replace('_', ' ', $originalName); //For saving in table to show the user
                $audioName = Str::slug($originalName, '_') . '_' . date('Ymdhis') . '.' . $request->audio->getClientOriginalExtension();
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
                $transcription                              = new Transcription();
                $transcription->user_id                     = auth()->user()->id;
                $transcription->language                    = $request->language;
                $transcription->speakers                    = $request->speakers;
                $transcription->audio_file_name             = $audioName;
                $transcription->audio_file_duration         = $duration;
                $transcription->transcribe_to_english       = $request->transcribe_to_english;
                $transcription->audio_file_original_name    = $cleanedName;
                $transcription->transcribe_with_package     = auth()->user()->currentSubscription->id;
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
                $fileUrl = route('audio.download', ['filename' => $transcript->audio_file_name]);
                $min_speakers = (int)$transcript->speakers;
                $max_speakers = (int)$transcript->speakers + 1;
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
                    'language'       => $transcript->language,
                    'speaker_labels' => true,
                    'translate'      => $transcribe_to_english,
                    'min_speakers'   => $min_speakers, 
                    'max_speakers'   => $max_speakers, 
                    'response_format'=> 'verbose_json',
                ]);

                $data = $response->json();
                //Update transcript in table
                $transcript->transcription_from_api  = $data['text'];
                $transcript->transcription_segments  = json_encode($data['segments']);
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

    public function viewTranscription(Transcription $transcription){
        // return $transcription->transcription_segments;
        if($transcription->user_id != auth()->user()->id){
            alert()->error('error', 'You do not have access for this transcriptions');
            return redirect()->route('user.dashboard');
        }
        return view('user.transcription_view', compact('transcription'));
    }

    public function editTranscription(Transcription $transcription){
        if($transcription->user_id != auth()->user()->id){
            alert()->error('error', 'You do not have access for this transcriptions');
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

    public function updateTranscriptionSegment(Request $request, $id) {
        $transcription = Transcription::findOrFail($id);
        // Decode existing segments
        $segments = json_decode($transcription->transcription_segments, true); // decode as associative array

        // Find and update the segment
        foreach ($segments as &$segment) {
            if ($segment['id'] == $request->segment_id) {
                $segment['text'] = $request->text;
                $segment['speaker'] = $request->speaker;
                break;
            }
        }
        // Save the updated segments back
        $transcription->transcription_segments = json_encode($segments, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $transcription->save();
        alert()->success('Success', 'Transcription Segment updated successfully');
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

    public function transcriptionPDFdownload(Request $request, Transcription $transcription){
        $pdf = Pdf::loadView('user.transcription_pdf', compact('transcription','request'));
        $fileName = $transcription->audio_file_original_name.".pdf";
        return $pdf->download($fileName);
    }

    public function transcriptionDOCXdownload(Request $request, Transcription $transcription){
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Add audio file name
        $section->addText("File Name: " . $transcription->audio_file_original_name, [
            'bold' => true,
            'size' => 14
        ]);

        // Prepare speaker map and counter
        $speakerMap = [];
        $speakerCounter = 1;

        $segments = json_decode($transcription->transcription_segments);

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
        } else {
            $section->addText("No transcription segments found.");
        }

        // Save and download
        $fileName = $transcription->audio_file_original_name . '.docx';
        $path = public_path($fileName);

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($path);

        return response()->download($path)->deleteFileAfterSend(true);
    }


    public function audioDownload($filename){
        $filePath = public_path('user/audios/' . $filename);
        return response()->download($filePath);
    }
    
    public function appToProofReading($id)
    {
        try {
            $transcription = Transcription::where('id', $id)->update([
                'add_to_proofreading' => 1
            ]);

            $addToTasks                 = new Task();
            $addToTasks->audio_id       = $id;
            $addToTasks->uploaded_dt    = Date::now();
            $addToTasks->level          = 1;
            $addToTasks->save();
            alert()->success('success', 'Your transcription has beed added to proof reading.');
            return redirect()->back();
        } catch (\Exception $ex) {
            alert()->success('error', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function renameFile(Request $request){
        try {
            $transcription = Transcription::where('id', $request->transcription_id)->update([
                'audio_file_original_name' => $request->name
            ]);
            alert()->success('success', 'File Renamed Successfully');
            return redirect()->back();
        } catch (\Exception $ex) {
            alert()->success('error', $ex->getMessage());
            return redirect()->back();
        }
    }
}
