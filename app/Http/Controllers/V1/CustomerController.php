<?php

namespace App\Http\Controllers\V1;

use App\Traits\ResponseTrait;
use App\Services\V1\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Customer\IndexCustomerRequest;
use App\Http\Requests\User\Customer\UpdateCustomerRequest;

class CustomerController extends Controller
{
    use ResponseTrait;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(IndexCustomerRequest $request)
    {
        $input = $request->validated();
        $output = $this->userService->customers($input);

        return $this->showResponse($output);
    }

    public function update(UpdateCustomerRequest $request) {
        $input = $request->validated();
        $this->userService->updateCustomer($input);

        return $this->showResponse();
    }

    public function show($customer_id) {
        $output = $this->userService->showCustomer($customer_id);

        return $this->showResponse($output);
    }
}
