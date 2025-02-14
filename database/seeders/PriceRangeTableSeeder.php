<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceRangeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('price_range')->insert([
            ['range_id' => 1, 'from_price' => 500000, 'to_price' => 1000000],
            ['range_id' => 2, 'from_price' => 1000000, 'to_price' => 2000000],
            ['range_id' => 3, 'from_price' => 2000000, 'to_price' => 3000000],
            ['range_id' => 4, 'from_price' => 3000000, 'to_price' => 4000000],
            ['range_id' => 5, 'from_price' => 4000000, 'to_price' => 5000000],
            ['range_id' => 6, 'from_price' => 5000000, 'to_price' => 10000000],
        ]);
    }
}
