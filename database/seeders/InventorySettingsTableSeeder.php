<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InventorySettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('inventory_settings')->delete();
        
        \DB::table('inventory_settings')->insert(array (
            
            array (
                'id' => 1,
                'default_currency' => 'RUB',
                'terms_of_delivery' => 'Стоимость запчастей может меняться с момента проценки до заказа. Поставщик при оформлении заказа обязан дополнительно уведомить покупателя. Благодарим за понимание.
',
                'created_at' => '2023-10-18 14:51:31',
                'updated_at' => '2023-10-18 14:51:31',
                'deleted_at' => NULL,
                'organisation_name' => 'Автомагазин "ProautoShop"',
                'organisation_email' => 'proauto.shop@outlook.com',
                'organisation_phone' => '+7 949 741 87 37',
            'organisation_phone2' => '+38 (071) 741 87 37',
                'slogan' => 'Мы будем рады Вашим предложениям, чтоб стать еще лучше!',
            ),
        ));
        
        
    }
}