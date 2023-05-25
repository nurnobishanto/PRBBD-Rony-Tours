<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{

    public function general_settings(){

        return view('admin.settings.general');
    }
    public function update_general_settings(Request $request){

        setSetting('site_title',$request->site_title,null);
        setSetting('site_tagline',$request->site_tagline,null);
        if($request->site_logo){
            $request->validate([
                'site_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
            $site_logo = 'light'.time().'.'.$request->site_logo->extension();
            $request->site_logo->move(public_path('images'), $site_logo);
            setSetting('site_logo','images/'.$site_logo,null);
            $old_site_logo = public_path($request->site_logo_old);
            if(File::exists($old_site_logo) && $request->site_logo_old ){
                unlink($old_site_logo);
            }
        }
        if($request->site_logo_dark){
            $request->validate([
                'site_logo_dark' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
            $site_logo_dark = 'dark'.time().'.'.$request->site_logo_dark->extension();
            $request->site_logo_dark->move(public_path('images'), $site_logo_dark);
            setSetting('site_logo_dark','images/'.$site_logo_dark,null);
            $old_site_logo_dark = public_path($request->site_logo_dark_old);
            if(File::exists($old_site_logo_dark) && $request->site_logo_dark_old){
                unlink($old_site_logo_dark);
            }
        }
        if($request->site_favicon){
            $request->validate([
                'site_favicon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
            $site_favicon = 'icon'.time().'.'.$request->site_favicon->extension();
            $request->site_favicon->move(public_path('images'), $site_favicon);
            setSetting('site_favicon','images/'.$site_favicon,null);
            $old_site_favicon = public_path($request->site_favicon_old);
            if(File::exists($old_site_favicon) && $request->site_favicon_old){
                unlink($old_site_favicon);
            }
        }
        if($request->loading){
            $request->validate([
                'loading' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
            $loading = 'loading'.time().'.'.$request->loading->extension();
            $request->loading->move(public_path('images'), $loading);
            setSetting('loading','images/'.$loading,null);
            $old_loading = public_path($request->loading_old);
            if(File::exists($old_loading) && $request->loading_old){
                unlink($old_loading);
            }
        }
        return redirect()->back();
    }
    public function flyhub_settings(){
        return view('admin.settings.settings');
    }
    public function update_flyhub_settings(Request $request){

        setSetting('flyhub_url',$request->url,null);
        setSetting('flyhub_username',$request->username,null);
        setSetting('flyhub_apikey',$request->apikey,null);
        setSetting('flyhub_password',$request->password,null);

        $client = new Client();
        $response = $client->request('POST', getSetting('flyhub_url').'Authenticate', [
            'json' => [
                'username' => getSetting('flyhub_username'),
                'apikey' => getSetting('flyhub_apikey')
            ]
        ]);
        $resp = json_decode($response->getBody(),false);
        setSetting('flyhub_status',$resp->Status,null);
        setSetting('flyhub_TokenId',null,$resp->TokenId);
       return redirect()->back();
    }
    public function update_custom_page(Request $request){
        if($request->about_us){
            setSetting('about_us',null,$request->about_us);
        }
        if($request->privacy_policy){
            setSetting('privacy_policy',null,$request->privacy_policy);
        }
        if($request->terms_conditions){
            setSetting('terms_conditions',null,$request->terms_conditions);
        }
        if($request->testimonials){
            setSetting('testimonials',null,$request->testimonials);
        }
        toastr()->success('Page Updated successfully','Updated');
        return redirect()->back();
    }
}
