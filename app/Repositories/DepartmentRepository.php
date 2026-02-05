<?php
namespace App\Repositories;

use App\Models\Department;

class DepartmentRepository {
    public function index($input = []) {
        return Department::select('id', 'name')->filter($input)->get();
    }

    public function show($input) {
        return Department::filter($input)->first();
    }

    public function create($input) {
        return Department::create($input);
    }

    public function find($department_id) {
        return Department::find($department_id);
    }

    public function update($input) {

        $department_id = $input['department_id'];
        unset($input['department_id']);

        Department::where('id', $department_id)->update($input);
    }
}
