<?php

namespace App\Http\Controllers\V1;

use App\Traits\ResponseTrait;
use App\Services\V1\UserService;
use App\Services\V1\EmployeeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Employee\AssignRoleRequest;
use App\Http\Requests\User\Employee\IndexEmployeeRequest;
use App\Http\Requests\User\Employee\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    use ResponseTrait;
    protected $userService;
    protected $employeeService;
    public function __construct(UserService $userService, EmployeeService $employeeService)
    {
        $this->userService = $userService;
        $this->employeeService = $employeeService;
    }

    public function index(IndexEmployeeRequest $request)
    {
        $input = $request->validated();
        $output = $this->userService->employees($input);

        return $this->showResponse($output);
    }

    public function update(UpdateEmployeeRequest $request)
    {
        $input = $request->validated();
        $this->userService->updateEmployee($input);

        return $this->showResponse();
    }

    public function show($emmploeyee_id)
    {
        $output = $this->userService->showEmployee($emmploeyee_id);

        return $this->showResponse($output);
    }

    public function assignRole(AssignRoleRequest $request)
    {
        $input = $request->validated();
        $this->employeeService->assignRole($input);

        return $this->showResponse();
    }

    public function roles($emmploeyee_id)
    {
        $output = $this->employeeService->roles($emmploeyee_id);

        return $this->showResponse($output);
    }

    public function positionPermissions($position_id) {

        $output = $this->employeeService->getPositonPermissions($position_id);

        return $this->showResponse($output); 
    }
}
