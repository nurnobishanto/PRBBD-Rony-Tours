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
             "EndUserIp" => "192.168.1.2",
             "JourneyType" => $request->JourneyType,
             "Segments" => [
                 [
                     "Origin" => $request->one_way_from,
                     "Destination" => $request->one_way_to,
                     "CabinClass" => $request->one_wayCabinClass,
                     "DepartureDateTime" => $request->one_way_date,
                 ]
             ]
         ];
         try {
             $response = $client->post('http://api.sandbox.flyhub.com/api/v1/AirSearch', [
                 'headers' => [
                     'Authorization' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImN0eSI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6InBvcnRhbHJvbmliZEBnbWFpbC5jb20iLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3VzZXJkYXRhIjoiMzEzMzN8NDE3NTh8MTAzLjg3LjIxMi4yMSwxMDMuMTkxLjI0MC4xOTYiLCJuYmYiOjE2ODQ2NDIzNzQsImV4cCI6MTY4NTI0NzE3NCwiaWF0IjoxNjg0NjQyMzc0LCJpc3MiOiJodHRwOi8vYXBpLnNhbmRib3guZmx5aHViLmNvbSIsImF1ZCI6ImFwaS5zYW5kYm94LmZseWh1Yi5jb20ifQ.jNYYEFRcQLTMxqCZRaapv4-WdhfGCeoA-Kgv_GNxhtU',
                     'Content-Type' => 'application/json',
                     'Accept' => 'application/json',
                 ],
                 'json' => $requestPayload
             ]);

             $statusCode = $response->getStatusCode();
             $airs = json_decode($response->getBody(), true);

            // Handle the response data as needed
             //$statusCode contains the HTTP status code
             //$responseData contains the response data
         } catch (RequestException $e) {
             //Handle request exception, if any
         }
        //$filePath = public_path('json/airSearch.json');
        //$jsonContents = file_get_contents($filePath);
        //$airs = json_decode($jsonContents, true);

        //return $airs;



        $data = [];
        foreach ($airs['Results'] as $key => $air) {
            $data[$key]['SearchId'] = $airs['SearchId'];
            $data[$key]['ResultID'] = $air['ResultID'];
            $data[$key]['IsRefundable'] = $air['IsRefundable'];
            $data[$key]['Discount'] = $air['Discount'];
            $data[$key]['TotalFare'] = $air['TotalFare']+($air['TotalFare']*(20/100));
            $data[$key]['TotalFare1'] = $air['TotalFare'];
            $data[$key]['Currency'] = $air['Currency'];
            // $data[$key]['TripIndicator'] = $air['segments']['TripIndicator'];
            $data[$key]['Availability'] = $air['Availabilty'];

            // $data[$key]['Baggage'] = $air['Baggage'];
            // $data[$key]['JourneyDuration'] = $air['JourneyDuration'];
            // $data[$key]['isMiniRulesAvailable'] = $air['isMiniRulesAvailable'];
            // $data[$key]['Origin'] = $air['segments']['Origin'];
            // $data[$key]['Destination'] = $air['segments']['Destination'];

            // $data[$key]['Airline'] = $air['segments']['Airline'];

            $count = count($air['segments']);
            $duration = 0;
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



        }

        // header('Content-Type: application/json');
        // $airs = json_encode($data);

        return response()->json($data);
    }

}
