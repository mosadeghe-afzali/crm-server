<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{

    public function create($input)
    {
        Permission::create($input);
    }

    public function index($input = [])
    {
        return Permission::select('id', 'name')->filter($input)->get();
    }

    public function findOrFail($permission_id)
    {
        return Permission::findOrFail($permission_id);
    }

    public function checkHasPermission($input) {
        $permissions = Permission::select('id', 'name')
            ->get()
            ->map(function ($permission) use ($positionPermissionIds) {
                return [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'has_permission' => in_array($permission->id, $positionPermissionIds) ? 1 : 0,
                ];
        });

        return $permissions;
    }
}
