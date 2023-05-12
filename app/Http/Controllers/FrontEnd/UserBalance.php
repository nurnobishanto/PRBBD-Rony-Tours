<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserBalance extends Controller
{
    public function wallet(){
        return view('frontend.user.wallet');

    }
}
