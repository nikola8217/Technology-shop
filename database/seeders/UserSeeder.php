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
        $pass = Hash::make('12345678');
        DB::table('users')->insert([
            ['name' => 'Admin', 'lastname' => 'Admin', 'email' => 'admin@gmail.com', 'password' => $pass, 'brBodova' => 0],
            ['name' => 'Menadzer', 'lastname' => 'Menadzer', 'email' => 'menadzer@gmail.com', 'password' => $pass, 'brBodova' => 0]    
        ]);
        DB::table('user_roles')->insert([
            ['user_id' => 1, 'role_id' => 2], 
            ['user_id' => 2, 'role_id' => 3],
        ]);
    }
}
