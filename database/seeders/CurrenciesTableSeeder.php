<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('currencies')->delete();
        
        \DB::table('currencies')->insert(array (
            
            array (
                'id' => 1,
                'name' => 'Российский рубль',
                'code' => 'RUB',
                'symbol' => '₽',
                'format' => '1 0,00 ₽',
                'exchange_rate' => '98.00',
                'active' => 1,
                'created_at' => '2023-07-07 09:58:15',
                'updated_at' => '2023-12-23 17:42:51',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 2,
                'name' => 'Euro',
                'code' => 'EUR',
                'symbol' => '€',
                'format' => '1.0,00 €',
                'exchange_rate' => '1.11',
                'active' => 1,
                'created_at' => '2023-07-07 09:58:15',
                'updated_at' => '2023-11-17 18:35:34',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 3,
                'name' => 'US Dollar',
                'code' => 'USD',
                'symbol' => '$',
                'format' => '$1,0.00',
                'exchange_rate' => '1.00',
                'active' => 1,
                'created_at' => '2023-07-07 09:58:15',
                'updated_at' => '2023-11-17 18:35:34',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 4,
                'name' => 'Україньська гривня',
                'code' => 'UAH',
                'symbol' => '₴',
                'format' => '1 0,00₴',
                'exchange_rate' => '35.00',
                'active' => 0,
                'created_at' => '2023-07-07 09:58:15',
                'updated_at' => '2023-11-17 18:35:34',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}