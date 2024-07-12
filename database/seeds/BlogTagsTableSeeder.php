<?php

use Illuminate\Database\Seeder;

class BlogTagsTableSeeder extends Seeder
{
    public function run()
    {
		\DB::table('blog_tags')->delete();

        \DB::table('blog_tags')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Масло',
                'slug' => 'maslo',
                'created_at' => '2020-05-26 18:21:29',
                'updated_at' => '2020-12-18 14:36:00',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'АКПП',
                'slug' => 'akpp',
                'created_at' => '2020-05-26 18:21:36',
                'updated_at' => '2020-12-18 14:35:54',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Коробка автомат',
                'slug' => 'korobka-avtomat',
                'created_at' => '2020-05-26 18:21:45',
                'updated_at' => '2020-12-18 14:35:49',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Тормозная жидкость',
                'slug' => 'tormoznaya-zhidkost',
                'created_at' => '2020-05-26 19:32:50',
                'updated_at' => '2020-12-18 14:35:37',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Тормоза',
                'slug' => 'tormoza',
                'created_at' => '2020-05-26 19:32:58',
                'updated_at' => '2020-12-18 14:35:32',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Сервис',
                'slug' => 'servis',
                'created_at' => '2020-05-26 19:33:04',
                'updated_at' => '2020-12-18 14:35:26',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Шины',
                'slug' => 'shiny',
                'created_at' => '2020-09-28 18:56:30',
                'updated_at' => '2020-12-18 14:35:21',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Колеса',
                'slug' => 'kolesa',
                'created_at' => '2020-09-28 18:56:56',
                'updated_at' => '2020-12-18 14:35:08',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Тюнинг',
                'slug' => 'tyuning',
                'created_at' => '2020-12-18 19:52:07',
                'updated_at' => '2020-12-18 19:52:07',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Автомобили',
                'slug' => 'avtomobili',
                'created_at' => '2020-12-18 19:52:27',
                'updated_at' => '2020-12-18 19:52:27',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Технологии',
                'slug' => 'tekhnologii',
                'created_at' => '2020-12-20 13:41:56',
                'updated_at' => '2020-12-20 13:41:56',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}