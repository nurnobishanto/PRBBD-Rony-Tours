<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Deposit;
use App\Models\Order;
use App\Models\Passenger;
use App\Models\Travel;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use function Termwind\render;

class FlightBookingController extends Controller
{

    public function flight_booking(Request $request)
    {

        $data = [];
        $data['SearchId'] = $request->SearchId;
        $data['ResultID'] = $request->ResultID;
        $url = getSetting('flyhub_url').'AirPrice';

        $client = new Client();
        $requestPayload = [
            "SearchId" => $request->SearchId,
            "ResultID" => $request->ResultID,
        ];



        try {

            $response = $client->post($url, [
                'headers' => [
                    'Authorization' =>getSettingDetails('flyhub_TokenId'),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $requestPayload
            ]);

            $airs = json_decode($response->getBody(), true);
            $data['airs'] =  $airs;

        } catch (RequestException $e) {
            toastr()->warning($e->getMessage(),'Something went wrong! ');
            return redirect(route('home'));
        }




//        $filePath = public_path('json/airPrice.json');
//        $jsonContents = file_get_contents($filePath);
//        $airs = json_decode($jsonContents, true);
//        $data['airs'] =$airs;
        if ($airs['Error']){
            toastr()->warning($airs['Error']['ErrorMessage']);
            return redirect(route('home'));

        }


        $data['IsRefundable'] = $airs['Results'][0]['IsRefundable'];
        $data['FareType'] = $airs['Results'][0]['FareType'];
        $data['PassportMadatory'] = $airs['Results'][0]['PassportMadatory'];
        $data['segments'] = $airs['Results'][0]['segments'];
        $data['passport_date'] =  $airs['Results'][0]['segments'][count($data['segments'])-1]['Destination']['ArrTime'];
        $data['total_ws_amount'] = 0;
        $data['adult_price'] = 0;
        $data['child_price'] = 0;
        $data['infant_price'] = 0;
        $data['total_discount'] =0;

        foreach ($airs['Results'][0]['Fares'] as $fares) {
            $base = $fares['BaseFare'];
            $other = $fares['Tax'] + $fares['OtherCharges'] + $fares['ServiceFee'];
            $count = $fares['PassengerCount'];

            $fee = 0;
            $extra = getSetting('extra_service') ? getSetting('extra_service')  :  0;
            if ($fares['PaxType'] == 'Adult') {
                $fee = ($base * getSetting('adult_service')) / 100;
                $data['adult_price'] = $base + $other+$fee;
            } else if ($fares['PaxType'] == 'Child') {
                $fee = ($base * getSetting('child_service')) / 100;
                $data['child_price'] = $base + $other+$fee;
            } else if ($fares['PaxType'] == 'Infant') {
                $fee = ($base * getSetting('infant_service')) / 100;
                $data['infant_price'] = $base + $other+$fee;
            }
            $total_WS = (($base + $other + $fee) * $count) + $extra;
            $data['total_discount'] += $fares['Discount'];
            $data['total_ws_amount'] += $total_WS;

        }
        if(auth('web')->user()->user_type == 1){
            $data['user_profit'] = ($data['total_discount'] * getSetting('agent_profit')) / 100;
        }else{
            $data['user_profit'] = ($data['total_discount'] * getSetting('user_profit')) / 100;
        }


        $data['total_amount'] = $airs['Results'][0]['TotalFare'];
        $data['gross_amount'] = $airs['Results'][0]['TotalFareWithAgentMarkup'];
        $data['net_pay'] = $data['total_ws_amount'] - $data['user_profit'];
        $data['profit_amount'] = $data['net_pay'] - $airs['Results'][0]['TotalFareWithAgentMarkup'];
        $data['percent'] = (($data['total_ws_amount'] - $data['net_pay']) * 100) / $data['total_ws_amount'];

        $data['net_pay'] = number_format($data['net_pay'], 1, '.', ',');
        $data['total_ws_amount'] = number_format($data['total_ws_amount'], 1, '.', ',');
        $data['percent'] = number_format($data['percent'], 1, '.',);


        return view('frontend.checkout', $data);
    }

    public function flight_booking_step2(Request $request){
        $count = $request->p_count;
        $count_travel = $request->count_travel;
        $expdate = date('Y-m-d',strtotime( $request->passport_date));

        for ($i=1; $i<$count; $i++){
            $title = 'title_'.$i;
            $gender = 'gender_'.$i;

            $paxtype = 'PaxType_'.$i;
            $dob= 'DateOfBirth_'.$i;
            $first_name = 'first_name_'.$i;
            $last_name = 'last_name_'.$i;
            $passport_exp = 'passport_expire_date_'.$i;
           if($request->passport_mandatory){
               if($request->$passport_exp < $expdate){
                   toastr()->warning('Invalid Passport Expire date','Invalid Expire date('.$i.')');
                   return redirect()->back()->withInput();
               }
           }

            if (!preg_match('/^[A-Za-z]{2,}$/', $request->$first_name)) {
                toastr()->warning('Invalid First name','Invalid First Name('.$i.')');
                return redirect()->back()->withInput();
            }
            if (!preg_match('/^[A-Za-z]{2,}$/', $request->$last_name)) {
                toastr()->warning('Invalid last name','Invalid last Name('.$i.')');
                return redirect()->back()->withInput();
            }
            if($request->$paxtype == 'Infant'){
                if(calculateAge(date('Y-m-d',strtotime($request->$dob)))>2){
                    toastr()->warning('Invalid Infant date of birth','Invalid DOB ('.$i.')');
                    return redirect()->back()->withInput();
                }
            }
            if($request->$paxtype == 'Child'){
                if(calculateAge(date('Y-m-d',strtotime($request->$dob)))>12 || calculateAge(date('Y-m-d',strtotime($request->$dob)))<2){
                    toastr()->warning('Invalid Child date of birth','Invalid DOB ('.$i.')');
                    return redirect()->back()->withInput();
                }
            }
            if($request->$paxtype == 'Adult'){
                if(calculateAge(date('Y-m-d',strtotime($request->$dob)))<12){
                    toastr()->warning('Invalid Adult date of birth','Invalid DOB ('.$i.')');
                    return redirect()->back()->withInput();
                }
            }

            if ($request->$title == 'Mstr' || $request->$title == 'Mr'){
                if($request->$gender == 'Female'){
                    toastr()->warning('Invalid Gender for title','Invalid Gender('.$i.')');
                    return redirect()->back()->withInput();
                }
            }
        }
        $order = Order::create([
            'user_id'=>auth('web')->user()->id,
            'trxid'=>uniqid(),
            'payment_status'=>'pending',
            'result_id'=>$request->result_id,
            'fare_type'=>$request->fare_type,
            'passport_mandatory'=>$request->passport_mandatory,
            'search_id'=>$request->search_id,
            'booking_time'=>Carbon::now(),
            'total_amount'=>str_replace(',', '',$request->total_amount),
            'gross_amount'=>str_replace(',', '',$request->gross_amount),
            'discount_amount'=>str_replace(',', '', $request->discount_amount),
            'total_ws_amount'=>str_replace(',', '', $request->total_ws_amount),
            'net_pay_amount'=>str_replace(',', '',$request->net_pay),
            'profit_amount'=>str_replace(',', '', $request->profit_amount),
            'paid_amount'=>0.0,
            'status'=>'pending',
        ]);
        for ($i=1; $i<$count; $i++){
            $title = 'title_'.$i;
            $pax_type = 'PaxType_'.$i;
            $first_name = 'first_name_'.$i;
            $last_name = 'last_name_'.$i;
            $email = 'email_'.$i;
            $phone = 'phone_'.$i;
            $dob = 'DateOfBirth_'.$i;
            $gender = 'gender_'.$i;
            $passport_no = 'passport_no_'.$i;
            $passport_exp = 'passport_expire_date_'.$i;
            $addr = 'address_'.$i;
            $nationality = 'nationality_'.$i;
            $passenger = Passenger::create([
                'user_id'=>auth('web')->user()->id,
                'title' => $request->$title,
                'first_name' => $request->$first_name,
                'last_name' => $request->$last_name,
                'pax_type' => $request->$pax_type,
                'email' => $request->$email,
                'contact_number' => $request->$phone,
                'gender' => $request->$gender,
                'dob' => $request->$dob,
                'country' => "BD",
                'passport_no' => $request->$passport_no,
                'passport_expire_date' => $request->$passport_exp,
                'nationality' => "BD",
                'address' => $request->$addr,
            ]);
            $order->passengers()->attach([$passenger->id]);
        }
        for ($j=1; $j<$count_travel; $j++){
            $from = 'from_'.$j;
            $to = 'to_'.$j;
            $carrier = 'carrier_'.$j;
            $distance = 'distance_'.$j;
            $duration = 'duration_'.$j;
            $cabin_class = 'cabin_class_'.$j;
            $arrival_time = 'arrival_time_'.$j;
            $departure_time = 'departure_time_'.$j;
            $return_date = 'return_date_'.$j;
            $airline_name = 'airline_name_'.$j;
            $airline_code = 'airline_code_'.$j;
            $trip_group = 'trip_group_'.$j;
            $trip_indicator = 'trip_indicator_'.$j;
            Travel::create([
                'order_id' =>$order->id,
                'from' => $request->$from,
                'to' => $request->$to,
                'carrier' => $request->$carrier,
                'distance' => $request->$distance,
                'duration' => $request->$duration,
                'cabin_class' => $request->$cabin_class,
                'arrival_time' => $request->$arrival_time,
                'departure_time' => $request->$departure_time,
                'return_date' => $request->$return_date,
                'airline_name' => $request->$airline_name,
                'airline_code' => $request->$airline_code,
                'trip_group' => $request->$trip_group,
                'trip_indicator' => $request->$trip_indicator,
            ]);
        }
        return redirect()->route('order_details',['id'=>$order->id]);

    }
    public function order_pay($id,Request $request){

        $order = Order::find($id);
        $user = auth('web')->user();

        if($request->payment == 'book_hold'){
            $prebook = $this->prebookOrder($order);
            if($prebook){
                $this->bookOrder($order);
            }
            return redirect()->back();

        }
        elseif ($request->payment == 'fund'){

            if ($order->payment_status == 'paid'){

                return FlightBookingController::complete_order($order);
            }
            else if($user->balance < $order->net_pay_amount){
                toastr()->warning('Not available balance in your fund!');
                return redirect()->back();
            }else{
                $user->balance = $user->balance - $order->net_pay_amount;
                $user->update();
                $order->paid_amount = $order->net_pay_amount;
                $order->payment_status = 'paid';
                $order->payment_method = 'Paid by fund';
                $order->update();
                return FlightBookingController::complete_order($order);
            }

        }
        elseif ($request->payment == 'SSLCOMMERZ'){
            $order->payment_status = 'pending';
            $order->update();
            if($user->user_type){
               return $this->pay_with_SSLCOMMERZ($order->total_ws_amount,$order->trxid);
            }else{


                return $this->pay_with_SSLCOMMERZ($order->net_pay_amount,$order->trxid);
            }

        }

    }
    public function order_details($id){
        $data = array();
        $data['order'] = Order::find($id);
        return view('frontend.confirm', $data);
    }

    static public function prebookOrder($order){

        $passengers = [];
        $isLead = 'true';
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
            $isLead = 'false';
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
    static public function bookOrder($order){

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
    public function pay_with_SSLCOMMERZ($amount,$trxid){

        $user = User::find(auth('web')->user()->id) ;
        $post_data = array();
        $post_data['total_amount'] = $amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $trxid; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_id'] = $user->id;
        $post_data['cus_name'] = $user->name;
        $post_data['cus_email'] = $user->email;
        $post_data['cus_add1'] = $user->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = $user->city;
        $post_data['cus_state'] = $user->city;
        $post_data['cus_postcode'] = $user->post_code;
        $post_data['cus_country'] = $user->country;
        $post_data['cus_phone'] = $user->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "";
        $post_data['ship_add1'] = "";
        $post_data['ship_add2'] = "";
        $post_data['ship_city'] = "";
        $post_data['ship_state'] = "";
        $post_data['ship_postcode'] = $user->post_code;
        $post_data['ship_phone'] = $user->phone;
        $post_data['ship_country'] = $user->country;

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Flight Booking";
        $post_data['product_category'] = "Ticket";
        $post_data['product_profile'] = "General";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "flight_booking";
        $post_data['value_b'] = "flight_booking";
        $post_data['value_c'] = "flight_booking";
        $post_data['value_d'] = "flight_booking";


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }
    static  public function complete_order($order){

        if($order->payment_status =='paid'){
            if($order->status == 'pending' || $order->status == null){
                if (FlightBookingController::prebookOrder($order)){
                    if (FlightBookingController::bookOrder($order)){
                        toastr()->success('Booked Successfully');
                    }
                }else{
                    toastr()->warning('Something Went wrong');
                }
            }else if($order->status == 'hold'){
                if (FlightBookingController::bookOrder($order)){
                    toastr()->success('Booked Successfully');
                }
            }else{
                toastr()->warning('Something Went wrong');
            }
        }
        return redirect(route('order_details',['id'=>$order->id]));
    }
    public function order_refresh($id){


        $order = Order::find($id);
        $requestPayload = [
            "BookingID" => $order->booking_id
        ];
        $client = new Client();
        try {
            $url = getSetting('flyhub_url').'AirRetrieve';
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

        }else {
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
                $passenger->address = $airs['Passengers'][$i]['Address1'] . " " . $airs['Passengers'][$i]['Address2'];
                $passenger->update();
                $i++;
            }
            $order->booking_status = $airs['BookingStatus'];
            $order->status = $airs['BookingStatus'];
            $order->booking_id = $airs['BookingID'];
            $order->last_ticket_date = $airs['Results'][0]['LastTicketDate'];
            $order->update();
            toastr()->success('Refreshed!');
        }

        return redirect()->back();
    }
    public function ticket_issue($id){
        $order = Order::find($id);

        $requestPayload = [
            "BookingID" => $order->booking_id,
            "IsAcceptedPriceChangeandIssueTicket" => true
        ];
        $client = new Client();

        try {
            $url = getSetting('flyhub_url').'AirTicketing';
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

//        $filePath = public_path('json/airTicket.json');
//        $jsonContents = file_get_contents($filePath);
//        $airs = json_decode($jsonContents, true);

        if($airs['Results'] ==null){
            toastr()->warning($airs['Error']['ErrorMessage']);

        }else {
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
                $passenger->address = $airs['Passengers'][$i]['Address1'] . " " . $airs['Passengers'][$i]['Address2'];
                $passenger->update();
                $i++;
            }
            $order->booking_status = $airs['BookingStatus'];
            $order->booking_id = $airs['BookingID'];
            $order->status = $airs['BookingStatus'];
            $order->last_ticket_date = $airs['Results'][0]['LastTicketDate'];
            $order->update();

            $user = $order->user;
            $msg = 'পিআরবি বিডি তে ,ফ্লাইট টিকেট ইস্যু করেছেন। Booking ID : '.$order->booking_id.' Status: '.$order->booking_status.',ভিসিট করুন : prbbd.com';
            send_sms($user->phone,$msg,'Flight booking');
            email_send($user->email,'Flight booking',$msg);

            toastr()->success('Ticket Issued');
        }
        return redirect()->back();


    }
    public function invoice($id,$p){
        $order = Order::find($id);
        $client = new Client();
        try {
            $url = getSetting('flyhub_url').'DownloadInvoice';
            $query = http_build_query([
                'BookingID' => $order->booking_id,
                'ShowPassenger' => ($p)?'true':'false',
            ]);
            $response = $client->get($url . '?' . $query, [
                'headers' => [
                    'Authorization' =>  getSettingDetails('flyhub_TokenId'),
                ],
            ]);

//            $data = json_decode($response->getBody(), true);
//            if($data['Response']['ErrorCode']){
//                toastr()->error($data['Response']['ErrorMessage']);
//                return  redirect()->back();
//
//            }


            // Retrieve the file content
            $fileContent = $response->getBody();

            // Generate a unique filename for the downloaded invoice
            $filename = 'invoice_'.$order->booking_id.'.pdf';

            // Set the appropriate headers for the file download
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $filename . '"');

            // Output the file content
            echo $fileContent;
            toastr()->error('Downloaded');
            // Terminate the script after downloading
            exit();
        } catch (RequestException $e) {
            toastr()->error('Problem'.$e->getMessage());
        }
        return redirect()->back();

    }
    public function cancel_ticket($id){
        $order = Order::find($id);

        $requestPayload = [
            "BookingID" => $order->booking_id,
        ];

        $client = new Client();
        try {
            $url = getSetting('flyhub_url').'AirCancel';

            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer '.getSettingDetails('flyhub_TokenId'),
                    'Content-Type' => 'application/json',
                ],
                'json' => $requestPayload
            ]);


            $airs = json_decode($response->getBody(), true);

            if($airs['Error']['ErrorCode']){
                toastr()->error($airs['Error']['ErrorMessage']);
            }else{
                $order->status = 'Canceled';
                $order->update();

                $user = $order->user;
                $msg = 'পিআরবি বিডি তে ,ফ্লাইট টিকেট বাতিল করেছেন। Booking ID : '.$order->booking_id.' Status: '.$order->status.',ভিসিট করুন : prbbd.com';
                send_sms($user->phone,$msg,'Flight booking');
                email_send($user->email,'Flight booking',$msg);

                toastr()->error('Air ticket Canceled');

            }


        } catch (RequestException $e) {

        }

        return redirect()->back();
    }
    public function downloadTicket($id,$ticket,$pax_index)
    {
        $order = Order::find($id);
        if($order){
            if($order->booking_status == 'Ticketed'){
                if ($ticket) {
                    $ticketNo = $ticket;
                    $client = new Client();
                    try {

                        $url = getSetting('flyhub_url') . 'DownloadTicket';
                        $bookingID = $order->booking_id;
                        $resultID = $order->result_id;
                        $paxIndex = $pax_index;
                        $ticketNumber = $ticketNo;
                        $showFare = 'false';
                        $showAllPax = 'true';

                        $query = http_build_query([
                            'BookingID' => $bookingID,
                            'ResultID' => $resultID,
                            'PaxIndex' => $paxIndex,
                            'TicketNumber' => $ticketNumber,
                            'ShowFare' => $showFare,
                            'ShowAllPax' => $showAllPax,
                        ]);
                        $response = $client->get($url . '?' . $query, [
                            'headers' => [
                                'Authorization' => 'Bearer ' . getSettingDetails('flyhub_TokenId'),
                            ],
                        ]);

                        // Retrieve the file content
                        $fileContent = $response->getBody();

                        // Generate a unique filename for the downloaded invoice
                        $filename = 'ticket_'.$ticketNo.'.pdf';

                        // Set the appropriate headers for the file download
                        header('Content-Type: application/pdf');
                        header('Content-Disposition: attachment; filename="' . $filename . '"');

                        // Output the file content
                        echo $fileContent;
                        // Terminate the script after downloading
                        exit();
                    } catch (RequestException $e) {
                        echo 'Problem'.$e->getMessage();
                    }
                }

            }else{
                toastr()->error($order->booking_status);
                return redirect()->back();
            }

        }else{
            toastr()->error('Order Not found!');
            return redirect()->back();
        }


    }


}
