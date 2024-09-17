<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductRepairOrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_repair_orders')->delete();
        
        \DB::table('product_repair_orders')->insert(array (
            
            array (
                'id' => 3,
                'repair_order_id' => 2,
                'product_id' => 353,
                'quantity' => '1.00',
                'price' => '500.00',
                'total' => '500.00',
                'discount' => '0.00',
                'currency' => 'RUB',
                'warehouse_id' => 1,
                'total_amount' => '500.00',
                'client_order_id' => NULL,
                'created_at' => '2024-06-01 18:35:24',
                'updated_at' => '2024-06-29 13:00:02',
            ),
            
            array (
                'id' => 6,
                'repair_order_id' => 3,
                'product_id' => 353,
                'quantity' => '1.00',
                'price' => '450.00',
                'total' => '450.00',
                'discount' => '0.00',
                'currency' => 'RUB',
                'warehouse_id' => 1,
                'total_amount' => '450.00',
                'client_order_id' => NULL,
                'created_at' => '2024-06-29 10:50:26',
                'updated_at' => '2024-06-29 10:50:26',
            ),
        ));
        
        
    }
}