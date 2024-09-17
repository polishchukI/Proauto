<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PricetypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pricetypes')->delete();
        
        \DB::table('pricetypes')->insert(array (
            
            array (
                'id' => 1,
                'price_type' => 'Закупочная',
                'price_discount' => 0.0,
                'price_view' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-11-17 17:18:18',
            ),
            
            array (
                'id' => 2,
                'price_type' => 'Розничная',
                'price_discount' => 0.0,
                'price_view' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-11-17 17:18:42',
            ),
        ));
        
        
    }
}