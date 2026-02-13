<?php
namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository {

    public function create($input) {
        Role::create($input);
    }

    public function index($input = []) {
        return Role::select('id', 'name')->filter($input)->get();
    }

    public function findOrFail($role_id) {
        return Role::findOrFail($role_id);
    }
}
