<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flight_history;

class Flight_historyController extends Controller
{
    public function index(){

        $history = Flight_history::paginate(5);
        //code to render flight history to the view
    }

}
