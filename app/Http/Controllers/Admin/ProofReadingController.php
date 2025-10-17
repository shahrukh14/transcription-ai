<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Task;
use App\Models\Wallet;
use App\Models\ProofReader;
use App\Models\Transaction;
use \App\Models\Generalsettings;
use Illuminate\Http\Request;
use App\Models\TaskClaimRecord;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\ProofReadingInvoice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProofReadingController extends Controller
{
    public function index(Request $request)
    {
        $query  = Task::with('getProofreader');
        $search = $request->input('search');
        if ($request->has('search')){
            $query->where('id', 'LIKE', "%$search%");
        }
        if ($request->from && $request->to && $request->from <= $request->to) {
            $from   = date('Y-m-d', strtotime($request->from));
            $to     = date('Y-m-d', strtotime($request->to));
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
            $user = $task->transcription->getUserName; // get user

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

            //Proof Reader invoice update
            $proofReadingInvoice = ProofReadingInvoice::where('proof_reader_id', $task->claimed_by)->where('month', date('M'))->where('year', date('Y'))->first();
            if($proofReadingInvoice){
                $proofReadingInvoice->amount = (int)$proofReadingInvoice->amount + (int)$amount;
                $proofReadingInvoice->save();
            }else{
                // Generate invoice number
                $lastInvoice = ProofReadingInvoice::orderBy('id', 'desc')->first();
                $lastNumber = $lastInvoice ? (int) str_replace('INV-', '', $lastInvoice->invoice_number) : 1000;
                $newInvoiceNumber = 'INV-' . ($lastNumber + 1);

                $proofReadingInvoice                    = new ProofReadingInvoice();
                $proofReadingInvoice->proof_reader_id   = $task->claimed_by;
                $proofReadingInvoice->amount            = $amount;
                $proofReadingInvoice->cf_amount         = 0;
                $proofReadingInvoice->month             = date('M');
                $proofReadingInvoice->year              = date('Y');
                $proofReadingInvoice->status            = 0;
                $proofReadingInvoice->invoice_number    = $newInvoiceNumber;
                $proofReadingInvoice->save();
            }

            alert()->success('success', 'Proof Reading Approved');
            return redirect()->back();
        } catch (\Exception $ex) {
            alert()->error('error', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function reject(Request $request, $id){
        $task = Task::find($id);
       
        //Store task claim records
        $taskClaimRecord                    = new TaskClaimRecord();
        $taskClaimRecord->proof_reader_id   = $task->claimed_by;
        $taskClaimRecord->task_id           = $id;
        $taskClaimRecord->status            = "Rejected";
        $taskClaimRecord->remark            = $request->reject_reason;
        $taskClaimRecord->save();

        //Update tasks
        $task->claimed_by                   = NULL;
        $task->claimed_dt                   = NULL;
        $task->status                       = "Rejected";
        $task->proof_reading_time_duration  = $request->proof_reading_time_duration;
        $task->save();

        alert()->success('success', 'Proof Reading Rejected');
        return redirect()->back();
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

    public function invoice(Request $request){
        if($request->month && $request->month!=''){
            $filterMonth = $request->month;
        }else{
            $filterMonth = date('M');
        }

        if($request->year && $request->year!=''){
            $filterYear = $request->year;
        }else{
            $filterYear = date('Y');
        }

        $currentYear    = now()->year;
        $invoices       = ProofReadingInvoice::where('month', $filterMonth)->where('year', $filterYear)->paginate(20);
        $months         = collect(range(1, 12))->map(fn($m) => date('M', mktime(0, 0, 0, $m, 1)))->toArray();
        $years          = collect(range($currentYear - 2, $currentYear))->values()->toArray();
        return view('admin.proofReading.invoice', compact('invoices','months','years','filterMonth', 'filterYear'));
    }

    public function invoiceDetails($id){
        $invoice = ProofReadingInvoice::find($id);
        $month = date('m', strtotime($invoice->month));
        $year  = $invoice->year;
        $tasks = Task::where('claimed_by', $invoice->proof_reader_id)->where('status', 'Completed')->whereYear('task_complete_time', $year)->whereMonth('task_complete_time', $month)->paginate(20);
        return view('admin.proofReading.invoice_deatils', compact('invoice', 'tasks'));
    }

    public function invoiceDownload($id){
        $invoice = ProofReadingInvoice::find($id);
        $month = date('m', strtotime($invoice->month));
        $year  = $invoice->year;
        $tasks = Task::where('claimed_by', $invoice->proof_reader_id)->where('status', 'Completed')->whereYear('task_complete_time', $year)->whereMonth('task_complete_time', $month)->paginate(20);
        $settings = Generalsettings::first();
        $pdf = Pdf::loadView('admin.proofReading.invoice_pdf', compact('invoice','tasks', 'settings'));
        $fileName = $invoice->proofReader->fullName()."_".$invoice->month."_".$invoice->year ."_invoice.pdf";
        return $pdf->stream($fileName);
    }

    public function statusUpdate(Request $request, $id){
        $request->validate([
            'file'   => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'remark' => 'nullable|string|max:255',
        ]);
        $invoice = ProofReadingInvoice::find($id);
            if($request->status == 2){
                $amount = (int)$invoice->amount + (int)$invoice->cf_amount;
                $invoice->status = 2;
            $invoice->remark = $request->remark ?? null;
            // file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('admin/invoice'), $filename);
                $invoice->file = 'admin/invoice/' . $filename;
            }
            $invoice->save();

            $proofReadingInvoice                    = new ProofReadingInvoice();
            $proofReadingInvoice->proof_reader_id   = $invoice->proof_reader_id;
            $proofReadingInvoice->amount            = 0;
            $proofReadingInvoice->cf_amount         = $amount;
            $proofReadingInvoice->month             = date('M');
            $proofReadingInvoice->year              = date('Y');
            $proofReadingInvoice->status            = 0;
            $proofReadingInvoice->save();
        }else{
            $invoice->status = 1;
            $invoice->remark = $request->remark ?? null;
            
            if ($request->hasFile('file')) {
                $path = $request->file('file')->store('invoices', 'public');
                $invoice->file = $path;
            }
            $invoice->save();
        }

        alert()->success('success', 'Payment Status Updated');
        return redirect()->back();
    }
}
