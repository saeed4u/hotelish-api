<?php

namespace Tests\Feature;

use App\Repo\AuthRepo;
use App\User;
use Tests\TestCase;

class AuthRepoTest extends TestCase
{
    /**
     * @var AuthRepo $authRepo
     */
    private $authRepo;

    /**
     * @var User $user
     */
    private $user;


    public function testRegisterCustomerExpectSuccess()
    {
        $this->registerUser();
        self::assertNotNull($this->user);
        self::assertIsObject($this->user);

        $customer = $this->user->customer;

        self::assertNotNull($customer);
        self::assertEquals($this->user->id, $customer->user_id);
    }

    private function registerUser($email = 'saeed@codeline.com', $password = 'randompassword')
    {
        $this->user = $this->authRepo->register($email, $password);
    }

    public function testLoginExpectSuccess()
    {
        $this->registerUser();
        $loggedInUser = $this->authRepo->login('saeed@codeline.com', 'randompassword');
        self::assertNotNull($loggedInUser);
        self::assertEquals($this->user->id, $loggedInUser->id);
        self::assertEquals($this->user->customer, $loggedInUser->customer);
    }

    public function testLoginExpectFailure(){
        $this->registerUser();
        $loggedInUser = $this->authRepo->login('saeed@codeline.com', 'wrongrandompassword');
        self::assertNull($loggedInUser);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->authRepo = $this->app->make(AuthRepo::class);
    }

    protected function tearDown()
    {
        parent::tearDown();
        if ($this->user) {
            $this->user->delete();
        }
    }


}
