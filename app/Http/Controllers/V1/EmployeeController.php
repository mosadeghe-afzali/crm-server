<?php

namespace App\Http\Controllers\V1;

use App\Traits\ResponseTrait;
use App\Services\V1\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\IndexUserRequest;

class EmployeeController extends Controller
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
        $output = $this->userService->employees($input);

        return $this->showResponse($output);
    }
}
