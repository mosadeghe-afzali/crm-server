<?php

namespace App\Services\V1;

use App\Repositories\PermissionRepository;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

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

    public Function store($input) {
        return $this->permissionRepository->create($input);
    }

    public function storeRole($input) {
        return $this->roleRepository->create($input);
    }

}
