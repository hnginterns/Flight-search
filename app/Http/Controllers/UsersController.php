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
        //
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
        //
    }
}
