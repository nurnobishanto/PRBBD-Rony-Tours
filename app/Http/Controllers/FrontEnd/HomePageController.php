<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {

        $time = time();
        $data = array();
        $data['sliders'] = Slider::get();
        $data['today'] = date('Y-m-d',$time);
        return view('frontend.index',$data);
    }
}
