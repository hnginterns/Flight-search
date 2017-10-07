<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IataCodeAutoCompleteController extends Controller
{
    //TASK 2  Users can recieve airport details from IATA code
   function getCityDetails($cityCode)
   {
     
     $cityName = $this->getCityName($cityCode);
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_URL, "https://iatacodes.org/api/v6/autocomplete?api_key=9919b3e9-67d6-4734-8fd8-099078d9037e&query=$cityName");
     $result = curl_exec($ch);
     curl_close($ch);
      $output = json_decode($result);
      
     
     // personalized JSON
      
      if(!isset( $output->error))
      {
         $cityCode = $output->response->cities[0]->code;
          $cityName = $output->response->cities[0]->name;
          $airport =  $output->response->airports_by_cities[0]->name;
          $country = $output->response->cities[0]->country_name;
           $result = ['success' => 200,
                'data' => [
                 [
                    'cityCode' => $cityCode,
                    'cityName' => $cityName,
                    'airport' => $airport,
                    'country' =>$country
                 ]
                ] ];
      }
      else
      {
         $result = ['success' => 404];//incase of any error
      }
       
      $output = json_encode($result);
      //var_dump($output);
      return  response(['data'=>$output]);
     
     
    }

    function getCityName($cityCode)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, "https://iatacodes.org/api/v6/cities?api_key=9919b3e9-67d6-4734-8fd8-099078d9037e&code=$cityCode");
        $result = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($result);
        
        
        return  $output->response[0]->name;// returns city name
    }
  
   
}

