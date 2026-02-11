<?php
namespace App\Repositories;
use Spatie\Permission\Models\Permission;

class PermissionRepository {

    public function create($input) {
        Permission::create($input); 
    }
}
