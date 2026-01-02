<?php

namespace App\Services\V1;

use App\Repositories\UserRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Validation\ValidationException;
use App\Repositories\CustomerCompanyRepository;

class  UserService
{
    private $userRepository;
    private $customerRepository;
    private $employeeRepository;
    private $customerCompanyRepository;

    public function __construct(
        UserRepository $userRepository,
        CustomerRepository $customerRepository,
        EmployeeRepository $employeeRepository,
        CustomerCompanyRepository $customerCompanyRepository
    ) {
        $this->userRepository = $userRepository;
        $this->customerRepository = $customerRepository;
        $this->employeeRepository = $employeeRepository;
        $this->customerCompanyRepository = $customerCompanyRepository;
    }

    public function show($input)
    {
        return $this->userRepository->find($input['user_id']);
    }

    public function update($input)
    {
        return $this->userRepository->update($input);
    }

    function customers($input)
    {
        return $this->customerRepository->index($input);
    }

    function employees($input)
    {
        return $this->employeeRepository->index($input);
    }
}
