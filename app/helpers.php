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
