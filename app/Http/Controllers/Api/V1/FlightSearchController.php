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
    public function showDummySearch(){
        
        $path = storage_path() . "/dummy.json"; 
        $json = json_decode(file_get_contents($path), true);
        
        echo json_encode($json) ;

    }
	

    

	/*
	*  This method collects the longitude and latitude of a place and returns the airport city data of the location
	*/
	public function findCurrentFlightsLocations(Request $request){
			
			$lat  =  $request->json()->post('lat');
			$long =  $request->json()->post('long');
			$ch = curl_init();
       		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_URL, "https://iatacodes.org/api/v6/nearby?api_key=9374976f-ba4f-41b5-a99f-edd4339facaf&lat=$lat&lng=$long&distance=1000");
        	$result = curl_exec($ch);
        	curl_close($ch);
			$output = utf8_encode(json_decode($result));
           
		  return response()->json(['status' => '200','data' =>  $output->response]);
	

      

	}


}