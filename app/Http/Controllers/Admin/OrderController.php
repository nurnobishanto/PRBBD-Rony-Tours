<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $data = array();
        $data['orders'] = Order::orderBy('id','desc')->get();
        return view('admin.orders.index',$data);
    }
    public function order_details ($id){
        $data = array();
        $data['order'] = Order::find($id);
        return view('admin.orders.details',$data);
    }
}
