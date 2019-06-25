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

Route::group(['prefix' => 'v1', 'middleware' => 'req.log'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout')->middleware('api.auth');
    });

    Route::group(['middleware' => 'api.auth'], function () {
        Route::group(['prefix' => 'admin', 'middleware' => 'user.is.admin'], function () {
            Route::get('hotel', 'HotelController@getHotel');
            Route::patch('hotel', 'HotelController@updateHotel');
        });
    });

});