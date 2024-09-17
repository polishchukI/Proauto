<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceRepairOrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_repair_orders')->delete();
        
        \DB::table('service_repair_orders')->insert(array (
            
            array (
                'id' => 12,
                'repair_order_id' => 3,
                'service_id' => 78,
                'employee_id' => 1,
                'price' => '400.00',
                'discount' => '0.00',
                'currency' => 'RUB',
                'warehouse_id' => 1,
                'total_amount' => '400.00',
                'client_order_id' => NULL,
                'created_at' => '2024-06-09 19:10:32',
                'updated_at' => '2024-06-10 17:33:25',
            ),
            
            array (
                'id' => 15,
                'repair_order_id' => 3,
                'service_id' => 515,
                'employee_id' => 2,
                'price' => '500.00',
                'discount' => '0.00',
                'currency' => 'RUB',
                'warehouse_id' => 1,
                'total_amount' => '500.00',
                'client_order_id' => NULL,
                'created_at' => '2024-06-10 13:12:18',
                'updated_at' => '2024-06-10 17:33:25',
            ),
            
            array (
                'id' => 16,
                'repair_order_id' => 2,
                'service_id' => 656,
                'employee_id' => 2,
                'price' => '500.00',
                'discount' => '0.00',
                'currency' => 'RUB',
                'warehouse_id' => 1,
                'total_amount' => '500.00',
                'client_order_id' => NULL,
                'created_at' => '2024-06-29 12:57:20',
                'updated_at' => '2024-06-29 13:00:05',
            ),
        ));
        
        
    }
}