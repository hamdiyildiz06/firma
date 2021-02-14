<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function show(){

        $settings = Setting::all();

        return view("backend.home.settings", compact("settings"));
    }

    public function update(Request $request){
        $setting = Setting::where("key",$request->key)->update(["value"=>$request->value]);
        if ($setting){
            return "Başarılı";
        }else{
            return "Hata Oluştu";
        }
    }
}
