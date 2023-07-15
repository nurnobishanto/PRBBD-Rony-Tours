<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Order;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
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
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
//        $update_product = DB::table('orders')
//            ->where('transaction_id', $post_data['tran_id'])
//            ->updateOrInsert([
//                'name' => $post_data['cus_name'],
//                'email' => $post_data['cus_email'],
//                'phone' => $post_data['cus_phone'],
//                'amount' => $post_data['total_amount'],
//                'status' => 'Pending',
//                'address' => $post_data['cus_add1'],
//                'transaction_id' => $post_data['tran_id'],
//                'currency' => $post_data['currency']
//            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
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
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
//        $update_product = DB::table('orders')
//            ->where('transaction_id', $post_data['tran_id'])
//            ->updateOrInsert([
//                'name' => $post_data['cus_name'],
//                'email' => $post_data['cus_email'],
//                'phone' => $post_data['cus_phone'],
//                'amount' => $post_data['total_amount'],
//                'status' => 'Pending',
//                'address' => $post_data['cus_add1'],
//                'transaction_id' => $post_data['tran_id'],
//                'currency' => $post_data['currency']
//            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";
        return $request;
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $sslc = new SslCommerzNotification();
        if($request->input('value_a') == 'deposit'){
            $deposit = Deposit::where('trxid',$tran_id)->first();


            if($deposit){
                if ($deposit->status == 'pending') {
                    $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);
                    if ($validation) {

                        $user = User::find($deposit->user_id);
                        $userBalance = $user->balance;
                        $user->balance = $userBalance + $deposit->amount;
                        $user->update();

                        $deposit->status = 'success';
                        $deposit->update();
                        addTrans($tran_id,'Add Fund',$amount,'SSLCOMMRZE',null,$deposit->status);
                        toastr()->success('Transaction is successful');
                       return redirect(route('user.wallet'));
                    }
                } else if ($deposit->status == 'success' || $deposit->status == 'complete') {
                    toastr()->info('Transaction is successfully Completed');
                    return redirect(route('user.wallet'));
                } else {

                    toastr()->error('Transaction is unsuccessful','Invalid Transaction');
                    return redirect(route('user.wallet'));
                }
            }
        }
        else if($request->input('value_a') == 'flight_booking'){
            $order = Order::where('trxid',$tran_id)->first();
            $net_pay = $order->net_pay_amount;
            $profit = $amount - $net_pay;
            if($order){
                if ($order->payment_status == 'pending' ) {
                    $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

                    if ($validation) {
                        $user  = User::find($order->user_id) ;

                        $user_balance = $user->balance;
                        $user->balance = $user_balance + $profit;
                        $user->update();

                        $order->paid_amount = $net_pay;
                        $order->payment_status = 'paid';
                        $order->payment_method = 'SSLCOMMRZE';
                        $order->update();
                        addTrans($tran_id.'P','Flight Booking Profit',$profit,'SSLCOMMRZE',null,'success');
                        addTrans($tran_id,'Flight Booking',$net_pay,'SSLCOMMRZE',null,'success');
                        toastr()->success('Transaction is successful');

                        return complete_order($order);
                    }
                } else if ($order->payment_status == 'paid' || $order->payment_status == 'complete') {
                    toastr()->info('Transaction is successfully Completed');
                    return complete_order($order);
                } else {

                    toastr()->error('Transaction is unsuccessful','Invalid Transaction');
                    return redirect(route('order_details',['id'=>$order->id]));
                }
            }
        }




    }

    public function fail(Request $request)
    {

        $tran_id = $request->input('tran_id');

        if($request->input('value_a') == 'deposit'){
            $deposit = Deposit::where('trxid',$tran_id)->first();
            if($deposit){
                if ($deposit->status == 'pending') {
                    $deposit->status = 'failed';
                    $deposit->update();
                    addTrans($tran_id,'Add Fund',$deposit->amount,'SSLCOMMRZE',null,'failed');
                    toastr()->error('Transaction is failed');
                    return redirect(route('user.wallet'));
                } else if ($deposit->status == 'success' || $deposit->status == 'complete') {
                    toastr()->info('Transaction is already Successful');
                    return redirect(route('user.wallet'));
                } else {
                    toastr()->error('Transaction is Invalid');
                    return redirect(route('user.wallet'));
                }
            }
        }elseif ($request->input('value_a') == 'flight_booking'){
            $order = Order::where('trxid',$tran_id)->first();
            if($order){
                addTrans($tran_id,'Flight Booking ',$order->net_pay_amount,'SSLCOMMRZE',null,'failed');
                addTrans($tran_id.'P','Flight Booking Profit',$order->profit_amount,'SSLCOMMRZE',null,'failed');
                if ($order->payment_status == 'pending') {
                    $order->payment_status = 'failed';
                    $order->update();

                    toastr()->error('Transaction is failed');
                    return redirect(route('order_details',['id'=>$order->id]));
                } else if ($order->payment_status == 'paid' || $order->payment_status == 'complete') {
                    toastr()->info('Transaction is already Successful');
                    return redirect(route('order_details',['id'=>$order->id]));
                } else {
                    toastr()->error('Transaction is Invalid');
                    return redirect(route('order_details',['id'=>$order->id]));
                }
            }
        }





    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        if($request->input('value_a') == 'deposit'){
            $deposit = Deposit::where('trxid',$tran_id)->first();
            if($deposit){
                if ($deposit->status == 'pending') {
                    $deposit->status = 'canceled';
                    $deposit->update();
                    addTrans($tran_id,'Add Fund',$deposit->amount,'SSLCOMMRZE',null,'canceled');
                    toastr()->error('Transaction is Cancel');
                    return redirect(route('user.wallet'));

                } else if ($deposit->status == 'success' || $deposit->status == 'complete') {
                    toastr()->info('Transaction is already Successful');
                    return redirect(route('user.wallet'));
                } else {
                    toastr()->error('Transaction is Invalid');
                    return redirect(route('user.wallet'));
                }
            }
        }elseif ($request->input('value_a') == 'flight_booking'){
            $order = Order::where('trxid',$tran_id)->first();
            if($order){
                if ($order->payment_status == 'pending') {
                    $order->payment_status = 'canceled';
                    $order->update();
                    addTrans($tran_id,'Flight Booking ',$order->net_pay_amount,'SSLCOMMRZE',null,'canceled');
                    addTrans($tran_id.'P','Flight Booking Profit',$order->profit_amount,'SSLCOMMRZE',null,'canceled');
                    toastr()->error('Transaction is Cancel');
                    return redirect(route('order_details',['id'=>$order->id]));

                } else if ($order->payment_status == 'paid' || $order->payment_status == 'complete') {
                    toastr()->info('Transaction is already Successful');
                    return redirect(route('order_details',['id'=>$order->id]));
                } else {
                    toastr()->error('Transaction is Invalid');
                    return redirect(route('order_details',['id'=>$order->id]));
                }
            }
        }





    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $deposit = Deposit::where('trxid',$tran_id)->first();
            if($deposit){
                if ($deposit->status == 'pending') {
                    $sslc = new SslCommerzNotification();
                    $validation = $sslc->orderValidate($request->all(), $tran_id, $deposit->amount, $deposit->currency);
                    if ($validation == TRUE) {
                        /*
                        That means IPN worked. Here you need to update order status
                        in order table as Processing or Complete.
                        Here you can also sent sms or email for successful transaction to customer
                        */
                        $deposit->status = 'success';
                        $deposit->update();

                        toastr()->info('Transaction is successfully Completed');
                        return redirect()->back();
                    }
                } else if ($deposit->status == 'success' || $deposit->status == 'complete') {
                    #That means Order status already updated. No need to udate database.
                    toastr()->info('Transaction is already successfully Completed');
                    return redirect()->back();
                } else {
                    #That means something wrong happened. You can redirect customer to your product page.
                    toastr()->error('Invalid Transaction');
                    return redirect()->back();
                }
            }


        } else {

            toastr()->error('Invalid Data');
            return redirect()->back();
        }
    }

}
