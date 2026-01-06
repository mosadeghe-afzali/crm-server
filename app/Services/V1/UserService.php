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

    public function updateEmployee($input)
    {
        $employee = $this->employeeRepository->find($input['employee_id']);
        $employee->update([
            'department_id' => $input['department_id'],
            'position' => $input['position'],
            'internal_code' => $input['internal_code']
        ]);
        $employee->user->update([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'mobile' => $input['mobile'],
            'email' => $input['email'],
            'national_code' => $input['national_code'],
            'gender' => $input['gender']
        ]);
    }

    public function updateCustomer($input)
    {
        $customer = $this->customerRepository->find($input['customer_id']);

        $this->updateCompany($input, $customer);
        $customer->update([
            'type' => $input['type']
        ]);
        $customer->user->update([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'mobile' => $input['mobile'],
            'email' => $input['email'],
            'national_code' => $input['national_code'],
            'gender' => $input['gender']
        ]);
    }

    public function updateCompany($input, $customer)
    {
        $customerCompany = $customer->company;
        if ($customer->type == 2 && $input['type'] == 1) {
            $this->customerCompanyRepository->delete($customerCompany->id);
        }

        if (!empty($customerCompany)) {
            $customerCompany->update([
                'company_name' => $input['company_name'],
                'registration_date' => $input['registration_date'],
                'national_id' => $input['national_id']
            ]);
        }
    }
}
