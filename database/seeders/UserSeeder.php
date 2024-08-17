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
     */
    public function run(): void
    {
        if (DB::table('users')->where('email', 'ismoil_007u@gmail.com')->doesntExist()) {
            DB::table('users')->insert([
                'first_name' => 'ismoil',
                'last_name' => 'Usmonov',
                'email' => 'ismoil_007u@gmail.com',
                'password' => Hash::make('ismoil_007u@gmail.com'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        if (DB::table('users')->where('email', 'staff@gmail.com')->doesntExist()) {
            DB::table('users')->insert([
                'first_name' => 'Staff',
                'last_name' => 'Staffov',
                'email' => 'staff@gmail.com',
                'password' => Hash::make('staff@gmail.com'),
                'role' => 'staff',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        if (DB::table('users')->where('email', 'manager@gmail.com')->doesntExist()) {
            DB::table('users')->insert([
                'first_name' => 'Manager',
                'last_name' => 'Managerov',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('manager@gmail.com'),
                'role' => 'manager',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
