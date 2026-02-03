<?php

namespace App\Services\V1;

use App\Models\Address;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;
use App\Repositories\AddressRepository;
use App\Repositories\UserRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Validation\ValidationException;
use App\Repositories\CustomerCompanyRepository;
use App\Repositories\UserTypeTypeRepository;

class AuthService
{
    private $userRepository;
    private $customerRepository;
    private $employeeRepository;
    private $customerCompanyRepository;
    private $addressRepository;
    private $userTypeRepository;

    public function __construct(
        UserRepository $userRepository,
        CustomerRepository $customerRepository,
        EmployeeRepository $employeeRepository,
        CustomerCompanyRepository $customerCompanyRepository,
        AddressRepository $addressRepository,
        UserTypeTypeRepository $userTypeRepository
    ) {
        $this->userRepository = $userRepository;
        $this->customerRepository = $customerRepository;
        $this->employeeRepository = $employeeRepository;
        $this->customerCompanyRepository = $customerCompanyRepository;
        $this->addressRepository = $addressRepository;
        $this->userTypeRepository = $userTypeRepository;
    }

    public function register($input)
    {
        $user = DB::transaction(function () use ($input) {
            $user = $this->userRepository->create([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'mobile' => $input['mobile'],
                'email' => $input['email'] ?? null,
                'national_code' => $input['national_code'] ?? null,
                'gender' => $input['gender'] ?? null,
                'password' => $input['password'],
            ]);
            $userType = $this->userTypeRepository->show(['slug' => $input['type_name']]); 
            $user->types()->sync([$userType->id]);
            if (isset($input['address']) && count($input['address'])) {
                $input['address']['addressable_id'] = $user->id;
                $input['address']['addressable_type'] = "App\Models\User";
                $this->addressRepository->create($input['address']);
            }
            switch ($input['type_name']) {
                case "customer":
                    $this->customerRepository->create([
                        'user_id' => $user->id,
                        'type' => $input['customer_type']
                    ]);
                    if ($input['customer_type'] == 2) {
                        $this->customerCompanyRepository->create([
                            'company_name' => $input['company_name'],
                            'registration_date' => $input['registration_date'],
                            'national_id' => $input['national_id']
                        ]);
                    }
                    break;
                case "employee":
                    $this->employeeRepository->create([
                        'user_id' => $user->id,
                        'department_id' => $input['department_id'],
                        'position_id' => $input['position_id'],
                        'internal_code' => $input['internal_code']
                    ]);
                    break;
                default:
                    throw ValidationException::withMessages(['type_name' => __('messages.user.invalid_type')]);
            }

            return $user;
        });

        return $user;
    }

    public function login($input)
    {
        $user = $this->userRepository->show([
            'mobile' => $input['mobile'],
        ]);

        if (empty($user)) {
            throw ValidationException::withMessages(['user' => __('messages.public.error.not_exist', ['pattern' => 'کاربر'])]);
        }

        $token = $this->createToken(['user' => $user]);

        $output = [
            "accessToken" => $token['token'],
            'exprie_at' => $token['expire_at'],
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ];

        return $output;
    }

    public function createToken($input)
    {
        $user = $input['user'];

        $token = $user->createToken('AuthToken' . $user->id);
        $accessToken = $token->accessToken;
        $tokenExpiration = $token->token->expires_at->format("Y-m-d H:i:s");

        return [
            'token' => $accessToken,
            'expire_at' => $tokenExpiration,
            'token_type' => 'bearer'
        ];
    }
}
