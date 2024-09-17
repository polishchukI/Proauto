<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProviderPriceColumnsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('provider_price_columns')->delete();
        
        \DB::table('provider_price_columns')->insert(array (
            
            array (
                'id' => 1,
                'provider_id' => 1,
                'field_number' => 1,
                'field_type' => 'article',
            ),
            
            array (
                'id' => 2,
                'provider_id' => 1,
                'field_number' => 2,
                'field_type' => 'provider_product_name',
            ),
            
            array (
                'id' => 3,
                'provider_id' => 1,
                'field_number' => 3,
                'field_type' => 'available',
            ),
            
            array (
                'id' => 4,
                'provider_id' => 1,
                'field_number' => 4,
                'field_type' => 'price',
            ),
            
            array (
                'id' => 6,
                'provider_id' => 4,
                'field_number' => 1,
                'field_type' => 'brand',
            ),
            
            array (
                'id' => 7,
                'provider_id' => 4,
                'field_number' => 2,
                'field_type' => 'article',
            ),
            
            array (
                'id' => 8,
                'provider_id' => 4,
                'field_number' => 3,
                'field_type' => 'provider_product_name',
            ),
            
            array (
                'id' => 9,
                'provider_id' => 4,
                'field_number' => 4,
                'field_type' => 'available',
            ),
            
            array (
                'id' => 10,
                'provider_id' => 4,
                'field_number' => 5,
                'field_type' => 'price',
            ),
            
            array (
                'id' => 11,
                'provider_id' => 4,
                'field_number' => 6,
                'field_type' => 'stock',
            ),
            
            array (
                'id' => 12,
                'provider_id' => 5,
                'field_number' => 2,
                'field_type' => 'article',
            ),
            
            array (
                'id' => 13,
                'provider_id' => 5,
                'field_number' => 3,
                'field_type' => 'brand',
            ),
            
            array (
                'id' => 14,
                'provider_id' => 5,
                'field_number' => 4,
                'field_type' => 'provider_product_name',
            ),
            
            array (
                'id' => 15,
                'provider_id' => 5,
                'field_number' => 5,
                'field_type' => 'price',
            ),
            
            array (
                'id' => 16,
                'provider_id' => 5,
                'field_number' => 6,
                'field_type' => 'available',
            ),
            
            array (
                'id' => 17,
                'provider_id' => 3,
                'field_number' => 5,
                'field_type' => 'article',
            ),
            
            array (
                'id' => 18,
                'provider_id' => 3,
                'field_number' => 2,
                'field_type' => 'provider_product_name',
            ),
            
            array (
                'id' => 19,
                'provider_id' => 3,
                'field_number' => 3,
                'field_type' => 'available',
            ),
            
            array (
                'id' => 20,
                'provider_id' => 3,
                'field_number' => 4,
                'field_type' => 'brand',
            ),
            
            array (
                'id' => 21,
                'provider_id' => 3,
                'field_number' => 7,
                'field_type' => 'price',
            ),
            
            array (
                'id' => 22,
                'provider_id' => 10,
                'field_number' => 1,
                'field_type' => 'brand',
            ),
            
            array (
                'id' => 23,
                'provider_id' => 10,
                'field_number' => 2,
                'field_type' => 'article',
            ),
            
            array (
                'id' => 24,
                'provider_id' => 10,
                'field_number' => 3,
                'field_type' => 'provider_product_name',
            ),
            
            array (
                'id' => 25,
                'provider_id' => 10,
                'field_number' => 4,
                'field_type' => 'available',
            ),
            
            array (
                'id' => 27,
                'provider_id' => 10,
                'field_number' => 5,
                'field_type' => 'price',
            ),
            
            array (
                'id' => 28,
                'provider_id' => 24,
                'field_number' => 1,
                'field_type' => 'brand',
            ),
            
            array (
                'id' => 29,
                'provider_id' => 24,
                'field_number' => 2,
                'field_type' => 'article',
            ),
            
            array (
                'id' => 30,
                'provider_id' => 24,
                'field_number' => 3,
                'field_type' => 'provider_product_name',
            ),
            
            array (
                'id' => 31,
                'provider_id' => 24,
                'field_number' => 4,
                'field_type' => 'available',
            ),
            
            array (
                'id' => 32,
                'provider_id' => 24,
                'field_number' => 5,
                'field_type' => 'price',
            ),
        ));
        
        
    }
}