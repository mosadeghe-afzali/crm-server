<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;
class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "id" => 1,
                "name" => "رییس هیئت مدیره",
                'department_id' => 1
            ],
            [
                "id" => 2,
                "name" => "مدیر عامل",
                'department_id' => 1
            ],
            [
                "id" => 3,
                "name" => "مدیر فنی",
                'department_id' => 4
            ],
            [
                "id" => 4,
                "name" => "کارشناس فنی",
                'department_id' => 4
            ],
            [
                "id" => 15,
                "name" => "مسئول دفتر",
                'department_id' => 5
            ],
            [
                "id" => 6,
                "name" => "منشی",
                'department_id' => 5
            ],
            [
                "id" => 7,
                "name" => "کارمند اداری",
                'department_id' => 5
            ],
            [
                "id" => 8,
                "name" => "مدیر واحد بازرگانی",
                'department_id' => 7
            ],
            [
                "id" => 9,
                "name" => "مدیر تدارکات",
                'department_id' => 6
            ],
            [
                "id" => 10,
                "name" => "کارشناس تدارکات",
                'department_id' => 6
            ],
            [
                "id" => 11,
                "name" => "کارپرداز",
                'department_id' => 5
            ],
            [
                "id" => 12,
                "name" => "مدیر فروش",
                'department_id' => 2
            ],
            [
                "id" => 13,
                "name" => "کارشناس فروش",
                'department_id' => 2
            ]
        ];

        Position::insert($data);
    }
}
