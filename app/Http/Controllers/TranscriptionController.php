<?php

namespace App\Http\Controllers;

use Log;
use getID3;
use Exception;
use App\Models\Task;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Transcription;
use PhpOffice\PhpWord\PhpWord;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Generalsettings;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;


class TranscriptionController extends Controller
{
    public function audioUpload(Request $request)
    {
        try {
            $folderPath = public_path('user/audios');
            File::ensureDirectoryExists($folderPath);

            if (!$request->hasFile('audio')) {
                return response()->json(['error' => true, 'message' => 'No file found.']);
            }

            $file = $request->file('audio');
            $mime = $file->getMimeType();
            $isVideo = str_starts_with($mime, 'video/');
            $isAudio = str_starts_with($mime, 'audio/');

            if (!$isAudio && !$isVideo) {
                return response()->json(['error' => true, 'message' => 'Only audio or video files are allowed.']);
            }

            $audio_code   = strtoupper(Str::random(10));
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanedName  = str_replace('_', ' ', $originalName);
            $timestamp    = now()->format('YmdHis');
            $extension    = $file->getClientOriginalExtension();
            $baseName     = Str::slug($originalName, '_') . '_' . $timestamp;

            $uploadedPath = $folderPath . '/' . $baseName . '.' . $extension;
            $file->move($folderPath, $baseName . '.' . $extension);

            $audioSourcePath = $uploadedPath;

            // Extract audio if it's a video
            if ($isVideo) {
                $extractedPath = $folderPath . '/' . $baseName . '_extracted.wav';
                $extractCmd = "ffmpeg -y -i \"$uploadedPath\" -vn -acodec pcm_s16le \"$extractedPath\"";
                shell_exec($extractCmd);

                if (!file_exists($extractedPath)) {
                    Log::error("Failed to extract audio from video: $uploadedPath");
                    File::delete($uploadedPath);
                    return response()->json(['error' => true, 'message' => 'Failed to extract audio from video.']);
                }

                // Delete original video after extracting audio
                File::delete($uploadedPath);
                $audioSourcePath = $extractedPath;
            }

            // Compress the audio
            $compressedPath = $folderPath . '/' . $baseName . '_compressed.aac';
            $cmd = "ffmpeg -y -i \"$audioSourcePath\" -acodec aac -b:a 64k \"$compressedPath\"";
            $output = shell_exec($cmd);

            if (!file_exists($compressedPath)) {
                Log::error("FFmpeg compression failed: " . $output);
                return response()->json(['error' => true, 'message' => 'Failed to compress audio.']);
            }

            // Delete source (extracted or original audio)
            File::delete($audioSourcePath);

            // Analyze duration
            $getID3 = new \getID3;
            $fileInfo = $getID3->analyze($compressedPath);
            $duration = isset($fileInfo['playtime_seconds']) ? (int) $fileInfo['playtime_seconds'] : 0;

            if ($duration <= 0) {
                Log::warning("getID3 failed to get duration for: " . $compressedPath);
                return response()->json(['error' => true, 'message' => "getID3 failed to get duration."]);
            }

            // Subscription Check
            $language = $request->language;
            $speakers = $request->speakers;
            $transcribeToEnglish = $request->transcribe_to_english;

            $subscription = auth()->user()->currentSubscription;
            $limitSecs = $subscription->audio_time_limit * 60;
            $usedSecs = auth()->user()->audioDurationWithCurrentPackage();

            if (($usedSecs + $duration) > $limitSecs) {
                File::delete($compressedPath);
                return response()->json(['error' => true, 'message' => 'You have reached your audio time limit.']);
            }

            if ($subscription->transcription_limit != 0) {
                $usedTrans = auth()->user()->audioTrascriptionWithCurrentPackage();
                $remainingTrans = $subscription->transcription_limit - $usedTrans;
                if ($remainingTrans < 1) {
                    File::delete($compressedPath);
                    return response()->json(['error' => true, 'message' => 'Transcription limit reached.']);
                }
            }

            // Save to DB
            $transcription                              = new Transcription();
            $transcription->user_id                     = auth()->user()->id;
            $transcription->audio_code                  = $audio_code;
            $transcription->language                    = $language;
            $transcription->speakers                    = $speakers;
            $transcription->audio_file_name             = basename($compressedPath);
            $transcription->audio_file_duration         = $duration;
            $transcription->transcribe_to_english       = $transcribeToEnglish;
            $transcription->audio_file_original_name    = $cleanedName;
            $transcription->transcribe_with_package     = $subscription->id;
            $transcription->save();

            return response()->json([
                'success' => true,
                'message' => 'Audio uploaded, compressed, and saved successfully.'
            ]);

        } catch (\Exception $ex) {
            Log::error('Audio upload error: ' . $ex->getMessage());
            return response()->json(['error' => true, 'message' => $ex->getMessage()]);
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

                // Check if the user wants to transcribe to English
                if($transcript->transcribe_to_english == 1){
                    $transcribe_to_english = true; 
                }else{
                    $transcribe_to_english = false;
                }
    
                // API request to lemonfox for speech-to-text transcription
                // $response = Http::withHeaders([
                //     'Authorization' => $authorizationToken,
                // ])->timeout(300)->post('https://api.lemonfox.ai/v1/audio/transcriptions', [
                //     'file'           => $fileUrl, // Send the audio file URL
                //     'language'       => $transcript->language,
                //     'speaker_labels' => true,
                //     'translate'      => $transcribe_to_english,
                //     'min_speakers'   => $min_speakers, 
                //     'max_speakers'   => $max_speakers, 
                //     'response_format'=> 'verbose_json',
                // ]);
                
                $response = Http::withHeaders([
                    'Authorization' => $authorizationToken,
                ])
                ->timeout(300)
                ->attach(
                    'file',
                    file_get_contents(public_path('user/audios/' . $transcript->audio_file_name)),
                    $transcript->audio_file_name
                )
                ->post('https://api.lemonfox.ai/v1/audio/transcriptions', [
                    'language'       => $transcript->language,
                    'speaker_labels' => true,
                    'translate'      => $transcribe_to_english,
                    'min_speakers'   => $min_speakers,
                    'max_speakers'   => $max_speakers,
                    'response_format'=> 'verbose_json',
                ]);

                $data = $response->json();
                //Update transcript in table
                $transcript->transcription_from_api          = $data['text'];
                $transcript->transcription_segments          = json_encode($data['segments']);
                $transcript->original_transcription_segments = json_encode($data['segments']);
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
        if($transcription->user_id != auth()->user()->id){
            alert()->error('error', 'You do not have access for this transcriptions');
            return redirect()->route('user.dashboard');
        }
        $allSpeakers = [];
        $speakerCounter = 1;
        $transcription_segments =  $transcription->transcription_segments;
        foreach(json_decode($transcription_segments)??[] as $segment){
            if (!isset($allSpeakers[$segment->speaker])) {
                $allSpeakers[$segment->speaker] = $segment->speaker_name ?? 'Speaker ' . $speakerCounter++;
            }
        }
        $proofreadingOnprogress = auth()->user()->proofReadings()->where('tasks.status', 'Claimed')->where('tasks.payment', 'Pending')->get();
        return view('user.transcription_view', compact('transcription','allSpeakers','proofreadingOnprogress'));
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
    
    public function addTranscriptionSegment(Request $request, $id){
        $transcription = Transcription::findOrFail($id);
        $segments = json_decode($transcription->transcription_segments, true);

        //New segment
        $newSegment = [
            "id"          => rand(10000000, 999999),
            "text"        => $request->text,
            "start"       => $request->start_time,
            "end"         => $request->end_time,
            "avg_logprob" => null,
            "language"    => $request->language,
            "speaker"     => $request->speaker,
            "words"       => []
        ];

        // Find the index to insert after $request->previous_segment_id;
        $insertAfterIndex = collect($segments)->search(fn($item) => $item['id'] == $request->previous_segment_id);

        // Insert and re-index
        if ($insertAfterIndex !== false) {
            array_splice($segments, $insertAfterIndex + 1, 0, [$newSegment]);

            // Reassign sequential IDs
            foreach ($segments as $index => &$segment) {
                $segment['id'] = $index;
            }
            unset($segment); // break reference (important)

        }

        //Update and save in table
        $transcription->transcription_segments = json_encode($segments, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $transcription->save();

        alert()->success('Success', 'Transcription updated successfully');
        return redirect()->back();
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
        return response()->json([
            'status' =>'success',
            'message' =>'Transcription Segment updated successfully',
        ]);
    }

    public function updateTranscriptionSpeaker(Request $request, $id) {
        $transcription = Transcription::findOrFail($id);
        // Decode existing segments
        $segments = json_decode($transcription->transcription_segments, true); // decode as associative array

        // Find and update the segment
        foreach ($segments as &$segment) {
            if ($segment['id'] == $request->segment_id) {
                $segment['speaker']      = $request->speaker;
                $segment['speaker_name'] = $request->speaker_name;
                break;
            }
        }
        // Save the updated segments back
        $transcription->transcription_segments = json_encode($segments, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $transcription->save();
        return response()->json([
            'status' =>'success',
            'message' =>'Transcription Speaker updated successfully',
        ]);
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
        }

        // Save and download
        $fileName = $transcription->audio_file_original_name . '.docx';
        $path = public_path($fileName);

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($path);

        return response()->download($path)->deleteFileAfterSend(true);
    }


    public function audioDownload($path, $filename){
        $filePath = public_path($path . $filename);
        return response()->download($filePath);
    }
    
    public function addToProofReading(Request $request, $id){       
        try {
            $transcription = Transcription::find($id);

            $generalsettings = Generalsettings::first();
            $audioBasePath = public_path('user/audios');

            // Attachment upload
            $fileNames = [];
            if ($request->hasFile('attachments')) {
                $folder_path = public_path('proofreading/attachments');
                if (!File::exists($folder_path)) {
                    File::makeDirectory($folder_path, 0777, true, true);
                }
                foreach ($request->attachments as $attachment) {
                    $filename = date('Ymd') . '_' . rand() . '.' . $attachment->getClientOriginalExtension();
                    $attachment->move($folder_path, $filename);
                    $fileNames[] = $filename;
                }
            }

            // Speaker Marking Check
            $speakerMarking = $request->speaker_marking == 1;

            // Duration per minute
            $proofReadingPerMinuteRate      = (int) $generalsettings->proof_reading_per_minute;
            $speakerMarkingPerMinuteRate    = (int) $generalsettings->speaker_marking_per_minute;
            $proofReadingTimePerMinute      = $generalsettings->proof_reading_time_duration;

            // Check if task already exist
            $existingTasks = Task::where('transcription_id', $id)->get();

            if ($existingTasks->count() > 0) {
                foreach ($existingTasks as $task) {
                    $audioDurationInMinutes = round($task->audio_duration / 60);
                    $price = $audioDurationInMinutes * $proofReadingPerMinuteRate;
                    if ($speakerMarking) {
                        $price += $audioDurationInMinutes * $speakerMarkingPerMinuteRate;
                    }
                    $totalProofTime = $audioDurationInMinutes * $proofReadingTimePerMinute;

                    $task->uploaded_dt                  = Date::now();
                    $task->price                        = $price;
                    $task->instruction                  = $request->instruction;
                    $task->attachment                   = json_encode($fileNames);
                    $task->status                       = NULL;
                    $task->transcription_segments       = $transcription->transcription_segments;
                    $task->proof_reading_time_duration  = $totalProofTime;
                    $task->save();
                }
            } else {
                // Split compressed audio
                $compressedFilePath = $audioBasePath . '/' . $transcription->audio_file_name;
                if (!File::exists($compressedFilePath)) {
                    alert()->error('Error', "Audio file not found.");
                    return redirect()->back();
                }

                $outputFolder = public_path('user/audios');
                if (!File::exists($outputFolder)) {
                    File::makeDirectory($outputFolder, 0777, true, true);
                }

                // Get duration
                $durationCmd    = "ffprobe -i \"$compressedFilePath\" -show_entries format=duration -v quiet -of csv=\"p=0\"";
                $duration       = (float) shell_exec($durationCmd);
                $chunkDuration  = (float) ($generalsettings->audio_split_duration * 60);
                $parts          = ceil($duration / $chunkDuration);

                $originalNameSlug = Str::slug(pathinfo($transcription->audio_file_original_name, PATHINFO_FILENAME));

                for ($i = 0; $i < $parts; $i++) {
                    $start          = $i * $chunkDuration;
                    $partFilename   = $originalNameSlug . '_part_' . ($i + 1) . '.aac';
                    $outputPath     = $outputFolder . '/' . $partFilename;

                    // Split chunk
                    $splitCmd = "ffmpeg -y -ss $start -t $chunkDuration -i \"$compressedFilePath\" -acodec aac -b:a 64k \"$outputPath\"";
                    shell_exec($splitCmd);

                    // Get chunk duration
                    $chunkDurationCmd   = "ffprobe -i \"$outputPath\" -show_entries format=duration -v quiet -of csv=\"p=0\"";
                    $chunkLength        = (float) shell_exec($chunkDurationCmd);
                    $chunkMinutes       = round($chunkLength / 60);

                    $price = $chunkMinutes * $proofReadingPerMinuteRate;
                    if ($speakerMarking) {
                        $price += $chunkMinutes * $speakerMarkingPerMinuteRate;
                    }

                    $proofTime = $chunkMinutes * $proofReadingTimePerMinute;

                    // Save task
                    $task                               = new Task();
                    $task->transcription_id             = $transcription->id;
                    $task->uploaded_dt                  = Date::now();
                    $task->audio_name                   = $transcription->audio_file_original_name . ' Part-' . ($i + 1);
                    $task->audio_file_name              = $partFilename;
                    $task->level                        = 1;
                    $task->price                        = $price;
                    $task->instruction                  = $request->instruction;
                    $task->attachment                   = json_encode($fileNames);
                    $task->audio_duration               = $chunkLength;
                    $task->proof_reading_time_duration  = $proofTime;
                    $task->save();
                }
            }

            //Update transcription
            $transcription->add_to_proofreading = 1;
            $transcription->save();

            alert()->success('Success', 'Your transcription has been added to proofreading.');
            return redirect()->back();

        } catch (\Exception $ex) {
            alert()->error('Error', $ex->getMessage());
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
            alert()->error('error', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function renameSpeaker(Request $request){
        try {
            $transcription = Transcription::findOrFail($request->transcription_id);
            $segments = json_decode($transcription->transcription_segments);

            // Find and update the segment
            foreach ($segments as &$segment) {
                $segment->speaker_name = $request->input($segment->speaker) ?? null;
            }
            // Save the updated segments back
            $transcription->transcription_segments = json_encode($segments, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            $transcription->save();
            
            alert()->success('success', 'Speaker Renamed Successfully');
            return redirect()->back();
        } catch (\Exception $ex) {
            alert()->error('Error', $ex->getMessage());
            return redirect()->back();
        }
    }

}
