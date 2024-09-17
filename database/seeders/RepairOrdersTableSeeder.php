<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RepairOrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('repair_orders')->delete();
        
        \DB::table('repair_orders')->insert(array (
            
            array (
                'id' => 2,
                'user_id' => 1,
                'reference_type' => NULL,
                'reference_id' => NULL,
                'client_id' => 4,
                'warehouse_id' => 1,
                'discount' => '0',
                'service_discount' => '0',
                'barcode' => '2024 06 01 1717200000 000004',
                'currency' => 'RUB',
                'total' => '0.00',
                'discount_amount' => '0.00',
                'total_amount' => '0.00',
                'comment' => NULL,
                'finalized_at' => NULL,
                'created_at' => '2024-06-01 06:11:18',
                'updated_at' => '2024-06-29 13:00:04',
                'client_auto_id' => 2083,
            ),
            
            array (
                'id' => 3,
                'user_id' => 1,
                'reference_type' => NULL,
                'reference_id' => NULL,
                'client_id' => 2640,
                'warehouse_id' => 1,
                'discount' => NULL,
                'service_discount' => '0',
                'barcode' => '2024 06 09 1717891200 002640',
                'currency' => 'RUB',
                'total' => '0.00',
                'discount_amount' => '0.00',
                'total_amount' => '0.00',
                'comment' => NULL,
                'finalized_at' => NULL,
                'created_at' => '2024-06-09 19:03:38',
                'updated_at' => '2024-06-10 17:33:25',
                'client_auto_id' => 2110,
            ),
        ));
        
        
    }
}