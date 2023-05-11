<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        return view('admin.settings');
    }
    public function general_settings(Request $request){
        setSetting('site_title',$request->site_title,null);
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
