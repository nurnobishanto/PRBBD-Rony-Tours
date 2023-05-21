<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
//        $client = new Client();
//        $requestPayload = [
//            "SearchId" => $request->SearchId,
//            "ResultID" => $request->ResultID,
//        ];
//        try {
//            $response = $client->post('http://api.sandbox.flyhub.com/api/v1/AirPrice', [
//                'headers' => [
//                    'Authorization' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImN0eSI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6InBvcnRhbHJvbmliZEBnbWFpbC5jb20iLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3VzZXJkYXRhIjoiMzEzMzN8NDE3NTh8MTAzLjg3LjIxMi4yMSwxMDMuMTkxLjI0MC4xOTYiLCJuYmYiOjE2ODQ2NDIzNzQsImV4cCI6MTY4NTI0NzE3NCwiaWF0IjoxNjg0NjQyMzc0LCJpc3MiOiJodHRwOi8vYXBpLnNhbmRib3guZmx5aHViLmNvbSIsImF1ZCI6ImFwaS5zYW5kYm94LmZseWh1Yi5jb20ifQ.jNYYEFRcQLTMxqCZRaapv4-WdhfGCeoA-Kgv_GNxhtU',
//                    'Content-Type' => 'application/json',
//                    'Accept' => 'application/json',
//                ],
//                'json' => $requestPayload
//            ]);
//
//            $statusCode = $response->getStatusCode();
//            $airPrice = json_decode($response->getBody(), true);
//
//            // Handle the response data as needed
//            //$statusCode contains the HTTP status code
//            //$responseData contains the response data
//        } catch (RequestException $e) {
//            //Handle request exception, if any
//        }
////        $filePath = public_path('json/airPrice.json');
////        $jsonContents = file_get_contents($filePath);
////        $airPrice = json_decode($jsonContents, true);



        return view('frontend.checkout');
    }

}
