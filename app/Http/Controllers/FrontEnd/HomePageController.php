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
        $data = array();
        $data['sliders'] = Slider::get();
        $data['airports'] =$airports;

        return view('frontend.index',$data);
    }
}
