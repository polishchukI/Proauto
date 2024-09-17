<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SalaryManagementTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('salary_management')->delete();
        
        \DB::table('salary_management')->insert(array (
            
            array (
                'id' => 1,
                'salary_payment_id' => 0,
                'payroll_id' => 2,
                'employee_id' => 1,
                'currency' => 'RUB',
                'total' => 15000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 6,
                'salary_payment_id' => 10,
                'payroll_id' => 0,
                'employee_id' => 1,
                'currency' => 'RUB',
                'total' => -15000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 7,
                'salary_payment_id' => 0,
                'payroll_id' => 3,
                'employee_id' => 1,
                'currency' => 'RUB',
                'total' => 15000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 8,
                'salary_payment_id' => 12,
                'payroll_id' => 0,
                'employee_id' => 1,
                'currency' => 'RUB',
                'total' => -15000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 9,
                'salary_payment_id' => 0,
                'payroll_id' => 4,
                'employee_id' => 1,
                'currency' => 'RUB',
                'total' => 15000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 10,
                'salary_payment_id' => 14,
                'payroll_id' => 0,
                'employee_id' => 1,
                'currency' => 'RUB',
                'total' => -15000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 11,
                'salary_payment_id' => 0,
                'payroll_id' => 5,
                'employee_id' => 1,
                'currency' => 'RUB',
                'total' => 35000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 12,
                'salary_payment_id' => 16,
                'payroll_id' => 0,
                'employee_id' => 1,
                'currency' => 'RUB',
                'total' => -35000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 13,
                'salary_payment_id' => 0,
                'payroll_id' => 6,
                'employee_id' => 1,
                'currency' => 'RUB',
                'total' => 40000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 14,
                'salary_payment_id' => 18,
                'payroll_id' => 0,
                'employee_id' => 1,
                'currency' => 'RUB',
                'total' => -40000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 15,
                'salary_payment_id' => 0,
                'payroll_id' => 7,
                'employee_id' => 1,
                'currency' => 'RUB',
                'total' => 35000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 16,
                'salary_payment_id' => 20,
                'payroll_id' => 0,
                'employee_id' => 1,
                'currency' => 'RUB',
                'total' => -35000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}