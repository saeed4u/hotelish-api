<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Service\AuthService;

class AuthController extends Controller
{

    /**
     * @var AuthService $authService
     */
    private $authService;

    /**
     * AuthController constructor.
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $loginRequest)
    {
        $payload = $loginRequest->validated();
        return $this->authService->login(array_merge($payload, ['ip' => $loginRequest->ip()]));
    }

    public function register(RegistrationRequest $registrationRequest)
    {
        $payload = $registrationRequest->validated();
        return $this->authService->registerCustomer(array_merge($payload, ['ip' => $registrationRequest->ip()]));
    }

    public function logout()
    {
        return $this->authService->logout();
    }
}
