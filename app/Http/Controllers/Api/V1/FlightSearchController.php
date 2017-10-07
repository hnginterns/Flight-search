<?php 
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FlightSearchController extends Controller{

	public function __construct(){
		//
    }
    
	public function oneWay(Request $request){
    
		$this->showDummySearch();
	
    }

    public function roundTrip(Request $request){

        $this->showDummySearch();

    }
    public function showDummySearch(Request $request){
        
        $path = storage_path() . "/dummy.json"; 
        $json = json_decode(file_get_contents($path), true);
        
        echo json_encode($json) ;

    }
	

    
    // this code does not do anything significant
	/* This method is used to find current flight locations, it recieves api_key, checks if it exist,
	* If it does not exist, a 404 error code is thrown, if it exists, a call is made to iatacodes using php
	* CURL and the response is sent to the user
	*
	*/
	public function findCurrentFlightsLocations(Request $request){

         $apiKey = $request->json()->get('apiKey');
         $user = User::where('api_key', $apiKey)->first();//check whethr there is a user with the api key
		 if(empty($user))
		 {
			  return response()->json(['status' => '404','data' => 'Api key not valid']);//if no user exist
		 }
		 else{
			 
			$ch = curl_init();
       		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_URL, "https://iatacodes.org/api/v7/flights?api_key=9374976f-ba4f-41b5-a99f-edd4339facaf");
        	$result = curl_exec($ch);
        	curl_close($ch);
			$output = json_decode($result);
           
		  return response()->json(['status' => '200','data' =>  $output->request->response]);//if no user exist
		 }

      

	}


}