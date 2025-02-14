<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoirTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('foir')->insert([
            [
                'id' => 1,
                'bank_name' => 'SBI',
                'min_salary' => 0.00,
                'max_salary' => 50000.00,
                'foir_percentage' => 40.00,
                'created_at' => '2024-09-25 11:54:29',
                'updated_at' => '2024-09-25 12:20:39',
            ],
            [
                'id' => 2,
                'bank_name' => 'HDFC',
                'min_salary' => 50001.00,
                'max_salary' => 100000.00,
                'foir_percentage' => 50.00,
                'created_at' => '2024-09-25 11:54:29',
                'updated_at' => '2024-09-25 12:20:58',
            ],
            [
                'id' => 3,
                'bank_name' => 'KOTAK',
                'min_salary' => 100001.00,
                'max_salary' => 150000.00,
                'foir_percentage' => 50.00,
                'created_at' => '2024-09-25 11:54:29',
                'updated_at' => '2024-09-25 12:20:58',
            ],
            [
                'id' => 4,
                'bank_name' => 'UNION',
                'min_salary' => 150001.00,
                'max_salary' => 200000.00,
                'foir_percentage' => 50.00,
                'created_at' => '2024-09-25 11:54:29',
                'updated_at' => '2024-09-25 12:20:58',
            ],
            [
                'id' => 5,
                'bank_name' => 'KOTAK',
                'min_salary' => 0.00,
                'max_salary' => 50000.00,
                'foir_percentage' => 40.00,
                'created_at' => '2024-09-25 11:54:29',
                'updated_at' => '2024-09-25 12:20:39',
            ],
            [
                'id' => 6,
                'bank_name' => 'AXIS',
                'min_salary' => 0.00,
                'max_salary' => 5000000.00,
                'foir_percentage' => 40.00,
                'created_at' => '2024-09-25 11:54:29',
                'updated_at' => '2024-09-25 12:20:39',
            ],
        ]);
    }
}
