<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductOrderManagementTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_order_management')->delete();
        
        
        
    }
}