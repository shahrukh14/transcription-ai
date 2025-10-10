<?php

namespace App\Http\Controllers;

use App\Models\Transcription;
use Illuminate\Http\Request;

class TranscribeController extends Controller
{
    public function list(Request $request)
    {
        $query = Transcription::with('getUserName', 'getPackage');
        if ($request->from && $request->to && $request->from <= $request->to) {
            $from = date('Y-m-d', strtotime($request->from));
            $to = date('Y-m-d', strtotime($request->to));
            $query->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
        }
        if ($request->has('search') && !empty($request->search)) {
            $searchTerms = explode(' ', $request->search);

            $query->whereHas('getUserName', function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->where(function ($query) use ($term) {
                        $query->where('first_name', 'LIKE', '%' . $term . '%')
                            ->orWhere('last_name', 'LIKE', '%' . $term . '%');
                    });
                }
            });
        }
        $transcriptions = $query->paginate(10);
        return view('admin.transcription.list', compact('transcriptions'));
    }

    public function details($id)
    {
        $detail = Transcription::find($id); 
        return view('admin.transcription.details', compact('detail'));
    }

}
