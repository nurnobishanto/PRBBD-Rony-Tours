<?php

use App\Models\Setting;


function getSetting($key)
{
    $setting = Setting::where('key', $key)->first();
    return $setting ? $setting->value : null;
}
function getSettingDetails($key)
{
    $setting = Setting::where('key', $key)->first();
    return $setting ? $setting->details : null;
}
function setSetting($key, $value,$details)
{
    $setting = Setting::where('key', $key)->first();
    if($setting){
        $setting->key = $key;
        $setting->value = $value;
        $setting->details = $details;
        $setting->update();
    }else{
        $setting = Setting::create([
            'key' => $key,
            'value' => $value,
            'details' => $details
        ]);
    }

    return $setting;
}

if(!function_exists('getImageUrl'))
{
    function getImageUrl($image = null){
        if($image == null) return asset('default.jpg');

        return asset('uploads/'.$image);
    }
}
function checkRolePermissions($role,$permissions){
    $status = true;
    foreach ($permissions as $permission){
        if(!$role->hasPermissionTo($permission)){
            $status = false;
        }
    }

    return $status;
}
function allCountries(){
    $json_str = '';
    $json_data = file_get_contents('json/country.json');
    return json_decode($json_data, true)['countries'];
}
function convertMinutesToDuration($minutes) {
    $hours = floor($minutes / 60);
    $remainingMinutes = $minutes % 60;

    $duration = '';

    if ($hours > 0) {
        $duration .= $hours . ' Hour ';
    }

    if ($remainingMinutes > 0) {
        $duration .= $remainingMinutes . ' Minute';
    }

    return trim($duration);
}
function calculateAge($birthdate) {
    $today = new DateTime();
    $diff = $today->diff(new DateTime($birthdate));
    return $diff->y;
}
//function addSMSLog($phone,$sms,$status,$type)
//{
//    SmsLog::create([
//        'phone' => $phone,
//        'msg' => $sms,
//        'status' => $status,
//        'type'=>$type,
//    ]);
//}
function number_validation($number) {

    $number = str_replace(' ', '', $number);
    $number = str_replace('-', '', $number);

    if (preg_match('/^(\+880|880|0)?1(1|5|6|7|8|9)\d{8}$/', $number) == 1) {

        if (preg_match("/^\+88/", $number) == 1) {
            $number = str_replace('+', '', $number);
        }
        if (preg_match("/^880|^0/", $number) == 0) {
            $number = "880" . $number;
        }
        if (preg_match("/^88/", $number) == 0) {
            $number = "88" . $number;
        }

        return $number;
    } else {
        return false;
    }
}
function send_sms($number,$msg,$type){
    $provider = getSetting('sms_provider');
    if($provider == 'bulk_sms_bd'){
        $status =  bulksmsbd_sms_send($number,$msg);
       // addSMSLog($number,$msg,$status,$type);
        return $status;
    }
}
function bulksmsbd_sms_send($phone_number,$msg) {

    $url = "http://bulksmsbd.net/api/smsapi";
    $api_key = getSetting('bulk_sms_bd_api');
    $senderid = getSetting('bulk_sms_bd_sender_id');
    $number = number_validation($phone_number);
    $message = trim($msg);

    $data = [
        "api_key" => $api_key,
        "senderid" => $senderid,
        "number" => $number,
        "message" => $message
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);


    $data = json_decode($response);
    if($data->response_code == 202){
        toastr()->success($data->success_message,'SMS sent successful');
        return $data->success_message;
    }else{
        toastr()->error($data->error_message,'SMS sent failed!');
        return $data->error_message;
    }
}
function get_balance_bulksmsbd() {
    if(getSetting('bulk_sms_bd_api')){
        $url = "http://bulksmsbd.net/api/getBalanceApi";
        $api_key = getSetting('bulk_sms_bd_api');
        $data = [
            "api_key" => $api_key
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);
        if($data->response_code == 202){
            return $data->balance;
        }else{
            return $data->error_message;
        }
    }
    else{
        return 'Enter api key to know balance';
    }

}
