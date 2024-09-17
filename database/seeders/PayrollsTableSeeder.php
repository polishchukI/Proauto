<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PayrollsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('payrolls')->delete();
        
        \DB::table('payrolls')->insert(array (
            
            array (
                'id' => 2,
                'currency' => 'RUB',
                'comment' => NULL,
                'total_amount' => '15000.00',
                'user_id' => 1,
                'period_start' => '2023-10-01 00:00:00',
                'period_end' => '2023-10-31 23:59:59',
                'finalized_at' => '2023-11-16 16:24:18',
                'created_at' => '2023-11-16 04:55:10',
                'updated_at' => '2023-11-16 16:24:18',
            ),
            
            array (
                'id' => 3,
                'currency' => 'RUB',
                'comment' => NULL,
                'total_amount' => '15000.00',
                'user_id' => 1,
                'period_start' => '2023-11-01 00:00:00',
                'period_end' => '2023-11-30 23:59:59',
                'finalized_at' => '2023-11-30 10:01:35',
                'created_at' => '2023-11-30 10:01:18',
                'updated_at' => '2023-11-30 10:01:35',
            ),
            
            array (
                'id' => 4,
                'currency' => 'RUB',
                'comment' => NULL,
                'total_amount' => '15000.00',
                'user_id' => 1,
                'period_start' => '2024-02-01 00:00:00',
                'period_end' => '2024-02-29 23:59:59',
                'finalized_at' => '2024-02-29 05:22:26',
                'created_at' => '2024-02-29 05:21:54',
                'updated_at' => '2024-02-29 05:22:26',
            ),
            
            array (
                'id' => 5,
                'currency' => 'RUB',
                'comment' => NULL,
                'total_amount' => '35000.00',
                'user_id' => 1,
                'period_start' => '2024-04-01 00:00:00',
                'period_end' => '2024-04-30 23:59:59',
                'finalized_at' => '2024-05-01 09:49:14',
                'created_at' => '2024-05-01 09:48:52',
                'updated_at' => '2024-05-01 09:49:14',
            ),
            
            array (
                'id' => 6,
                'currency' => 'RUB',
                'comment' => NULL,
                'total_amount' => '40000.00',
                'user_id' => 1,
                'period_start' => '2024-05-01 00:00:00',
                'period_end' => '2024-05-31 23:59:59',
                'finalized_at' => '2024-05-31 17:24:28',
                'created_at' => '2024-05-31 17:24:01',
                'updated_at' => '2024-05-31 17:24:28',
            ),
            
            array (
                'id' => 7,
                'currency' => 'RUB',
                'comment' => NULL,
                'total_amount' => '35000.00',
                'user_id' => 1,
                'period_start' => '2024-06-01 00:00:00',
                'period_end' => '2024-06-30 23:59:59',
                'finalized_at' => '2024-06-30 16:39:33',
                'created_at' => '2024-06-30 16:18:01',
                'updated_at' => '2024-06-30 16:39:33',
            ),
        ));
        
        
    }
}