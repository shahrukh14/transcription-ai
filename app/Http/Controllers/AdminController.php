<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
  public function dashboard(Request $request)
  {
    return view('admin.dashboard');
  }
  public function userList(Request $request)
  {
    $users = Admin::paginate(10);
    return view('admin.user.list', compact('users'));
  }
  public function addUserForm(Request $request)
  {
    $roles = Role::all();
    return view('admin.user.add', compact('roles'));
  }
  public function addUser(Request $request)
  {
    $request->validate([
      'email' => 'unique:admins,email',
      'password' => 'min:8',
    ]);

    try {
      $newUser = new Admin();
      $newUser->first_name =  $request->first_name;
      $newUser->last_name =  $request->last_name;
      $newUser->email =  $request->email;
      $newUser->password =  Hash::make($request->password);
      $newUser->save();
      $role = Role::findByName($request->role);
      $newUser->assignRole($role);
      alert()->success('Success', 'User Added Successfully');
      return to_route('admin.user-list');
    } catch (Exception $e) {
      alert()->warning('Alert', $e->getMessage());
      return to_route('admin.add-user-form');
    }
  }
  public function changeUserStatus(Request $request)
  {
    if (isset($request->user_status)) {
      Admin::where('id', $request->user_id)->update([
        'status' => $request->user_status,
      ]);
    } else {
      Admin::where('id', $request->user_id)->update([
        'status' => config('constant.status.inactive'),
      ]);
    }
    alert()->success('Success', 'User Status Changed Successfully');
    return redirect()->back();
  }
  public function editUser(Request $request)
  {
    $user = Admin::where('id', $request->id)->first();
    $roles = Role::all();
    return view('admin.user.edit', compact('user', 'roles'));
  }
  public function updateUser(Request $request)
  {
    $request->validate([
      'email' => 'unique:admins,email,'.$request->id,
    ]);

    try {
      $existingUser = Admin::where('id',$request->id)->first();
      $existingUser->first_name =  $request->first_name;
      $existingUser->last_name =  $request->last_name;
      $existingUser->email =  $request->email;
      $existingUser->save();
      $role = Role::findByName($request->role);
      $existingUser->syncRoles([$role->name]);
      alert()->success('Success', 'User Updated Successfully');
      return to_route('admin.user-list');
    } catch (Exception $e) {
      alert()->warning('Alert', $e->getMessage());
      return to_route('admin.add-user-form');
    }
  }

  public function deleteUser(Request $request){
    try {
      
      $existingUser = Admin::where('id',$request->id)->delete();
      alert()->success('Success', 'User Deleted Successfully');
      return to_route('admin.user-list');
    } catch (Exception $e) {
      alert()->warning('Alert', $e->getMessage());
      return to_route('admin.user-list');
    }
  }
  public function profileForm()
  {
      $userid = Auth::guard()->user()->id;
      $userdata = Admin::where('id', $userid)->first();
      return view('admin.profile.profileForm', compact('userdata', 'userid'));
  }

  public function updateProfile(Request $request, $id)
  {
      $user = Admin::findOrFail($id);

      $folder_path = public_path('admin/profileImage/' . $user->username . '/');
      if (!File::exists($folder_path)) {
          File::makeDirectory($folder_path, 0777, true, true);
      }

      if (isset($request->image)) {
          $sl = rand();
          $image =  date('Ymd') . '_' . $sl . '.' . $request->image->getClientOriginalExtension();
          $request->image->move($folder_path, $image);
      } else {
          $image = NULL;
      }
      if ($image) {
          $user->image = $image;
      }
      if ($request->first_name) {
      $user->first_name = $request->first_name;
      }
      if ($request->last_name) {
      $user->last_name = $request->last_name;
      }
      if ($request->password) {
          $user->password = Hash::make($request->password);
      }
      $user->save();

      alert()->success('Success', 'Profile Updated Successfully');
      return redirect()->back();
  }
}
