<?php

namespace Database\Seeders;

use App\Models\TicketCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'name' => "وظیفه داخلی"],
            ['id' => 2, 'name' => "وظیفه اجرایی"],
            ['id' => 3, 'name' => "پیگری سفارش"],
            ['id' => 4, 'name' => "پیگیری پرداخت"],
        ];

        TicketCategory::insert($data); 
    }
}
