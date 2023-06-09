<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'receiver_email',
        'msg',
        'sender_email',
        'type',
        'status',
    ];
}
