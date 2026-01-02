<?php
namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository {
    public function index($input = []) {
        return Employee::with('user')->filter($input)->paginate(10);
    }
    public function show($input) {
        return Employee::filter($input)->first();
    }

    public function create($input) {
        return Employee::create($input);
    }

    public function find($user_id) {
        return Employee::find($user_id);
    }

    public function update($input) {

        $user_id = $input['user_id'];
        unset($input['user_id']);

        Employee::where('id', $user_id)->update($input);
    }
}
