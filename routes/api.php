<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('login', 'user_controller@login');
Route::post('register', 'user_controller@store');


Route::middleware(['Checkout'])->group(function(){

    Route::apiResource('Category', 'CategoryController');
    Route::apiResource('Password', 'PasswordController');
    Route::apiResource('users', 'user_controller');
    Route::get('ShowUsers&Passwords', 'user_controller@showCategoriesAndPasswords');

});
