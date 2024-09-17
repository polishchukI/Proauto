<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OnlineOrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('online_orders')->delete();
        
        \DB::table('online_orders')->insert(array (
            
            array (
                'id' => 9,
                'invoice' => '2024-02-14-4',
                'order_status_id' => 1,
                'client_id' => 4,
                'firstname' => 'Иван',
                'lastname' => 'Полищук',
                'email' => 'polishchuk.i.m.84@gmail.com',
                'phone' => NULL,
                'currency' => 'RUB',
                'delivery_id' => 1,
                'billing_address_id' => 1,
                'shipping_address_id' => 1,
                'comment' => NULL,
                'track_status' => NULL,
                'sum' => NULL,
                'count' => '4',
                'shipping' => '25.90',
                'balance' => NULL,
                'subtotal' => '2590.00',
                'tax' => '0.00',
                'total' => '2745.40',
                'payment_status' => NULL,
                'payment_methods' => NULL,
                'payment_details' => NULL,
                'client_product_discount' => NULL,
                'created_at' => '2024-02-14 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'finalized_at' => NULL,
            ),
            
            array (
                'id' => 10,
                'invoice' => '2024-02-25-4',
                'order_status_id' => 1,
                'client_id' => 4,
                'firstname' => 'Иван',
                'lastname' => 'Полищук',
                'email' => 'polishchuk.i.m.84@gmail.com',
                'phone' => NULL,
                'currency' => 'RUB',
                'delivery_id' => 1,
                'billing_address_id' => 1,
                'shipping_address_id' => 1,
                'comment' => NULL,
                'track_status' => NULL,
                'sum' => NULL,
                'count' => '2',
                'shipping' => '29.10',
                'balance' => NULL,
                'subtotal' => '2910.00',
                'tax' => '0.00',
                'total' => '3084.60',
                'payment_status' => NULL,
                'payment_methods' => NULL,
                'payment_details' => NULL,
                'client_product_discount' => NULL,
                'created_at' => '2024-02-25 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'finalized_at' => NULL,
            ),
            
            array (
                'id' => 11,
                'invoice' => '2024-05-01-4',
                'order_status_id' => 1,
                'client_id' => 4,
                'firstname' => 'Иван',
                'lastname' => 'Полищук',
                'email' => 'polishchuk.i.m.84@gmail.com',
                'phone' => NULL,
                'currency' => 'RUB',
                'delivery_id' => 1,
                'billing_address_id' => 1,
                'shipping_address_id' => 1,
                'comment' => NULL,
                'track_status' => NULL,
                'sum' => NULL,
                'count' => '3',
                'shipping' => '49.83',
                'balance' => NULL,
                'subtotal' => '4982.53',
                'tax' => '0.00',
                'total' => '5281.48',
                'payment_status' => NULL,
                'payment_methods' => NULL,
                'payment_details' => NULL,
                'client_product_discount' => NULL,
                'created_at' => '2024-05-01 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'finalized_at' => NULL,
            ),
        ));
        
        
    }
}