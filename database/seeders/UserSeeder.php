<?php

namespace Database\Seeders;

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
                'name'=>'Demo Director',
                'email'=>'director@yopmail.com',
                'password'=>Hash::make('12345678'),
                'role_id'=>1,
            ],
            [
                'name'=>'Demo Manager',
                'email'=>'manager@yopmail.com',
                'password'=>Hash::make('12345678'),
                'role_id'=>2,
            ],
            [
                'name'=>'Demo Staff',
                'email'=>'staff@yopmail.com',
                'password'=>Hash::make('12345678'),
                'role_id'=>3,
            ],
            ]);
    }
}
