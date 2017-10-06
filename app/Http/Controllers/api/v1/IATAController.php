<?php 
namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\APIResultModels\IATAModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Transformers\IATATransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class IATAController extends Controller{

     /**
     * @var Manager
     */
     private $fractal;

     private $iataTransformer;

	public function __construct(Manager $fractal, IATATransformer $iataTransformer){

        $this->fractal = $fractal;
        $this->iataTransformer = $iataTransformer;
        //
        $this->middleware('auth');
    }

    public function index(Request $request){
        
        $cityName = $request->json()->get('cityName');
        
        return IATAController::getCityDataFromName($cityName);
    }
    public function showCity(Request $request){
        
        $cityCode = $request->json()->get('cityCode');
        
        return IATAController::getCityDataFromCode($cityCode);
    }


    
    public function getCityDataFromCode($cityCode)
    {

    }


    public function getCityDataFromName($cityName)
    {
        $APIKEY = "9919b3e9-67d6-4734-8fd8-099078d9037e";
        $URL = "https://iatacodes.org/api/v6/autocomplete?api_key=$APIKEY&query=$cityName";
        

        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $URL);
        $result = curl_exec($ch);
        curl_close($ch);
    
         $output = json_decode($result);
         
         $iata = new IATAModel();

    
         if(!empty( $output))
         {

            $cityCode = $output->response->cities[0]->code;
            $cityName = $output->response->cities[0]->name;
            $airport =  $output->response->airports_by_cities[0]->name;
            $country = $output->response->cities[0]->country_name;

            $result = [
                [
                    'cityCode' => $cityCode,
                    'cityName' => $cityName,
                    'airport' => $airport,
                    'country' =>$country,
           ]
                ];

$resource = new Collection($result, function(array $iata) {
    return [
        'cityCode' => $iata['cityCode'],
        'cityName' => $iata['cityName'],
        'airport' => $iata['airport'],
        'country' => $iata['country']
    ];
});

// Turn that into a structured array (handy for XML views or auto-YAML converting)
$array = $this->fractal->createData($resource)->toArray();

// Turn all of that into a JSON string
echo $this->fractal->createData($resource)->toJson();


         }

    }
    
}