<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Passenger;
use App\Models\Travel;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class FlightBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function flight_booking(Request $request)
    {

        $data = [];
        $data['SearchId'] = $request->SearchId;
        $data['ResultID'] = $request->ResultID;

        $client = new Client();
        $requestPayload = [
            "SearchId" => $request->SearchId,
            "ResultID" => $request->ResultID,
        ];

        try {
            $url = getSetting('flyhub_url').'AirPrice';
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

        }

//        $filePath = public_path('json/airPrice.json');
//        $jsonContents = file_get_contents($filePath);
//        $airs = json_decode($jsonContents, true);
//        $data['airs'] =$airs;


        $data['IsRefundable'] = $airs['Results'][0]['IsRefundable'];
        $data['PassportMadatory'] = $airs['Results'][0]['PassportMadatory'];
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
            $data['total_discount'] += $fares['Discount']+500;
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
        for ($i=1; $i<$count; $i++){
            $paxtype = 'PaxType_'.$i;
            $dob= 'DateOfBirth_'.$i;
            $first_name = 'first_name_'.$i;
            $last_name = 'last_name_'.$i;
            $passport_exp = 'passport_expire_date_'.$i;
            $date = date('m/d/y', strtotime('+7 day'));


            if($request->$passport_exp < $date){
                toastr()->warning('Invalid Passport Expire dat','Invalid Expire date('.$i.')');
                return redirect()->back()->withInput();
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
                    toastr()->warning('Invalid Infant date of birth','Invalid');
                    return redirect()->back()->withInput();
                }
            }
            if($request->$paxtype == 'Child'){
                if(calculateAge(date('Y-m-d',strtotime($request->$dob)))>12 || calculateAge(date('Y-m-d',strtotime($request->$dob)))<2){
                    toastr()->warning('Invalid Child date of birth','Invalid');
                    return redirect()->back()->withInput();
                }
            }
            if($request->$paxtype == 'Adult'){
                if(calculateAge(date('Y-m-d',strtotime($request->$dob)))<12){
                    toastr()->warning('Invalid Adult date of birth','Invalid');
                    return redirect()->back()->withInput();
                }
            }
        }
        $order = Order::create([
            'user_id'=>auth('web')->user()->id,
            'trxid'=>uniqid(),
            'payment_status'=>'pending',
            'result_id'=>$request->result_id,
            'search_id'=>$request->search_id,
            'booking_time'=>Carbon::now(),
            'total_amount'=>str_replace(',', '',$request->total_amount),
            'gross_amount'=>str_replace(',', '',$request->gross_amount),
            'discount_amount'=>str_replace(',', '', $request->discount_amount),
            'total_ws_amount'=>str_replace(',', '', $request->total_ws_amount),
            'net_pay_amount'=>str_replace(',', '',$request->net_pay),
            'profit_amount'=>str_replace(',', '', $request->profit_amount),
            'paid_amount'=>0.0,
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
        if($request->payment = 'book_hold'){
            //do prebook
            return $this->prebookOrder($order);
            if($this->prebookOrder($order)){
                $order->booking_expired = date('Y-m-d', strtotime('-1 day', strtotime($order->from()->departure_time)));
                $order->update();
                toastr()->warning('Pre-book Successfully');
                return redirect()->back();
            }
            toastr()->warning('Something went error');
            return redirect()->back();

        }elseif ($request->payment = 'fund'){
            if($user->balance < $order->net_pay_amount){
                toastr()->warning('Not available balance in your fund!');
                return redirect()->back();
            }else{
                $user->balance = $user->balance - $order->net_pay_amount;
                $user->update();
                $order->paid_amount = $order->net_pay_amount;
                $order->payment_status = 'paid';
                $order->update();
                // do booking
            }

        }elseif ($request->payment = 'SSLCOMMERZ'){
            return $this->bookOrder($order);
        }

    }
    public function order_details($id){
        $data = array();
        $data['order'] = Order::find($id);
        return view('frontend.confirm', $data);
    }

    public function prebookOrder($order){

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
            return $airs;

        } catch (RequestException $e) {
            return false;
        }

    }
    public function bookOrder($order){

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
                "PassportNumber" => "HJFHFJKHFH6876",
                "PassportExpiryDate" => "2029-10-12",
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
            return $airs;

        } catch (RequestException $e) {
            return false;
        }

    }


}
