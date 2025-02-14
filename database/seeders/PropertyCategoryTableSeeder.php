<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('property_category')->insert([
            ['pid' => 1, 'category_name' => 'Residential'],
            ['pid' => 2, 'category_name' => 'Commercial'],
        ]);
    }
}
