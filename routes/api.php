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

const LOGIN_URI = '/login';
const LOGIN_REFRESH_URI = '/login/refresh';
const REGISTER_URI = '/register';
const LOGOUT_URI = '/logout';
const USER_URI = '/user';

Route::post(LOGIN_URI, 'Api\Auth\LoginController@login');
Route::post(LOGIN_REFRESH_URI, 'Api\Auth\LoginController@refresh');
Route::post(REGISTER_URI, 'Api\Auth\RegisterController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post(LOGOUT_URI, 'Api\Auth\LoginController@logout');
    ROute::get(USER_URI, 'Api\UserController@index');
});
