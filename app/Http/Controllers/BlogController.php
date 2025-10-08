<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index(Request $request)
    {
    $query = Blog::query();
    if ($request->has('search')) {
    $search = $request->input('search');
    $query->where('title', 'LIKE', "%$search%");
    }
    $query->orderBy('id', 'DESC');
    $blogs = $query->paginate(10);
    return view('admin.blog.list', compact('blogs'));
    }
    public function create()
    {
    return view('admin.blog.add');
    }
    public function store(Request $request)
    {
      $request->validate([
        'title'      => 'required',
        'date'       => 'required',
        'description'=> 'required',
        'categories' => 'required',
        'meta'       => 'required',
        ]);
        try {
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->meta = $request->meta;
        $blog->date = date("Y-m-d", strtotime($request->date));
        $blog->description = $request->description;
        $blog->categories = $request->categories;

        $folder_path = public_path('admin/blog/');
        if (!File::exists($folder_path)) {
            File::makeDirectory($folder_path, 0777, true, true);
        }
        if ($request->hasFile('image')) {
        $sl = rand();
        $imageName = date('Ymd') . '_' . $sl . '.' . $request->image->getClientOriginalExtension();
        $request->image->move($folder_path, $imageName);
        $blog->image = $imageName;
        }
        $blog->save();
        return redirect()->route('admin.blog.list')->with('message', 'Blog created successfully.');
        } catch (\Exception $ex) {
         return back()->with('error', $ex->getMessage());
        }
        }
    public function edit(string $id)
    {
        $blogs = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blogs'));
    }
    public function update(Request $request, string $id)
    {
    try {
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->meta = $request->meta;
        $blog->date = date("Y-m-d", strtotime($request->date));
        $blog->description = $request->description;
        $blog->categories = $request->categories;
        $folder_path = public_path('admin/blog/');
        if (!File::exists($folder_path)) {
            File::makeDirectory($folder_path, 0777, true, true);
        }
        if ($request->hasFile('image')) {
        $sl = rand();
        $imageName = date('Ymd') . '_' . $sl . '.' . $request->image->getClientOriginalExtension();
        $request->image->move($folder_path, $imageName);
        $blog->image = $imageName;
        }
        $blog->save();
        return redirect()->route('admin.blog.list')->with('message', 'Blog updated successfully.');
        } catch (\Exception $ex) {
        return back()->with('error', $ex->getMessage());
        }
        }
    public function destroy(string $id)
    {
    $blogs = Blog::findOrFail($id);
    $blogs->delete();
    return redirect()->route('admin.blog.list')->with('error', 'Blog deleted successfully.');
    }
}
