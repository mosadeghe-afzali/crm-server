<?php

namespace App\Services\V1;

use App\Models\Address;
use App\Repositories\UserRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;

class  EmployeeService
{
    private $userRepository;
    private $employeeRepository;
    private $roleRepository;
    private $permissionRepository;
    public function __construct(
        UserRepository $userRepository,
        EmployeeRepository $employeeRepository,
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository
    ) {
        $this->userRepository = $userRepository;
        $this->employeeRepository = $employeeRepository;
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function update($input)
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

        if (count($input['address'])) {
            if (empty($input['address']['address_id'])) {
                $input['address']['addressable_id'] = $customer->id;
                $input['address']['addressable_type'] = 'App\Models\User';

                Address::creat($input['address']);
            } else {
                $user->addresses()->where('id', $input['address']['address_id'])->update($input['address']);
            }
        }
    }

    public function show($employee_id)
    {
        return $this->employeeRepository->show(['id' => $employee_id]);
    }

    public function assignRole($input)
    {
        $employee = $this->employeeRepository->find($input['employee_id']);
        $role = $this->roleRepository->find($input['role_id']);

        $user = $employee->user;
        $user->assignRole($role->name);
    }

    public function roles($employee_id)
    {
        $employee = $this->employeeRepository->findOrFail($employee_id);
        $user = $employee->user;
        $roles = $user->roles()
            ->select('id', 'name')
            ->get()
            ->toArray();

        return $roles;
    }

    public function getPositonPermissions($position_id)
    {
        $users = $this->userRepository->filterByPosition($position_id);

        $positionPermissionIds = $users
            ->flatMap(fn($user) => $user->getAllPermissions())
            ->pluck('id')
            ->unique()
            ->toArray();


        $permissions = $this->permissionRepository->index();
        $permissions  =   $permissions->map(function ($permission) use ($positionPermissionIds) {
            return [
                'id' => $permission->id,
                'name' => $permission->name,
                'has_permission' => in_array($permission->id, $positionPermissionIds) ? 1 : 0,
            ];
        });

        return $permissions;
    }
}
