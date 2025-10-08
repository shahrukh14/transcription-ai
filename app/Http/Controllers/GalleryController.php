<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function galleryllisting(Request $request){
        $query = Gallery::query();
        if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('name', 'LIKE', "%$search%");
    }
        $query->orderBy('id', 'DESC');
        $galleryes = $query->paginate(10);
         return view('admin.gallery.list',compact('galleryes'));
    }
    public function galleryForm(){
        return view('admin.gallery.add');
    }
    public function galleryAdd(Request $request)
    {
        $request->validate([
        'name'         => 'required',
       ]);
        try {
        $gallery = new Gallery();
        $gallery->name = $request->name;
        $folder_path = public_path('admin/gallery/');
        if (!File::exists($folder_path)) {
            File::makeDirectory($folder_path, 0777, true, true);
        }
        if ($request->hasFile('image')) {
        $sl = rand();
        $imageName = date('Ymd') . '_' . $sl . '.' . $request->image->getClientOriginalExtension();
        $request->image->move($folder_path, $imageName);
        $gallery->image = $imageName;
        }
        $gallery->save();
        return redirect()->route('admin.gallery.list')->with('message', 'Gallery Photo Insert successfully..');
        } catch (\Exception $ex) {
        return back()->with('error', $ex->getMessage());
        }

    }
    public function galleryEdit($id)
    {
        $galleryes = Gallery::find($id);
        return view('admin.gallery.edit', compact('galleryes'));
    }
    public function galleryUpdate( Request $request,$id){

        try {
        $gallery = Gallery::find($id);
        $gallery->name = $request->name;
        $folder_path = public_path('admin/gallery/');
        if (!File::exists($folder_path)) {
            File::makeDirectory($folder_path, 0777, true, true);
        }
        if ($request->hasFile('image')) {
        $sl = rand();
        $imageName = date('Ymd') . '_' . $sl . '.' . $request->image->getClientOriginalExtension();
        $request->image->move($folder_path, $imageName);
        $gallery->image = $imageName;
        }
        $gallery->save();
        return redirect()->route('admin.gallery.list')->with('message', 'Gallery Photo update successfully....');
    } catch (\Exception $ex) {
        return back()->with('error', $ex->getMessage());
    }
    }
     public function galleryDelete($id)
    {
        $dynamic = Gallery::find($id);
        $dynamic->delete();
        // session()->flash('success', ['Dynamic Delete successfully..', 'Success']);
        return redirect()->route('admin.gallery.list')->with('error', 'Gallery Photo Delete successfully...');
    }
    }

