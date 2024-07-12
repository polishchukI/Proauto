<?php

use Illuminate\Database\Seeder;

class ProductPriceGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_price_groups')->delete();
        
        \DB::table('product_price_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Тест',
                'comment' => NULL,
                'surcharge' => '5.0',
                'surcharge_coefficient' => '50.0',
            ),
        ));
        
        
    }
}