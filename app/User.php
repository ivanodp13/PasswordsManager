<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class User extends Model
{
    protected $filliable = ['name','email','password'];

    public function register(Request $request)
    {
        $user = new self();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return $user->email;
    }

    public function login(Request $request)
    {
        $user = new self();
        $user_email = $request->email;
        $user_password = $request->password;

        $email = DB::table('users')->where('email', $user_email)->value('email');
        $password = DB::table('users')->where('password', $user_password)->value('password');

        var_dump($email);

        return $email;

    }
}
