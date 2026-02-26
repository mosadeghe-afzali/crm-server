<?php

namespace App\Services\V1;

use App\Models\Address;
use App\Repositories\CustomerCompanyRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\UserRepository;

class UserService
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

    public function customers($input)
    {
        return $this->customerRepository->index($input);
    }

    public function employees($input)
    {
        return $this->employeeRepository->index($input);
    }

    public function updateEmployee($input)
    {
        $employee = $this->employeeRepository->find($input['employee_id']);
        $employee->update([
            'department_id' => $input['department_id'],
            'position_id' => $input['position_id'],
            'internal_code' => $input['internal_code'],
        ]);
        $employee->user->update([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'mobile' => $input['mobile'],
            'email' => $input['email'],
            'national_code' => $input['national_code'],
            'gender' => $input['gender'],
        ]);

        if (isset($input['address']) && count($input['address'])) {
            if (empty($input['address']['address_id'])) {
                $input['address']['addressable_id'] = $employee->id;
                $input['address']['addressable_type'] = 'App\Models\User';

                Address::create($input['address']);
            } else {
                $employee->user->addresses()->where('id', $input['address']['address_id'])->update($input['address']);
            }
        }
    }

    public function updateCustomer($input)
    {
        $customer = $this->customerRepository->find($input['customer_id']);

        $this->updateCompany($input, $customer);
        $customer->update([
            'type' => $input['type'],
        ]);
        $customer->user->update([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'mobile' => $input['mobile'],
            'email' => $input['email'],
            'national_code' => $input['national_code'],
            'gender' => $input['gender'],
        ]);

        if (isset($input['address']) && count($input['address'])) {
            if (empty($input['address']['address_id'])) {
                $input['address']['addressable_id'] = $customer->user_id;
                $input['address']['addressable_type'] = 'App\Models\User';

                Address::create($input['address']);
            } else {
                $address_id = $input['address']['address_id'];
                unset($input['address']['address_id']);
                $customer->user->addresses()->where('id', $address_id)->update($input['address']);
            }
        }
    }

    public function updateCompany($input, $customer)
    {
        $customerCompany = $customer->company;
        if ($customer->type == 2 && $input['type'] == 1) {
            $this->customerCompanyRepository->delete($customerCompany->id);
        }

        if (! empty($customerCompany)) {
            $customerCompany->update([
                'company_name' => $input['company_name'],
                'registeration_date' => $input['registeration_date'],
                'national_id' => $input['national_id'],
            ]);
        }
    }

    public function showCustomer($customer_id)
    {
        return $this->customerRepository->show(['id' => $customer_id]);
    }

    public function showEmployee($employee_id)
    {
        return $this->employeeRepository->show(['id' => $employee_id]);
    }
}
