<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'msg',
        'sender_id',
        'type',
        'status',
    ];
}
