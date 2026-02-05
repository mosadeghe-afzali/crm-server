<?php
namespace App\Repositories;

use App\Models\City;

class CityRepository {
    public function index($input = []) {
        return City::select('id', 'name', 'province_id')->filter($input)->get();
    }
    public function show($input) {
        return City::filter($input)->first();
    }

    public function create($input) {
        return City::create($input);
    }

    public function find($city_id) {
        return City::find($city_id);
    }

    public function update($input) {

        $city_id = $input['city_id'];
        unset($input['city_id']);

        City::where('id', $city_id)->update($input);
    }
}
