<?php

use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_categories')->delete();
        
        \DB::table('product_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'general',
                'created_at' => '2023-09-07 19:54:18',
                'updated_at' => '2023-09-07 19:54:18',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'bulbs',
                'created_at' => '2023-09-08 03:57:37',
                'updated_at' => '2023-09-08 03:57:37',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'batteries',
                'created_at' => '2023-09-08 03:57:37',
                'updated_at' => '2023-09-08 03:57:37',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'tyres',
                'created_at' => '2023-09-08 03:57:37',
                'updated_at' => '2023-09-08 03:57:37',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'oils',
                'created_at' => '2023-09-08 03:57:37',
                'updated_at' => '2023-09-08 03:57:37',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'rims',
                'created_at' => '2023-09-08 03:57:37',
                'updated_at' => '2023-09-08 03:57:37',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'tools',
                'created_at' => '2023-09-08 03:57:37',
                'updated_at' => '2023-09-08 03:57:37',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'alternator',
                'created_at' => '2024-03-08 03:57:37',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'starter',
                'created_at' => '2024-03-08 03:57:37',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'тестовая',
                'created_at' => '2024-03-13 19:28:37',
                'updated_at' => '2024-03-13 19:52:59',
                'deleted_at' => '2024-03-13 19:52:59',
            ),
        ));
        
        
    }
}