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
    $setting = Setting::updateOrCreate(['key' => $key], ['value' => $value], ['details' => $details]);
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
