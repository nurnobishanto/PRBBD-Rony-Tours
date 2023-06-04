<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;

class UserBalance extends Controller
{
    public function index(){
        $data = array();
        $data['deposits'] = Deposit::all();
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
        $data['deposits'] =  Deposit::where('user_id', $user->id)->get();

        return view('frontend.user.wallet',$data);

    }
    public function add_balance_SSLCOMMERZ(Request $request){
        $request->validate([
            'amount'=>'required',
        ]);
        $user = auth('web')->user();
        $post_data = array();
        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = ($request->trxid)?$request->trxid:uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_id'] = $user->id;
        $post_data['cus_name'] = $user->name;
        $post_data['cus_email'] = $user->email;
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Add Fund";
        $post_data['product_category'] = "deposits";
        $post_data['product_profile'] = "deposits";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.

        $deposit = Deposit::where('trxid', $post_data['tran_id'])
            ->updateOrInsert([
                'user_id' => $post_data['cus_id'],
                'amount' => $post_data['total_amount'],
                'paid_by' => 'SSLCOMMERZ',
                'trxid' => $post_data['tran_id'],
                'status' => 'pending',
                'slip' => '',
                'currency' => $post_data['currency'],
                'note' => '',
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function create()
    {
        return view('admin.deposits.create');
    }

}
