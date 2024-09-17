<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentMethodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('payment_methods')->delete();
        
        \DB::table('payment_methods')->insert(array (
            
            array (
                'id' => 1,
                'name' => 'Наличный расчет',
                'description' => 'Оплата наличными, при отгрузке',
                'status' => 1,
                'created_at' => '2023-09-09 04:00:44',
                'updated_at' => '2023-09-09 04:00:44',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 2,
                'name' => 'Перевод на карту',
                'description' => NULL,
                'status' => NULL,
                'created_at' => '2023-12-15 04:32:04',
                'updated_at' => '2023-12-15 04:32:04',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}