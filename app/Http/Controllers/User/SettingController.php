<?php

namespace App\Http\Controllers\User;

use App\Models\Setting;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    public function index(){
        $setting = Auth::user()->setting;
        $currencies = Currency::orderBy('name','asc')->get();

        return view('user.setting',compact('setting','currencies'));
    }


    public function updateGeneralSetting(SettingRequest $request){

        $setting = Auth::user()->setting;

        if(!$setting){

            if($request->hasFile('logo') && $request->file('logo')->isValid()){
                $store_logo = $request->file('logo')->store('/','files');
            }
            if($request->hasFile('footer_logo') && $request->file('footer_logo')->isValid()){
                $footer_logo = $request->file('footer_logo')->store('/','files');
            }

            $setting = new Setting();

            $setting->user_id = Auth::user()->id;
            $setting->currency_id = $request->currency_id ;
            $setting->store_name = $request->store_name ;
            $setting->store_name_en = $request->store_name_en ;
            $setting->store_email = $request->store_email ;
            $setting->store_phone = $request->store_phone ;
            $setting->currency_short = $request->currency_short ;
            $setting->store_logo = $store_logo;
            $setting->footer_logo = $footer_logo;
            $setting->store_address = $request->store_address ;
            $setting->maintenance_mode = $request->maintenance_mode ? 1 : 0 ;
            $setting->timezone = $request->timezone ?? 'UTC'  ;
            $setting->facebook_url = $request->facebook_url ;
            $setting->twitter_url = $request->twitter_url ;
            $setting->instagram_url = $request->instagram_url ;
            $setting->linkedin_url = $request->linkedin_url ;
            $setting->youtube_url = $request->youtube_url ;
            $setting->about_us_en = $request->about_us_en ;
            $setting->about_us_ar = $request->about_us_ar ;
            $setting->privacy_policy_en = $request->privacy_policy_en ;
            $setting->privacy_policy_ar = $request->privacy_policy_ar ;
            $setting->shipping_info_en = $request->shipping_info_en ;
            $setting->shipping_info_ar = $request->shipping_info_ar ;
            $setting->terms_conditions_en = $request->terms_conditions_en ;
            $setting->terms_conditions_ar = $request->terms_conditions_ar ;

            $setting->save();

        }else{

            $request->merge(['id' => $setting->id]);

            $store_logo = $setting->store_logo;
            if($request->hasFile('logo') && $request->file('logo')->isValid()){
                if($setting->store_logo)
                Storage::disk('files')->delete($setting->store_logo);
                $store_logo = $request->file('logo')->store('/','files');
            }
            $footer_logo = $setting->footer_logo;
            if($request->hasFile('footer_logo') && $request->file('footer_logo')->isValid()){
                if($setting->footer_logo)
                Storage::disk('files')->delete($setting->footer_logo);
                $footer_logo = $request->file('footer_logo')->store('/','files');
            }

            $setting->currency_id = $request->currency_id ?? $setting->currency_id ;
            $setting->store_name = $request->store_name ?? $setting->store_name;
            $setting->store_name_en = $request->store_name_en ?? $setting->store_name_en ;
            $setting->store_email = $request->store_email ?? $setting->store_email ;
            $setting->store_phone = $request->store_phone ?? $setting->store_phone ;
            $setting->currency_short = $request->currency_short ?? $setting->currency_short ;
            $setting->store_logo = $store_logo;
            $setting->footer_logo = $footer_logo;
            $setting->store_address = $request->store_address ?? $setting->store_address ;
            $setting->maintenance_mode = $request->maintenance_mode ?? 0 ;
            $setting->timezone = $request->timezone ?? $setting->timezone ;
            $setting->facebook_url = $request->facebook_url ?? $setting->facebook_url ;
            $setting->twitter_url = $request->twitter_url ?? $setting->twitter_url ;
            $setting->instagram_url = $request->instagram_url ?? $setting->instagram_url ;
            $setting->linkedin_url = $request->linkedin_url ?? $setting->linkedin_url ;
            $setting->youtube_url = $request->youtube_url ?? $setting->youtube_url ;
            $setting->about_us_en = $request->about_us_en ?? $setting->about_us_en;
            $setting->about_us_ar = $request->about_us_ar ?? $setting->about_us_ar ;
            $setting->privacy_policy_en = $request->privacy_policy_en ?? $setting->privacy_policy_en ;
            $setting->privacy_policy_ar = $request->privacy_policy_ar ?? $setting->privacy_policy_ar ;
            $setting->shipping_info_en = $request->shipping_info_en ?? $setting->shipping_info_en ;
            $setting->shipping_info_ar = $request->shipping_info_ar ?? $setting->shipping_info_ar ;
            $setting->terms_conditions_en = $request->terms_conditions_en ?? $setting->terms_conditions_en ;
            $setting->terms_conditions_ar = $request->terms_conditions_ar ?? $setting->terms_conditions_ar ;

            $setting->save();

        }

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
