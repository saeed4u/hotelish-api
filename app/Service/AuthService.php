<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-25
 * Time: 10:49
 */

namespace App\Service;


use App\Http\Resources\UserResource;
use App\Repo\AuthRepo;
use App\Utils\ApiResponse;
use App\Utils\Logging;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthService
{
    use Logging, ApiResponse;
    /**
     * @var AuthRepo $baseRepo
     */
    private $baseRepo;

    /**
     * AuthService constructor.
     * @param AuthRepo $baseRepo
     */
    public function __construct(AuthRepo $baseRepo)
    {
        $this->baseRepo = $baseRepo;
    }

    /**
     * @param array $registrationData
     * @return JsonResponse
     */
    public function registerCustomer(array $registrationData)
    {
        try {
            if ($user = $this->baseRepo->register($registrationData['email'], $registrationData['password'])) {
                return $this->success('Registration successful', ['user' => new UserResource($user)]);
            }
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }

    /**
     * @param array $loginData
     * @return ResponseFactory|JsonResponse|Response
     */
    public function login(array $loginData)
    {
        try {
            $user = $this->baseRepo->login($loginData['email'], $loginData['password'], $loginData['ip']);
            if ($user) {
                if ($user->status === static::$USER_ACCOUNT_BLOCKED_TOO_MANY_LOGIN_ATTEMPTS) {
                    return $this->forbidden('Sorry, your account has been temporarily blocked. Please contact our support to get it resolved');
                }
                return $this->success('Logged in successfully', ['user' => new UserResource($user)]);
            }
            return $this->badRequest('Invalid credentials');
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        try {
            $this->baseRepo->logout();
            return $this->success();
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }

}
