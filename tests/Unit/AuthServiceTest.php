<?php

namespace Tests\Unit;

use App\Service\AuthService;
use App\User;
use Illuminate\Http\JsonResponse;
use Tests\BaseAuthTest;

class AuthServiceTest extends BaseAuthTest
{
    /**
     * @var AuthService $service
     */
    private $service;

    public function testCreateUserCustomerExpectSuccess()
    {
        $registrationData = ['email' => 'saeed@codeline.com', 'password' => 'randompassword'];
        /**
         * @var JsonResponse $response
         */
        $response = $this->service->registerCustomer($registrationData);
        self::assertEquals(200, $response->status());
    }

    public function testLoginExpectSuccess()
    {
        $this->registerUser();
        $loginData = ['email' => 'saeed@codeline.com', 'password' => 'randompassword'];
        $response = $this->service->login($loginData);
        self::assertEquals(200, $response->status());
    }

    protected function setUp()
    {
        parent::setUp();
        $this->service = $this->app->make(AuthService::class);
    }

    protected function tearDown()
    {
        $this->user = User::where('email', 'saeed@codeline.com')->first();
        parent::tearDown();
    }
}
