<?php

namespace Tests\Feature;

use App\Repo\AuthRepo;
use App\User;
use Tests\BaseAuthTest;
use Tests\TestCase;

class AuthRepoTest extends BaseAuthTest
{



    public function testRegisterCustomerExpectSuccess()
    {
        $this->registerUser();
        self::assertNotNull($this->user);
        self::assertIsObject($this->user);
    }


    public function testLoginExpectSuccess()
    {
        $this->registerUser();
        $loggedInUser = $this->authRepo->login('saeed@codeline.com', 'randompassword');
        self::assertNotNull($loggedInUser);
        self::assertIsString($loggedInUser->token);
        self::assertEquals($this->user->id, $loggedInUser->id);
    }

    public function testLoginExpectFailure()
    {
        $this->registerUser();
        $loggedInUser = $this->authRepo->login('saeed@codeline.com', 'wrongrandompassword');
        self::assertNull($loggedInUser);
    }

}
