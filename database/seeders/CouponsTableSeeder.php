<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('coupons')->delete();
        
        \DB::table('coupons')->insert(array (
            
            array (
                'id' => 1,
                'code' => '123456AS',
                'type' => 'fixed',
                'value' => 5,
                'created_at' => '2023-11-17 14:26:05',
                'updated_at' => '2023-11-17 14:59:07',
            ),
        ));
        
        
    }
}