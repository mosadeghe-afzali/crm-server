<?php

namespace App\Http\Controllers\V1;

use App\Traits\ResponseTrait;
use App\Services\V1\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\IndexUserRequest;

class CustomerController extends Controller
{
    use ResponseTrait;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(IndexUserRequest $request)
    {
        $input = $request->validated();
        $output = $this->userService->customers($input);

        return $this->showResponse($output);
    }
}
