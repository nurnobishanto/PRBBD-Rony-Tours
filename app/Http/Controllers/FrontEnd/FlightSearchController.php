<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlightSearchController extends Controller
{
    public function flight_search(Request $request)
    {
        $filePath = public_path('json/airSearch.json');
        $jsonContents = file_get_contents($filePath);
        $airs = json_decode($jsonContents, true);



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
            $data[$key]['Availabilty'] = $air['Availabilty'];

            // $data[$key]['Baggage'] = $air['Baggage'];
            // $data[$key]['JourneyDuration'] = $air['JourneyDuration'];
            // $data[$key]['isMiniRulesAvailable'] = $air['isMiniRulesAvailable'];
            // $data[$key]['Origin'] = $air['segments']['Origin'];
            // $data[$key]['Destination'] = $air['segments']['Destination'];

            // $data[$key]['Airline'] = $air['segments']['Airline'];

            $data[$key]['FromAirportCode'] = $air['segments'][0]['Origin']['Airport']['AirportCode'];
            $data[$key]['FromAirportName'] = $air['segments'][0]['Origin']['Airport']['AirportName'];
            $data[$key]['FromCityName'] = $air['segments'][0]['Origin']['Airport']['CityName'];

            $data[$key]['ToAirportCode'] = $air['segments'][0]['Destination']['Airport']['AirportCode'];
            $data[$key]['ToAirportName'] = $air['segments'][0]['Destination']['Airport']['AirportName'];
            $data[$key]['ToCityName'] = $air['segments'][0]['Destination']['Airport']['CityName'];

            $data[$key]['AirlineCode'] = $air['segments'][0]['Airline']['AirlineCode'];
            $data[$key]['StopQuantity'] = $air['segments'][0]['StopQuantity'];
            $data[$key]['JourneyDuration'] = $air['segments'][0]['JourneyDuration'];


        }

        // header('Content-Type: application/json');
        // $airs = json_encode($data);

        return response()->json($data);
    }
}
