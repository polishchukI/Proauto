<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicesReceiptItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('services_receipt_items')->delete();
        
        \DB::table('services_receipt_items')->insert(array (
            
            array (
                'id' => 8,
                'services_receipt_id' => 1,
                'service_id' => 1,
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'price' => '1.20',
                'quantity' => '1000.00',
                'total_amount' => '1200.00',
                'created_at' => '2023-12-02 12:44:14',
                'updated_at' => '2023-12-02 12:44:14',
            ),
            
            array (
                'id' => 9,
                'services_receipt_id' => 1,
                'service_id' => 2,
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'price' => '25.00',
                'quantity' => '2.00',
                'total_amount' => '50.00',
                'created_at' => '2023-12-02 12:48:36',
                'updated_at' => '2023-12-02 12:48:36',
            ),
        ));
        
        
    }
}