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
            //hotel
            Route::group(['prefix' => 'hotel'], function () {
                Route::get('', 'HotelController@getHotel');
                Route::post('image', 'HotelController@addHotelImage');
                Route::patch('', 'HotelController@updateHotel');
            });

            //rooms
            Route::group(['prefix' => 'room'], function () {
                Route::get('', 'RoomController@getRooms');
                Route::post('', 'RoomController@addRoom');

                Route::group(['middleware' => 'room'], function () {
                    Route::get('/{id}', 'RoomController@getRoom');
                    Route::patch('/{id}', 'RoomController@updateRoom');
                    Route::delete('/{id}', 'RoomController@deleteRoom');
                });
            });

            //room types
            Route::group(['prefix' => 'room-type'], function () {
                Route::get('', 'RoomTypeController@getRoomTypes');
                Route::post('', 'RoomTypeController@addRoomType');

                Route::group(['middleware' => 'room-type'], function () {
                    Route::get('/{id}', 'RoomTypeController@getRoomType');
                    Route::patch('/{id}', 'RoomTypeController@updateRoomType');
                    Route::delete('/{id}', 'RoomTypeController@deleteRoomType');
                });
            });

            //pricing
            Route::group(['prefix' => 'pricing'], function () {
                Route::get('', 'PricingController@getPricings');
                Route::post('', 'PricingController@addPricing');

                Route::group(['middleware' => 'pricing'], function () {
                    Route::get('/{id}', 'PricingController@getPricing');
                    Route::patch('/{id}', 'PricingController@updatePricing');
                    Route::delete('/{id}', 'PricingController@deletePricing');
                });
            });
        });
    });

});