<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Generalsettings;
use App\Models\languages;
use Illuminate\Support\Facades\File;

class GeneralsettingsController extends Controller
{
    public function generalsettingscreate()
    {
        $existingSettings = Generalsettings::first();
        $languages = DB::table('languages')->orderBy('name','ASC')->pluck('name')->toArray();
        return view("admin.generalsetting.form_generalsettingslisting", compact('existingSettings','languages'));
    }

    public function generalsettingsstore(Request $request){
        $existingSettings = Generalsettings::first();
        if ($existingSettings == null) {
            $settings                               = new Generalsettings();
            $settings->name                         = $request->input('name');
            $settings->email                        = $request->input('email');
            $settings->mobile                       = $request->input('mobile');
            $settings->address                      = $request->input('address');
            $settings->facebook                     = $request->input('facebook');
            $settings->twitter                      = $request->input('twitter');
            $settings->instagram                    = $request->input('instagram');
            $settings->linkedin                     = $request->input('linkedin');
            $settings->printest                     = $request->input('printest');
            $settings->meta_title                   = $request->input('meta_title');
            $settings->proof_reading_per_minute     = $request->input('proof_reading_per_minute');
            $settings->speaker_marking_per_minute   = $request->input('speaker_marking_per_minute');
            $settings->proof_reading_time_duration  = $request->input('proof_reading_time_duration');
            $settings->proofreading_language        = json_encode($request->input('proofreading_language'));

            $folder_path = public_path('admin/generalSetting/');

            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0777, true, true);
            }
            if ($request->hasFile('icon')) {
                $sl = rand();
                $imageName = date('Ymd') . '_' . $sl . '.' . $request->icon->getClientOriginalExtension();
                $request->icon->move($folder_path, $imageName);
                $settings->icon = $imageName;
            }
            
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

            if ($request->input('proof_reading_per_minute') !== null) {
                $settings->proof_reading_per_minute = $request->input('proof_reading_per_minute');
            }

            if ($request->input('speaker_marking_per_minute') !== null) {
                $settings->speaker_marking_per_minute = $request->input('speaker_marking_per_minute');
            }

            if ($request->input('proof_reading_time_duration') !== null) {
                $settings->proof_reading_time_duration = $request->input('proof_reading_time_duration');
            }

            if ($request->input('proofreading_language') !== null) {
                $settings->proofreading_language    = json_encode($request->input('proofreading_language'));
            }
            
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

