<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function list(Request $request){
        $query = User::query();
        $search = $request->input('search');
        if ($request->has('search')) {
            $query->where('first_name', 'LIKE', "%$search%")->orWhere('last_name', 'LIKE', "%$search%");
        }
        $query->orderBy('id', 'DESC');
        $users = $query->paginate(10);
        return view('admin.customers.list',compact('users','search'));
    }

    public function add(){
        return view('admin.customers.add');
    }

    public function insert(Request $request){
        try {
            //Image Upload 
            if ($request->hasFile('image')) {
                $folder_path = public_path('admin/customer/');
                if (!File::exists($folder_path)) {
                    File::makeDirectory($folder_path, 0777, true, true);
                }
                
                $imageName = date('Ymd') . '_' . rand() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($folder_path, $imageName);
            }

            $user                   = new User();
            $user->first_name       = $request->first_name;
            $user->last_name        = $request->last_name;
            $user->email            = $request->email;
            $user->mobile           = $request->mobile;
            $user->password         = Hash::make($request->password);
            $user->sso_google_id    = $request->sso_google_id;
            $user->image            = $imageName;
            $user->save();
            return redirect()->route('admin.customers.list')->with('message', 'Customer Added Successfully');
        } catch (\Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }

    public function edit($id){
        $user = User::find($id);
        return view('admin.customers.edit', compact('user'));
    }

    public function update(Request $request, $id){
        try {
            $user = User::find($id);

            //Image Upload 
            if ($request->hasFile('image')) {
                $folder_path = public_path('admin/customer/');
                if (!File::exists($folder_path)) {
                    File::makeDirectory($folder_path, 0777, true, true);
                }
                $imageName = date('Ymd') . '_' . rand() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($folder_path, $imageName);
            }else{
                $imageName = $user->image;
            }

            $user->first_name       = $request->first_name;
            $user->last_name        = $request->last_name;
            $user->email            = $request->email;
            $user->mobile           = $request->mobile;
            $user->sso_google_id    = $request->sso_google_id;
            $user->image            = $imageName;
            $user->save();
            return redirect()->route('admin.customers.list')->with('message', 'Customer updated Successfully');
        } catch (\Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.customers.list')->with('message', 'Customer deleted Successfully');
    }
}
