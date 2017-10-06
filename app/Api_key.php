<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Api_key extends Model
{
    protected $fillable = ['api_key', 'status'];
}
