<?php 

namespace App\Transformers;

use App\Models\APIResultModels\IATAModel;
use League\Fractal\TransformerAbstract;

class IATATransformer extends TransformerAbstract
{
    public function transform(array $iata)
    {
        $result = [
            'cityCode' => $iata['cityCode'],
            'cityName' => $iata['cityName'],
            'airport' => $iata['airport'],
            'country' => $iata['country']
  ];
    }
}