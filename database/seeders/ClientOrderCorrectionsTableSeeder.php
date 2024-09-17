<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClientOrderCorrectionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('client_order_corrections')->delete();
        
        \DB::table('client_order_corrections')->insert(array (
            
            array (
                'id' => 1,
                'user_id' => 1,
                'client_id' => 64,
                'barcode' => '2024 07 17 1721174400 000000',
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'quantity' => NULL,
                'total_amount' => NULL,
                'comment' => NULL,
                'reference_type' => NULL,
                'reference_id' => NULL,
                'finalized_at' => NULL,
                'created_at' => '2024-07-17 17:10:41',
                'updated_at' => '2024-07-17 17:10:41',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 2,
                'user_id' => 1,
                'client_id' => 2648,
                'barcode' => '2024 07 17 1721174400 000000',
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'quantity' => NULL,
                'total_amount' => NULL,
                'comment' => NULL,
                'reference_type' => 'client_order',
                'reference_id' => 111,
                'finalized_at' => NULL,
                'created_at' => '2024-07-17 19:51:45',
                'updated_at' => '2024-07-17 19:51:45',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 3,
                'user_id' => 1,
                'client_id' => 2648,
                'barcode' => '2024 07 17 1721174400 000000',
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'quantity' => NULL,
                'total_amount' => NULL,
                'comment' => NULL,
                'reference_type' => 'client_order',
                'reference_id' => 111,
                'finalized_at' => NULL,
                'created_at' => '2024-07-17 19:55:11',
                'updated_at' => '2024-07-17 19:55:11',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 4,
                'user_id' => 1,
                'client_id' => 2648,
                'barcode' => '2024 07 17 1721174400 000000',
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'quantity' => NULL,
                'total_amount' => NULL,
                'comment' => NULL,
                'reference_type' => 'client_order',
                'reference_id' => 111,
                'finalized_at' => NULL,
                'created_at' => '2024-07-17 19:55:46',
                'updated_at' => '2024-07-17 19:55:46',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}