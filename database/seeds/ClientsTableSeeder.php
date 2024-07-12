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
                'lastname' => 'Полищук',
                'firstname' => 'Иван',
                'secondname' => 'Максимович',
                'name' => 'Полищук Иван Максимович',
                'email' => 'polishchuk.i.m.84@gmail.com',
                'password' => NULL,
                'phone' => '+79497418737',
                'active' => 0,
                'newsletter' => 0,
                'avatar' => NULL,
                'birthday' => '1984-06-20',
                'discount' => '0.9',
                'servicediscount' => '0.0',
                'comment' => 'test comment',
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