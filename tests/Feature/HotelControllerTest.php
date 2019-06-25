<?php

namespace Tests\Feature;

use App\Country;
use App\Hotel;
use Tests\TestCase;

class HotelControllerTest extends TestCase
{
    private $baseUrl = '/api/v1/admin/hotel';

    private $authPayload = [
        'email' => 'admin@codeline.com',
        'password' => 'password1'
    ];

    private $contentTypeHeaders = [
        'accept' => 'application/json',
    ];

    public function testGetHotelExpectSuccess()
    {
        $loginResponse = $this->withHeaders($this->contentTypeHeaders)->post('api/v1/auth/login',
            $this->authPayload);
        $loginResponse->assertStatus(200);
        $loginResponse->assertJsonStructure(['status_code', 'message', 'user']);
        $user = $loginResponse->json('user');

        $token = $user['token'];

        $hotelResponse = $this->withHeaders(array_merge($this->contentTypeHeaders,
            ["Authorization" => "Bearer $token"]))->get($this->baseUrl);
        $hotelResponse->assertStatus(200);
        $hotelResponse->assertJsonStructure(['status_code', 'message', 'hotel']);

        $hotel = Hotel::first();

        $data = $hotelResponse->json('hotel');

        self::assertEquals($hotel->id, $data['id']);
        self::assertEquals($hotel->name, $data['name']);
    }

    public function testGetHotelExpectAuthError()
    {
        $authPayload = ['email' => 'saeed@email.com', 'password' => 'password2'];
        $response = $this->withHeaders($this->contentTypeHeaders)->post('api/v1/auth/register',
            $authPayload);
        $response->assertStatus(200);

        $loginResponse = $this->withHeaders($this->contentTypeHeaders)->post('api/v1/auth/login',
            $authPayload);
        $loginResponse->assertStatus(200);

        $loginResponse->assertJsonStructure(['status_code', 'message', 'user']);
        $user = $loginResponse->json('user');

        $token = $user['token'];

        $hotelResponse = $this->withHeaders(array_merge($this->contentTypeHeaders,
            ["Authorization" => "Bearer $token"]))->get($this->baseUrl);
        $hotelResponse->assertStatus(401);
    }

    public function testUpdateHotelExpectSuccess()
    {
        $loginResponse = $this->withHeaders($this->contentTypeHeaders)->post('api/v1/auth/login',
            $this->authPayload);
        $loginResponse->assertStatus(200);
        $loginResponse->assertJsonStructure(['status_code', 'message', 'user']);
        $user = $loginResponse->json('user');

        /**
         * @var Hotel $hotel
         */
        $hotel = Hotel::first();

        $hotelArray = $hotel->attributesToArray();
        $hotelArray['name'] = 'new name';
        $hotelArray['country_id'] = Country::where('iso_code','AU')->first()->id;

        $token = $user['token'];


        $hotelResponse = $this->withHeaders(array_merge($this->contentTypeHeaders,
            ["Authorization" => "Bearer $token"]))->patch($this->baseUrl,$hotelArray);
        $hotelResponse->assertStatus(200);

        $hotel = $hotel->refresh();

        $data = $hotelResponse->json('hotel');

        self::assertEquals($hotel->id, $data['id']);
        self::assertEquals($hotel->name, $data['name']);
    }

    public function testUpdateHotelExpectValidationError(){
        $loginResponse = $this->withHeaders($this->contentTypeHeaders)->post('api/v1/auth/login',
            $this->authPayload);
        $loginResponse->assertStatus(200);
        $loginResponse->assertJsonStructure(['status_code', 'message', 'user']);
        $user = $loginResponse->json('user');

        /**
         * @var Hotel $hotel
         */
        $hotel = Hotel::first();

        $hotelArray = $hotel->attributesToArray();
        $hotelArray['name'] = 'new name';

        $token = $user['token'];


        $hotelResponse = $this->withHeaders(array_merge($this->contentTypeHeaders,
            ["Authorization" => "Bearer $token"]))->patch($this->baseUrl,$hotelArray);
        $hotelResponse->assertStatus(422);
    }


}
