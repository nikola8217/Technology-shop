<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = array(
            array('name'=>'SONY PlayStation 5 konzola + 3 igrice', 'img' => '../img/action1.png', 'price' => 59999),
            array('name'=>'Konzola XBOX SERIES S 512GB - Fortnite', 'img' => '../img/action2.png','price' => 49999),
            
            
        );

        DB::table('actions')->insert($actions);
    }
}
