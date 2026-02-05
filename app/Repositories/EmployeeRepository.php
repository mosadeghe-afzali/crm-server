<?php

namespace App\Repositories;

use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Employee;

class EmployeeRepository
{
    public function index($input = [])
    {
        $result = Employee::with('user', 'department', 'position')
            ->filter($input)
            ->paginate(10);
        return new EmployeeCollection($result);
    }

    public function show($input)
    {
        $result = Employee::with('user', 'department', 'position')
            ->filter($input)->first();
        return new EmployeeResource($result);
    }

    public function create($input)
    {
        $result = Employee::create($input);
        return new EmployeeResource($result);
    }

    public function find($user_id)
    {
        return Employee::find($user_id);
    }

    public function update($input)
    {

        $user_id = $input['user_id'];
        unset($input['user_id']);

        Employee::where('id', $user_id)->update($input);
    }
}
