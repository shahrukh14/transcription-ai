<?php

namespace App\Http\Controllers;

use App\Models\Dynamic;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DynamicController extends Controller
{
public function DynamicList(Request $request)
{
    $query = Dynamic::query();
    $search = $request->input('search');
    if ($request->has('search')) {
    $query->where('title', 'LIKE', "%$search%");
}
    $query->orderBy('id', 'DESC');
    $dynamics = $query->paginate(10);
    return view('admin.Dynamic.list', compact('dynamics', 'search'));
}
public function DynamicForm()
{
    return view('admin.Dynamic.Form');
}
public function DynamicAdd(Request $request)
{
        $request->validate([
            'title'     => 'required|unique:dynamics',
            'content'   => 'required',
            'meta'      => 'required',
        ]);
        try {
            $dynamic = new Dynamic();
            $dynamic->title = $request->title;
            $dynamic->meta = $request->meta;
            $dynamic->slug = Str::slug($request->title);
            $dynamic->content = $request->content;
            $dynamic->save();
            // session()->flash('success', ['Dynamic Add successfully..', 'Success']);
            return redirect()->route('admin.dynamic.list')->with('message', 'Dynamic Add successfully..');
        } catch (\Exception $ex) {
            session()->flash('error', [$ex->getMessage(), 'Error']);
            return redirect()->back();
        }
    }
    public function DynamicEdit($id)
    {
        $dynamics = Dynamic::find($id);
        return view('admin.Dynamic.edit', compact('dynamics'));
    }
    public function DynamicUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:dynamics,title,' . $id,
            'content' => 'required',
        ]);
        try {
            $dynamic = Dynamic::find($id);
            $dynamic->title = $request->title;
            $dynamic->meta = $request->meta;
            $dynamic->slug = Str::slug($request->title);
            $dynamic->content = $request->content;
            $dynamic->save();
            // session()->flash('success', ['Dynamic update successfully..', 'Success']);
            return redirect()->route('admin.dynamic.list')->with('message', 'Dynamic update successfully..');
        } catch (\Exception $ex) {
            session()->flash('error', [$ex->getMessage(), 'Error']);
            return redirect()->back();
        }
    }
    public function DynamicDelete($id)
    {
        $dynamic = Dynamic::find($id);
        $dynamic->delete();
        // session()->flash('success', ['Dynamic Delete successfully..', 'Success']);
        return redirect()->route('admin.dynamic.list')->with('error', 'Dynamic Delete successfully...');
    }
}
