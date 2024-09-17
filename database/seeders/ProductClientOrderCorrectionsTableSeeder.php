<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductClientOrderCorrectionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_client_order_corrections')->delete();
        
        \DB::table('product_client_order_corrections')->insert(array (
            
            array (
                'id' => 1,
                'client_order_correction_id' => 3,
                'product_id' => 859,
                'quantity' => '1.00',
                'price' => '19000.00',
                'total_amount' => '19000.00',
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'client_order_id' => 111,
            ),
            
            array (
                'id' => 2,
                'client_order_correction_id' => 3,
                'product_id' => 860,
                'quantity' => '1.00',
                'price' => '9600.00',
                'total_amount' => '9600.00',
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'client_order_id' => 111,
            ),
            
            array (
                'id' => 3,
                'client_order_correction_id' => 3,
                'product_id' => 861,
                'quantity' => '1.00',
                'price' => '12000.00',
                'total_amount' => '12000.00',
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'client_order_id' => 111,
            ),
            
            array (
                'id' => 4,
                'client_order_correction_id' => 3,
                'product_id' => 862,
                'quantity' => '1.00',
                'price' => '10500.00',
                'total_amount' => '10500.00',
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'client_order_id' => 111,
            ),
        ));
        
        
    }
}