<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function banks()
    {
        $banks = Bank::get();
        return view('frontend.bank', compact('banks'));
    }

}
