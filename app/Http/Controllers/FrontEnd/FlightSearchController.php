<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class FlightSearchController extends Controller
{

    public function flight_search(Request $request)
    {
         $client = new Client();
         $requestPayload = [
             "AdultQuantity" => $request->one_way_adult,
             "ChildQuantity" => $request->one_way_child,
             "InfantQuantity" => $request->one_way_infant,
             "EndUserIp" => $_SERVER['REMOTE_ADDR'],
             "JourneyType" => $request->JourneyType,
             "Segments" => [
                 [
                     "Origin" => $request->one_way_from,
                     "Destination" => $request->one_way_to,
                     "CabinClass" => $request->CabinClass,
                     "DepartureDateTime" => $request->one_way_date,
                 ]
             ]
         ];
         try {
             $url = getSetting('flyhub_url').'AirSearch';
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
//        $filePath = public_path('json/airSearch.json');
//        $jsonContents = file_get_contents($filePath);
//        $airs = json_decode($jsonContents, true);

        $data = [];

        foreach ($airs['Results'] as $key => $air) {
            $data[$key]['SearchId'] = $airs['SearchId'];
            $data[$key]['ResultID'] = $air['ResultID'];
            $data[$key]['IsRefundable'] = $air['IsRefundable'];
            $data[$key]['Discount'] = $air['Discount'];

            $data[$key]['Currency'] = $air['Currency'];
            $data[$key]['Availability'] = $air['Availabilty'];
            $data[$key]['FareType'] = $air['FareType'];

            $count = count($air['segments']);
            $duration = 0;
            $data[$key]['stop'] = ($count>1)?$count-1:'Non' ;
            $data[$key]['stopped'] = ($count>1)?'multi-stop':'non-stop' ;
            for ($i = 0; $i<$count ; $i++){
                $duration += $air['segments'][$i]['JourneyDuration'];
            }

            $data[$key]['FromAirportCode'] = $air['segments'][0]['Origin']['Airport']['AirportCode'];
            $data[$key]['FromAirportName'] = $air['segments'][0]['Origin']['Airport']['AirportName'];
            $data[$key]['FromCityName'] = $air['segments'][0]['Origin']['Airport']['CityName'];

            $data[$key]['ToAirportCode'] = $air['segments'][$count-1]['Destination']['Airport']['AirportCode'];
            $data[$key]['ToAirportName'] = $air['segments'][$count-1]['Destination']['Airport']['AirportName'];
            $data[$key]['ToCityName'] = $air['segments'][$count-1]['Destination']['Airport']['CityName'];

            $data[$key]['AirlineCode'] = $air['segments'][0]['Airline']['AirlineCode'];
            $data[$key]['StopQuantity'] = $air['segments'][0]['StopQuantity'];
            $data[$key]['JourneyDuration'] = convertMinutesToDuration($duration);
            $data[$key]['segments'] = $air['segments'];

            $data[$key]['total_ws_amount'] = 0;
            $data[$key]['adult_price'] = 0;
            $data[$key]['child_price'] = 0;
            $data[$key]['infant_price'] = 0;
            $data[$key]['total_discount'] = 0;
            foreach ($air['Fares'] as $fares){
                $base = $fares['BaseFare'];
                $other = $fares['Tax']+$fares['OtherCharges']+$fares['ServiceFee'];
                $count = $fares['PassengerCount'];

                $fee = 0;
                $extra = getSetting('extra_service')?getSetting('extra_service'):0;
                if($fares['PaxType'] =='Adult'){
                    $data[$key]['adult_price'] = $base+$other;
                    $fee = ($base * getSetting('adult_service'))/100;
                }else if ($fares['PaxType'] =='Child'){
                    $data[$key]['child_price'] = $base+$other;
                    $fee = ($base * getSetting('child_service'))/100;
                }else if ($fares['PaxType'] =='Infant'){
                    $data[$key]['infant_price'] = $base+$other;
                    $fee = ($base * getSetting('infant_service'))/100;
                }
                $total_WS = (($base+$other+$fee) * $count)+$extra;
                $data[$key]['total_discount'] += $fares['Discount'];
                $data[$key]['total_ws_amount'] += $total_WS;

            }
            $data[$key]['user_profit'] = ($data[$key]['total_discount'] * getSetting('user_profit'))/100;
            $data[$key]['agent_profit'] = ($data[$key]['total_discount'] * getSetting('agent_profit'))/100;
            $data[$key]['total_amount'] = $air['TotalFare'];
            $data[$key]['gross_amount'] = $air['TotalFareWithAgentMarkup'];
            $data[$key]['net_pay'] = $data[$key]['total_ws_amount'] - $data[$key]['user_profit'];
            $data[$key]['profit_amount'] = $data[$key]['net_pay'] - $air['TotalFareWithAgentMarkup'];
            $data[$key]['percent'] = (($data[$key]['total_ws_amount'] - $data[$key]['net_pay'])*100)/$data[$key]['total_ws_amount'] ;

            $data[$key]['net_pay']= number_format($data[$key]['net_pay'], 1, '.', ',');
            $data[$key]['total_ws_amount']= number_format($data[$key]['total_ws_amount'], 1, '.', ',');
            $data[$key]['percent']= number_format($data[$key]['percent'], 1, '.', );

        }

        return response()->json($data);
    }
    public function flight_search_rt(Request $request)
    {

        $client = new Client();
        $requestPayload = [
            "AdultQuantity" => $request->adult,
            "ChildQuantity" => $request->child,
            "InfantQuantity" => $request->infant,
            "EndUserIp" => $_SERVER['REMOTE_ADDR'],
            "JourneyType" => $request->JourneyType,
            "Segments" => [
                [
                    "Origin" => $request->from,
                    "Destination" => $request->to,
                    "CabinClass" => $request->CabinClass,
                    "DepartureDateTime" => $request->date_jd,
                ],
                [
                    "Origin" => $request->to,
                    "Destination" => $request->from,
                    "CabinClass" => $request->CabinClass,
                    "DepartureDateTime" => $request->date_rd,
                ]
            ]
        ];
        try {
            $url = getSetting('flyhub_url').'AirSearch';
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
            //Handle request exception, if any
        }
//        $filePath = public_path('json/airSearch.json');
//        $jsonContents = file_get_contents($filePath);
//        $airs = json_decode($jsonContents, true);





        $data = [];
        foreach ($airs['Results'] as $key => $air) {
            $data[$key]['SearchId'] = $airs['SearchId'];
            $data[$key]['ResultID'] = $air['ResultID'];
            $data[$key]['IsRefundable'] = $air['IsRefundable'];
            $data[$key]['Discount'] = $air['Discount'];
            $data[$key]['Currency'] = $air['Currency'];
            $data[$key]['Availability'] = $air['Availabilty'];
            $data[$key]['FareType'] = $air['FareType'];
            $count = count($air['segments']);
            $duration = 0;
            $data[$key]['stopped'] = ($count>1)?'multi-stop':'non-stop' ;
            $data[$key]['stop'] = ($count>1)?$count-1:'Non' ;
            for ($i = 0; $i<$count ; $i++){
                $duration += $air['segments'][$i]['JourneyDuration'];
            }
            $data[$key]['FromAirportCode'] = $air['segments'][0]['Origin']['Airport']['AirportCode'];
            $data[$key]['FromAirportName'] = $air['segments'][0]['Origin']['Airport']['AirportName'];
            $data[$key]['FromCityName'] = $air['segments'][0]['Origin']['Airport']['CityName'];

            $data[$key]['ToAirportCode'] = $air['segments'][$count-1]['Destination']['Airport']['AirportCode'];
            $data[$key]['ToAirportName'] = $air['segments'][$count-1]['Destination']['Airport']['AirportName'];
            $data[$key]['ToCityName'] = $air['segments'][$count-1]['Destination']['Airport']['CityName'];

            $data[$key]['AirlineCode'] = $air['segments'][0]['Airline']['AirlineCode'];
            $data[$key]['StopQuantity'] = $air['segments'][0]['StopQuantity'];
            $data[$key]['JourneyDuration'] = convertMinutesToDuration($duration);
            $data[$key]['segments'] = $air['segments'];
            $data[$key]['total_ws_amount'] = 0;
            $data[$key]['adult_price'] = 0;
            $data[$key]['child_price'] = 0;
            $data[$key]['infant_price'] = 0;
            $data[$key]['total_discount'] = 0;
            foreach ($air['Fares'] as $fares){
                $base = $fares['BaseFare'];
                $other = $fares['Tax']+$fares['OtherCharges']+$fares['ServiceFee'];
                $count = $fares['PassengerCount'];

                $fee = 0;
                $extra = getSetting('extra_service')?getSetting('extra_service'):0;
                if($fares['PaxType'] =='Adult'){
                    $data[$key]['adult_price'] = $base+$other;
                    $fee = ($base * getSetting('adult_service'))/100;
                }else if ($fares['PaxType'] =='Child'){
                    $data[$key]['child_price'] = $base+$other;
                    $fee = ($base * getSetting('child_service'))/100;
                }else if ($fares['PaxType'] =='Infant'){
                    $data[$key]['infant_price'] = $base+$other;
                    $fee = ($base * getSetting('infant_service'))/100;
                }
                $total_WS = (($base+$other+$fee) * $count)+$extra;
                $data[$key]['total_discount'] += $fares['Discount'];
                $data[$key]['total_ws_amount'] += $total_WS;

            }
            $data[$key]['user_profit'] = ($data[$key]['total_discount'] * getSetting('user_profit'))/100;
            $data[$key]['agent_profit'] = ($data[$key]['total_discount'] * getSetting('agent_profit'))/100;
            $data[$key]['total_amount'] = $air['TotalFare'];
            $data[$key]['gross_amount'] = $air['TotalFareWithAgentMarkup'];
            $data[$key]['net_pay'] = $data[$key]['total_ws_amount'] - $data[$key]['user_profit'];
            $data[$key]['profit_amount'] = $data[$key]['net_pay'] - $air['TotalFareWithAgentMarkup'];
            $data[$key]['percent'] = (($data[$key]['total_ws_amount'] - $data[$key]['net_pay'])*100)/$data[$key]['total_ws_amount'] ;

            $data[$key]['net_pay']= number_format($data[$key]['net_pay'], 1, '.', ',');
            $data[$key]['total_ws_amount']= number_format($data[$key]['total_ws_amount'], 1, '.', ',');
            $data[$key]['percent']= number_format($data[$key]['percent'], 1, '.', );

        }
        return response()->json($data);
    }
    public function flight_search_mc(Request $request){

        $segments = [];
        for ($i = 0; $i < $request->count; $i++) {
            $segment = [
                "Origin" => $request->from[$i],
                "Destination" => $request->to[$i],
                "CabinClass" => $request->CabinClass,
                "DepartureDateTime" => $request->date[$i]
            ];

            $segments[] = $segment;
        }

        $requestPayload = [
            "AdultQuantity" => $request->adult,
            "ChildQuantity" => $request->child,
            "InfantQuantity" => $request->infant,
            "EndUserIp" => $_SERVER['REMOTE_ADDR'],
            "JourneyType" => $request->JourneyType,
            "Segments" => $segments
        ];
        $client = new Client();
        try {
            $url = getSetting('flyhub_url').'AirSearch';
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

//        $filePath = public_path('json/airSearch.json');
//        $jsonContents = file_get_contents($filePath);
//        $airs = json_decode($jsonContents, true);

        $data = [];
        foreach ($airs['Results'] as $key => $air) {
            $data[$key]['SearchId'] = $airs['SearchId'];
            $data[$key]['ResultID'] = $air['ResultID'];
            $data[$key]['IsRefundable'] = $air['IsRefundable'];
            $data[$key]['Currency'] = $air['Currency'];
            $data[$key]['Availability'] = $air['Availabilty'];
            $data[$key]['FareType'] = $air['FareType'];
            $count = count($air['segments']);
            $duration = 0;
            $data[$key]['stopped'] = ($count>1)?'multi-stop':'non-stop' ;
            $data[$key]['stop'] = ($count>1)?$count-1:'Non' ;
            for ($i = 0; $i<$count ; $i++){
                $duration += $air['segments'][$i]['JourneyDuration'];
            }

            $data[$key]['FromAirportCode'] = $air['segments'][0]['Origin']['Airport']['AirportCode'];
            $data[$key]['FromAirportName'] = $air['segments'][0]['Origin']['Airport']['AirportName'];
            $data[$key]['FromCityName'] = $air['segments'][0]['Origin']['Airport']['CityName'];

            $data[$key]['ToAirportCode'] = $air['segments'][$count-1]['Destination']['Airport']['AirportCode'];
            $data[$key]['ToAirportName'] = $air['segments'][$count-1]['Destination']['Airport']['AirportName'];
            $data[$key]['ToCityName'] = $air['segments'][$count-1]['Destination']['Airport']['CityName'];

            $data[$key]['AirlineCode'] = $air['segments'][0]['Airline']['AirlineCode'];
            $data[$key]['StopQuantity'] = $air['segments'][0]['StopQuantity'];
            $data[$key]['JourneyDuration'] = convertMinutesToDuration($duration);
            $data[$key]['segments'] = $air['segments'];
            $data[$key]['total_ws_amount'] = 0;
            $data[$key]['adult_price'] = 0;
            $data[$key]['child_price'] = 0;
            $data[$key]['infant_price'] = 0;
            $data[$key]['total_discount'] = 0;
            foreach ($air['Fares'] as $fares){
                $base = $fares['BaseFare'];
                $other = $fares['Tax']+$fares['OtherCharges']+$fares['ServiceFee'];
                $count = $fares['PassengerCount'];

                $fee = 0;
                $extra = getSetting('extra_service')?getSetting('extra_service'):0;
                if($fares['PaxType'] =='Adult'){
                    $data[$key]['adult_price'] = $base+$other;
                    $fee = ($base * getSetting('adult_service'))/100;
                }else if ($fares['PaxType'] =='Child'){
                    $data[$key]['child_price'] = $base+$other;
                    $fee = ($base * getSetting('child_service'))/100;
                }else if ($fares['PaxType'] =='Infant'){
                    $data[$key]['infant_price'] = $base+$other;
                    $fee = ($base * getSetting('infant_service'))/100;
                }
                $total_WS = (($base+$other+$fee) * $count)+$extra;
                $data[$key]['total_discount'] += $fares['Discount'];
                $data[$key]['total_ws_amount'] += $total_WS;

            }
            $data[$key]['user_profit'] = ($data[$key]['total_discount'] * getSetting('user_profit'))/100;
            $data[$key]['agent_profit'] = ($data[$key]['total_discount'] * getSetting('agent_profit'))/100;
            $data[$key]['total_amount'] = $air['TotalFare'];
            $data[$key]['gross_amount'] = $air['TotalFareWithAgentMarkup'];
            $data[$key]['net_pay'] = $data[$key]['total_ws_amount'] - $data[$key]['user_profit'];
            $data[$key]['profit_amount'] = $data[$key]['net_pay'] - $air['TotalFareWithAgentMarkup'];
            $data[$key]['percent'] = (($data[$key]['total_ws_amount'] - $data[$key]['net_pay'])*100)/$data[$key]['total_ws_amount'] ;

            $data[$key]['net_pay']= number_format($data[$key]['net_pay'], 1, '.', ',');
            $data[$key]['total_ws_amount']= number_format($data[$key]['total_ws_amount'], 1, '.', ',');
            $data[$key]['percent']= number_format($data[$key]['percent'], 1, '.', );
        }

        return response()->json($data);

    }
    public function airports(){
        $filePath = public_path('json/airports.json');
        $jsonContents = file_get_contents($filePath);
        $airports = json_decode($jsonContents, true);
        return response()->json($airports);
    }

}
