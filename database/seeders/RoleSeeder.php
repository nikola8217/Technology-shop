<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = array(
            array('name'=>'Korisnik'),
            array('name'=>'Admin'),
            array('name'=>'Menadzer')
            
        );

        DB::table('roles')->insert($role);
    }
}
