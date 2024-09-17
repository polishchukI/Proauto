<?php

namespace Database\Seeders;

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
            
            array (
                'id' => 1,
                'name' => 'Общая',
                'created_at' => '2023-09-07 19:54:18',
                'updated_at' => '2023-09-07 19:54:18',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 2,
                'name' => 'Автолампа',
                'created_at' => '2023-09-08 03:57:37',
                'updated_at' => '2023-09-08 03:57:37',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 3,
                'name' => 'АКБ',
                'created_at' => '2023-09-08 03:57:37',
                'updated_at' => '2023-09-08 03:57:37',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 4,
                'name' => 'Шины',
                'created_at' => '2023-09-08 03:57:37',
                'updated_at' => '2023-09-08 03:57:37',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 5,
                'name' => 'Масла',
                'created_at' => '2023-09-08 03:57:37',
                'updated_at' => '2023-09-08 03:57:37',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 6,
                'name' => 'Диски',
                'created_at' => '2023-09-08 03:57:37',
                'updated_at' => '2023-09-08 03:57:37',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 7,
                'name' => 'Инструменты',
                'created_at' => '2023-09-08 03:57:37',
                'updated_at' => '2023-09-08 03:57:37',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 8,
                'name' => 'Генераторы',
                'created_at' => '2024-03-08 03:57:37',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 9,
                'name' => 'Стартеры',
                'created_at' => '2024-03-08 03:57:37',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}