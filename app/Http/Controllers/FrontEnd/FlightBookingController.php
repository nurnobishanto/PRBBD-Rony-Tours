<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Passenger;
use App\Models\Travel;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;

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
//
//        $client = new Client();
//        $requestPayload = [
//            "SearchId" => $request->SearchId,
//            "ResultID" => $request->ResultID,
//        ];
//        try {
//            $response = $client->post('http://api.sandbox.flyhub.com/api/v1/AirPrice', [
//                'headers' => [
//                    'Authorization' =>getSettingDetails('flyhub_TokenId'),
//                    'Content-Type' => 'application/json',
//                    'Accept' => 'application/json',
//                ],
//                'json' => $requestPayload
//            ]);
//
//            $data['statusCode '] = $response->getStatusCode();
//            $data['airPrice'] = json_decode($response->getBody(), true);
//
//            // Handle the response data as needed
//            //$statusCode contains the HTTP status code
//            //$responseData contains the response data
//        } catch (RequestException $e) {
//            //Handle request exception, if any
//
//            return redirect()->route('home');
//        }



        $filePath = public_path('json/airPrice.json');
        $jsonContents = file_get_contents($filePath);
        $data['airPrice'] = json_decode($jsonContents, true);



        return view('frontend.checkout', $data);
    }

    public function flight_booking_step2(Request $request){
        $count = $request->p_count;
        $count_travel = $request->count_travel;
        for ($i=1; $i<$count; $i++){
            $paxtype = 'PaxType_'.$i;
            $dob= 'DateOfBirth_'.$i;
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
            'total_amount'=>$request->total_amount,
            'gross_amount'=>$request->gross_amount,
            'profit_amount'=>$request->profit_amount,
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


    }

    public function add_passenger(Request $request)
    {
        $input = $request->validate([
            'SearchId' => 'required|string',
            'pax_type' => 'required|numeric',
            'title' => 'required|numeric',
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'email' => 'required|email',
            'contact_number' => 'required|string|max:20',
            'age' => 'required|string|max:20',
            'gender' => 'required|numeric',
        ]);
        $input['user_id'] = auth()->user()->id;

        try {

            $passenger = Passenger::create($input);

            $array = [
                'pax_type' => $passenger->pax_type,
                'first_name' => $passenger->first_name,
                'gender' => $passenger->gender,
                'age' => $passenger->age,
            ];

            Session::push($request->SearchId, $array);

            $data = Session::get($request->SearchId);

            return response()->json([
                'data' => $data,
                'message' => 'Passenger Add successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function passengerSession(Request $request)
    {
        $data = Session::get($request->SearchId);
        return response()->json([
            'data' => $data,
            'message' => 'Passenger Add successfully'
        ]);
    }

}
