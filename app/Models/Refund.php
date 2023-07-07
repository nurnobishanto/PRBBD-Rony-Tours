<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'trxid',
        'status',
        'note',
        'currency',
        'paid_by',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
