<?php

use Illuminate\Database\Seeder;

class ProvidersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('providers')->delete();
        
        \DB::table('providers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Поставщик',
                'provider_code' => 'AIM',
                'hasprice' => 'Price',
                'description' => NULL,
                'paymentinfo' => NULL,
                'email' => '',
                'phone' => '',
                'client_login' => '',
                'client_password' => '',
                'client_id' => '',
                'price_type' => 1,
                'price_currency' => 'RUB',
                'price_add' => NULL,
                'price_extra' => 0,
                'day_add' => NULL,
                'min_availability' => 0,
                'max_day' => 0,
                'percentgive' => 100,
                'active' => '0',
                'get_direct_art_search' => 0,
                'script' => NULL,
                'cache' => '0',
                'query_limit' => NULL,
                'daily_limit' => NULL,
                'links_take' => '0',
                'links_side' => '0',
                'refresh_time' => 0,
                'column_separator' => ';',
                'price_encoding' => 'UTF-8',
                'remote' => 'Local',
                'file_path' => 'Общий прайс А-Я 08.09.23 + ПРИХОД.xls',
                'article_brand_side' => 'Left',
                'article_brand_separator' => NULL,
                'file_name' => NULL,
                'file_password' => NULL,
                'start_from' => NULL,
                'stop_before' => NULL,
                'delete_on_start' => 'Yes',
                'delete_quotes' => 'Yes',
                'range_discount' => NULL,
                'consider_hot' => 'Yes',
                'default_brand' => 'AURA',
                'default_available' => 1,
                'default_stock' => NULL,
                'created_at' => '2023-09-10 04:41:37',
                'updated_at' => '2023-09-10 18:29:46',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}