<?php

namespace App\Models\APIResultModels;

use Illuminate\Database\Eloquent\Model;

class IATAModel
{
    

    var $cityCode;
    var $cityName;
    var $airport;
    var $country;


    public function __construct(){
        
                $this->cityCode = "";
                $this->cityName = "";
                $this->airport = "";
                $this->country = "";
                
                
            }

    function setCityCode($cityCode){
        $this->cityCode = $cityCode;
     }
     
     function getCityCode(){
        echo $this->cityCode;
     }

     function setCityName($cityName){
        $this->cityName = $cityName;
     }
     
     function getCityName(){
        echo $this->cityName;
     }

     function setAirport($airport){
        $this->airport = $airport;
     }
     
     function getAirport(){
        echo $this->airport;
     }

     function setCountry($country){
        $this->country = $country;
     }
     
     function getCountry(){
        echo $this->country;
     }


    
  
}