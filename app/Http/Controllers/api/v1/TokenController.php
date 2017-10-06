<?php 
namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller{
	public function __construct(){
        //
    }

    public function index(Request $request){
        
    $apiKey = $request->json()->get('apiKey');

    return TokenController::generateToken($apiKey);
    

    }

    public function generateToken($apiKey){
		
        $user = User::where('api_key', $apiKey)->first();
        if(!empty($user)){
            $token = (str_random(64));
            
            $user->token 	= $token;
            $user->save();
                    
            return response()->json(['status' => '200',
                              'token' => $token]); 	                     
        }
        else {
            return response()->json(['status' => '404','data' => 'Api key not valid']);          		 
            
        }

	}
    
}