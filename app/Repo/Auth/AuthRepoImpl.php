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
use App\Utils\Constants;
use App\Utils\Logging;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AuthRepoImpl implements AuthRepo
{
    use Logging, Constants;

    /**
     * @param $email
     * @param $password
     * @param string $ip
     * @return User
     */
    function login($email, $password, $ip = '')
    {
        $this->logAuth("Logging in user {$email} coming from {$ip}");
        $auth = auth();
        if ($token = $auth->attempt(['email' => $email, 'password' => $password])) {
            $user = $auth->user();
            if (is_null($user->first_login)) {
                $user->first_login = true;
            } else {
                if ($user->first_login) {
                    $user->first_login = false;
                }
            }
            $user->last_login = now();
            $user->last_ip = $ip;
            $user->save();
            $user->token = $token;
            return $user;
        }
        $this->logAuth("Authentication failed. Increasing login attempts");
        //first lets see if the user even exist
        /**
         * @var User $user
         */
        $user = User::where('email', $email)->first();
        if ($user) {
            $this->logAuth("User found.... increasing attempts");
            $login_attempts = ++$user->login_attempts;
            $user->login_attempts = $login_attempts;

            if ($login_attempts === env('MAXIMUM_LOGIN_ATTEMPTS', 5)) {
                $user->status = static::$USER_ACCOUNT_BLOCKED_TOO_MANY_LOGIN_ATTEMPTS;
            }
            $user->save();
        }
        return null;
    }

    /**
     * @param Model $model
     * @param $attributes
     * @return bool
     */
    function update(Model $model,array $attributes): bool
    {
        return $model->update($attributes);
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
    function logout(): bool
    {
        auth()->logout();
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
    function delete(Model $model): bool
    {
        return $model->delete();
    }
}