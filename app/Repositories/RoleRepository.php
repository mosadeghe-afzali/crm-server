<?php
namespace App\Repositories;
use Spatie\Permission\Models\Role;

class RoleRepository {

    public function create($input) {
        Role::create($input);
    }
}
