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

    public function create(Request $request){
        $setting = new Setting();

        $setting->key = $request->key;
        $setting->value = $request->value;
        if($setting->save()){
            return ["status" => "success","title" => "Başarılı","message" => "Yeni Ayar Kayıtedildi"];
        }
        return ["status" => "error","title" => "Hatalı","message" => "Yeni Ayar Kayır İşleminde Bir Sorun Yaşandı"];
    }

    public function delete(Request $request){
        $setting = Setting::where("key",$request->key)->delete();

        if($setting){
            return ["status" => "success","title" => "Başarılı","message" => "Ayar Başarıyla Silindi"];
        }
        return ["status" => "error","title" => "Hatalı","message" => " Ayar Silme İşleminde Bir Sorun Yaşandı"];


    }
}
