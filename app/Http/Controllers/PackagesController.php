<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class PackagesController extends Controller
{
    public function list(Request $request){
        $query = Package::query();
        $search = $request->input('search');
        if ($request->has('search')) {
            $query->where('name', 'LIKE', "%$search%");
        }
        $query->orderBy('id', 'DESC');
        $packages = $query->paginate(10);
        return view('admin.packages.list',compact('packages','search'));
    }

    public function add(){
        return view('admin.packages.add');
    }

    public function insert(Request $request){
        try {
            //Description image upload
            $folder_path = public_path('admin/packages/descriptions');
            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0777, true, true);
            }
            $description = $request->description;
            foreach ($description as $key => $desc) {
                if (isset($desc['image'])) {
                    $imageName = "packages_descriptions_".date('Ymd') . '_' . rand() . '.' . $desc['image']->getClientOriginalExtension();
                    $desc['image']->move($folder_path, $imageName);
                    $description[$key]['image'] = $imageName;
                }else{
                    $description[$key]['image'] = null;
                }
            }
            $package                        = new Package();
            $package->name                  = $request->name;
            $package->amount                = $request->amount;
            $package->type                  = $request->type;
            $package->audio_time_limit      = $request->audio_time_limit;
            $package->transcription_limit   = $request->transcription_limit;
            $package->description           = json_encode($description);
            $package->save();
            return redirect()->route('admin.package.list')->with('message', 'Package Added Successfully');
        } catch (\Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }

    public function edit($id){
        $package = Package::find($id);
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, $id){
        try {
            //Description image update
            $folder_path = public_path('admin/packages/descriptions');
            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0777, true, true);
            }
            $description = $request->description;
            foreach ($description as $key => $desc) {
                if (isset($desc['image'])) {
                    $imageName = "packages_descriptions_".date('Ymd') . '_' . rand() . '.' . $desc['image']->getClientOriginalExtension();
                    $desc['image']->move($folder_path, $imageName);
                    $description[$key]['image'] = $imageName;

                    //Remove old image if new one uploaded
                    if (isset($desc['old_image'])) {
                        $filePath = public_path('admin/packages/descriptions/'.$desc['old_image']);
                        if (File::exists($filePath)) {
                            File::delete($filePath);
                        }
                    }
                }else{
                    $description[$key]['image'] = $desc['old_image'];
                }
                unset($description[$key]['old_image']);
            }
            $package                        = Package::find($id);
            $package->name                  = $request->name;
            $package->amount                = $request->amount;
            $package->type                  = $request->type;
            $package->audio_time_limit      = $request->audio_time_limit;
            $package->transcription_limit   = $request->transcription_limit;
            $package->description           = json_encode($description);
            $package->save();
            return redirect()->route('admin.package.list')->with('message', 'Package updated Successfully');
        } catch (\Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }
}
