<?php

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
            0 => 
            array (
                'id' => 1,
                'name' => 'Наличный расчет',
                'description' => 'Оплата наличными, при отгрузке',
                'created_at' => '2023-09-09 04:00:44',
                'updated_at' => '2023-09-09 04:00:44',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}