<?php

namespace App\Http\Controllers\ProofReader;

use Exception;
use App\Models\Task;
use App\Models\Transcription;
use Illuminate\Http\Request;
use App\Models\TaskClaimRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;


class TaskController extends Controller
{
    public function list(Request $request){
        $query = Task::where('claimed_by' , NULL)->with('transcription');

        // Search filter
        $search = $request->search ?? '';
        if ($search) {
            $query->whereHas('transcription', function ($q) use ($search) {
                $q->where('audio_file_original_name', 'LIKE', '%' . $search . '%');
            });
        }
        // Date filter
        $from = $request->from ? date('Y-m-d', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d', strtotime($request->to)) : null;

        if ($from && $to && $from <= $to) {
            $query->whereBetween('uploaded_dt', [$from, $to]);
        }
        //status filter claimed or unclaimed
         $status = $request->status ?? 'all';
        if ($status === 'claimed') {
            $query->whereNotNull('claimed_dt'); // Only claimed
        } elseif ($status === 'unclaimed') {
            $query->whereNull('claimed_dt');    // Only unclaimed
        }
        $tasks = $query->orderBy('created_at', 'DESC')->paginate(10);
        return view('proofReader.task.list', compact('tasks', 'search', 'from', 'to'));
    }

    public function myTask(Request $request){
        $query = TaskClaimRecord::where('proof_reader_id', auth()->guard('reader')->user()->id);

        // Date filtering
        $from = $request->from ? date('Y-m-d', strtotime($request->from)) : null;
        $to = $request->to ? date('Y-m-d', strtotime($request->to)) : null;

        if ($from && $to && $from <= $to) {
            $query->whereBetween('claim_date', [$from, $to]);
        }

        // Search filtering
        $search = $request->search;
        $status = $request->status ?? 'all';
        if ($status == 'Claimed' || $status == 'Unclaimed') {
            $query->where('status', $status);
        }

        $tasks = $query->orderBy('created_at', 'DESC')->paginate(10);
        return view('proofReader.task.my_tasks', compact('tasks', 'search', 'from', 'to'));
    }

    public function claimedByProofReader(Request $request, $id)
    {
        try {
            //check if already have a claimed task
            $claimedTask = Task::where('claimed_by', Auth::guard('reader')->user()->id)->where('status', 'Claimed')->get();
            if($claimedTask->count() > 0){
                alert()->warning('Error', "You already have a claimed task, You need to complete that before claiming another task.");
                return redirect()->back();
            }

            $task = Task::findOrFail($id);
            if($request->status == 'Claimed'){
                $task->claimed_by = Auth::guard('reader')->user()->id;
                $task->claimed_dt = Date::now();
            }else{
                $task->claimed_by = NULL;
                $task->claimed_dt = NULL;
            }
            $task->status = $request->status;
            $task->save();

            //Store task claim records
            $taskClaimRecord                    = new TaskClaimRecord();
            $taskClaimRecord->proof_reader_id   = auth()->guard('reader')->user()->id;
            $taskClaimRecord->task_id           = $id;
            $taskClaimRecord->claim_date        = Date::now();
            $taskClaimRecord->status            = $request->status;

            if($request->status == 'Claimed'){
                $taskClaimRecord->claim_date = Date::now();
                $taskClaimRecord->remark = "Task claimed by ".auth()->guard('reader')->user()->fullName();
            }

            if($request->status == 'Unclaimed'){
                $taskClaimRecord->unclaim_date = Date::now();
                $taskClaimRecord->remark = "Task unclaimed by ".auth()->guard('reader')->user()->fullName();
            }
            $taskClaimRecord->save();
           
            alert()->success('success', 'You ' . $request->status . ' the task!');
            return redirect()->back();
        } catch (\Exception $ex) {
            alert()->error('error', $ex->getMessage());
            return redirect()->back();
        }
    }
 
    public function taskView($id){
        $task =  Task::findOrFail($id);
        $allSpeakers = []; 
        $speakerCounter = 1;
        $transcription_segments =  $task->transcription_segments;
        foreach(json_decode($transcription_segments)??[] as $segment){
            if (!isset($allSpeakers[$segment->speaker])) {
                $allSpeakers[$segment->speaker] = $segment->speaker_name ?? 'Speaker ' . $speakerCounter++;
            }
        }
        return view('proofReader.task-view', compact('task','transcription_segments','allSpeakers'));
    }

    public function addSegment(Request $request, $id){
        $task = Task::findOrFail($id);
        $segments = json_decode($task->transcription_segments, true);

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
        $task->transcription_segments = json_encode($segments, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $task->save();

        alert()->success('Success', 'Segment added updated successfully');
        return redirect()->back();
    }

    public function updateTaskTranscription(Request $request, $id) {
        $task =  Task::find($id);
        $transcription = Transcription::findOrFail($task->transcription_id);

        if($task->transcription_segments == null){
            $segments = json_decode($transcription->transcription_segments, true); // decode as associative array
        }else{
            $segments = json_decode($task->transcription_segments, true); // decode as associative array
        }

        // Find and update the segment
        foreach ($segments as &$segment) {
            if ($segment['id'] == $request->segment_id) {
                $segment['text'] = $request->text;
                $segment['speaker'] = $request->speaker;
                break;
            }
        }
        // Save the updated segments back
        $task->transcription_segments = json_encode($segments, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $task->save();
        return response()->json([
            'status' =>'success',
            'message' =>'Transcription updated successfully',
        ]);
    }

    public function updateTranscriptionSpeaker(Request $request, $id){
        $task =  Task::find($id);
        $transcription = Transcription::findOrFail($task->transcription_id);

        if($task->transcription_segments == null){
            $segments = json_decode($transcription->transcription_segments, true); // decode as associative array
        }else{
            $segments = json_decode($task->transcription_segments, true); // decode as associative array
        }

        // Find and update the speaker only
        foreach ($segments as &$segment) {
            if ($segment['id'] == $request->segment_id) {
                $segment['speaker']      = $request->speaker;
                $segment['speaker_name'] = $request->speaker_name;
                break;
            }
        }
        // Save the updated segments back
        $task->transcription_segments = json_encode($segments, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $task->save();
        return response()->json([
            'status' =>'success',
            'message' =>'Speaker updated successfully',
        ]);
    }

    public function markAsComplete($id){
        $task                     = Task::find($id);
        $task->status             = "Completed";
        $task->task_complete_time = Date::now();
        $task->save();

        //Store task claim records
        $taskClaimRecord                    = new TaskClaimRecord();
        $taskClaimRecord->proof_reader_id   = auth()->guard('reader')->user()->id;
        $taskClaimRecord->task_id           = $id;
        $taskClaimRecord->completed_date    = Date::now();
        $taskClaimRecord->status            = "Completed";
        $taskClaimRecord->save();

        alert()->success('Success', 'Proof Reading Submitted');
        return redirect()->back();
    }

    public function renameTranscriptionSpeaker(Request $request){
        try {
            $task = Task::findOrFail($request->task_id);
            $segments = json_decode($task->transcription_segments);

            // Find and update the segment
            foreach ($segments as &$segment) {
                $segment->speaker_name = $request->input($segment->speaker) ?? null;
            }
            // Save the updated segments back
            $task->transcription_segments = json_encode($segments, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            $task->save();
            
            alert()->success('success', 'Speaker Renamed Successfully');
            return redirect()->back();
        } catch (\Exception $ex) {
            alert()->error('Error', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function getTranscription($id){
        try {
            $task = Task::findOrFail($id);
            $transcript = Transcription::findOrFail($task->transcription_id);
            $min_speakers = (int)$transcript->speakers;
            $max_speakers = (int)$transcript->speakers + 1;
            $authorizationToken = "Bearer ".env('WISHPER_API_KEY');

            // Check if the user wants to transcribe to English
            if($transcript->transcribe_to_english == 1){
                $transcribe_to_english = true; 
            }else{
                $transcribe_to_english = false;
            }

            $response = Http::withHeaders([
                'Authorization' => $authorizationToken,
            ])
            ->timeout(300)
            ->attach(
                'file',
                file_get_contents(public_path('user/audios/' . $task->audio_file_name)),
                $task->audio_file_name
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

            //Update task table
            $task->transcription_segments = json_encode($data['segments']);
            $task->transcripted           = 1;
            $task->save();

            return response()->json([
                'success' => true,
                'message' => "Transcription successfully done",
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'error' => true,
                'message' => $ex->getMessage()
            ]);
        }
    }

}
