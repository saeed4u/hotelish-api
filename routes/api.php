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
        Route::group(['prefix' => 'hotel'], function () {
            Route::get('', 'HotelController@getHotel');
            Route::post('image', 'HotelController@addHotelImage')->middleware('user.is.admin');
            Route::patch('', 'HotelController@updateHotel')->middleware('user.is.admin');
        });

        //rooms
        Route::group(['prefix' => 'room'], function () {
            Route::get('', 'RoomController@getRooms');
            Route::post('', 'RoomController@addRoom')->middleware('user.is.admin');

            Route::group(['prefix' => '/{id}', 'middleware' => 'room'], function () {
                Route::get('', 'RoomController@getRoom');
                Route::group(['middleware' => 'user.is.admin'], function () {
                    Route::patch('', 'RoomController@updateRoom');
                    Route::delete('', 'RoomController@deleteRoom');
                    Route::post('image', 'RoomController@addRoomImage');
                });
            });
        });

        //room types
        Route::group(['prefix' => 'room-type'], function () {
            Route::get('', 'RoomTypeController@getRoomTypes');
            Route::post('', 'RoomTypeController@addRoomType')->middleware('user.is.admin');

            Route::group(['middleware' => 'room-type'], function () {
                Route::get('/{id}', 'RoomTypeController@getRoomType');
                Route::patch('/{id}', 'RoomTypeController@updateRoomType')->middleware('user.is.admin');
                Route::delete('/{id}', 'RoomTypeController@deleteRoomType')->middleware('user.is.admin');
            });
        });

        //pricing
        Route::group(['prefix' => 'pricing', 'middleware' => 'user.is.admin'], function () {
            Route::get('', 'PricingController@getPricings');
            Route::post('', 'PricingController@addPricing');

            Route::group(['middleware' => 'pricing'], function () {
                Route::get('/{id}', 'PricingController@getPricing');
                Route::patch('/{id}', 'PricingController@updatePricing');
                Route::delete('/{id}', 'PricingController@deletePricing');
            });
        });

        //booking
        Route::group(['prefix' => 'booking'], function () {
            Route::get('', 'BookingController@getBookins');
            Route::post('', 'BookingController@addBooking');

            Route::group(['middleware' => 'booking'], function () {
                Route::patch('/{id}', 'BookingController@updateBooking');
                Route::delete('/{id}', 'BookingController@deleteBooking');
            });
        });
    });

});