<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = array(
            array('name'=>'Desktop računari', 'img' => '../img/komp1.png'),
            array('name'=>'Laptop računari', 'img' => '../img/lp1.png'),
            array('name'=>'Mobilni telefoni', 'img' => '../img/m1.png')
            
        );

        DB::table('categories')->insert($category);
    }
}
