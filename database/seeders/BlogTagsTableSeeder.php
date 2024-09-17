<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogTagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('blog_tags')->delete();
        
        \DB::table('blog_tags')->insert(array (
            
            array (
                'id' => 1,
                'name' => 'Масло',
                'slug' => 'maslo',
                'created_at' => '2020-05-26 17:21:29',
                'updated_at' => '2020-12-18 14:36:00',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 2,
                'name' => 'АКПП',
                'slug' => 'akpp',
                'created_at' => '2020-05-26 17:21:36',
                'updated_at' => '2020-12-18 14:35:54',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 3,
                'name' => 'Коробка автомат',
                'slug' => 'korobka-avtomat',
                'created_at' => '2020-05-26 17:21:45',
                'updated_at' => '2020-12-18 14:35:49',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 4,
                'name' => 'Тормозная жидкость',
                'slug' => 'tormoznaya-zhidkost',
                'created_at' => '2020-05-26 18:32:50',
                'updated_at' => '2020-12-18 14:35:37',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 5,
                'name' => 'Тормоза',
                'slug' => 'tormoza',
                'created_at' => '2020-05-26 18:32:58',
                'updated_at' => '2020-12-18 14:35:32',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 6,
                'name' => 'Сервис',
                'slug' => 'servis',
                'created_at' => '2020-05-26 18:33:04',
                'updated_at' => '2020-12-18 14:35:26',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 7,
                'name' => 'Шины',
                'slug' => 'shiny',
                'created_at' => '2020-09-28 17:56:30',
                'updated_at' => '2020-12-18 14:35:21',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 8,
                'name' => 'Колеса',
                'slug' => 'kolesa',
                'created_at' => '2020-09-28 17:56:56',
                'updated_at' => '2020-12-18 14:35:08',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 9,
                'name' => 'Тюнинг',
                'slug' => 'tyuning',
                'created_at' => '2020-12-18 19:52:07',
                'updated_at' => '2020-12-18 19:52:07',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 10,
                'name' => 'Автомобили',
                'slug' => 'avtomobili',
                'created_at' => '2020-12-18 19:52:27',
                'updated_at' => '2024-01-09 10:07:55',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 11,
                'name' => 'Технологии',
                'slug' => 'texnologii',
                'created_at' => '2020-12-20 13:41:56',
                'updated_at' => '2024-01-09 07:54:49',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}