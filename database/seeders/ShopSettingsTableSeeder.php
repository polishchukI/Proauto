<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShopSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shop_settings')->delete();
        
        \DB::table('shop_settings')->insert(array (
            
            array (
                'id' => 1,
                'name' => 'slogan',
                'value' => 'Мы будем рады Вашим предложениям, чтоб стать еще лучше!',
                'comment' => 'тестовый комментарий',
            ),
        ));
        
        
    }
}