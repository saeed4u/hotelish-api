<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-24
 * Time: 00:51
 */

namespace App\Repo;


use App\User;

interface AuthRepo extends Repo
{
    /**
     * @param $email
     * @param $password
     * @param string $ip
     * @return User
     */
    function login($email, $password, $ip = '');

    /**
     * @param $email
     * @param $password
     * @param $type
     * @return User
     */
    function register($email, $password, $type = 'customer');

    /**
     * @return bool
     */
    function logout(): bool;

    /**
     * @param User $user
     * @return bool
     */
    function resetPassword(User $user): bool;
}