<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SalaryPaymentEmployeesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('salary_payment_employees')->delete();
        
        \DB::table('salary_payment_employees')->insert(array (
            
            array (
                'id' => 2,
                'salary_payment_id' => 10,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 15000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 3,
                'salary_payment_id' => 11,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 15000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 4,
                'salary_payment_id' => 12,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 15000.0,
                'created_at' => '2023-11-30 10:01:59',
                'updated_at' => '2023-11-30 10:01:59',
            ),
            
            array (
                'id' => 5,
                'salary_payment_id' => 14,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 15000.0,
                'created_at' => '2024-02-29 05:32:08',
                'updated_at' => '2024-02-29 05:32:08',
            ),
            
            array (
                'id' => 6,
                'salary_payment_id' => 16,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 35000.0,
                'created_at' => '2024-05-01 09:49:47',
                'updated_at' => '2024-05-01 09:49:47',
            ),
            
            array (
                'id' => 7,
                'salary_payment_id' => 18,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 40000.0,
                'created_at' => '2024-05-31 17:24:58',
                'updated_at' => '2024-05-31 17:24:58',
            ),
            
            array (
                'id' => 8,
                'salary_payment_id' => 19,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 35000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 9,
                'salary_payment_id' => 20,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 35000.0,
                'created_at' => '2024-06-30 18:08:59',
                'updated_at' => '2024-06-30 18:08:59',
            ),
        ));
        
        
    }
}