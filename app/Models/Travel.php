<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Travel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'travels';
    protected $fillable = [
        'order_id',
        'from',
        'to',
        'carrier',
        'distance',
        'duration',
        'cabin_class',
        'arrival_time',
        'departure_time',
        'return_date',
        'airline_name',
        'airline_code',
        'trip_group',
        'trip_indicator',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
