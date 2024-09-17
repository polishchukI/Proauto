<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductReturnsToProviderTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_returns_to_provider')->delete();
        
        \DB::table('product_returns_to_provider')->insert(array (
            
            array (
                'id' => 5,
                'return_to_provider_id' => 4,
                'product_id' => 402,
                'warehouse_id' => 1,
                'currency' => 'RUB',
                'quantity' => '1.00',
                'price' => '8775.00',
                'base_price' => '10160.00',
                'total_amount' => '8775.00',
                'base_total_amount' => '10160.00',
                'created_at' => '2024-02-24 07:01:06',
                'updated_at' => '2024-02-24 07:03:02',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}