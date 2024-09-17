<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReturnsFromTheClientTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('returns_from_the_client')->delete();
        
        \DB::table('returns_from_the_client')->insert(array (
            
            array (
                'id' => 13,
                'currency' => 'RUB',
                'total_amount' => '1100.00',
                'warehouse_id' => 1,
                'client_id' => 2631,
                'barcode' => '2023 12 26 1703548800 002631',
                'user_id' => 1,
                'reference_type' => 'sale',
                'reference_id' => 84,
                'finalized_at' => '2023-12-26 16:15:01',
                'created_at' => '2023-12-26 15:44:49',
                'updated_at' => '2023-12-26 16:15:01',
                'comment' => NULL,
            ),
            
            array (
                'id' => 14,
                'currency' => 'RUB',
                'total_amount' => '2200.00',
                'warehouse_id' => 1,
                'client_id' => 2442,
                'barcode' => '2023 12 26 1703548800 002442',
                'user_id' => 1,
                'reference_type' => 'sale',
                'reference_id' => 64,
                'finalized_at' => '2023-12-26 16:59:50',
                'created_at' => '2023-12-26 16:59:04',
                'updated_at' => '2023-12-26 16:59:50',
                'comment' => NULL,
            ),
            
            array (
                'id' => 15,
                'currency' => 'RUB',
                'total_amount' => NULL,
                'warehouse_id' => 1,
                'client_id' => 2648,
                'barcode' => '2024 07 08 1720396800 002648',
                'user_id' => 1,
                'reference_type' => 'sale',
                'reference_id' => 302,
                'finalized_at' => NULL,
                'created_at' => '2024-07-08 04:14:09',
                'updated_at' => '2024-07-08 04:14:09',
                'comment' => NULL,
            ),
        ));
        
        
    }
}