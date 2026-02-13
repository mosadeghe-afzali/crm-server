<?php

namespace App\Services\V1;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;

class  PermissionService
{
    private $permissionRepository;
    private $roleRepository;


    public function __construct(
        PermissionRepository $permissionRepository,
        RoleRepository $roleRepository
    ) {
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    public function store($input)
    {
        return $this->permissionRepository->create($input);
    }

    public function roleStore($input)
    {
        return $this->roleRepository->create($input);
    }

    public function index()
    {
        return $this->permissionRepository->index();
    }

    public function roleIndex()
    {
        return $this->roleRepository->index();
    }

    public function rolePermissions($role_id)
    {
        $role = $this->roleRepository->findOrFail($role_id);
        $permissions = $role->permissions()
            ->select('id', 'name')
            ->get()
        ->toArray();

        return $permissions;
    }

    public function assignrolePermissions($input)
    {
        $role = $this->roleRepository->findOrFail($input['role_id']);
        $permission = $this->permissionRepository->findOrFail($input['permission_id']);

        $role->givePermissionTo($permission->name);
    }
}
