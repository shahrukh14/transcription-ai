<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PhotoController extends Controller
{
    public function photo($id)
    {
        $gallerys = Gallery::find($id);
        $photos = Photo::where('gallery_id', $id)->get();
       return view('admin.photo.form', compact('gallerys','photos'));
    }
    public function photoAdd(Request $request, $id)
    {
        foreach ($request->image as $img) {
            $photo = new Photo();
            $photo->gallery_id = $id;

            $image = rand(100000, 999999) . time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('admin/photos/album'), $image);
            $photo->image = $image;
            $photo->save();
        }
        return redirect()->back()->with('success', 'Gallery Photos uploaded successfully.');
    }
    public function PhotoDelete($id)
    {
     $photo = Photo::where('id', $id)->first();
    
    if ($photo) {
        $image_path = 'admin/photos/album/' . $photo->image;
        $photo->delete();
       if (File::exists($image_path)) {
            File::delete($image_path);
        }

    return redirect()->back()->with('success', 'Photo deleted successfully...');
    }

    return redirect()->back()->with('error', 'Photo not found...');
    }
}
   
