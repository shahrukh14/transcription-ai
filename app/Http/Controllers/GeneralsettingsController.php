<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Generalsettings;
use Illuminate\Support\Facades\File;

class GeneralsettingsController extends Controller
{
public function generalsettingscreate()
{
    $existingSettings = Generalsettings::first();
    return view("admin.generalsetting.form_generalsettingslisting", compact('existingSettings'));
}
public function generalsettingsstore(Request $request)
{
$existingSettings = Generalsettings::first();
if ($existingSettings == null) {
    $settings = new Generalsettings();
    $settings->name = $request->input('name');
    $settings->email = $request->input('email');
    $settings->mobile = $request->input('mobile');
    $settings->address = $request->input('address');
    $settings->facebook = $request->input('facebook');
    $settings->twitter = $request->input('twitter');
    $settings->instagram = $request->input('instagram');
    $settings->linkedin = $request->input('linkedin');
    $settings->printest = $request->input('printest');
    $settings->meta_title = $request->input('meta_title');
    // $settings->meta_description = $request->input('meta_description');
    // $settings->keyword = $request->input('keyword');
    // $settings->email_type = $request->input('email_type');
    // $settings->email_setting = $request->input('email_setting');
    // $settings->mail_password = $request->input('mail_password');
    // $settings->smtp_mailhost = $request->input('smtp_mailhost');
    $folder_path = public_path('admin/icon/');
    if (!File::exists($folder_path)) {
    File::makeDirectory($folder_path, 0777, true, true);
    }
    if ($request->hasFile('icon')) {
    $sl = rand();
    $imageName = date('Ymd') . '_' . $sl . '.' . $request->icon->getClientOriginalExtension();
    $request->icon->move($folder_path, $imageName);
    $settings->icon = $imageName;
    }
    $folder_path = public_path('admin/generalSetting/');
    if (!File::exists($folder_path)) {
    File::makeDirectory($folder_path, 0777, true, true);
    }
    if ($request->hasFile('logo')) {
    $sl = rand();
    $imageName = date('Ymd') . '_' . $sl . '.' . $request->logo->getClientOriginalExtension();
    $request->logo->move($folder_path, $imageName);
    $settings->logo = $imageName;
    }
    $settings->save();
    } else {
    $settings = Generalsettings::first();
    if ($request->input('name') !== null) {
    $settings->name = $request->input('name');
    }
    if ($request->input('email') !== null) {
    $settings->email = $request->input('email');
    }
    if ($request->input('mobile') !== null) {
    $settings->mobile = $request->input('mobile');
    }
    if ($request->input('address') !== null) {
    $settings->address = $request->input('address');
    }
    if ($request->input('facebook') !== null) {
    $settings->facebook = $request->input('facebook');
    }
    if ($request->input('twitter') !== null) {
    $settings->twitter = $request->input('twitter');
    }
    if ($request->input('instagram') !== null) {
    $settings->instagram = $request->input('instagram');
    }
    if ($request->input('linkedin') !== null) {
    $settings->linkedin = $request->input('linkedin');
    }
    if ($request->input('printest') !== null) {
    $settings->printest = $request->input('printest');
    }
    if ($request->input('meta_title') !== null) {
        $settings->meta_title = $request->input('meta_title');
    }
    // if ($request->input('meta_description') !== null) {
    //     $settings->meta_description = $request->input('meta_description');
    // }
    // if ($request->input('keyword') !== null) {
    //     $settings->keyword = $request->input('keyword');
    // }
    // if ($request->input('email_type') !== null) {
    //     $settings->email_type = $request->input('email_type');
    // }
    // if ($request->input('email_setting') !== null) {
    //     $settings->email_setting = $request->input('email_setting');
    //     if ($request->input('mail_password') !== null) {
    //         $settings->mail_password = $request->input('mail_password');
    //     }
    //     if ($request->input('smtp_mailhost') !== null) {
    //         $settings->smtp_mailhost = $request->input('smtp_mailhost');
    //     }
    $folder_path = public_path('admin/icon/');
    if (!File::exists($folder_path)) {
    File::makeDirectory($folder_path, 0777, true, true);
    }
    if ($request->hasFile('icon')) {
    $sl = rand();
    $imageName = date('Ymd') . '_' . $sl . '.' . $request->icon->getClientOriginalExtension();
    $request->icon->move($folder_path, $imageName);
    $settings->icon = $imageName;
    }
    $folder_path = public_path('admin/generalSetting/');
    if (!File::exists($folder_path)) {
    File::makeDirectory($folder_path, 0777, true, true);
    }
    if ($request->hasFile('logo')) {
    $sl = rand();
    $imageName = date('Ymd') . '_' . $sl . '.' . $request->logo->getClientOriginalExtension();
    $request->logo->move($folder_path, $imageName);
    $settings->logo = $imageName;
    }
    $settings->save();
    }
    return redirect()->back()->with('success', 'Settings updated successfully!');
    }
    }

