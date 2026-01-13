<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "id" => 1,
                "name" => "مدیریت"
            ],
            [
                "id" => 2,
                "name" => "فروش"
            ],
            [
                "id" => 3,
                "name" => "امور مالی"
            ],
            [
                "id" => 4,
                "name" => "فنی"
            ],
            [
                "id" => 5,
                "name" => "واحد اداری"
            ],
            [
                "id" => 6,
                "name" => "واحتد تدارکات"
            ],
            [
                "id" => 7,
                "name" => "واحد بازرگانی"
            ],
        ];
        Department::insert($data); 
    }
}
