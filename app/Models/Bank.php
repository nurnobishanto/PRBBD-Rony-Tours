<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;
    
    const BANK = 1;
    const MOBILE_BANK=2;

    const PERSONAL = 1;
    const AGENT=2;

    use HasFactory;

    protected $guarded = ['id'];
    // 'operator', //required int 1= bank, 2= mobile bank
    // 'bank_name',//required
    // 'account_name',//required
    // 'account_no',//required
    // 'branch_name',//optional
    // 'swift_code',//optional
    // 'routing_no',//optional
    // 'charge_info',//optional
    // 'charge',//optional, double
    // 'operator_type',//optional, int,1=personal,2=agent

    public static function getOperator($operator)
    {
        switch($operator){
            case static::BANK:
                return 'Bank';
            case static::MOBILE_BANK:
                return 'Mobile Bank';
            default:
                return 'Unknown';
        }
    }
    public static function getOperatorType($operator_type)
    {
        switch($operator_type){
            case static::PERSONAL:
                return 'Personal';
            case static::AGENT:
                return 'Agent';
            default:
                return 'Unknown';
        }
    }
}
