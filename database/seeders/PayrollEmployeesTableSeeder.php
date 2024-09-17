<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PayrollEmployeesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('payroll_employees')->delete();
        
        \DB::table('payroll_employees')->insert(array (
            
            array (
                'id' => 9,
                'payroll_id' => 2,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 15000.0,
                'created_at' => '2023-11-16 15:32:59',
                'updated_at' => '2023-11-16 15:32:59',
            ),
            
            array (
                'id' => 10,
                'payroll_id' => 3,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 15000.0,
                'created_at' => '2023-11-30 10:01:29',
                'updated_at' => '2023-11-30 10:01:29',
            ),
            
            array (
                'id' => 11,
                'payroll_id' => 4,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 15000.0,
                'created_at' => '2024-02-29 05:22:17',
                'updated_at' => '2024-02-29 05:22:17',
            ),
            
            array (
                'id' => 12,
                'payroll_id' => 5,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 35000.0,
                'created_at' => '2024-05-01 09:49:07',
                'updated_at' => '2024-05-01 09:49:07',
            ),
            
            array (
                'id' => 13,
                'payroll_id' => 6,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 40000.0,
                'created_at' => '2024-05-31 17:24:16',
                'updated_at' => '2024-05-31 17:24:16',
            ),
            
            array (
                'id' => 14,
                'payroll_id' => 7,
                'employee_id' => 1,
                'currency' => 'RUB',
                'salary' => 35000.0,
                'created_at' => '2024-06-30 16:39:27',
                'updated_at' => '2024-06-30 16:39:27',
            ),
        ));
        
        
    }
}