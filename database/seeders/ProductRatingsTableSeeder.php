<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductRatingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_ratings')->delete();
        
        \DB::table('product_ratings')->insert(array (
            
            array (
                'id' => 1,
                'client_id' => 4,
                'akey' => '7700274177',
                'bkey' => 'RENAULT',
                'pkey' => 'RENAULT7700274177',
                'name' => 'Фильтр',
                'rating' => '5',
                'review' => 'Оригинальное качество. Все что можно сказать.',
                'email' => 'polishchuk.i.m.84@gmail.com',
                'created_at' => '2024-01-01 06:29:00',
                'updated_at' => '2024-01-01 06:29:00',
                'deleted_at' => NULL,
                'article' => '7700274177',
                'brand' => 'RENAULT',
                'price' => 0.0,
                'currency' => '',
            ),
            
            array (
                'id' => 2,
                'client_id' => 4,
                'akey' => 'TFJ1025E',
                'bkey' => 'TATSUMI',
                'pkey' => 'TATSUMITFJ1025E',
                'name' => 'Щетка стеклоочистителя задняя',
                'rating' => '3',
                'review' => 'Щетка стеклоочистителя задняя',
                'email' => 'polishchuk.i.m.84@gmail.com',
                'created_at' => '2024-01-01 06:45:04',
                'updated_at' => '2024-01-01 06:45:04',
                'deleted_at' => NULL,
                'article' => 'TFJ1025E',
                'brand' => 'TATSUMI',
                'price' => 0.0,
                'currency' => '',
            ),
            
            array (
                'id' => 3,
                'client_id' => 4,
                'akey' => 'TFJ1025E',
                'bkey' => 'TATSUMI',
                'pkey' => 'TATSUMITFJ1025E',
                'name' => 'Щетка стеклоочистителя задняя',
                'rating' => '5',
                'review' => 'Доброе утро страна',
                'email' => 'polishchuk.i.m.84@gmail.com',
                'created_at' => '2024-01-01 06:50:19',
                'updated_at' => '2024-01-01 06:50:19',
                'deleted_at' => NULL,
                'article' => 'TFJ1025E',
                'brand' => 'TATSUMI',
                'price' => 0.0,
                'currency' => '',
            ),
            
            array (
                'id' => 4,
                'client_id' => 4,
                'akey' => 'TFJ1025E',
                'bkey' => 'TATSUMI',
                'pkey' => 'TATSUMITFJ1025E',
                'name' => 'Щетка стеклоочистителя задняя',
                'rating' => '5',
            'review' => 'еще один отзыв)))',
            'email' => 'polishchuk.i.m.84@gmail.com',
            'created_at' => '2024-01-01 06:52:15',
            'updated_at' => '2024-01-01 06:52:15',
            'deleted_at' => NULL,
            'article' => 'TFJ1025E',
            'brand' => 'TATSUMI',
            'price' => 0.0,
            'currency' => '',
        ),
        
        array (
            'id' => 5,
            'client_id' => 4,
            'akey' => '68191',
            'bkey' => 'NARVA',
            'pkey' => 'NARVA68191',
            'name' => 'лампа NARVA H21W',
            'rating' => '5',
            'review' => 'Хорошее качество, за приемлемые деньги.',
            'email' => 'polishchuk.i.m.84@gmail.com',
            'created_at' => '2024-01-08 07:42:56',
            'updated_at' => '2024-01-08 07:42:56',
            'deleted_at' => NULL,
            'article' => '68191',
            'brand' => 'NARVA',
            'price' => 0.0,
            'currency' => '',
        ),
        
        array (
            'id' => 6,
            'client_id' => 4,
            'akey' => '1987946059',
            'bkey' => 'BOSCH',
            'pkey' => 'BOSCH1987946059',
            'name' => 'ремень приводной поликлиновой',
            'rating' => '5',
            'review' => 'Хороший Ремень. Недорого.',
            'email' => 'polishchuk.i.m.84@gmail.com',
            'created_at' => '2024-01-08 13:56:39',
            'updated_at' => '2024-01-08 13:56:39',
            'deleted_at' => NULL,
            'article' => '1987946059',
            'brand' => 'BOSCH',
            'price' => 0.0,
            'currency' => '',
        ),
        
        array (
            'id' => 7,
            'client_id' => 4,
            'akey' => '1987946059',
            'bkey' => 'BOSCH',
            'pkey' => 'BOSCH1987946059',
            'name' => 'ремень приводной поликлиновой',
            'rating' => '5',
            'review' => 'awsedrfgb',
            'email' => 'polishchuk.i.m.84@gmail.com',
            'created_at' => '2024-01-08 14:11:15',
            'updated_at' => '2024-01-08 14:11:15',
            'deleted_at' => NULL,
            'article' => '1987946059',
            'brand' => 'BOSCH',
            'price' => 698.0,
            'currency' => 'RUB',
        ),
        
        array (
            'id' => 8,
            'client_id' => 4,
            'akey' => '7700274177',
            'bkey' => 'RENAULT',
            'pkey' => 'RENAULT7700274177',
            'name' => 'ФИЛЬТР',
            'rating' => '5',
            'review' => 'Дороговато, но качество того стоит.',
            'email' => 'polishchuk.i.m.84@gmail.com',
            'created_at' => '2024-01-08 15:11:06',
            'updated_at' => '2024-01-08 15:11:06',
            'deleted_at' => NULL,
            'article' => '7700274177',
            'brand' => 'RENAULT',
            'price' => 1050.0,
            'currency' => 'RUB',
        ),
    ));
        
        
    }
}