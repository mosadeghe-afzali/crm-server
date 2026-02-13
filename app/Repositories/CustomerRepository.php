<?php
namespace App\Repositories;

use App\Http\Resources\Customer\CustomerCollection;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;

class CustomerRepository {
    public function index($input = []) {
        $result = Customer::with('user', 'company')->filter($input)->paginate(10);

        return new CustomerCollection($result);
    }
    public function show($input) {
        $result = Customer::with('user', 'company')->filter($input)->first();
        return new CustomerResource($result);
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
