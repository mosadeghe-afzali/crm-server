<?php
namespace App\Repositories;

use App\Models\Address;

class AddressRepository {
    public function index($input) {
        return Address::filter($input)->paginate(10);
    }
    public function show($input) {
        return Address::filter($input)->first();
    }

    public function create($input) {
        return Address::create($input);
    }

    public function find($address_id) {
        return Address::find($address_id);
    }

    public function update($input) {

        $address_id = $input['address_id'];
        unset($input['address_id']);

        Address::where('id', $address_id)->update($input);
    }
}
