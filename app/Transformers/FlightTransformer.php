<?php namespace App\Transformers;

use App\Flight;
use League\Fractal\TransformerAbstract;

class FlightTransformer extends TransformerAbstract {

    public function transform(Flight $flight)
    {
        return [
            'city'           => $flight->city,
            'IATA'           => $flight->IATA,
            'airport'        => $flight->airport,
            'origin'         => $flight->origin,
            'destination'    => $flight->destination,
        ];
    }
}