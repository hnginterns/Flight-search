<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class TripsController extends Controller{

  public function search() {
    return view('search');
  }


  public function singleTrip(Request $request) {

    if (! $this->isValidRequest($request)) {
      return response()->json([
        'status' => 'error',
        'data' => null,
        'message' => 'You must have at least 1 adult or 1 senior citizen, origin and destination',
        'code' => 400
      ])->setStatusCode(400);
    }

    
    $curl = curl_init();
    $post_data = array("request" => array("passengers" => array("adultCount" => (int) $request->adult_count), "slice" =>
        array(
        array(
            "origin" => $request->origin,
            "destination" => $request->destination,
            "date" => $request->date
        )
    
        ),
        "solutions" => $request->solution
        ));

    $apiKey = env('GOOGLE_API_KEY');
    // $apiKey = 'AIzaSyDzmxuG60PSzQS2DCbJ7AqY1FtevC8H7Sc';
    $post_data = json_encode($post_data);
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.googleapis.com/qpxExpress/v1/trips/search?key=".$apiKey,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $post_data,
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json"
      ),
    ));

    // dd($post_data);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      return json_decode($response, true);
    }
  }

  public function getTrips() {

  }

  protected function getParams($request) {
    // dd($request->toArray());
    if (! $this->isValidRequest($request)) {
      return response()->json([
        'status' => 'error',
        'data' => null,
        'message' => 'You must have at least 1 adult or 1 senior citizen, origin and destination',
        'code' => 400
      ])->setStatusCode(400);
    }


    $adultCount = $request->adult_count;
    $seniorCount = $request->senior_count ? $request->child_count : '';
    $origin   = $request->origin;
    $destination = $request->destination;
    $childCount = $request->child_count ? $request->child_count : '';
    $date = $request->date;
    $solution = $request->solution;

    $passengers = [
      "adultCount" => "1"
      // "childCount" => $childCount,
      // "seniorCount" => $seniorCount
    ];

    $trip = [
      "origin" => "LOS",
      "destination" => "LHR",
      "date" => "2017-10-30"
    ];

    $main = ["request" => [
      "passengers" => $passengers,
      "slice" => [
      $trip
    ],
    "solution" => $solution
   ]
  ];

  return $main;

}

  protected function isValidRequest($request) {

    $adultCount = (int) $request->adult_count;
    $seniorCount = (int) $request->senior_count;
    $origin   = trim($request->origin);
    $destination = trim($request->destination);


    if (!isset($adultCount) || ! isset($seniorCount) || !isset($origin) || !isset($destination)) {
      return null;
    } else {
      return true;
    }
  }

  protected function toJson(array $arr) {

    return response()->json($arr);
  }
  
}