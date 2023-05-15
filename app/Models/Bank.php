<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = [
        'operator', //required int 1= bank, 2= mobile bank
        'bank_name',//required
        'account_name',//required
        'account_no',//required
        'branch_name',//optional
        'swift_code',//optional
        'routing_no',//optional
        'charge_info',//optional
        'charge',//optional, double
        'operator_type',//optional, int,1=personal,2=agent
        ];
}
