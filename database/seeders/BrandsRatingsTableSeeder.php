<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsRatingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands_ratings')->delete();
        
        \DB::table('brands_ratings')->insert(array (
            
            array (
                'id' => 1,
                'client_id' => 4,
                'brand_id' => 4165,
                'rating' => '5',
                'review' => 'Fine brand! I like it.',
                'email' => 'polishchuk.i.m.84@gmail.com',
                'created_at' => '2023-11-22 14:13:06',
                'updated_at' => '2023-11-22 14:13:06',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 2,
                'client_id' => 4,
                'brand_id' => 3481,
                'rating' => '5',
                'review' => 'тест',
                'email' => 'polishchuk.i.m.84@gmail.com',
                'created_at' => '2024-01-08 11:20:56',
                'updated_at' => '2024-01-08 11:20:56',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 3,
                'client_id' => 4,
                'brand_id' => 3481,
                'rating' => '5',
                'review' => 'еще тест, сделали карусель.',
                'email' => 'polishchuk.i.m.84@gmail.com',
                'created_at' => '2024-01-08 11:21:13',
                'updated_at' => '2024-01-08 11:21:13',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 4,
                'client_id' => 4,
                'brand_id' => 3481,
                'rating' => '5',
                'review' => 'тест placeholder to value',
                'email' => 'polishchuk.i.m.84@gmail.com',
                'created_at' => '2024-01-08 11:28:14',
                'updated_at' => '2024-01-08 11:28:14',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}