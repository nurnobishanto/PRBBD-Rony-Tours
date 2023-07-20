<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class UserBalance extends Controller
{
    public function index(){
        $data = array();
        $data['deposits'] = Deposit::orderBy('id','DESC')->get();
        return view('admin.deposits.index',$data);
    }
    public function deposit_approve($id){
        $deposit = Deposit::find($id);
        $user = User::find($deposit->user_id);
        $userBalance = $user->balance;
        $user->balance = $userBalance + $deposit->amount;
        $user->update();
        $deposit->status = 'success';
        $deposit->update();
        toastr()->success('Deposit approved');
        return redirect()->back();
    }
    public function deposit_reject($id){
        $deposit = Deposit::find($id);
        $deposit->status = 'rejected';
        $deposit->update();
        toastr()->success('Deposit rejected');
        return redirect()->back();
    }
    public function wallet(){
        $user = auth('web')->user();
        $data = array();
        $data['deposits'] =  Deposit::where('user_id', $user->id)->orderBy('id','desc')->get();
        return view('frontend.user.wallet',$data);

    }
    public function add_balance_amar_pay(Request $request){
        echo 'Thank you for your patience. The payment process is currently loading...';
        $request->validate([
            'amount'=>'required|numeric|min:10',
            'service'=>'required',
        ]);
        $user = auth('web')->user();
        $tran_id = ($request->trxid)?$request->trxid:uniqid();
        $currency = 'BDT';
        #Before  going to initiate the payment order status need to insert or update as pending.
         Deposit::where('trxid', $tran_id)
            ->updateOrInsert([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'paid_by' => 'AMAR PAY',
                'trxid' => $tran_id,
                'status' => 'pending',
                'slip' => '',
                'currency' => $currency,
                'note' => $request->service,
            ]);

        $url = env('AMAR_PAY_REQUEST_URL'); // live url https://secure.aamarpay.com/request.php
        $fields = array(
            'store_id' => env('AMAR_PAY_STORE_ID'), //store id will be aamarpay,  contact integration@aamarpay.com for test/live id
            'amount' => $request->amount, //transaction amount
            'payment_type' => 'VISA', //no need to change
            'currency' => $currency,  //currenct will be USD/BDT
            'tran_id' => $tran_id, //transaction id must be unique from your end
            'cus_name' => $user->name,  //customer name
            'cus_email' => $user->email, //customer email address
            'cus_add1' => $user->address,  //customer address
            'cus_add2' => $user->address, //customer address
            'cus_city' => $user->city,  //customer city
            'cus_state' => $user->city,  //state
            'cus_postcode' => $user->post_code, //postcode or zipcode
            'cus_country' => $user->country,  //country
            'cus_phone' => $user->phone, //customer phone number
            'cus_fax' => '',  //fax
            'ship_name' => '', //ship name
            'ship_add1' => '',  //ship address
            'ship_add2' => '',
            'ship_city' => '',
            'ship_state' => '',
            'ship_postcode' => '',
            'ship_country' => '',
            'desc' => 'Add Fund in portal',
            'success_url' => route('success_fund'), //your success route
            'fail_url' => route('fail_fund'), //your fail route
            'cancel_url' => route('cancel_fund'), //your cancel url
            'opt_a' => '',  //optional paramter
            'opt_b' => '',
            'opt_c' => '',
            'opt_d' => '',
            'signature_key' => env('AMAR_PAY_SIGNATURE_KEY')); //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key


        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));
        curl_close($ch);
        redirect_to_amar_pay_merchant($url_forward);

    }

    public function create()
    {
        return view('admin.deposits.create');
    }

}
