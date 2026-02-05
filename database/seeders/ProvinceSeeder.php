<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = File::get('database/data/provinces.json');
        $input = [];
        foreach (json_decode($provinces)->RECORDS as $province) {
            $input[] = [
                'id' => $province->id,
                'country_id' => $province->country_id,
                'name' => $province->name,
                'latitude' => $province->latitude,
                'longitude' => $province->longitude,
                'code' => $province->code
            ];
        }
        Province::insert($input);
    }
}
