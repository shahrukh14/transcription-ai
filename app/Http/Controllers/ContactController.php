<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Exports\ContactExport;
use Maatwebsite\Excel\Facades\Excel;


class ContactController extends Controller
{
    public function contactlist(Request $request)
    {
        $query = Contact::query();
        if ($request->query('search')) {
            $search = $request->query('search');
            $query->where('refId', 'like', "%$search%")
                ->orWhere('fname', 'like', "%$search%")
                ->orWhere('lname', 'like', "%$search%");
        }
        if ($request->from && $request->to && $request->from <= $request->to) {
            $from = date('Y-m-d', strtotime($request->from));
            $to = date('Y-m-d', strtotime($request->to));
            $query->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
        }
        $query->orderBy('id', 'DESC');
        $contacts = $query->paginate(10);
        return view("admin.contact.contact_list", compact('contacts'));
    }
    public function contactlistdelete($id)
    {
        $contacts = Contact::findOrFail($id);
        $contacts->delete();
        session()->flash('success', ['Contact Deleted Successfully...', 'Success']);
        return redirect()->route('admin.contact.list');
    }
    public function contactexport()
    {
        return Excel::download(new ContactExport, 'contact.xlsx');
    }
}
