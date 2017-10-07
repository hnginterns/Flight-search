<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'status' => 'success',
            'data' => User::all(),
            'message' => 'Users Retrieved Successfully'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $user->fill($request->all());
        
        if ($user->save()) {
            return response([
              'status' => 'success',
              'data' => $user->toArray(),
              'message' => 'Users was Saved Successfully'
          ]);
        } else {
            return response([
              'status' => 'error',
              'data' => null,
              'code' => 500,
              'message' => 'User was not saved!'
          ])->setStatusCode(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response([
                'status' => 'success',
                'data' => $user->toArray(),
                'message' => 'User was Found'
            ]);
        } else {
            return response([
                'status' => 'error',
                'data' => null,
                'message' => 'User with ID of '. $id . ' was not found in the database',
                'code' => 404
            ])->setStatusCode(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            // Logic to Put or Patch User data

           
        } else {

            return response([
                'status' => 'error',
                'data' => null,
                'code' => 404,
                'message' => 'User with ID of ' . $id . 'Not found'
            ])->setStatusCode(404);
        }

        if ($user->save()) {

            return response([
                'status' => 'success',
                'data'   => $user->toArray(),
                'message' => 'User updated successfully'
            ]);
            
        } else {
            return response([
                'status' => 'error',
                'data' => null,
                'code' => 500,
                'message' => 'Update Failed!'
            ])->setStatusCode(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {

            if ($user->delete()) {
                return response([
                    'status' => 'success',
                    'data'   => null,
                    'message' => 'User deleted successfully'
                ]);
            } else {
                return response([
                    'status' => 'error',
                    'data' => null,
                    'code' => 500,
                    'message' => 'Update Failed!'
                ])->setStatusCode(500);
            }
        } else {
          
          return response([
                'status' => 'error',
                'data' => null,
                'code' => 404,
                'message' => 'User with ID of ' . $id . 'Not found'
            ])->setStatusCode(404);
        }
    }
	
	
	/**
     *user receives token verification for accessing api and updates it in the database table
     *
     * @return \Illuminate\Http\Response
     */
    public function gettoken($id, $remember_token)
    {
		 $user = User::find($id);

        if ($user) {
			

			$user->remember_token = $remember_token;
           
        } else {

            return response([
                'status' => 'error',
                'data' => null,
                'code' => 404,
                'message' => 'User with ID of ' . $id . 'Not found'
            ])->setStatusCode(404);
        }

        if ($user->save()) {

            return response([
                'status' => 'success',
                'data'   => $user->toArray(),
                'message' => 'User updated successfully'
            ]);
            
        } else {
            return response([
                'status' => 'error',
                'data' => null,
                'code' => 500,
                'message' => 'Update Failed!'
            ])->setStatusCode(500);
        }			
    }

}
