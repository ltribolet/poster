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


Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function(){
        Route::get('/user/{user}', 'UserController@get');

        Route::post('/album/new', 'AlbumController@create');
        Route::get('/album/{album}', 'AlbumController@get');
        Route::put('/album/{album}', 'AlbumController@update');
        Route::delete('/album/{album}', 'AlbumController@delete');
        Route::get('/albums', 'AlbumController@all');

        Route::post('/picture/new', 'PictureController@create');
});
