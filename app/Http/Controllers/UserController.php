<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Firebase\JWT\JWT;
use App\Helpers\Token;

class user_controller extends Controller
{

    public function login(Request $request)
    {
        $data = ['email' => $request->email];
        $user = User::where($data)->first();


        if($user==NULL){
            return response()->json([
                "message" => 'Incorrect email or password'
            ],401);
        }

        if($user->password == $request->password)
        {

            $token = new token($data);
            $token = $token->encode();

            return response()->json([
                "token" => $token
            ],200);
        }

        return response()->json([
            "message" => 'Incorrect email or password'
        ],401);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        $token = new token(['email' => $user->email]);
        $token = $token->encode();


        return response()->json([
            "token" => $token
        ],200);

        //$token = JWT::encode($data_token, $this->key);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
