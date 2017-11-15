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

const REGISTER_URI = '/register';
const LOGOUT_URI = '/logout';
const USER_URI = '/user';

Route::post(REGISTER_URI, 'Api\Auth\RegisterController@register');

Route::get('/user/{user}', 'Api\UserController@get');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get(USER_URI, 'Api\UserController@index');
});
