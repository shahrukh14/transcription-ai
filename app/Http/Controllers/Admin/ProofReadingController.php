<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Task;
use App\Models\Wallet;
use App\Models\ProofReader;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProofReadingController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with('getProofreader');
        $search = $request->input('search');
        if ($request->has('search')) {
            $query->where('id', 'LIKE', "%$search%");
        }
        if ($request->from && $request->to && $request->from <= $request->to) {
            $from = date('Y-m-d', strtotime($request->from));
            $to = date('Y-m-d', strtotime($request->to));
            $query->whereDate('uploaded_dt', '>=', $from)->whereDate('uploaded_dt', '<=', $to);
        }
        $query->orderBy('id', 'DESC');
        $tasks = $query->paginate(10);
        return view('admin.proofReading.index', compact('tasks','search'));
    }
    
    public function view($id){
        $task = Task::find($id);
        $proofReaders = ProofReader::get();
        $segments = json_decode($task->transcription_segments);
        $allSpeakers = []; 
        $speakerCounter = 1;
        foreach($segments as $segment){
            if (!isset($allSpeakers[$segment->speaker])) {
                $allSpeakers[$segment->speaker] = $segment->speaker_name ?? 'Speaker ' . $speakerCounter++;
            }
        }
        return view('admin.proofReading.view', compact('task','segments','allSpeakers','proofReaders'));
    }

    public function assignProofreader(Request $request, $id){
        $task = Task::find($id);
        $task->claimed_by = $request->claimed_by;
        $task->save();
        alert()->success('success', 'Proof reader assign successfully');
        return redirect()->back();
    }

    public function priceUpdate(Request $request, $id){
        $task = Task::find($id);
        if($request->price && $request->price > 0){
            $task->price = $request->price;
        }
        $task->save();
        alert()->success('success', 'Proof reading price updated successfully');
        return redirect()->back();
    }

    public function approve(Request $request, $id){
        try {
            $task = Task::find($id);
            //document upload
            if ($request->hasFile('document')) {
                $folder_path = public_path('proofreading/documents');
                if (!File::exists($folder_path)) {
                    File::makeDirectory($folder_path, 0777, true, true);
                }
                $filename = $task->transcription->audio_file_original_name. '_' . rand() . '.' . $request->document->getClientOriginalExtension();
                $request->document->move($folder_path, $filename);
            }else{
                $filename = null;
            }

            //Update tasks
            $task->status           = "Completed";
            $task->admin_approved   = 1;
            $task->document         = $filename;
            $task->payment          = "Paid";
            $task->save();

            $amount = (int)$task->price;//Amount
            $user = $task->transcription->getUserName; // get user

            //Store in wallet table
            $wallet             =  new Wallet();
            $wallet->user_id    = $user->id;
            $wallet->amount     = $amount;
            $wallet->type       = "debit";
            $wallet->save();
            
            //Save Transaction into table
            Transaction::create([
                'user_id'           => $user->id,
                'wallet_id'         => $wallet->id,
                'transaction_for'   => 'wallet',
                'amount'            => $amount,
                'currency'          => "INR",
                'remark'            => 'Proof Reading Chargers',
            ]);
        
            // update  user's Balance
            $user->balance -= $amount;
            $user->save();

            alert()->success('success', 'Proof Reading Approved');
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

}
