<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('blog_categories')->delete();
        
        \DB::table('blog_categories')->insert(array (
            
            array (
                'id' => 1,
                'title' => 'Последние новости',
                'slug' => 'poslednie-novosti',
                'created_at' => '2020-06-01 19:16:17',
                'updated_at' => '2020-06-02 09:26:32',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 2,
                'title' => 'Новые потупления',
                'slug' => 'novye-potupleniya',
                'created_at' => '2020-06-02 09:26:07',
                'updated_at' => '2020-06-02 09:26:07',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 3,
                'title' => 'Сервис',
                'slug' => 'servis',
                'created_at' => '2020-07-14 19:39:30',
                'updated_at' => '2020-07-14 19:39:30',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 4,
                'title' => 'Тюнинг',
                'slug' => 'tyuning',
                'created_at' => '2020-12-18 20:40:39',
                'updated_at' => '2020-12-18 20:40:39',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 5,
                'title' => 'Теория',
                'slug' => 'teoriya',
                'created_at' => '2020-12-19 15:04:35',
                'updated_at' => '2020-12-19 15:04:35',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 6,
                'title' => 'Технологии',
                'slug' => 'tekhnologii',
                'created_at' => '2020-12-20 14:10:51',
                'updated_at' => '2020-12-20 14:10:51',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}