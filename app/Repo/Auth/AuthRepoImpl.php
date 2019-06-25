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
use Illuminate\Support\Facades\Hash;

class AuthRepoImpl implements AuthRepo
{

    /**
     * @param $email
     * @param $password
     * @param string $api
     * @return User
     */
    function login($email, $password, $api = '')
    {
        $auth = auth();
        if($auth->attempt(['email' => $email, 'password' => $password])){
            return $auth->user();
        }
        return null;
    }

    /**
     * @param $email
     * @param $password
     * @param string $type
     * @return User
     */
    function register($email, $password, $type = 'customer')
    {
        $user = new User();
        $user->email = $email;
        $user->password = Hash::make($password);
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
        $auth = auth();
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