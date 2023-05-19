<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlightBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function flight_select(Request $request)
    {
        return view('frontend.checkout', compact('request'));
    }
}
