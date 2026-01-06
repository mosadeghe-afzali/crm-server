<?php

namespace App\Http\Controllers\V1;

use App\Traits\ResponseTrait;
use App\Services\V1\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Employee\IndexEmployeeRequest;
use App\Http\Requests\User\Employee\UpdateEmployeeRequest;
use App\Http\Requests\User\IndexUserRequest;

class EmployeeController extends Controller
{
    use ResponseTrait;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(IndexEmployeeRequest $request)
    {
        $input = $request->validated();
        $output = $this->userService->employees($input);

        return $this->showResponse($output);
    }

    public function update(UpdateEmployeeRequest $request) {
        $input = $request->validated();
        $this->userService->updateEmployee($input);

        return $this->showResponse();
    }
}
