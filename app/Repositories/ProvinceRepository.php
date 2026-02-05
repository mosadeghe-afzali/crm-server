<?php
namespace App\Repositories;

use App\Models\Province;

class ProvinceRepository {
    public function index($input = []) {
        return Province::select('id', 'name')->filter($input)->get();
    }
    
    public function show($input) {
        return Province::filter($input)->first();
    }

    public function create($input) {
        return Province::create($input);
    }

    public function find($province_id) {
        return Province::find($province_id);
    }

    public function update($input) {

        $province_id = $input['province_id'];
        unset($input['province_id']);

        Province::where('id', $province_id)->update($input);
    }
}
