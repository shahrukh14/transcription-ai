<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    public function testimoniallisting(Request $request)
    {
        $query = Testimonial::query();
        if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('title', 'LIKE', "%$search%");
    }
        $query->orderBy('id', 'DESC');
        $Testimonial = $query->paginate(10);
        return view('admin.testimonials.list', compact('Testimonial'));
    }
    public function testimonialcreate()
    {
        return view('admin.testimonials.add');
    }
    public function testimonialstore(Request $request)
    {
        $request->validate([
        'title'         => 'required',
        'description'   => 'required'
        ]);
        try {
        $Testimonial = new Testimonial();
        $Testimonial->title = $request->title;
        $Testimonial->description = $request->description;
        $folder_path = public_path('admin/testimonials/');
        if (!File::exists($folder_path)) {
            File::makeDirectory($folder_path, 0777, true, true);
        }
        if ($request->hasFile('image')) {
        $sl = rand();
        $imageName = date('Ymd') . '_' . $sl . '.' . $request->image->getClientOriginalExtension();
        $request->image->move($folder_path, $imageName);
        $Testimonial->image = $imageName;
        }
        $Testimonial->save();
        return redirect()->route('admin.testimonial.list')->with('message', 'Testimonial created successfully..');
        } catch (\Exception $ex) {
        return back()->with('error', $ex->getMessage());
        }
    }
    public function testimonialedit(string $id)
    {
        $Testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('Testimonial'));
    }
    public function testimonialupdate(Request $request, string $id)
    {
    try {
        $Testimonial = Testimonial::findOrFail($id);
        $Testimonial->title = $request->title;
        $Testimonial->description = $request->description;
        $folder_path = public_path('admin/testimonials/');
    if (!File::exists($folder_path)) {
            File::makeDirectory($folder_path, 0777, true, true);
    }
    if ($request->hasFile('image')) {
        $sl = rand();
        $imageName = date('Ymd') . '_' . $sl . '.' . $request->image->getClientOriginalExtension();
        $request->image->move($folder_path, $imageName);
        $Testimonial->image = $imageName;
    }
        $Testimonial->save();
        return redirect()->route('admin.testimonial.list')->with('message', 'Testimonial update successfully....');
    } catch (\Exception $ex) {
        return back()->with('error', $ex->getMessage());
    }
    }
    public function testimonialdelete(string $id)
    {
        $Testimonial = Testimonial::findOrFail($id);
        $Testimonial->delete();
        return redirect()->route('admin.testimonial.list')->with('error', 'Testimonial deleted successfully..');
    }
}
