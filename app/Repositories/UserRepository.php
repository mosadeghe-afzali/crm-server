<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository {
    public function index($input) {
        return User::filter($input)->paginate(10);
    }
    public function show($input) {
        return User::filter($input)->first();
    }

    public function create($input) {
        return User::create($input);
    }

    public function find($user_id) {
        return User::find($user_id);
    }

    public function update($input) {

        $user_id = $input['user_id'];
        unset($input['user_id']);

        User::where('id', $user_id)->update($input);
    }
}
