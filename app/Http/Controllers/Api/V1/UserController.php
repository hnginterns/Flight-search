<?php 
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{
	public function __construct(){
		//
	}
	public function index(){
		$users = User::all();
		return $this->success($users, 200);
	}
	
	
	public function store(Request $request){

		$this->validateRequest($request);

		
		$user = User::create([
					'email' => $request->get('email'),
					'password'=> Hash::make($request->get('password')),
					'name' => $request->get('name'),
					'api_key' => str_random(32),
					'remember_token' => str_random(48)
				]);


		return response()->json(['status' => 200,'api_key' => $apikey]);

	}

	public function show($id){
		$user = User::find($id);
		if(!$user){
			return response()->json(['status' => '404','message' => 'user does not exist']);
		}
		return response()->json(['status' => 200,'user' => $user]);
	}

	public function findUserByEmail(Request $request){
		
		$user = User::where('email', $request->get('email'))->first();
		if(!empty($user)){
			return response()->json(['status' => 200,'user' => $user]);
					 
		}else{
			return response()->json(['status' => '404','message' => 'user does not exist']);
		}
	
	}



	public function update(Request $request, $id){
		$user = User::find($id);
		
		if(!$user){
			return response()->json(['status' => 404,'message' => 'user does not exist']);
			
		}

		$this->validateRequest($request);
		$user->email 		= $request->get('email');
		$user->password 	= Hash::make($request->get('password'));
		$user->save();
		return response()->json(['status' => 200,'user' => "The user with with id {$user->id} has been updated"]);		
	}


	public function destroy($id){
		$user = User::find($id);
		if(!$user){
			return response()->json(['status' => 404,'message' => 'user does not exist']);
		}
		$user->delete();
		return response()->json(['status' => 200,'user' => "The user with with id {$user->id} has been deleted"]);		
		
	}
	public function validateRequest(Request $request){
		$rules = [
			'email' => 'required|email|unique:users', 
			'password' => 'required|min:6'
		];
		$this->validate($request, $rules);
	}
	public function isAuthorized(Request $request){
		$resource = "users";
		// $user     = User::find($this->getArgs($request)["user_id"]);
		return $this->authorizeUser($request, $resource);
	}
	
	public function success($data, $code){
        return response()->json(['data' => $data], $code);
    }
    public function error($message, $code){
        return response()->json(['message' => $message], $code);
    }
}