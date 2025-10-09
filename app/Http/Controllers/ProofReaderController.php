<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ProofReader;
use Illuminate\Http\Request;
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
            return redirect()->route('admin.proof-reader.list')->with('message', 'Proof Reader Added Successfully');
        } catch (\Exception $ex) {
            return back()->with('error', $ex->getMessage());
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
            return redirect()->route('admin.proof-reader.list')->with('message', 'Proof Reader updated Successfully');
        } catch (\Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }

    public function delete($id){
        $proofReader = ProofReader::find($id);
        $proofReader->delete();
        return redirect()->route('admin.proof-reader.list')->with('message', 'Proof Reader deleted Successfully');
    }
}
