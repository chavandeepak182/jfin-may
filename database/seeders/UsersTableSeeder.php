<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Deepak',
                'email_id' => 'admin@jfinserv.com',
                'pan_no' => null,
                'password' => md5('admin123'), // Using MD5 Hash
                'wallet_id' => null,
                'existing_loan_id' => null,
                'role_id' => 4, // Admin Role
                'profile_id' => 1,
                'edu_id' => null,
                'professional_id' => null,
                'referral_code' => null,
                'refer_user_id' => null,
                'email_otp' => '',
                'is_email_verify' => 1,
                'created_at' => '2024-08-07 10:37:37',
                'updated_at' => '2025-01-28 14:21:11',
                'deleted_at' => null,
            ],
            [
                'id' => 30,
                'name' => 'Amol Dagale',
                'email_id' => 'amol@jfstechnologies.com',
                'pan_no' => null,
                'password' => md5('12345678'), // Using MD5 Hash
                'wallet_id' => null,
                'existing_loan_id' => null,
                'role_id' => 2, // Agent Role
                'profile_id' => 25,
                'edu_id' => null,
                'professional_id' => null,
                'referral_code' => null,
                'refer_user_id' => null,
                'email_otp' => '869934',
                'is_email_verify' => 1,
                'created_at' => '2024-08-08 06:41:45',
                'updated_at' => '2024-08-16 14:26:38',
                'deleted_at' => null,
            ],
            [
                'id' => 33,
                'name' => 'Tarun Pynee',
                'email_id' => 'tarun@jfstechnologies.com',
                'pan_no' => null,
                'password' => md5('admin123'), // Using MD5 Hash
                'wallet_id' => null,
                'existing_loan_id' => null,
                'role_id' => 2, // Agent Role
                'profile_id' => 27,
                'edu_id' => null,
                'professional_id' => null,
                'referral_code' => null,
                'refer_user_id' => null,
                'email_otp' => '559991',
                'is_email_verify' => 1,
                'created_at' => '2024-08-08 07:32:11',
                'updated_at' => '2024-09-04 07:45:34',
                'deleted_at' => null,
            ],
        ]);
    }
}
