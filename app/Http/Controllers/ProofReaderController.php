<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ProofReader;
use Illuminate\Http\Request;
use App\Models\ProofReaderTest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProofReaderController extends Controller
{
    public function list(Request $request){
        $query = ProofReader::query();
        $search = $request->input('search');
        if ($request->has('search')) {
            $query->where('first_name', 'LIKE', "%$search%")->orWhere('last_name', 'LIKE', "%$search%");
        }
        $query->orderBy('id', 'DESC');
        $proofReaders = $query->paginate(10);
        return view('admin.proofReaders.list',compact('proofReaders','search'));
    }

    public function add(){
        return view('admin.proofReaders.add');
    }

    public function insert(Request $request){
        try {
            //Image Upload 
            if ($request->hasFile('image')) {
                $folder_path = public_path('admin/proofreaders/');
                if (!File::exists($folder_path)) {
                    File::makeDirectory($folder_path, 0777, true, true);
                }
                $imageName = date('Ymd') . '_' . rand() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($folder_path, $imageName);
            }

            $proofReader                   = new ProofReader();
            $proofReader->first_name       = $request->first_name;
            $proofReader->last_name        = $request->last_name;
            $proofReader->email            = $request->email;
            $proofReader->mobile           = $request->mobile;
            $proofReader->password         = Hash::make($request->password);
            $proofReader->image            = $imageName;
            $proofReader->save();
            alert()->success('Success', 'Proof Reader Added Successfully');
            return redirect()->route('admin.proof-reader.list');
        } catch (\Exception $ex) {
            alert()->error('error', $ex->getMessage());
            return back();
        }
    }

    public function edit($id){
        $proofReader = ProofReader::find($id);
        return view('admin.proofReaders.edit', compact('proofReader'));
    }

    public function update(Request $request, $id){
        try {
            $proofReader = ProofReader::find($id);

            //Image Upload 
            if ($request->hasFile('image')) {
                $folder_path = public_path('admin/proofreaders/');
                if (!File::exists($folder_path)) {
                    File::makeDirectory($folder_path, 0777, true, true);
                }
                $imageName = date('Ymd') . '_' . rand() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($folder_path, $imageName);
            }else{
                $imageName = $proofReader->image;
            }

            $proofReader->first_name       = $request->first_name;
            $proofReader->last_name        = $request->last_name;
            $proofReader->email            = $request->email;
            $proofReader->mobile           = $request->mobile;
            $proofReader->image            = $imageName;
            $proofReader->save();
            alert()->success('Success', 'Proof Reader updated Successfully');
            return redirect()->route('admin.proof-reader.list');
        } catch (\Exception $ex) {
            alert()->error('error', $ex->getMessage());
            return back();
        }
    }

    public function delete($id){
        $proofReader = ProofReader::find($id);
        $proofReader->delete();
        alert()->success('Success', 'Proof Reader deleted Successfully');
        return redirect()->route('admin.proof-reader.list');
    }

    public function recruitmentList(Request $request){
        $query = ProofReader::where('status', 0);
        $search = $request->input('search');
        if ($request->has('search')) {
            $query->where('first_name', 'LIKE', "%$search%")->orWhere('last_name', 'LIKE', "%$search%");
        }
        $query->orderBy('id', 'DESC');
        $proofReaders = $query->paginate(20);
        return view('admin.proofReaders.recruitment', compact('proofReaders','search'));
    }

    public function recruitmentTest($id){
        $test = ProofReaderTest::findOrFail($id);
        $allSpeakers = []; 
        $speakerCounter = 1;
        $transcription_segments =  $test->transcription_segments;
        foreach(json_decode($transcription_segments)??[] as $segment){
            if (!isset($allSpeakers[$segment->speaker])) {
                $allSpeakers[$segment->speaker] = 'Speaker ' . $speakerCounter++;
            }
        }
        return view('admin.proofReaders.recruitment_test', compact('test','allSpeakers'));
    }

    public function recruitmentTestApprove($id){
        $test = ProofReaderTest::findOrFail($id);
        $test->status = 1;
        $test->save();

        $proofReader = ProofReader::findOrFail($test->user_id);
        if($test->assessment->assessment_type == 1){
            $proofReader->assessment_1_status = 1;
        }

        if($test->assessment->assessment_type == 2){
            $proofReader->assessment_2_status = 1;
            $proofReader->status = 1;
        }
        $proofReader->save();
        alert()->success('Success', 'Assessment Approved Successfully');
        return redirect()->route('admin.proof-reader.recruitment.list');
    }

    public function recruitmentTestReDo($id){
        //Reject the test 
        $test = ProofReaderTest::findOrFail($id);
        $test->status = 2;
        $test->save();

        //Reject/Ban the proof reader 
        $proofReader = ProofReader::findOrFail($test->user_id);
        $proofReader->re_do_assessment = 1;
        $proofReader->save();
        alert()->success('Success', 'Assessment sent for re do');
        return redirect()->route('admin.proof-reader.recruitment.list');
    }

    public function recruitmentTestReject($id){
        //Reject the test 
        $test = ProofReaderTest::findOrFail($id);
        $test->status = 2;
        $test->save();

        //Reject/Ban the proof reader 
        $proofReader = ProofReader::findOrFail($test->user_id);
        $proofReader->status = 2;
        $proofReader->save();
        alert()->success('Success', 'Assessment Rejcted Successfully');
        return redirect()->route('admin.proof-reader.recruitment.list');
    }
}
