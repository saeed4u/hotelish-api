<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-24
 * Time: 00:51
 */

namespace App\Repo;


use App\User;

interface AuthRepo extends Crud
{
    /**
     * @param $email
     * @param $password
     * @return User
     */
    function login($email, $password): User;

    /**
     * @param $email
     * @param $password
     * @return User
     */
    function register($email, $password): User;

    /**
     * @param User $user
     * @return bool
     */
    function logout(User $user): bool;

    /**
     * @param $email
     * @return bool
     */
    function resetPassword($email): bool;
}