<?php

namespace App\Http\Controllers\V1;

use App\Traits\ResponseTrait;
use App\Services\V1\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    use ResponseTrait;
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $input = $request->validated();
        $this->authService->register($input);
        return $this->showResponse();
    }

    public function login(LoginRequest $request) {
        $input = $request->validated();

        $output = $this->authService->login($input);

        return $this->showResponse($output);
    }
}
