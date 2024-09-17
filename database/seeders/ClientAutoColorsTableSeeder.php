<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClientAutoColorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('client_auto_colors')->delete();
        
        \DB::table('client_auto_colors')->insert(array (
            
            array (
                'id' => 1,
                'name' => 'Черный',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 2,
                'name' => 'Белый',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 3,
                'name' => 'Бежевый',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 5,
                'name' => 'Желтый',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 6,
                'name' => 'Фиолетовый',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 7,
                'name' => 'Зеленый',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 8,
                'name' => 'Коричневый',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 9,
                'name' => 'Красный',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 10,
                'name' => 'Оранжевый',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 11,
                'name' => 'Серый',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 12,
                'name' => 'Синий',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}