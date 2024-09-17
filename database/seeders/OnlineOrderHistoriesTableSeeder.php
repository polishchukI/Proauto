<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OnlineOrderHistoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('online_order_histories')->delete();
        
        \DB::table('online_order_histories')->insert(array (
            
            array (
                'id' => 1,
                'order_id' => 4,
                'client_id' => 4,
                'status_id' => 1,
                'created_at' => '2023-11-18 10:37:51',
                'updated_at' => '2023-11-18 10:37:51',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 2,
                'order_id' => 5,
                'client_id' => 4,
                'status_id' => 1,
                'created_at' => '2023-11-20 10:44:56',
                'updated_at' => '2023-11-20 10:44:56',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 3,
                'order_id' => 6,
                'client_id' => 4,
                'status_id' => 1,
                'created_at' => '2023-11-20 10:47:09',
                'updated_at' => '2023-11-20 10:47:09',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 4,
                'order_id' => 7,
                'client_id' => 4,
                'status_id' => 1,
                'created_at' => '2023-11-20 10:48:05',
                'updated_at' => '2023-11-20 10:48:05',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 5,
                'order_id' => 8,
                'client_id' => 4,
                'status_id' => 1,
                'created_at' => '2023-12-09 07:16:22',
                'updated_at' => '2023-12-09 07:16:22',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 6,
                'order_id' => 9,
                'client_id' => 4,
                'status_id' => 1,
                'created_at' => '2024-02-14 19:14:02',
                'updated_at' => '2024-02-14 19:14:02',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 7,
                'order_id' => 10,
                'client_id' => 4,
                'status_id' => 1,
                'created_at' => '2024-02-25 17:17:27',
                'updated_at' => '2024-02-25 17:17:27',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 8,
                'order_id' => 11,
                'client_id' => 4,
                'status_id' => 1,
                'created_at' => '2024-05-01 07:30:04',
                'updated_at' => '2024-05-01 07:30:04',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}