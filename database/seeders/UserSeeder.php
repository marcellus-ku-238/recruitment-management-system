<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Keya Goswami',
                'role' => 'recruiter',
                'email' => 'keya.goswami@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Sagar mali',
                'role' => 'interviewer',
                'email' => 'sagar.mali@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Prakash Kumar',
                'role' => 'interviewer',
                'email' => 'prakash.kumar@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Akash Chaudhry',
                'role' => 'recruiter',
                'email' => 'akash.chaudhry@example.com',
                'password' => Hash::make('password')
            ]
        ]);
    }
}
