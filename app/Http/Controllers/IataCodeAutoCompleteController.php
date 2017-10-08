<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class  IataCodeAutoCompleteController extends Controller

{
          //TASK 1  Users can recieve airport details from IATA code

         function getAirportDetailsByCityCode($cityCode)
        {
        

          $cityName = $this->getCityNameByCityCode($cityCode);
          $response = $this-> getAirportDetailsByCityName($cityName);
          return $response;

        

      }

      
//TASK 2  Users can recieve airport details from Airport city name


      function getAirportDetailsByCityName($cityName)
      {

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

            

           $response = json_encode($result);
          
           return  $response;
        
        


      }

      function getCityNameByCityCode($cityCode)
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
 
//Task 3 Users should be able to locate airports within set distaces

      function getAirportsNearby($latitude,$logitude,$KMRadius)
      {
           $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, "https://iatacodes.org/api/v6/nearby?api_key=9919b3e9-67d6-4734-8fd8-099078d9037e&lat=$latitude&lng=$logitude&distance=$KMRadius");
        $result = curl_exec($ch);
        curl_close($ch);

           $output = json_decode($result);
          



           if(!isset( $output->error))
           {
                
             $result = ['success' => 200,
                               'data' => [] ];

             foreach ( $output->response as $details) {

                    $cityCode = $details->code;
                    $cityName = $this->getCityNameByCityCode($cityCode);
                    $airport =  $details->name;
                    $country = $details->country_name;

                


                  $input =  [
                         'cityCode' => $cityCode,
                         'cityName' => $cityName,
                         'airport' => $airport,
                         'country' =>$country

                        ];


                        array_push($result['data'],$input);
        
             }

              

           }
           else
           {
              $result = ['success' => 404];//incase of any error


           }

           $response = json_encode($result);

          return  $response;

           


      }




}


    $object = new IataCodeAutoCompleteController();

//Test Call please remove after tests
    //TASK 1  Users can recieve airport details from IATA code
    echo'//TASK 1  Users can recieve airport details from IATA code, Test data ABV </br>';
   var_dump($object->getAirportDetailsByCityCode('ABV')) ;
   echo'<pre>



     </pre>';
   //TASK 2  Users can recieve airport details from Airport city name
    echo '//TASK 2  Users can recieve airport details from Airport city name, Test data UYo </br>';
    var_dump($object->getAirportDetailsByCityName('UYO'));
     echo'<pre>



     </pre>';

   //TASK 3 Users should be able to locate airports within set distaces
    echo'//TASK 3 Users should be able to locate airports within set distaces, Test data Lagos cordinates, 300km radius</br>'; 

  var_dump($object->getAirportsNearby(6.4319891593955685,3.415541052818299,300)); 