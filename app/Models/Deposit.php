<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'paid_by',
        'trxid',
        'status',
        'slip',
        'currency',
        'note',
    ];
    public function user(): BelongsTo
    {
       return $this->belongsTo(User::class);
    }
}
