<?php 
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class IATAAutoCompleteController extends Controller{

	public function __construct(){
		//
    }



    public function index(Request $request){
        
        $cityName = $request->json()->get('cityName');
        $cityCode = $request->json()->get('cityCode');

        if (!is_null($cityName)){
            return IATAAutoCompleteController::getCityDataFromName($cityName);
            
        }
        else if (!is_null($cityCode)){
            return IATAAutoCompleteController::getCityDataFromCode($cityCode);
        } else {

        }
        
        
    }



    // public function showCity(Request $request){
        
    //     $cityCode = $request->json()->get('cityCode');
        
    //     return IATAAutoCompleteController::getCityDataFromCode($cityCode);
    // }

    public function getCityDataFromName($cityName){

        $baseUrl = "https://iatacodes.org/api/v6/autocomplete";
        $apiKey  = "9919b3e9-67d6-4734-8fd8-099078d9037e";
  
        $ch = curl_init();
  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, "$baseUrl?api_key=$apiKey&query=$cityName");
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
         return  response(['data'=>$output]);
        

    }

    public function getCityDataFromCode($cityCode){
        
        //$cityName = $this->getCityName($cityCode);

        echo $cityCode;

        // $this->getCityDataFromName($cityName);
        
        
    }

     function getCityName($cityCode)
     {

        //function not working

        $baseUrl = "https://iatacodes.org/api/v6/autocomplete";
        $apiKey  = "9919b3e9-67d6-4734-8fd8-099078d9037e";
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_URL, "$baseUrl?api_key=$apiKey&code=$cityCode");
         $result = curl_exec($ch);
         curl_close($ch);
         $output = json_decode($result);
         
         
         return  $output->response[0]->name;// returns city name
     }



}