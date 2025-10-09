<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function faqList(Request $request){
        $query = Faq::query();
        $search = $request->input('search');
        if ($request->has('search')) {
            $query->where('title', 'LIKE', "%$search%");
        }
        $query->orderBy('id', 'DESC');
        $faqs = $query->paginate(10);
        return view('admin.Faq.list',compact('faqs','search'));
    }
        public function faqcreate(){
        return view('admin.Faq.add');
        }
        public function faqadd(Request $request){
        $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        ]);
        try {
        $faq = new Faq();
        $faq->title = $request->title;
        $faq->description = $request->description;
        $faq->save();

        return redirect()->route('admin.faq.list')->with('message', 'FAQ created successfully.');
        }   catch (\Exception $ex) {
          return back()->with('error', $ex->getMessage());
        }
        }

        public function faqedit($id){
        $faqs=Faq::find($id);
        return view('admin.Faq.edit',compact('faqs'));
        }
        public function faqupdate(Request $request, $id){
         $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        ]);
        try {
        $faq = Faq::find($id);
        $faq->title = $request->title;
        $faq->description = $request->description;
        $faq->save();
        return redirect()->route('admin.faq.list')->with('message', 'FAQ updated successfully.');
         }    catch (\Exception $ex) {
          return back()->with('error', $ex->getMessage());
         }
        }
        public function faqdelete($id){
        $faq = Faq::find($id);
        $faq->delete();
        return redirect()->route('admin.faq.list')->with('error', 'FAQ deleted successfully..');;
        }
}
