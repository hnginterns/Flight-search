<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Iata;

class IatasController extends Controller
{
    public function index()
    {
        $iata = Iata::paginate(20); 

        //code to render the data to the view here
    }
}
