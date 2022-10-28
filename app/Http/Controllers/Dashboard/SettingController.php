<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit(){
        $setting = Setting::first();

        return view('admins.settings.edit')->with('setting', $setting);
    }

    public function update(Request $request){
        $setting = Setting::first();

        $setting->site_name = $request->site_name;
        $setting->date_format = $request->date_format;
        $setting->time_zone = $request->time_zone;
        $setting->save();

        return redirect('dashboard/settings/edit')->with('success', 'success');
    }
}
