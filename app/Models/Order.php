<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'trxid',
        'trip_type',
        'last_ticket_date',
        'is_refundable',
        'booking_time',
        'booking_id',
        'result_id',
        'search_id',
        'booking_expired',
        'total_amount',
        'gross_amount',
        'discount_amount',
        'total_ws_amount',
        'net_pay_amount',
        'paid_amount',
        'profit_amount',
        'payment_status',
        'payment_method',
        'ticket_number',
        'status',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function travels(){
        return $this->hasMany(Travel::class);
    }
    public function passengers(){
        return $this->belongsToMany(Passenger::class);
    }
    public function from(){
        return $this->travels()->first();
    }
    public function to(){
        return $this->travels()->orderBy('id','DESC')->first();

    }



}
