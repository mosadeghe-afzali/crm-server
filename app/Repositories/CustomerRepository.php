<?php
namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository {
    public function index($input = []) {
        return Customer::with('user', 'company')->filter($input)->paginate(10);
    }
    public function show($input) {
        return Customer::filter($input)->first();
    }

    public function create($input) {
        return Customer::create($input);
    }

    public function find($user_id) {
        return Customer::find($user_id);
    }

    public function update($input) {

        $user_id = $input['user_id'];
        unset($input['user_id']);

        Customer::where('id', $user_id)->update($input);
    }
}
