<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WarehousesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('warehouses')->delete();
        
        \DB::table('warehouses')->insert(array (
            
            array (
                'id' => 1,
                'name' => 'Основной склад',
                'description' => NULL,
                'active' => 1,
                'address' => 0,
                'created_at' => NULL,
                'updated_at' => '2024-02-01 12:39:29',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 2,
                'name' => 'Дополнительный склад',
                'description' => NULL,
                'active' => 1,
                'address' => 0,
                'created_at' => '2023-10-20 18:08:41',
                'updated_at' => '2023-10-20 18:08:41',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}