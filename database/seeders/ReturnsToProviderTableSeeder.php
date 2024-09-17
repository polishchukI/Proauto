<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReturnsToProviderTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('returns_to_provider')->delete();
        
        \DB::table('returns_to_provider')->insert(array (
            
            array (
                'id' => 4,
                'currency' => 'RUB',
                'total_amount' => '8775.00',
                'warehouse_id' => 1,
                'provider_id' => 2,
                'barcode' => '2024 02 24 1708732800 000002',
                'user_id' => 1,
                'reference_type' => 'receipt',
                'reference_id' => 105,
                'finalized_at' => '2024-02-24 07:17:40',
                'created_at' => '2024-02-24 07:01:06',
                'updated_at' => '2024-02-24 07:17:40',
                'comment' => NULL,
            ),
        ));
        
        
    }
}