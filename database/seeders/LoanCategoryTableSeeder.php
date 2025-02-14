<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('loan_category')->insert([
            ['loan_category_id' => 1, 'category_name' => 'HOME'],
            ['loan_category_id' => 2, 'category_name' => 'LAP'],
            ['loan_category_id' => 3, 'category_name' => 'PROJECT LOAN'],
            ['loan_category_id' => 4, 'category_name' => 'OVERDRAFT FACILITY'],
            ['loan_category_id' => 5, 'category_name' => 'LEASE RENTAL DISCOUNTING'],
            ['loan_category_id' => 6, 'category_name' => 'MSME LOAN'],
        ]);
    }
}
