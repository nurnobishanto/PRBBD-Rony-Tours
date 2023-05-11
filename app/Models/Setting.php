<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'value',
        'details',
    ];
    public static function getSetting($key)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : null;
    }
    public static function getSettingDetails($key)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->details : null;
    }
    public static function setSetting($key, $value,$details)
    {
        $setting = self::updateOrCreate(['key' => $key], ['value' => $value], ['details' => $details]);
        return $setting;
    }
}
