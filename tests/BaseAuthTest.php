<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-25
 * Time: 11:40
 */

namespace Tests;


use App\Repo\AuthRepo;
use App\User;

class BaseAuthTest extends TestCase
{

    /**
     * @var AuthRepo $authRepo
     */
    protected $authRepo;

    /**
     * @var User $user
     */
    protected $user;

    protected function registerUser($email = 'saeed@codeline.com', $password = 'randompassword')
    {
        $this->user = $this->authRepo->register($email, $password);
    }

    protected function tearDown()
    {
        parent::tearDown();
        if ($this->user) {
            $this->user->delete();
        }
    }

    protected function setUp()
    {
        parent::setUp();
        $this->authRepo = $this->app->make(AuthRepo::class);
    }


}