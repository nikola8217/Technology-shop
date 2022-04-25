<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array(
            array('name'=>'Ryzen 3 43008GB256GB', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                    'price' => 41999.00, 'img' => '../img/komp1.png', 'category_id' => 1),
            array('name'=>'PRIME GAMING FORMULA', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 449999.00, 'img' => '../img/komp2.png', 'category_id' => 1),
            array('name'=>'Prime Core Super GP', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 115999.00, 'img' => '../img/komp3.png', 'category_id' => 1),
            array('name'=>'LENOVO IdeaPad 3', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 69999.00, 'img' => '../img/lp1.png', 'category_id' => 2),
            array('name'=>'ACER Aspire 3', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 65999.00, 'img' => '../img/lp2.png', 'category_id' => 2),
            array('name'=>'LENOVO IdeaPad 3 14ALC6', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 89999.00, 'img' => '../img/lp3.png', 'category_id' => 2),
            array('name'=>'WIKO VIEW 5 Plus', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 16999.00, 'img' => '../img/m1.png', 'category_id' => 3),
            array('name'=>'Alcatel 1SE 3', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 14999.00, 'img' => '../img/m2.png', 'category_id' => 3),
            array('name'=>'SAMSUNG Galaxy Z Fold 3', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 219999.00, 'img' => '../img/m3.png', 'category_id' => 3),

            array('name'=>'Prime Pro MPG Forge Titan', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 194999.00, 'img' => '../img/komp4.png', 'category_id' => 1),
            array('name'=>'Prime Lider Compact', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 69999.00, 'img' => '../img/komp5.png', 'category_id' => 1),
            array('name'=>'Prime Lider COLOSSUS', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 64999.00, 'img' => '../img/komp6.png', 'category_id' => 1),
            array('name'=>'DESK WIN11HOME R21008G240S', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 41999.00, 'img' => '../img/komp7.png', 'category_id' => 1),
            array('name'=>'Prime R2500X8G480', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 84999.00, 'img' => '../img/komp8.png', 'category_id' => 1),
            array('name'=>'Prime Lider Black', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 774999.00, 'img' => '../img/komp9.png', 'category_id' => 1),
            array('name'=>'Prime Pro Bayonet', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 105999.00, 'img' => '../img/komp10.png', 'category_id' => 1),
            array('name'=>'Prime Lider Edge', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 42999.00, 'img' => '../img/komp11.png', 'category_id' => 1),
            array('name'=>'Prime Lider Element', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 61999.00, 'img' => '../img/komp12.png', 'category_id' => 1),
            array('name'=>'Aurora Lider Iris 10100', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 38999.00, 'img' => '../img/komp13.png', 'category_id' => 1),
            array('name'=>'PRIME LIDER CM1660', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 116999.00, 'img' => '../img/komp14.png', 'category_id' => 1),
            array('name'=>'Prime Pro Phantom', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 159999.00, 'img' => '../img/komp15.png', 'category_id' => 1),

            array('name'=>'LENOVO IdeaPad 3 15IIL05', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 78219.00, 'img' => '../img/lp4.png', 'category_id' => 2),
            array('name'=>'ACER Aspire 3 A315', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 48879.00, 'img' => '../img/lp5.png', 'category_id' => 2),
            array('name'=>'LENOVO IdeaPad 3 14ITL6', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 58669.00, 'img' => '../img/lp6.png', 'category_id' => 2),
            array('name'=>'LENOVO IdeaPad Gaming 3', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 109999.00, 'img' => '../img/lp7.png', 'category_id' => 2),
            array('name'=>'HP 470 G7 Notebook', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 94219.00, 'img' => '../img/lp8.png', 'category_id' => 2),
            array('name'=>'ACER Nitro 5', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 133329.00, 'img' => '../img/lp9.png', 'category_id' => 2),
            array('name'=>'ACER PREDATOR HELIOS 300', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 199989.00, 'img' => '../img/lp10.png', 'category_id' => 2),
            array('name'=>'APPLE MacBook Pro 13', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 345999.00, 'img' => '../img/lp11.png', 'category_id' => 2),
            array('name'=>'APPLE MacBook Pro 16', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 367999.00, 'img' => '../img/lp12.png', 'category_id' => 2),
            array('name'=>'DELL Vostro 5510', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 97999.00, 'img' => '../img/lp13.png', 'category_id' => 2),
            array('name'=>'LENOVO Yoga', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 134999.00, 'img' => '../img/lp14.png', 'category_id' => 2),
            array('name'=>'HP ENVY', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 178999.00, 'img' => '../img/lp15.png', 'category_id' => 2),

            array('name'=>'APPLE iPhone 13', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 177999.00, 'img' => '../img/m4.png', 'category_id' => 3),
            array('name'=>'APPLE iPhone 12', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 93999.00, 'img' => '../img/m5.png', 'category_id' => 3),
            array('name'=>'APPLE iPhone 13 mini', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 145999.00, 'img' => '../img/m6.png', 'category_id' => 3),
            array('name'=>'SAMSUNG Galaxy Z FLIP 3', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 123999.00, 'img' => '../img/m7.png', 'category_id' => 3),
            array('name'=>'SAMSUNG GALAXY S21', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 129999.00, 'img' => '../img/m8.png', 'category_id' => 3),
            array('name'=>'SAMSUNG GALAXY A12', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 20999.00, 'img' => '../img/m9.png', 'category_id' => 3),
            array('name'=>'SAMSUNG GALAXY S21 Ultra', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 152999.00, 'img' => '../img/m10.png', 'category_id' => 3),
            array('name'=>'HUAWEI Nova 9', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 61999.00, 'img' => '../img/m11.png', 'category_id' => 3),
            array('name'=>'HONOR 50', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 64999.00, 'img' => '../img/m12.png', 'category_id' => 3),
            array('name'=>'XIAOMI Mi 9 DS 6', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 55999.00, 'img' => '../img/m13.png', 'category_id' => 3),
            array('name'=>'ONE PLUS Nord 2', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 55999.00, 'img' => '../img/m14.png', 'category_id' => 3),
            array('name'=>'XIAOMI Redmi Note 8', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'price' => 27999.00, 'img' => '../img/m15.png', 'category_id' => 3),
           
            
        );

        DB::table('products')->insert($products);
    }
}
