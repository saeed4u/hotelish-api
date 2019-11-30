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

    Route::group(['prefix' => 'device'], function () {
        Route::post('register', 'DeviceController@registerDevice');
        Route::post('update-fcm-token', 'DeviceController@updateFcmToken')->middleware('device');
    });

    Route::group(['middleware' => 'api.auth'], function () {
        Route::group(['prefix' => 'hotels'], function () {

            Route::get('', 'HotelController@getHotels');
            Route::group(['middleware' => 'user.is.admin'], function () {
                Route::post('add', 'HotelController@addHotel');
                Route::group(['prefix' => '{id}', 'middleware' => ['hotel']], function () {

                    Route::post('image', 'HotelController@addHotelImage');
                    Route::patch('update', 'HotelController@updateHotel');

                    //rooms
                    Route::group(['prefix' => 'rooms'], function () {
                        Route::get('', 'RoomController@getRooms');
                        Route::post('', 'RoomController@addRoom')->middleware('user.is.admin');
                        Route::group(['prefix' => '/{roomId}', 'middleware' => 'room'], function () {
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

                        Route::group(['prefix' => '/{typeId}', 'middleware' => 'room-type'], function () {
                            Route::get('/', 'RoomTypeController@getRoomType');
                            Route::patch('/', 'RoomTypeController@updateRoomType')->middleware('user.is.admin');
                            Route::delete('/', 'RoomTypeController@deleteRoomType')->middleware('user.is.admin');
                        });
                    });

                    //pricing
                    Route::group(['prefix' => 'pricing', 'middleware' => 'user.is.admin'], function () {
                        Route::get('', 'PricingController@getPricings');
                        Route::post('', 'PricingController@addPricing');

                        Route::group(['prefix' => '/{pricingId}', 'middleware' => 'pricing'], function () {
                            Route::get('', 'PricingController@getPricing');
                            Route::patch('', 'PricingController@updatePricing');
                            Route::delete('}', 'PricingController@deletePricing');
                        });
                    });

                    //booking
                    Route::group(['prefix' => 'booking'], function () {
                        Route::get('', 'BookingController@getBookings');
                        Route::post('', 'BookingController@addBooking');

                        Route::group(['prefix' => '/{bookingId}', 'middleware' => 'booking'], function () {
                            Route::patch('', 'BookingController@updateBooking');
                            Route::delete('', 'BookingController@deleteBooking');
                        });
                    });

                });
            });
        });

        Route::group(['middleware' => ['device']], function () {
            //rooms
            Route::group(['prefix' => 'user', 'middleware' => 'user.is.customer'], function () {
                Route::post('bookings', 'BookingController@addBooking');
                Route::get('bookings', 'BookingController@getUserBookings');
            });
        });

    });
});
