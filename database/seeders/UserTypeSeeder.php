<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'name' => 'کاربر', 'slug' => 'customer'],
            ['id' => 2, 'name' => 'کارشناس', 'slug' => 'emploeee']
        ];

        UserType::insert($data);
    }
}
