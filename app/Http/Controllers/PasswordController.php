<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Firebase\JWT\JWT;
use App\Helpers\Token;
use App\Password;
use App\User;

class PasswordController extends Controller
{

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
    public function create(Request $request)
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
        $request_token = $request->header('Authorization');
        $token = new token();
        $decoded_email = $token->decode($request_token);

        $email = $decoded_email->email;

        $user_email = ['email' => $email];
        $user = User::where('email', '=', $user_email)->first();
        $user_id = $user->id;


        $requested_category = Category::where('name', '=', $request->category)
                ->where('user_id', '=', $user_id)
                ->first();

        if($requested_category == NULL){
            return response()->json([
                "message" => 'Error, esa categoría no existe, debes crearla primero'
            ],401);
        }

        $category_id_final = $requested_category->id;

        $password = new Password();
        $password->title = $request->title;
        $password->password = $request->password;
        $password->category_id = $category_id_final;
        $password->save();

        return response()->json([
            "message" => 'Contraseña creada'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $password = Password::find($id);
        $password->delete();

        return response()->json([
            "message" => 'Contraseña eliminada correctamente'
        ],200);
    }
}
