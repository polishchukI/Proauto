<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShopMessageSubjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shop_message_subjects')->delete();
        
        \DB::table('shop_message_subjects')->insert(array (
            
            array (
                'id' => 1,
                'subject' => 'Вопросы по доставке',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 2,
                'subject' => 'Возврат товара',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 3,
                'subject' => 'Гарантия',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 4,
                'subject' => 'Редактировать мой заказ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 5,
                'subject' => 'Возврат/обмен основных деталей',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 6,
                'subject' => 'Я не могу войти в систему',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 7,
                'subject' => 'Подойдет ли выбранная мною запчасть для моего автомобиля?',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 8,
                'subject' => 'Проверить наличие',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 9,
                'subject' => 'Уточнить информацию о запчасти',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 10,
                'subject' => 'Помощь в заказе',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 11,
                'subject' => 'Условия оплаты',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 12,
                'subject' => 'Корпоративные заказы',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 13,
                'subject' => 'Сообщить об ошибке на этом сайте',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 14,
                'subject' => 'Найти подходящую запчасть для моего автомобиля',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 15,
                'subject' => 'Другая причина',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 16,
                'subject' => 'Вопросы о бонусных баллах',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 17,
                'subject' => 'Проверка совместимости',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 18,
                'subject' => 'Запрос цены',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}