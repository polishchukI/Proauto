<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductReturnsFromTheClientTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_returns_from_the_client')->delete();
        
        \DB::table('product_returns_from_the_client')->insert(array (
            
            array (
                'id' => 10,
                'return_from_the_client_id' => 13,
                'product_id' => 358,
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'quantity' => '1.00',
                'price' => '1100.00',
                'base_price' => '880.00',
                'total_amount' => '1100.00',
                'base_total_amount' => '880.00',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 12,
                'return_from_the_client_id' => 14,
                'product_id' => 233,
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'quantity' => '1.00',
                'price' => '2200.00',
                'base_price' => '1635.00',
                'total_amount' => '2200.00',
                'base_total_amount' => '1635.00',
                'created_at' => '2023-12-26 16:59:04',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 13,
                'return_from_the_client_id' => 15,
                'product_id' => 1658,
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'quantity' => '1.00',
                'price' => '12300.00',
                'base_price' => '9811.00',
                'total_amount' => '12300.00',
                'base_total_amount' => '9811.00',
                'created_at' => '2024-07-08 04:14:09',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 17,
                'return_from_the_client_id' => 15,
                'product_id' => 1694,
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'quantity' => '1.00',
                'price' => '4300.00',
                'base_price' => '3235.00',
                'total_amount' => '4300.00',
                'base_total_amount' => '3235.00',
                'created_at' => '2024-07-08 04:48:50',
                'updated_at' => '2024-07-08 04:48:50',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}