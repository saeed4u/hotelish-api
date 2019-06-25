<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    private $baseUrl = '/api/v1/auth';

    private $authPayload = [
        'email' => 'saeed@email.com',
        'password' => 'password1'
    ];

    private $contentTypeHeaders = [
        'accept' => 'application/json',
    ];

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegistrationExpectSuccess()
    {
        $response = $this->withHeaders($this->contentTypeHeaders)->post($this->baseUrl . '/register',
            $this->authPayload);
        $response->assertStatus(200);
        $response->assertJsonStructure(['status_code', 'message']);
    }

    public function testRegistrationExpectValidationErrors()
    {

        $response = $this->withHeaders($this->contentTypeHeaders)->post($this->baseUrl . '/register',
            ['email' => 'saeed@email.com']);
        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors']);

        $errors = $response->json('errors');
        self::assertArrayHasKey('password', $errors);
    }

    public function testLoginExpectSuccess()
    {
        $response = $this->withHeaders($this->contentTypeHeaders)->post($this->baseUrl . '/register',
            $this->authPayload);
        $response->assertStatus(200);

        $loginResponse = $this->withHeaders($this->contentTypeHeaders)->post($this->baseUrl . '/login',
            $this->authPayload);
        $loginResponse->assertStatus(200);
        $loginResponse->assertJsonStructure(['status_code', 'message', 'user']);
        $user = $loginResponse->json('user');
        self::assertArrayHasKey('token', $user);
        self::assertEquals($this->authPayload['email'], $user['email']);
    }

    public function testLoginExpectValidationErrors()
    {
        $loginResponse = $this->withHeaders($this->contentTypeHeaders)->post($this->baseUrl . '/login',
            ['email' => 'saeed@email.com']);
        $loginResponse->assertStatus(422);
        $loginResponse->assertJsonStructure(['message', 'errors']);
        $errors = $loginResponse->json('errors');
        self::assertArrayHasKey('password', $errors);
    }

    public function testLogoutExpectSuccess()
    {
        $response = $this->withHeaders($this->contentTypeHeaders)->post($this->baseUrl . '/register',
            $this->authPayload);
        $response->assertStatus(200);

        $loginResponse = $this->withHeaders($this->contentTypeHeaders)->post($this->baseUrl . '/login',
            $this->authPayload);
        $loginResponse->assertStatus(200);


        $user = $loginResponse->json('user');
        self::assertArrayHasKey('token', $user);

        $token = $user['token'];

        $logOutResponse = $this->withHeaders(array_merge($this->contentTypeHeaders,
            ['Authorization' => "Bearer $token"]))->post($this->baseUrl . '/logout');

        $logOutResponse->assertStatus(200);
        $logOutResponse->assertJsonStructure(['status_code', 'message']);
    }

    public function testLogoutExpect401(){

        $response = $this->withHeaders($this->contentTypeHeaders)->post($this->baseUrl . '/register',
            $this->authPayload);
        $response->assertStatus(200);

        $loginResponse = $this->withHeaders($this->contentTypeHeaders)->post($this->baseUrl . '/login',
            $this->authPayload);
        $loginResponse->assertStatus(200);


        $user = $loginResponse->json('user');
        self::assertArrayHasKey('token', $user);


        $logOutResponse = $this->withHeaders(array_merge($this->contentTypeHeaders,
            ['Authorization' => "Bearer "]))->post($this->baseUrl . '/logout');
        $logOutResponse->assertStatus(401);
    }

    protected function tearDown()
    {
        $user = User::where('email', $this->authPayload['email'])->first();
        if ($user) {
            $user->delete();
        }
        parent::tearDown();
    }

}
