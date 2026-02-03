<?php
namespace App\Repositories;

use App\Models\UserType;

class UserTypeTypeRepository {
    public function index($input) {
        return UserType::filter($input)->paginate(10);
    }
    public function show($input) {
        return UserType::filter($input)->first();
    }

    public function create($input) {
        return UserType::create($input);
    }

    public function find($id) {
        return UserType::find($id);
    }

    public function update($input) {

        $id = $input['id'];
        unset($input['id']);

        UserType::where('id', $id)->update($input);
    }
}
