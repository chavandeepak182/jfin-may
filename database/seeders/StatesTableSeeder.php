<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cities')->insert([
            ['id' => 313, 'city' => 'Ahmednagar', 'state_id' => 12],
            ['id' => 314, 'city' => 'Akola', 'state_id' => 12],
            ['id' => 315, 'city' => 'Amrawati', 'state_id' => 12],
            ['id' => 316, 'city' => 'Aurangabad', 'state_id' => 12],
            ['id' => 317, 'city' => 'Bhandara', 'state_id' => 12],
            ['id' => 318, 'city' => 'Beed', 'state_id' => 12],
            ['id' => 319, 'city' => 'Buldhana', 'state_id' => 12],
            ['id' => 320, 'city' => 'Chandrapur', 'state_id' => 12],
            ['id' => 321, 'city' => 'Dhule', 'state_id' => 12],
            ['id' => 322, 'city' => 'Gadchiroli', 'state_id' => 12],
            ['id' => 323, 'city' => 'Gondiya', 'state_id' => 12],
            ['id' => 324, 'city' => 'Hingoli', 'state_id' => 12],
            ['id' => 325, 'city' => 'Jalgaon', 'state_id' => 12],
            ['id' => 326, 'city' => 'Jalna', 'state_id' => 12],
            ['id' => 327, 'city' => 'Kolhapur', 'state_id' => 12],
            ['id' => 328, 'city' => 'Latur', 'state_id' => 12],
            ['id' => 329, 'city' => 'Mumbai City', 'state_id' => 12],
            ['id' => 330, 'city' => 'Mumbai suburban', 'state_id' => 12],
            ['id' => 331, 'city' => 'Nandurbar', 'state_id' => 12],
            ['id' => 332, 'city' => 'Nanded', 'state_id' => 12],
            ['id' => 333, 'city' => 'Nagpur', 'state_id' => 12],
            ['id' => 334, 'city' => 'Nashik', 'state_id' => 12],
            ['id' => 335, 'city' => 'Osmanabad', 'state_id' => 12],
            ['id' => 336, 'city' => 'Parbhani', 'state_id' => 12],
            ['id' => 337, 'city' => 'Pune', 'state_id' => 12],
            ['id' => 338, 'city' => 'Raigad', 'state_id' => 12],
            ['id' => 339, 'city' => 'Ratnagiri', 'state_id' => 12],
            ['id' => 340, 'city' => 'Sindhudurg', 'state_id' => 12],
            ['id' => 341, 'city' => 'Sangli', 'state_id' => 12],
            ['id' => 342, 'city' => 'Solapur', 'state_id' => 12],
            ['id' => 343, 'city' => 'Satara', 'state_id' => 12],
            ['id' => 344, 'city' => 'Thane', 'state_id' => 12],
            ['id' => 345, 'city' => 'Wardha', 'state_id' => 12],
            ['id' => 346, 'city' => 'Washim', 'state_id' => 12],
            ['id' => 347, 'city' => 'Yavatmal', 'state_id' => 12],
        ]);
    }
}
