<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_statuses')->delete();
        
        \DB::table('order_statuses')->insert(array (
            
            array (
                'id' => 1,
                'name' => 'Заказ принят',
                'description' => 'Заказ размещен на платформе и ждет очереди обработки',
                'status_color' => '444',
                'telegram_notifications' => 1,
                'status_notification' => 1,
                'order_status_subject' => NULL,
                'template' => NULL,
                'created_at' => '2023-09-22 19:21:18',
                'updated_at' => '2024-01-09 10:40:05',
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 2,
                'name' => 'Ожидает оплаты',
                'description' => 'Заказ не размещен и требует внесения оплаты',
                'status_color' => '#eef1f5',
                'telegram_notifications' => NULL,
                'status_notification' => NULL,
                'order_status_subject' => NULL,
                'template' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 3,
                'name' => 'Ожидает обработки',
                'description' => 'Заказ размещен в системе и будет отправлен на склад в соответствии с графиком',
                'status_color' => '#dad3ea;',
                'telegram_notifications' => NULL,
                'status_notification' => NULL,
                'order_status_subject' => NULL,
                'template' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 4,
                'name' => 'Заказано',
                'description' => 'Заказ отправлен на склад и ожидает подтверждения',
                'status_color' => '#ffefb4;',
                'telegram_notifications' => NULL,
                'status_notification' => NULL,
                'order_status_subject' => NULL,
                'template' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 5,
                'name' => 'Подтвержден складом',
                'description' => 'Заказ подтвержден складом',
                'status_color' => '#ffca95;',
                'telegram_notifications' => NULL,
                'status_notification' => NULL,
                'order_status_subject' => NULL,
                'template' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 6,
                'name' => 'В пути',
                'description' => 'Заказ принят от поставщика и готовится к отправке клиенту',
                'status_color' => '#96eca3;',
                'telegram_notifications' => NULL,
                'status_notification' => NULL,
                'order_status_subject' => NULL,
                'template' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 7,
                'name' => 'На складе',
                'description' => 'Заказ готов к выдаче',
                'status_color' => '#a7c8ff;',
                'telegram_notifications' => NULL,
                'status_notification' => NULL,
                'order_status_subject' => NULL,
                'template' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 8,
                'name' => 'Выдано',
                'description' => 'Заказ выдан клиенту',
                'status_color' => '#e4e7ea',
                'telegram_notifications' => NULL,
                'status_notification' => NULL,
                'order_status_subject' => NULL,
                'template' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 9,
                'name' => 'Нет в наличии',
                'description' => 'Склад отказал в поставке, необходим перезаказ',
                'status_color' => '#f1b2b0;',
                'telegram_notifications' => NULL,
                'status_notification' => NULL,
                'order_status_subject' => NULL,
                'template' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}