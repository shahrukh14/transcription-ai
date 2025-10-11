<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProofReadingController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with('getProofreader')->where('status', 'complete');
        $search = $request->input('search');
        if ($request->has('search')) {
            $query->where('id', 'LIKE', "%$search%");
        }
        $query->orderBy('id', 'DESC');
        $tasks = $query->paginate(10);
        //return $tasks;
        return view('admin.proofReading.index', compact('tasks','search'));
    }
    public function view($id)
    {
        $tasks = Task::find($id);
        $segments = json_decode($tasks->transcription_segments, true);

        //return $segments;
        return view('admin.proofReading.view', compact('tasks', 'segments'));
    }

}
