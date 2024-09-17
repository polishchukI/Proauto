<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SalaryPaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('salary_payments')->delete();
        
        \DB::table('salary_payments')->insert(array (
            
            array (
                'id' => 10,
                'payroll_id' => 2,
                'user_id' => 1,
                'currency' => 'RUB',
                'comment' => NULL,
                'total_amount' => '15000.00',
                'finalized_at' => '2023-11-16 18:51:55',
                'created_at' => '2023-11-16 18:12:31',
                'updated_at' => '2023-11-16 18:51:55',
            ),
            
            array (
                'id' => 12,
                'payroll_id' => 3,
                'user_id' => 1,
                'currency' => 'RUB',
                'comment' => NULL,
                'total_amount' => '15000.00',
                'finalized_at' => '2023-11-30 10:02:08',
                'created_at' => '2023-11-30 10:01:48',
                'updated_at' => '2023-11-30 10:02:08',
            ),
            
            array (
                'id' => 14,
                'payroll_id' => NULL,
                'user_id' => 1,
                'currency' => 'RUB',
                'comment' => NULL,
                'total_amount' => '15000.00',
                'finalized_at' => '2024-02-29 05:32:15',
                'created_at' => '2024-02-29 05:31:56',
                'updated_at' => '2024-02-29 05:32:15',
            ),
            
            array (
                'id' => 16,
                'payroll_id' => NULL,
                'user_id' => 1,
                'currency' => 'RUB',
                'comment' => NULL,
                'total_amount' => '35000.00',
                'finalized_at' => '2024-05-01 09:49:54',
                'created_at' => '2024-05-01 09:49:35',
                'updated_at' => '2024-05-01 09:49:54',
            ),
            
            array (
                'id' => 18,
                'payroll_id' => NULL,
                'user_id' => 1,
                'currency' => 'RUB',
                'comment' => NULL,
                'total_amount' => '40000.00',
                'finalized_at' => '2024-05-31 17:25:06',
                'created_at' => '2024-05-31 17:24:44',
                'updated_at' => '2024-05-31 17:25:06',
            ),
            
            array (
                'id' => 20,
                'payroll_id' => 7,
                'user_id' => 1,
                'currency' => 'RUB',
                'comment' => NULL,
                'total_amount' => '35000.00',
                'finalized_at' => '2024-06-30 18:09:06',
                'created_at' => '2024-06-30 16:39:47',
                'updated_at' => '2024-06-30 18:09:06',
            ),
        ));
        
        
    }
}