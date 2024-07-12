<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('clients')->delete();
        
        \DB::table('clients')->insert(array (
            0 => 
            array (
                'id' => 4,
                'lastname' => 'Клиент',
                'firstname' => 'для',
                'secondname' => 'служебных операций',
                'name' => 'Клиент для служебных операций',
                'email' => 'mail@gmail.com',
                'password' => bcrypt('11111111'),
                'phone' => '',
                'active' => 1,
                'newsletter' => 0,
                'avatar' => NULL,
                'birthday' => '2020-01-01',
                'product_discount' => '0.0',
                'service_discount' => '0.0',
                'comment' => '',
                'last_purchase' => NULL,
                'total_purchases' => 0,
                'total_paid' => '0.00',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}