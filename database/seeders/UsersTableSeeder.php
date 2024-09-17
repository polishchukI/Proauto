<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            
            array (
                'id' => 1,
                'name' => 'Иван',
                'default_currency' => 'RUB',
                'default_warehouse_id' => 1,
                'unfinalize' => 'on',
                'avatar' => NULL,
                'email' => 'polishchuk.i@outlook.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$wJBDsTWR4BdRxTOeoaUfIu8RqVmcLltUXhHxT.JWCZ1zmKRqTUqai',
                'remember_token' => NULL,
                'created_at' => '2023-09-07 19:31:37',
                'updated_at' => '2024-07-11 06:33:14',
                'deleted_at' => NULL,
                'white_color' => 'false',
                'google' => NULL,
                'twitter' => NULL,
                'facebook' => 'https://www.avtoto.ru/',
            ),
        ));
        
        
    }
}