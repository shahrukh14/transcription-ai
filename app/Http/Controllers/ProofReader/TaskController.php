<?php

namespace App\Http\Controllers\ProofReader;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class TaskController extends Controller
{
    public function list(Request $request)
    {
        $search = $request['search'] ? $request['search'] : '';
        if ($search) {
            $tasks = Task::with('getTranscriptionDetails')
                ->whereHas('getTranscriptionDetails', function ($query) use ($search) {
                    $query->where('audio_file_name', 'LIKE', '%' . $search . '%');
                })
                ->orderBy('created_at', 'DESC')->paginate(10);
        } else {
            $tasks = Task::with('getTranscriptionDetails')->orderBy('created_at', 'DESC')->paginate(10);
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
}
