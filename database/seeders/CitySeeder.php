<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = File::get('database/data/cities.json');
        $input = [];
        foreach (json_decode($cities)->RECORDS as $city) {
            $input[] = [
                'id' => $city->id,
                'province_id' => $city->province_id,
                'name' => $city->name,
                'latitude' => $city->latitude,
                'longitude' => $city->longitude
            ];
        }
        City::insert($input);
    }
}
