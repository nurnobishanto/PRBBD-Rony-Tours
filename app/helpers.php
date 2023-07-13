<?php

use App\Http\Controllers\Frontend\FlightBookingController;
use App\Mail\SendEmail;
use App\Models\EmailLog;
use App\Models\Setting;
use App\Models\SmsLog;
use App\Models\Transaction;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


function getSetting($key)
{
    $setting = Setting::where('key', $key)->first();
    return $setting ? $setting->value : null;
}
function getSettingDetails($key)
{
    $setting = Setting::where('key', $key)->first();
    return $setting ? $setting->details : null;
}
function setSetting($key, $value,$details)
{
    $setting = Setting::where('key', $key)->first();
    if($setting){
        $setting->key = $key;
        $setting->value = $value;
        $setting->details = $details;
        $setting->update();
    }else{
        $setting = Setting::create([
            'key' => $key,
            'value' => $value,
            'details' => $details
        ]);
    }

    return $setting;
}
if(!function_exists('getImageUrl'))
{
    function getImageUrl($image = null){
        if($image == null) return asset('default.jpg');

        return asset('uploads/'.$image);
    }
}
function checkRolePermissions($role,$permissions){
    $status = true;
    foreach ($permissions as $permission){
        if(!$role->hasPermissionTo($permission)){
            $status = false;
        }
    }

    return $status;
}
function allCountries(){
    $json_str = '';
    $json_data = file_get_contents('json/country.json');
    return json_decode($json_data, true)['countries'];
}
function convertMinutesToDuration($minutes) {
    $hours = floor($minutes / 60);
    $remainingMinutes = $minutes % 60;

    $duration = '';

    if ($hours > 0) {
        $duration .= $hours . ' Hour ';
    }

    if ($remainingMinutes > 0) {
        $duration .= $remainingMinutes . ' Minute';
    }

    return trim($duration);
}
function calculateAge($birthdate) {
    $today = new DateTime();
    $diff = $today->diff(new DateTime($birthdate));
    return $diff->y;
}
function addSMSLog($phone,$sms,$sender,$status,$type)
{
    SmsLog::create([
        'phone' => $phone,
        'msg' => $sms,
        'sender_id' => $status,
        'status' => $status,
        'type'=>$type,
    ]);
}
function number_validation($number) {

    $number = str_replace(' ', '', $number);
    $number = str_replace('-', '', $number);

    if (preg_match('/^(\+880|880|0)?1(1|5|6|7|8|9)\d{8}$/', $number) == 1) {

        if (preg_match("/^\+88/", $number) == 1) {
            $number = str_replace('+', '', $number);
        }
        if (preg_match("/^880|^0/", $number) == 0) {
            $number = "880" . $number;
        }
        if (preg_match("/^88/", $number) == 0) {
            $number = "88" . $number;
        }

        return $number;
    } else {
        return false;
    }
}
function send_sms($number,$msg,$type){
    $provider = getSetting('sms_provider');
    if($provider == 'bulk_sms_bd'){
        $status =  bulksmsbd_sms_send($number,$msg);
        addSMSLog($number,$msg,getSetting('bulk_sms_bd_sender_id'),$status,$type);
        return $status;
    }
}
function bulksmsbd_sms_send($phone_number,$msg) {

    $url = "http://bulksmsbd.net/api/smsapi";
    $api_key = getSetting('bulk_sms_bd_api');
    $senderid = getSetting('bulk_sms_bd_sender_id');
    $number = number_validation($phone_number);
    $message = trim($msg);

    $data = [
        "api_key" => $api_key,
        "senderid" => $senderid,
        "number" => $number,
        "message" => $message
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);


    $data = json_decode($response);
    if($data->response_code == 202){
        toastr()->success($data->success_message,'SMS sent successful');
        return $data->success_message;
    }else{
        toastr()->error($data->error_message,'SMS sent failed!');
        return $data->error_message;
    }
}
function get_balance_bulksmsbd() {
    if(getSetting('bulk_sms_bd_api')){
        $url = "http://bulksmsbd.net/api/getBalanceApi";
        $api_key = getSetting('bulk_sms_bd_api');
        $data = [
            "api_key" => $api_key
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);
        if($data->response_code == 202){
            return $data->balance;
        }else{
            return $data->error_message;
        }
    }
    else{
        return 'Enter api key to know balance';
    }

}
function flyhubBalance(){

    $client = new Client();
    $requestPayload = [
        "UserName" => getSetting('flyhub_username'),
    ];

    try {
        $response = $client->post('http://api.sandbox.flyhub.com/api/v1/GetBalance', [
            'headers' => [
                'Authorization' =>getSettingDetails('flyhub_TokenId'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => $requestPayload
        ]);
        $airs = json_decode($response->getBody(), true);

    } catch (RequestException $e) {
        return 'Error';
    }
    return $airs['Balance'];
}
function flyhubCredit(){

    $client = new Client();
    $requestPayload = [
        "UserName" => getSetting('flyhub_username'),
    ];

    try {
        $response = $client->post('http://api.sandbox.flyhub.com/api/v1/GetBalance', [
            'headers' => [
                'Authorization' =>getSettingDetails('flyhub_TokenId'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => $requestPayload
        ]);
        $airs = json_decode($response->getBody(), true);

    } catch (RequestException $e) {
        return 'Error';
    }
    return $airs['Credits'];
}
function addTrans($trxid,$type,$amount,$method,$note,$status): void
{
    $trans = Transaction::where('trxid',$trxid)->first();
    if($trans){
        $trans->trxid = $trxid;
        $trans->debit_credit = $type;
        $trans->amount = $amount;
        $trans->method = $method;
        $trans->note = $note;
        $trans->status = $status;
        $trans->update();
    }else{
        Transaction::create([
            'trxid' =>$trxid,
            'debit_credit' =>$type,
            'amount' =>$amount,
            'method' =>$method,
            'note' =>$note,
            'status' =>$status,
        ]);
    }

}
function addEmailLog($sender, $receiver, $subject, $body,$status){

    EmailLog::create([
        'receiver_email' => $receiver,
        'msg' => $body,
        'sender_email' => $sender,
        'type' => $subject,
        'status' => $status,
    ]);
}
function complete_order($order){
    if($order->payment_status =='paid'){
        if($order->status == 'pending' || $order->status == null){
            if (prebookOrder($order)){
                if (bookOrder($order)){
                    toastr()->success('Booked Successfully');
                }
            }else{
                toastr()->warning('Something Went wrong');
            }
        }else if($order->status == 'hold'){
            if (bookOrder($order)){
                toastr()->success('Booked Successfully');
            }
        }else{
            toastr()->warning('Something Went wrong');
        }
    }
    return redirect(route('order_details',['id'=>$order->id]));
}
function prebookOrder($order){
    $passengers = [];
    $isLead = true;
    foreach ($order->passengers as $psngr){
        $passenger = [
            "Title" =>  $psngr->title,
            "FirstName" =>  $psngr->first_name,
            "LastName" =>  $psngr->last_name,
            "PaxType" =>  $psngr->pax_type,
            "DateOfBirth" => $psngr->dob,
            "Gender" =>  $psngr->gender,
            "Address1" =>  $psngr->address,
            "CountryCode" =>  "BD",
            "Nationality" =>  "BD",
            "ContactNumber" =>  $psngr->contact_number,
            "Email" =>  $psngr->email,
            "IsLeadPassenger" => $isLead,
            "PassportNumber" => $psngr->passport_no,
            "PassportExpiryDate" => $psngr->passport_expire_date,
            "PassportNationality" => "BD"
        ];
        $passengers[] = $passenger;
        $isLead = false;
    }

    $requestPayload = [
        "SearchID" => $order->search_id,
        "ResultID" => $order->result_id,
        "Passengers" => $passengers
    ];



    $client = new Client();
    try {
        $url = getSetting('flyhub_url').'AirPreBook';
        $response = $client->post($url, [
            'headers' => [
                'Authorization' =>getSettingDetails('flyhub_TokenId'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => $requestPayload
        ]);

        $airs = json_decode($response->getBody(), true);

        if($airs['Results'] ==null){
            toastr()->warning($airs['Error']['ErrorMessage']);
            return false;
        }else{
            $order->booking_expired = date('Y-m-d', strtotime('-1 day', strtotime($order->from()->departure_time)));
            $order->status = 'PreBooked';
            $order->update();
            toastr()->warning('Pre-book Successfully');
            return true;
        }
    } catch (RequestException $e) {

    }


}
function bookOrder($order){
    $passengers = [];
    $isLead = true;
    foreach ($order->passengers as $psngr){
        $passenger = [
            "Title" =>  $psngr->title,
            "FirstName" =>  $psngr->first_name,
            "LastName" =>  $psngr->last_name,
            "PaxType" =>  $psngr->pax_type,
            "DateOfBirth" => $psngr->dob,
            "Gender" =>  $psngr->gender,
            "Address1" =>  $psngr->address,
            "CountryCode" =>  "BD",
            "Nationality" =>  "BD",
            "ContactNumber" =>  $psngr->contact_number,
            "Email" =>  $psngr->email,
            "IsLeadPassenger" => $isLead,
            "PassportNumber" => $psngr->passport_no,
            "PassportExpiryDate" => $psngr->passport_expire_date,
            "PassportNationality" => "BD"
        ];
        $passengers[] = $passenger;
        $isLead = false;
    }

    $requestPayload = [
        "SearchID" => $order->search_id,
        "ResultID" => $order->result_id,
        "Passengers" => $passengers
    ];

    $client = new Client();
    try {
        $url = getSetting('flyhub_url').'AirBook';
        $response = $client->post($url, [
            'headers' => [
                'Authorization' =>getSettingDetails('flyhub_TokenId'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => $requestPayload
        ]);

        $airs = json_decode($response->getBody(), true);

    } catch (RequestException $e) {

    }
    if($airs['Results'] ==null){
        toastr()->warning($airs['Error']['ErrorMessage']);
        return false;
    }else{
        $i = 0;
        foreach ($order->passengers as $passenger) {
            $passenger->pax_index = $airs['Passengers'][$i]['PaxIndex'];
            $passenger->ticket = $airs['Passengers'][$i]['Ticket'];
            $passenger->title = $airs['Passengers'][$i]['Title'];
            $passenger->first_name = $airs['Passengers'][$i]['FirstName'];
            $passenger->last_name = $airs['Passengers'][$i]['LastName'];
            $passenger->pax_type = $airs['Passengers'][$i]['PaxType'];
            $passenger->email = $airs['Passengers'][$i]['Email'];
            $passenger->contact_number = $airs['Passengers'][$i]['ContactNumber'];
            $passenger->gender = $airs['Passengers'][$i]['Gender'];
            $passenger->dob = $airs['Passengers'][$i]['DateOfBirth'];
            $passenger->passport_no = $airs['Passengers'][$i]['PassportNumber'];
            $passenger->passport_expire_date = $airs['Passengers'][$i]['PassportExpiryDate'];
            $passenger->nationality = $airs['Passengers'][$i]['Nationality'];
            $passenger->address = $airs['Passengers'][$i]['Address1']." ".$airs['Passengers'][$i]['Address2'];
            $passenger->update();
            $i++;
        }
        $order->booking_status = $airs['BookingStatus'];
        $order->status = $airs['BookingStatus'];
        $order->booking_id = $airs['BookingID'];
        $order->last_ticket_date = $airs['Results'][0]['LastTicketDate'];
        $order->booking_expired = $airs['Results'][0]['LastTicketDate'];
        $order->update();

        $user = $order->user;
        $msg = 'পিআরবি বিডি তে ,ফ্লাইট বুকিং করেছেন। Booking ID : '.$order->booking_id.' Status: '.$order->booking_status.',ভিসিট করুন : prbbd.com';
        send_sms($user->phone,$msg,'Flight booking');
        email_send($user->email,'Flight booking',$msg);
        return true;

    }



}
function email_send($to,$subject,$body){

    $dynamicData = [
        'body' => $body,
    ];
    $from = env('MAIL_FROM_ADDRESS');
    if(Mail::to($to)->send(new SendEmail($dynamicData,$subject))){
        addEmailLog($from,$to,$subject,$body,'success');
        toastr()->success('Email sent success');
    }else{
        addEmailLog($from,$to,$subject,$body,'failed');
        toastr()->success('Email sent failed');
    }

    return redirect()->back();

}
