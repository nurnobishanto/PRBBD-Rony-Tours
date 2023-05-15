<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $json_data = file_get_contents('json/airports.json');
        $airports = json_decode($json_data);
        $time = time();

        $data = array();
        $data['sliders'] = Slider::get();
        $data['airports'] =$airports;
        $data['today'] = date('Y-m-d',$time);

        return view('frontend.index',$data);
    }
}
