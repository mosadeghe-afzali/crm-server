<?php
namespace App\Repositories;

use App\Models\CustomerCompany;

class CustomerCompanyRepository {
    public function index($input) {
        return CustomerCompany::filter($input)->paginate(10);
    }
    public function show($input) {
        return CustomerCompany::filter($input)->first();
    }

    public function create($input) {
        return CustomerCompany::create($input);
    }

    public function find($user_id) {
        return CustomerCompany::find($user_id);
    }

    public function update($input) {

        $user_id = $input['user_id'];
        unset($input['user_id']);

        CustomerCompany::where('id', $user_id)->update($input);
    }
}
