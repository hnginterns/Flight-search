<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city', 'IATA', 'airport', 'origin', 'destination',
    ];

}
