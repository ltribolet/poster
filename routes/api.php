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

Route::post('/login', 'Api\Auth\LoginController@login');
Route::post('/login/refresh', 'Api\Auth\LoginController@refresh');
Route::post('/register', 'Api\Auth\RegisterController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/logout', 'Api\Auth\LoginController@logout');
    ROute::get('/user', 'Api\UserController@index');
});
