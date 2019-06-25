<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-24
 * Time: 00:52
 */

namespace App\Repo\Auth;


use App\Repo\AuthRepo;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class AuthRepoImpl implements AuthRepo
{

    /**
     * @param $email
     * @param $password
     * @param string $api
     * @return User
     */
    function login($email, $password, $api = ''): User
    {
        $auth = auth('api');
        return $auth->attempt(['email' => $email, 'password' => $password]);
    }

    /**
     * @param $email
     * @param $password
     * @param string $type
     * @return User
     */
    function register($email, $password, $type = 'customer'): User
    {
        $user = new User();
        $user->email = $email;
        $user->password = $password;
        $user->user_type = $type;
        if ($this->create($user)) {
            return $user;
        }
        return null;
    }

    /**
     * @param Model $model
     * @return boolean
     */
    function create(Model $model): bool
    {
        return $model->save();
    }

    /**
     * @param User $user
     * @return bool
     */
    function logout(User $user): bool
    {
        $auth = auth('api');
        $auth->logout();
        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    function resetPassword(User $user): bool
    {
        //TODO: Not implemented
        return false;
    }

    /**
     * @param Builder $queryBuilder
     * @return mixed
     */
    function read(Builder $queryBuilder)
    {
        return $queryBuilder->get();
    }

    /**
     * @param Model $model
     * @return bool
     */
    function update(Model $model): bool
    {
        return $model->update();
    }

    /**
     * @param Model $model
     * @return bool
     */
    function delete(Model $model): bool
    {
        return $model->delete();
    }
}