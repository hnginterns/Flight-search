<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight_histories extends Model
{
     protected $table = 'flights_histories';

	protected $fillable = ['user_id','location','destination','departure_time','no_of_passengers','amount,'];


	public function user()
	{
		return $this->belongsTo('\App\User', 'user_id', 'id');
	}

}
