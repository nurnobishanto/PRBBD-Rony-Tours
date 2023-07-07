<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Order;


class BookingController extends Controller
{
    public function flights(){
        $data = array();
        $data['orders'] = Order::where('user_id',auth('web')->user()->id)->orderBy('id','DESC')->get();
        return view('frontend.user.order',$data);
    }
}
