<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('employees')->delete();
        
        \DB::table('employees')->insert(array (
            
            array (
                'id' => 1,
                'lastname' => 'Полищук',
                'firstname' => 'Иван',
                'secondname' => 'Максимович',
                'fullname' => 'Полищук Иван Максимович',
                'isuser' => 'True',
                'user_id' => 1,
                'fired_at' => NULL,
                'created_at' => '2023-11-16 06:07:00',
                'updated_at' => '2024-06-01 18:07:39',
                'isworker' => 'False',
            ),
            
            array (
                'id' => 2,
                'lastname' => 'Беляков',
                'firstname' => 'Максим',
                'secondname' => 'Олегович',
                'fullname' => 'Беляков Максим Олегович',
                'isuser' => 'False',
                'user_id' => NULL,
                'fired_at' => NULL,
                'created_at' => '2024-06-02 20:28:26',
                'updated_at' => '2024-06-03 07:18:37',
                'isworker' => 'True',
            ),
            
            array (
                'id' => 3,
                'lastname' => 'Беседа',
                'firstname' => 'Виталий',
                'secondname' => 'Михайлович',
                'fullname' => 'Беседа Виталий Михайлович',
                'isuser' => 'False',
                'user_id' => NULL,
                'fired_at' => NULL,
                'created_at' => '2024-06-03 06:57:42',
                'updated_at' => '2024-06-03 06:57:42',
                'isworker' => 'True',
            ),
        ));
        
        
    }
}