<?php

namespace App\Http\Controllers\ProofReader;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use App\Models\Transcription;

class TaskController extends Controller
{
    public function list(Request $request)
    {
        $search = $request['search'] ? $request['search'] : '';
        if ($search) {
            $tasks = Task::with('transcription')
                ->whereHas('transcription', function ($query) use ($search) {
                    $query->where('audio_file_name', 'LIKE', '%' . $search . '%');
                })
                ->orderBy('created_at', 'DESC')->paginate(10);
        } else {
            $tasks = Task::with('transcription')->orderBy('created_at', 'DESC')->paginate(10);
        }
        return view('proofReader.task.list', compact('tasks', 'search'));
    }
    public function claimedByProofReader(Request $request, $id)
    {
        try {
            $updateTask = Task::where('id', $id)->update([
                'claimed_by' => Auth::guard('reader')->user()->id,
                'claimed_dt' => Date::now(),
                'status' => $request->status,
            ]);
            if ($request->status == 'C') {
                $status = 'Claimed';
            } else {
                $status = 'Unclaimed';
            }
            alert()->success('success', 'You ' . $status . ' the task!');
            return redirect()->back();
        } catch (\Exception $ex) {
            alert()->success('error', $ex->getMessage());
            return redirect()->back();
        }
    }
 
    public function taskView($id)
    {
        $task =  Task::find($id);
        return view('proofReader.task-view', compact('task'));
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

    public function markAsComplete($id){
        $task = Task::find($id);
        $task->status = "Complete";
        $task->save();
        alert()->success('Success', 'Transcription Submitted');
        return redirect()->back();
    }

}
