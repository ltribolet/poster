<?php

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

Route::post(REGISTER_URI, 'Api\Auth\RegisterController@register');


Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/user/{user}', 'Api\UserController@get');

    Route::post('/album/new', 'Api\AlbumController@create');
    Route::get('/album/{album}', 'Api\AlbumController@get');
    Route::put('/album/{album}', 'Api\AlbumController@update');
    Route::delete('/album/{album}', 'Api\AlbumController@delete');
    Route::get('/albums', 'Api\AlbumController@all');
});
