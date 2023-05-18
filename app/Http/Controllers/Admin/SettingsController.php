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
        $request->validate([
            'site_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        setSetting('site_title',$request->site_title,null);
        if($request->site_logo){
            $site_logo = 'light'.time().'.'.$request->site_logo->extension();
            $request->site_logo->move(public_path('images'), $site_logo);
            setSetting('site_logo','images/'.$site_logo,null);
            $old_site_logo = public_path($request->site_logo_old);
            if(File::exists($old_site_logo)){
                unlink($old_site_logo);
            }
        }
        if($request->site_logo_dark){
            $site_logo_dark = 'dark'.time().'.'.$request->site_logo_dark->extension();
            $request->site_logo_dark->move(public_path('images'), $site_logo_dark);
            setSetting('site_logo_dark','images/'.$site_logo_dark,null);
            $old_site_logo_dark = public_path($request->site_logo_dark_old);
            if(File::exists($old_site_logo_dark) && $request->site_logo_dark_old){
                unlink($old_site_logo_dark);
            }
        }
        return redirect()->back();
    }
    public function flyhub_settings(Request $request){

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
       return redirect()->back();
    }
}
