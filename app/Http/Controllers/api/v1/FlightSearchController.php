<?php 
namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FlightSearchController extends Controller{
	public function __construct(){
        //
        $this->middleware('auth');
    }

    public function test(){
        return response()->json(['status' => 200,'message' => 'authentication test successful']);

    }
    
}