<?php

namespace App\Http\Controllers;


use App\Models\Deposit;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AmarPayController extends Controller
{

    public function success_fund(Request $request){
        echo "Transaction is Successful";
        $tran_id = $request->mer_txnid;
        $amount = $request->amount_original;
        $store_amount = $request->store_amount;
        $pg_service_charge_bdt = $request->pg_service_charge_bdt;
        $deposit = Deposit::where('trxid',$tran_id)->first();
        if($deposit){
            if ($deposit->status == 'pending') {
                $user = User::find($deposit->user_id);
                $userBalance = $user->balance;
                $user->balance = $userBalance + $store_amount;
                $user->update();
                $deposit->status = 'success';
                $deposit->update();

                addTrans($tran_id,'Add Fund',$amount,'AMAR PAY',null,$deposit->status);
                toastr()->success('Transaction is successful');

                $msg = 'পিআরবি বিডি তে আপনার '.$store_amount.' টাকা ব্যালান্স যুক্ত হয়েছে। চার্জ '.$pg_service_charge_bdt. 'টাকা এখন আপনার নতুন ব্যালেন্স '.$user->balance.' টাকা ';
                email_send($user->email,'Add Fund '.$amount,$msg);
                send_sms($user->phone,$msg,'Add Fund '.$amount);

                return redirect(route('user.wallet'));

            } else if ($deposit->status == 'success' || $deposit->status == 'complete') {
                toastr()->info('Transaction is successfully Completed');
                return redirect(route('user.wallet'));
            } else {

                toastr()->error('Transaction is unsuccessful','Invalid Transaction');
                return redirect(route('user.wallet'));
            }
        }else {
            toastr()->error('Transaction not found!');
            return redirect(route('user.wallet'));
        }

    }
    public function fail_fund(Request $request){
        echo "Transaction is failed";
        $tran_id = $request->mer_txnid;
        $deposit = Deposit::where('trxid',$tran_id)->first();
        if($deposit){
            if ($deposit->status == 'pending') {
                $deposit->status = 'failed';
                $deposit->update();
                addTrans($tran_id,'Add Fund',$deposit->amount,'AMAR PAY',null,'failed');
                toastr()->error('Transaction is failed');
                return redirect(route('user.wallet'));
            } else if ($deposit->status == 'success' || $deposit->status == 'complete') {
                toastr()->info('Transaction is already Successful');
                return redirect(route('user.wallet'));
            } else {
                toastr()->error('Transaction is Invalid');
                return redirect(route('user.wallet'));
            }
        }else {
            toastr()->error('Transaction not found!');
            return redirect(route('user.wallet'));
        }

    }
    public function cancel_fund(Request $request){
        echo "Transaction is canceled!";
        toastr()->error('Transaction is canceled!');
        return redirect(route('user.wallet'));


    }

    public function success_flight_pay(Request $request){
        echo "Transaction is Successful";
        $tran_id = $request->mer_txnid;
        $amount = $request->amount_original;
        $store_amount = $request->store_amount;
        $pg_service_charge_bdt = $request->pg_service_charge_bdt;
        $order = Order::where('trxid',$tran_id)->first();
        $net_pay = $order->net_pay_amount;
        $profit = $amount - $net_pay;
        if($order){
            if ($order->payment_status == 'pending' ) {
                $user  = User::find($order->user_id) ;
                $user_balance = $user->balance;
                $user->balance = $user_balance + $profit;
                $user->update();

                $order->paid_amount = $net_pay;
                $order->payment_status = 'paid';
                $order->payment_method = 'AMAR PAY';
                $order->update();
                addTrans($tran_id.'P','Flight Booking Profit',$profit,'AMAR PAY',null,'success');
                addTrans($tran_id,'Flight Booking',$net_pay,'AMAR PAY',null,'success');
                toastr()->success('Transaction is successful');

                return complete_order($order);

            }
            else if ($order->payment_status == 'paid' || $order->payment_status == 'complete') {
                toastr()->info('Transaction is successfully Completed');
                return complete_order($order);
            } else {
                toastr()->error('Transaction is unsuccessful','Invalid Transaction');
                return redirect(route('order_details',['id'=>$order->id]));
            }
        }else {
            toastr()->error('Transaction not found!');
            return redirect(route('user.wallet'));
        }

    }
    public function fail_flight_pay(Request $request){
        echo "Transaction is Failed";
        $tran_id = $request->mer_txnid;
        $order = Order::where('trxid',$tran_id)->first();
        if($order){
            addTrans($tran_id,'Flight Booking ',$order->net_pay_amount,'AMAR PAY',null,'failed');
            addTrans($tran_id.'P','Flight Booking Profit',$order->profit_amount,'AMAR PAY',null,'failed');
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
        }else {
            toastr()->error('Transaction not found!');
            return redirect(route('user.wallet'));
        }

    }
    public function cancel_flight_pay(Request $request){
        echo "Transaction is canceled";
        toastr()->error('Transaction not found!');
        return redirect(route('user.wallet'));
    }
}
