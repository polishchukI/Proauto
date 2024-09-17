<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('services')->delete();
        
        \DB::table('services')->insert(array (
            
            array (
                'id' => 1,
                'article' => 'SU.1400',
                'name' => 'Услуги типографии',
                'created_at' => '2023-12-01 17:19:00',
                'updated_at' => '2023-12-01 17:19:53',
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 2,
                'article' => 'SU.0500',
            'name' => 'Транспортные услуги(подряд)',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 3,
                'article' => 'R1.0001',
                'name' => 'Замена защиты бампера',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 4,
                'article' => 'A1.0001',
                'name' => 'СУ защиты двигателя',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 5,
                'article' => 'A1.0100',
                'name' => 'Двигатель и трансмиссия вместе. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 6,
                'article' => 'A1.0200',
                'name' => 'Двигатель только. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 7,
                'article' => 'A1.0300',
                'name' => 'Двигатель. Полная замена.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 8,
                'article' => 'A1.0400',
                'name' => 'Двигатель. Ремонт',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 9,
                'article' => 'A1.0500',
            'name' => 'Двигатель и трансмиссия (вне транспортного ср-ва). Перебрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 10,
                'article' => 'A1.0600',
                'name' => 'Двигатель полностью. РC',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 11,
                'article' => 'A1.0700',
                'name' => 'Блок цилиндров. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 12,
                'article' => 'A1.0800',
                'name' => 'Опора двигателя. Левая. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 13,
                'article' => 'A1.0900',
                'name' => 'Опора двигателя. Правая. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 14,
                'article' => 'A1.1000',
                'name' => 'Опора двигателя. Передняя. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 15,
                'article' => 'A1.1100',
                'name' => 'Опора двигателя. Задняя. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 16,
                'article' => 'A1.1200',
                'name' => 'Кронштейн опоры двигателя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 17,
                'article' => 'A1.1300',
                'name' => 'Узел опоры. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 18,
                'article' => 'A1.1400',
                'name' => 'Стабилизатор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 19,
                'article' => 'A2.0100',
                'name' => 'Проверка компрессии',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 20,
                'article' => 'A2.0200',
                'name' => 'Клапанная крышка. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 21,
                'article' => 'A2.0300',
            'name' => 'Клапанная крышка и прокладка (левая). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 22,
                'article' => 'A2.0400',
            'name' => 'Клапанная крышка и прокладка (правая). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 23,
                'article' => 'A2.0500',
            'name' => 'Клапанная крышка и прокладка (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 24,
                'article' => 'A2.0608',
                'name' => 'Зазор клапанов. Регулировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 25,
                'article' => 'A2.0700',
                'name' => 'Головка блока и прокладка. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 26,
                'article' => 'A2.0800',
            'name' => 'Головка блока и прокладка (левая). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 27,
                'article' => 'A2.0900',
            'name' => 'Головка блока и прокладка (правая). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 28,
                'article' => 'A2.1000',
            'name' => 'Головка блока и прокладка (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 29,
                'article' => 'A2.1100',
                'name' => 'Головка блока. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 30,
                'article' => 'A2.1200',
            'name' => 'Головка блока (левая). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 31,
                'article' => 'A2.1300',
            'name' => 'Головка блока (правая). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 32,
                'article' => 'A2.1400',
            'name' => 'Головка блока (обе). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 33,
                'article' => 'A2.1500',
                'name' => 'Головка блока. Протяжка болтов. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 34,
                'article' => 'A2.1600',
            'name' => 'Головка блока. Протяжка болтов - (обе). Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 35,
                'article' => 'A2.1700',
                'name' => 'Головка блока. Замена деталей. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 36,
                'article' => 'A2.1800',
            'name' => 'Головка блока. Замена деталей - (левый). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 37,
                'article' => 'A2.1900',
            'name' => 'Головка блока. Замена деталей - (правый). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 38,
                'article' => 'A2.2000',
            'name' => 'Головка блока. Замена деталей - (оба). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 39,
                'article' => 'A2.2100',
                'name' => 'Головка блока. Очистить от нагара. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 40,
                'article' => 'A2.2200',
            'name' => 'Головка блока. Очистить от нагара - (левую). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 41,
                'article' => 'A2.2300',
            'name' => 'Головка блока. Очистить от нагара - (правую). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 42,
                'article' => 'A2.2400',
            'name' => 'Головка блока. Очистить от нагара - (обе). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 43,
                'article' => 'A2.2500',
                'name' => 'Ось коромысел в сборе. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 44,
                'article' => 'A2.2600',
            'name' => 'Ось коромысел в сборе (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 45,
                'article' => 'A2.2700',
                'name' => 'Ось коромысел в сборе. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 46,
                'article' => 'A2.2800',
            'name' => 'Ось коромысел в сборе (оба) Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 47,
                'article' => 'A2.2900',
            'name' => 'Клапаны (все), включая притирку. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 48,
                'article' => 'A2.3000',
            'name' => 'Клапаны (все), включая притирку - (левое). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 49,
                'article' => 'A2.3100',
            'name' => 'Клапаны (все), включая притирку - (правое). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 50,
                'article' => 'A2.3200',
            'name' => 'Маслоотражательный колпачок (все). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 51,
                'article' => 'A2.3300',
                'name' => 'Фазы газораспределения. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 52,
                'article' => 'A2.3401',
                'name' => 'Клапан фазорегулятора. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 53,
                'article' => 'A3.0300',
                'name' => 'Распредвал. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 54,
                'article' => 'A3.0400',
            'name' => 'Распредвал(оба). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 55,
                'article' => 'A3.0803',
                'name' => 'Распредвал. Сальник передний. Замена.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 56,
                'article' => 'A3.1100',
                'name' => 'Сальник распредвала задний. Замена.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 57,
                'article' => 'A3.1700',
                'name' => 'Шестерня привода распредвала. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 58,
                'article' => 'A3.1800',
                'name' => 'Цепь привода распредвала межвальная. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 59,
                'article' => 'A3.2300',
                'name' => 'Ремень/цепь привода ГРМ. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 60,
                'article' => 'A3.2301',
            'name' => 'Ремень/цепь привода ГРМ(AC). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 61,
                'article' => 'A3.2303',
            'name' => 'Ремень/цепь привода ГРМ(PAS). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 62,
                'article' => 'A3.2306',
            'name' => 'Ремень/цепь привода ГРМ(AC+PAS). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 63,
                'article' => 'A3.2500',
                'name' => 'Крышка цепи распредвалов и прокладка. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 64,
                'article' => 'A3.2600',
                'name' => 'Промежуточный вал и сальники. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 65,
                'article' => 'A4.0100',
                'name' => 'Коленвал. Коренные вкладыши. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 66,
                'article' => 'A4.0200',
                'name' => 'Коленвал. Сальник передний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 67,
                'article' => 'A4.0300',
                'name' => 'Коленвал. Сальник задний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 68,
                'article' => 'A4.0400',
                'name' => 'Шкив коленвала. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 69,
                'article' => 'A4.0500',
                'name' => 'Уравновешивающий вал. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 70,
                'article' => 'A4.0600',
            'name' => 'Уравновешивающий вал (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 71,
                'article' => 'A4.0700',
                'name' => 'Шатунные вкладыши. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 72,
                'article' => 'A4.0800',
            'name' => 'Шатуны и поршни (все). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 73,
                'article' => 'A4.0900',
            'name' => 'Шатун и поршень (один). Двигатель разобран. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 74,
                'article' => 'A4.1000',
            'name' => 'Шатуны и поршни (все). Двигатель разобран. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 75,
                'article' => 'A4.1100',
            'name' => 'Шатун и поршень (один). Двигатель разобран. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 76,
                'article' => 'A4.1200',
            'name' => 'Поршень и вкладыши - (все). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 77,
                'article' => 'A4.1300',
            'name' => 'Поршневые кольца (все). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 78,
                'article' => 'A5.0100',
                'name' => 'Масло двигателя. Замена',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 79,
                'article' => 'A5.0110',
                'name' => 'Масляный фильтр. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 80,
                'article' => 'A5.0200',
                'name' => 'Масляный фильтр. Корпус. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 81,
                'article' => 'A5.0300',
                'name' => 'Давление масла. Проверить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 82,
                'article' => 'A5.0400',
                'name' => 'Редукционный клапан давления масла. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 83,
                'article' => 'A5.0500',
                'name' => 'Маслянный поддон двигателя. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 84,
                'article' => 'A5.0600',
                'name' => 'Маслоприемник. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 85,
                'article' => 'A5.0700',
                'name' => 'Масляный насос. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 86,
                'article' => 'A5.0800',
                'name' => 'Масляный насос. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 87,
                'article' => 'A5.0900',
                'name' => 'Масляный насос. Ведущий привод. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 88,
                'article' => 'A5.1000',
                'name' => 'Масляный теплообменник. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 89,
                'article' => 'A5.1100',
                'name' => 'Масляный теплообменник. Шланги. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 90,
                'article' => 'A5.1200',
                'name' => 'Маслозаливная горловина / сапун картера. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 91,
                'article' => 'A5.1300',
                'name' => 'Клапан. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 92,
                'article' => 'A5.1400',
                'name' => 'Уточнить название Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'A',
            ),
            
            array (
                'id' => 93,
                'article' => 'B1.0100',
                'name' => 'Зажигание. Электронный блок управления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 94,
                'article' => 'B1.0101',
                'name' => 'Замок зажигания. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 95,
                'article' => 'B1.0200',
            'name' => 'Электронный блок управления (впрыск). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 96,
                'article' => 'B1.0300',
                'name' => 'Установка угла опережения зажигания. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 97,
                'article' => 'B1.0400',
                'name' => 'Угол замкнутого состояния контактов прерывателя. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 98,
                'article' => 'B1.0500',
            'name' => 'Свечи зажигания (все). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 99,
                'article' => 'B1.0600',
            'name' => 'Высоковольтные провода (все). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 100,
                'article' => 'B1.0700',
                'name' => 'Зажигание. Катушка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 101,
                'article' => 'B1.0800',
            'name' => 'Зажигание. Катушка (обе/все). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 102,
                'article' => 'B1.0900',
                'name' => 'Конденсатор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 103,
                'article' => 'B1.1000',
                'name' => 'Распределитель зажигания. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 104,
                'article' => 'B1.1100',
            'name' => 'Распределитель зажигания. Прерыватель (любой тип). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 105,
                'article' => 'B1.1200',
                'name' => 'Распределитель зажигания. Шестерня привода. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 106,
                'article' => 'B1.1300',
                'name' => 'Распределитель зажигания. Крышка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 107,
                'article' => 'B1.1400',
            'name' => 'Распределитель зажигания. Крышка (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 108,
                'article' => 'B1.1500',
                'name' => 'Распределитель зажигания. Вал тромблера. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 109,
                'article' => 'B1.1600',
                'name' => 'Распределитель зажигания. Вакуумный регулятор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 110,
                'article' => 'B1.1700',
            'name' => 'Датчик оборотов (трамблера). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 111,
                'article' => 'B1.1800',
            'name' => 'Датчик оборотов (коленвала). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 112,
                'article' => 'B1.1900',
                'name' => 'Датчик работы цилиндра. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 113,
                'article' => 'B1.2000',
                'name' => 'Выходной блок зажигания. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 114,
                'article' => 'B1.2100',
                'name' => 'Датчик детонации. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 115,
                'article' => 'B1.2200',
            'name' => 'Датчик детонации (левый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 116,
                'article' => 'B1.2300',
            'name' => 'Датчик детонации (правый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'B',
            ),
            
            array (
                'id' => 117,
                'article' => 'C1.0100',
                'name' => 'Фильтр воздушный. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 118,
                'article' => 'C1.0200',
            'name' => 'Воздушный фильтр в сборе (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 119,
                'article' => 'C1.0300',
                'name' => 'Воздушный фильтр. Элемент. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 120,
                'article' => 'C1.0400',
            'name' => 'Воздушный фильтр. Элемент - (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 121,
                'article' => 'C1.0500',
                'name' => 'Устройство подогрева воздуха на впуске. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 122,
                'article' => 'C1.0600',
                'name' => 'Патрубок воздуховода. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 123,
                'article' => 'C1.0700',
            'name' => 'Впускной коллектор (левый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 124,
                'article' => 'C1.0800',
            'name' => 'Впускной коллектор (правый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 125,
                'article' => 'C1.0900',
            'name' => 'Впускной коллектор (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 126,
                'article' => 'C1.1000',
                'name' => 'Впускной коллектор. Прокладка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 127,
                'article' => 'C1.1100',
            'name' => 'Впускной коллектор. Прокладка (левая). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 128,
                'article' => 'C1.1200',
            'name' => 'Впускной коллектор. Прокладка (правая). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 129,
                'article' => 'C1.1300',
            'name' => 'Впускной коллектор. Прокладка (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 130,
                'article' => 'C1.1400',
                'name' => 'Подогреватель всасываемого воздуха. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 131,
                'article' => 'C1.1500',
            'name' => 'Воздушный ресивер (пуск). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 132,
                'article' => 'C1.1600',
                'name' => 'Вакуумный термовыключатель. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 133,
                'article' => 'C2.0100',
                'name' => 'Холостой ход. Обороты и СО. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 134,
                'article' => 'C2.0200',
                'name' => 'Обороты холостого хода. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 135,
                'article' => 'C2.0300',
                'name' => 'Трос газа. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 136,
                'article' => 'C2.0400',
                'name' => 'Трос привода дроссельной заслонки. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 137,
                'article' => 'C2.0500',
                'name' => 'Тяга газа. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 138,
                'article' => 'C2.0600',
                'name' => 'Тяга газа. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 139,
                'article' => 'C2.0700',
                'name' => 'Пружина возврата. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 140,
                'article' => 'C2.0800',
                'name' => 'Педаль газа - правый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 141,
                'article' => 'C2.0900',
                'name' => 'Педаль акселератора. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 142,
                'article' => 'C3.0100',
                'name' => 'Карбюратор. Электронный блок управления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 143,
                'article' => 'C3.0200',
                'name' => 'Карбюратор/зажигание. Комбинированный блок управления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 144,
                'article' => 'C3.0300',
                'name' => 'Карбюратор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 145,
                'article' => 'C3.0400',
            'name' => 'Карбюратор (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 146,
                'article' => 'C3.0500',
                'name' => 'Карбюратор. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 147,
                'article' => 'C3.0600',
            'name' => 'Карбюратор (оба). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 148,
                'article' => 'C3.0700',
                'name' => 'Трос ручной воздушной заслонки. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 149,
                'article' => 'C3.0800',
                'name' => 'Трос ручной воздушной заслонки. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 150,
                'article' => 'C3.0900',
            'name' => 'Автоматическая воздушная заслонка (дроссель). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 151,
                'article' => 'C3.1000',
                'name' => 'Дроссельная заслонка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 152,
                'article' => 'C3.1001',
                'name' => 'Дроссельная заслонка. Очистка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 153,
                'article' => 'C3.1100',
                'name' => 'Насос дроссельной заслонки. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 154,
                'article' => 'C3.1200',
                'name' => 'Шаговый двигатель. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 155,
                'article' => 'C3.1300',
                'name' => 'Термовыключатель запуска. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 156,
                'article' => 'C3.1400',
                'name' => 'Клапан отсечки топлива при торможении двигателем. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 157,
                'article' => 'C3.1500',
            'name' => 'Поплавок (один). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 158,
                'article' => 'C3.1600',
            'name' => 'Поплавок. Игольчатый клапан (один). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 159,
                'article' => 'C3.1700',
                'name' => 'Поплавок. Уровень топлива. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 160,
                'article' => 'C3.1800',
                'name' => 'Поплавок. Прокладка камеры. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 161,
                'article' => 'C3.1900',
                'name' => 'Игла постоянного разряжения. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 162,
                'article' => 'C3.2000',
            'name' => 'Главное сопло (форсунка). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 163,
                'article' => 'C4.0100',
                'name' => 'Впрыск. Блок управления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 164,
                'article' => 'C4.0200',
                'name' => 'Впрыск/зажигание. Комбинированный блок управления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 165,
                'article' => 'C4.0300',
                'name' => 'Реле управления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 166,
                'article' => 'C4.0400',
            'name' => 'Форсунки (все). Проверить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 167,
                'article' => 'C4.0401',
            'name' => 'Форсунка (одна). Проверить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 168,
                'article' => 'C4.0500',
            'name' => 'Форсунки (все). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 169,
                'article' => 'C4.0501',
            'name' => 'Форсунка (одна). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 170,
                'article' => 'C4.0600',
                'name' => 'Датчик воздухомера. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 171,
                'article' => 'C4.0700',
                'name' => 'Датчик воздухомера. Заслонка. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 172,
                'article' => 'C4.0800',
                'name' => 'Датчик давления коллектора. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 173,
                'article' => 'C4.0900',
                'name' => 'Датчик температуры охлаждающей жидкости. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 174,
                'article' => 'C4.1000',
                'name' => 'Датчик температуры топлива. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 175,
                'article' => 'C4.1100',
                'name' => 'Датчик температуры окружающей среды. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 176,
                'article' => 'C4.1200',
                'name' => 'Датчик температуры воздуха. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 177,
                'article' => 'C4.1300',
                'name' => 'Датчик атмосферного давления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 178,
                'article' => 'C4.1400',
                'name' => 'Датчик скорости автомобиля. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 179,
                'article' => 'C4.1500',
                'name' => 'Датчик положения распредвала. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 180,
                'article' => 'C4.1600',
                'name' => 'Воздушная заслонка. Корпус. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 181,
                'article' => 'C4.1700',
                'name' => 'Дроссельная заслонка. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 182,
                'article' => 'C4.1800',
            'name' => 'Датчик положения дросселя (потенциометр). Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 183,
                'article' => 'C4.1900',
            'name' => 'Датчик положения дросселя (потенциометр). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 184,
                'article' => 'C4.2000',
                'name' => 'Воздушная заслонка. Мотор привода. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 185,
                'article' => 'C4.2100',
                'name' => 'Конечный выключатель дросселя. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 186,
                'article' => 'C4.2200',
                'name' => 'Конечный выключатель дросселя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 187,
                'article' => 'C4.2300',
                'name' => 'Холостой ход. Клапан. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 188,
                'article' => 'C4.2400',
                'name' => 'Холостой ход. Электромагнитный клапан оборотов прогрева. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 189,
                'article' => 'C4.2500',
                'name' => 'Потенциометр регулятора смеси. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 190,
                'article' => 'C4.2600',
                'name' => 'Форсунка холодного пуска. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 191,
                'article' => 'C4.2700',
            'name' => 'Вспомогательный (дополнительный) воздушный клапан. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 192,
                'article' => 'C4.2800',
                'name' => 'Топливо. Регулятор давления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 193,
                'article' => 'C4.2900',
                'name' => 'Топливная шина. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 194,
                'article' => 'C4.3000',
                'name' => 'Распределитель топлива. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 195,
                'article' => 'C5.0100',
                'name' => 'Электронный блок управления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 196,
                'article' => 'C5.0200',
                'name' => 'Датчик давления коллектора. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 197,
                'article' => 'C5.0300',
                'name' => 'Датчик воздухомера. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 198,
                'article' => 'C5.0400',
                'name' => 'Датчик температуры охлаждающей жидкости. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 199,
                'article' => 'C5.0500',
                'name' => 'Датчик температуры топлива. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 200,
                'article' => 'C5.0501',
                'name' => 'Датчик температуры выхлопных газов. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 201,
                'article' => 'C5.0600',
                'name' => 'Датчик оборотов. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 202,
                'article' => 'C5.0700',
                'name' => 'Система впрыска. Герметизация.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 203,
                'article' => 'C5.0800',
                'name' => 'Отстойник воды. Слить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 204,
                'article' => 'C5.0900',
            'name' => 'Фильтр топливный дизельный(вкладыш). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 205,
                'article' => 'C5.1000',
                'name' => 'Фильтр топливный дизельный. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 206,
                'article' => 'C5.1100',
                'name' => 'Впрыск. Насос высокого давления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 207,
                'article' => 'C5.1110',
                'name' => 'Впрыск. Насос высокого давления. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 208,
                'article' => 'C5.1200',
                'name' => 'Впрыск. Привод топливного насоса высокого давления. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 209,
                'article' => 'C5.1300',
            'name' => 'Впрыск. Опережение (статика). Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 210,
                'article' => 'C5.1400',
            'name' => 'Впрыск. Опережение (динамика). Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 211,
                'article' => 'C5.1500',
            'name' => 'Форсунки (все). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 212,
                'article' => 'C5.1501',
            'name' => 'Форсунка (одна). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 213,
                'article' => 'C5.1600',
            'name' => 'Форсунки (все). Очистка и проверка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 214,
                'article' => 'C5.1601',
            'name' => 'Форсунка (одна). Очистка и проверка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 215,
                'article' => 'C5.1700',
            'name' => 'Трубки форсунки (все). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 216,
                'article' => 'C5.1800',
            'name' => 'Трубка форсунки (одна). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 217,
                'article' => 'C5.1900',
                'name' => 'Трос управления подсосом. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 218,
                'article' => 'C5.2000',
                'name' => 'Клапан отсечки подачи топлива. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 219,
                'article' => 'C5.2100',
            'name' => 'Свечи накаливания (все). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 220,
                'article' => 'C5.2200',
                'name' => 'Тепловой запуск двигателя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 221,
                'article' => 'C5.2300',
                'name' => 'Система подогрева. Реле. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 222,
                'article' => 'C5.2400',
                'name' => 'Система подогрева. Таймер. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 223,
                'article' => 'C5.2500',
                'name' => 'Топливный нагреватель. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 224,
                'article' => 'C5.2600',
                'name' => 'Датчик наличия воды в топливе. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 225,
                'article' => 'C5.2700',
                'name' => 'Топливная система. Чистка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 226,
                'article' => 'C6.0100',
                'name' => 'Топливо. Давление. Проверить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 227,
                'article' => 'C6.0200',
                'name' => 'Топливный насос. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 228,
                'article' => 'C6.0300',
                'name' => 'Высасывающий насос. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 229,
                'article' => 'C6.0400',
                'name' => 'Высасывающий насос. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 230,
                'article' => 'C6.0500',
                'name' => 'Высасывающий насос. Фильтр. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 231,
                'article' => 'C6.0600',
                'name' => 'Бак топливный. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 232,
                'article' => 'C6.0700',
                'name' => 'Топливный бак - комбинированный. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 233,
                'article' => 'C6.0800',
                'name' => 'Топливный бак - пластиковый. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 234,
                'article' => 'C6.0900',
                'name' => 'Топливный бак. Система вентиляции. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 235,
                'article' => 'C6.1000',
                'name' => 'Бензопровод от бака к насосу. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 236,
                'article' => 'C6.1100',
                'name' => 'Топливный фильтр. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 237,
                'article' => 'C6.1200',
                'name' => 'Топливный фильтр / отстойник. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 238,
                'article' => 'C6.1300',
                'name' => 'Электромагнитный клапан. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 239,
                'article' => 'C6.1400',
                'name' => 'Угольный фильтр. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 240,
                'article' => 'C6.1500',
                'name' => 'Клапан отсечки топлива. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 241,
                'article' => 'C6.1600',
                'name' => 'Топливопровод подающий. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 242,
                'article' => 'C6.1700',
                'name' => 'Топливопровод возвратный. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 243,
                'article' => 'C6.1800',
                'name' => 'Шланг - от бака к насосу. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 244,
                'article' => 'C6.1900',
                'name' => 'Шланг - от насоса к фильтру. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 245,
                'article' => 'C6.2000',
                'name' => 'Шланг - от фильтра к главной подаче. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 246,
                'article' => 'C6.2100',
                'name' => 'Шланг - от регулятора к обратке. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 247,
                'article' => 'C7.0100',
                'name' => 'Турбокомпрессор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 248,
                'article' => 'C7.0200',
            'name' => 'Турбокомпрессор (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 249,
                'article' => 'C7.0300',
                'name' => 'Турбокомпрессор. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 250,
                'article' => 'C7.0400',
            'name' => 'Турбокомпрессор (оба). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 251,
                'article' => 'C7.0500',
                'name' => 'Давление наддува. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 252,
                'article' => 'C7.0600',
                'name' => 'Перепуск газов мимо турбины. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 253,
                'article' => 'C7.0700',
                'name' => 'Привод клапана перепуска газов. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 254,
                'article' => 'C7.0800',
                'name' => 'Привод клапана перепуска газов. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 255,
                'article' => 'C7.0900',
                'name' => 'Соединение - впускной коллектор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 256,
                'article' => 'C7.1000',
                'name' => 'Соединение впуска воздуха. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 257,
                'article' => 'C7.1100',
            'name' => 'Соединение впуска воздуха (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 258,
                'article' => 'C7.1200',
                'name' => 'Соединение внешнего радиатора. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 259,
                'article' => 'C8.0974',
                'name' => 'Замена газовой форсунки',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 260,
                'article' => 'C8.8955',
                'name' => 'Замена фильтра сист пит сжижен газ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 261,
                'article' => 'C8.8960',
                'name' => 'СУ блока редуктора газового топлива',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 262,
                'article' => 'C8.8970',
                'name' => 'Фильтра газового топлива.Замена',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 263,
                'article' => 'C8.8995',
                'name' => 'Проверка герметичности контура LPG',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 264,
                'article' => 'C8.A0KL',
                'name' => 'Замена датчика давления LPG',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'C',
            ),
            
            array (
                'id' => 265,
                'article' => 'D1.0100',
                'name' => 'Жидкость охлаждающая. Замена.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 266,
                'article' => 'D1.0200',
                'name' => 'Опрессовка системы. Проверить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 267,
                'article' => 'D1.0300',
                'name' => 'Ремень вентилятора. Натяжение. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 268,
                'article' => 'D1.0400',
                'name' => 'Ремень вентилятора. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 269,
                'article' => 'D1.0500',
                'name' => 'Вентилятор радиатора. Муфта. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 270,
                'article' => 'D1.0600',
            'name' => 'Вентилятор радиатора. Муфта (обоих). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 271,
                'article' => 'D1.0700',
                'name' => 'Вентилятор радиатора. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 272,
                'article' => 'D1.0800',
            'name' => 'Вентилятор радиатора (оба). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 273,
                'article' => 'D1.0900',
                'name' => 'Вентилятор радиатора. Двигатель. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 274,
                'article' => 'D1.1000',
            'name' => 'Вентилятор радиатора. Двигатели (обоих). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 275,
                'article' => 'D1.1100',
                'name' => 'Вентилятор радиатора. Термодатчик. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 276,
                'article' => 'D1.1200',
                'name' => 'Радиатор системы охлаждения. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 277,
                'article' => 'D1.1300',
                'name' => 'Радиатор. Диффузор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 278,
                'article' => 'D1.1400',
                'name' => 'Термостат. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 279,
                'article' => 'D1.1500',
                'name' => 'Промежуточный охладитель. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 280,
                'article' => 'D1.1501',
                'name' => 'Водомасляный охладитель. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 281,
                'article' => 'D1.1600',
                'name' => 'Долив охлождающей жидкости',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 282,
                'article' => 'D2.0100',
                'name' => 'Водяной насос.СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 283,
                'article' => 'D2.0200',
                'name' => 'Водяная помпа. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 284,
                'article' => 'D2.0300',
                'name' => 'Водяная помпа. Шкив. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 285,
                'article' => 'D3.0100',
                'name' => 'Расширительный бачек. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 286,
                'article' => 'D3.0200',
                'name' => 'Радиатор. Верхний шланг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 287,
                'article' => 'D3.0300',
                'name' => 'Радиатор. Нижний шланг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 288,
                'article' => 'D3.0400',
                'name' => 'Расширительный бачек. Шланг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 289,
                'article' => 'D3.0600',
                'name' => 'Шланг к водяной помпе. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 290,
                'article' => 'D3.0700',
                'name' => 'Шланг от водяной помпы. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 291,
                'article' => 'D3.0800',
                'name' => 'Шланг к впускному коллектору. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 292,
                'article' => 'D3.0900',
                'name' => 'Шланг от впускного коллектора. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 293,
                'article' => 'D3.1000',
                'name' => 'Водяной трубопровод. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 294,
                'article' => 'D3.1100',
                'name' => 'Шланг к радиатору. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 295,
                'article' => 'D3.1200',
                'name' => 'Шланг от радиатора. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'D',
            ),
            
            array (
                'id' => 296,
                'article' => 'E1.0100',
                'name' => 'Выпускной коллектор. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 297,
                'article' => 'E1.0200',
            'name' => 'Выпускной коллектор (левый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 298,
                'article' => 'E1.0400',
            'name' => 'Выпускной коллектор (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 299,
                'article' => 'E1.0500',
                'name' => 'Выпускной коллектор. Прокладка. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 300,
                'article' => 'E1.0600',
            'name' => 'Выпускной коллектор. Прокладка (левая). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 301,
                'article' => 'E1.0700',
            'name' => 'Выпускной коллектор. Прокладка (правая). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 302,
                'article' => 'E1.0800',
            'name' => 'Выпускной коллектор. Прокладка (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 303,
                'article' => 'E1.1000',
            'name' => 'Приемная труба. Прокладка (левая). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 304,
                'article' => 'E1.1100',
            'name' => 'Приемная труба. Прокладка (правая). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 305,
                'article' => 'E1.1200',
            'name' => 'Приемная труба. Прокладка (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 306,
                'article' => 'E1.1201',
                'name' => 'Приемная труба. Прокладка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 307,
                'article' => 'E1.1300',
                'name' => 'Труба передняя / приемная. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 308,
                'article' => 'E1.1400',
            'name' => 'Труба передняя / приемная (левая). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 309,
                'article' => 'E1.1500',
            'name' => 'Труба передняя / приемная (правая). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 310,
                'article' => 'E1.1600',
            'name' => 'Труба передняя / приемная (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 311,
                'article' => 'E1.1700',
                'name' => 'Глушитель. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 312,
                'article' => 'E1.1800',
            'name' => 'Труба задняя / глушитель (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 313,
                'article' => 'E1.1900',
                'name' => 'Система в сборе. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 314,
                'article' => 'E2.0100',
                'name' => 'Подушка подвески выпускного трубопровода. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 315,
                'article' => 'E2.0200',
                'name' => 'Крепеж передний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 316,
                'article' => 'E2.0300',
                'name' => 'Крепеж средний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 317,
                'article' => 'E2.0400',
                'name' => 'Крепеж задний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 318,
                'article' => 'E2.0500',
                'name' => 'Термозащита передняя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 319,
                'article' => 'E2.0600',
                'name' => 'Термозащита средняя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 320,
                'article' => 'E2.0700',
                'name' => 'Термозащита задняя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 321,
                'article' => 'E3.0100',
                'name' => 'Катализатор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 322,
                'article' => 'E3.0200',
            'name' => 'Катализатор (левый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 323,
                'article' => 'E3.0300',
            'name' => 'Катализатор (правый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 324,
                'article' => 'E3.0400',
            'name' => 'Катализатор (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 325,
                'article' => 'E3.0500',
                'name' => 'Датчик кислорода. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 326,
                'article' => 'E3.0501',
                'name' => 'Датчик кислорода. Левый/левый верхний. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 327,
                'article' => 'E3.0503',
                'name' => 'Датчик кислорода. Правый/правый верхний. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 328,
                'article' => 'E3.0507',
            'name' => 'Датчик кислорода(Оба). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 329,
                'article' => 'E3.0600',
            'name' => 'Клапан рециркуляции выпускных газов(EGR). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 330,
                'article' => 'E3.0601',
            'name' => 'Клапан рециркуляции выпускных газов(EGR). РС.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'E',
            ),
            
            array (
                'id' => 331,
                'article' => 'F1.0100',
                'name' => 'Система управления сцеплением. Проверка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 332,
                'article' => 'F1.0200',
                'name' => 'Педаль сцепления в сборе - правый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 333,
                'article' => 'F1.0300',
                'name' => 'Педаль сцепления в сборе - левый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 334,
                'article' => 'F1.0400',
                'name' => 'Саморегулирующий механизм - правый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 335,
                'article' => 'F1.0500',
                'name' => 'Саморегулирующий механизм - левый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 336,
                'article' => 'F1.0600',
                'name' => 'Пружина возврата педали. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 337,
                'article' => 'F1.0700',
                'name' => 'Сцепление. Гидравлическая система. Прокачка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 338,
                'article' => 'F1.0800',
            'name' => 'Главный цилиндр привода сцепления(RHD). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 339,
                'article' => 'F1.0900',
            'name' => 'Главный цилиндр привода сцепления(LHD). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 340,
                'article' => 'F1.1000',
                'name' => 'Главный цилиндр - правый руль. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 341,
                'article' => 'F1.1100',
                'name' => 'Главный цилиндр - левый руль. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 342,
                'article' => 'F1.1200',
                'name' => 'Сцепление. Рабочий цилиндр. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 343,
                'article' => 'F1.1400',
                'name' => 'Рабочий цилиндр. Шланг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 344,
                'article' => 'F1.1500',
                'name' => 'Гидравлическая трубка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 345,
                'article' => 'F1.1600',
                'name' => 'Трос сцепления - правый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 346,
                'article' => 'F1.1700',
                'name' => 'Сцепление.Трос. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 347,
                'article' => 'F1.1701',
                'name' => 'Трос сцепления. Регулировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 348,
                'article' => 'F1.1800',
                'name' => 'Вилка сцепления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 349,
                'article' => 'F1.1900',
                'name' => 'Вилка сцепления. Пружина возврата. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 350,
                'article' => 'F1.2000',
                'name' => 'МКПП. Подшипник выжимной. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 351,
                'article' => 'F2.0100',
                'name' => 'Сцепление. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 352,
                'article' => 'F2.0200',
                'name' => 'Маховик. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 353,
                'article' => 'F2.0400',
                'name' => 'Подшипник вала КПП. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 354,
                'article' => 'F2.0500',
                'name' => 'Корзина сцепления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'F',
            ),
            
            array (
                'id' => 355,
                'article' => 'G1.0100',
                'name' => 'КПП. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 356,
                'article' => 'G1.0200',
                'name' => 'КПП. РС.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 357,
                'article' => 'G1.0300',
                'name' => 'Картер сцепления и прокладка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 358,
                'article' => 'G1.0400',
                'name' => 'Задняя крышка и прокладка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 359,
                'article' => 'G1.0500',
                'name' => 'Дополнительный картер и прокладка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 360,
                'article' => 'G1.0600',
                'name' => 'КПП. Заднее крепление. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 361,
                'article' => 'G1.0700',
                'name' => 'МКПП. Масло. Замена.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 362,
                'article' => 'G1.0701',
                'name' => 'CVT. Масло. Замена.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 363,
                'article' => 'G1.0705',
                'name' => 'МКПП. Масло. Долив.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 364,
                'article' => 'G2.0100',
                'name' => 'Кулиса. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 365,
                'article' => 'G2.0200',
                'name' => 'КПП. Кулиса. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 366,
                'article' => 'G2.0201',
                'name' => 'КПП. Кулиса. Ремонт.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 367,
                'article' => 'G2.0300',
                'name' => 'Кулиса. Муфта привода. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 368,
                'article' => 'G2.0400',
                'name' => 'Рычаг переключения КПП. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 369,
                'article' => 'G2.0500',
                'name' => 'Рычаг переключения КПП. Крепление. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 370,
                'article' => 'G2.0600',
                'name' => 'Механизм выбора передачи. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 371,
                'article' => 'G2.0700',
                'name' => 'Кулиса. Сальники тяги переключения. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 372,
                'article' => 'G3.0100',
                'name' => 'Привод спидометра. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 373,
                'article' => 'G3.0200',
                'name' => 'Привод спидометра. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 374,
                'article' => 'G3.0300',
                'name' => 'Сальник первичного вала. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 375,
                'article' => 'G3.0400',
                'name' => 'Сальник вторичного вала. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 376,
                'article' => 'G3.0500',
                'name' => 'Первичный вал. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 377,
                'article' => 'G3.0600',
                'name' => 'Пятиступенчатая КПП. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 378,
                'article' => 'G3.0700',
            'name' => 'Переключение передачи (трос/тяга/переключатель). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'G',
            ),
            
            array (
                'id' => 379,
                'article' => 'H1.0100',
                'name' => 'Трансформатор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 380,
                'article' => 'H1.0200',
            'name' => 'Трансформатор. Центральное кольцо (сальник). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 381,
                'article' => 'H1.0300',
                'name' => 'Муфта привода. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 382,
                'article' => 'H1.0400',
                'name' => 'Трансформатор. Корпус и прокладка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 383,
                'article' => 'H1.0700',
                'name' => 'АКПП. Замена масла.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 384,
                'article' => 'H1.1400',
                'name' => 'Датчик частоты вращения гидротрансформатора. Замена',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 385,
                'article' => 'H1.1401',
                'name' => 'Датчик давления масла',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 386,
                'article' => 'H2.0100',
                'name' => 'АКПП в сборе. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 387,
                'article' => 'H2.0300',
                'name' => 'Дополнительный картер и прокладка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 388,
                'article' => 'H2.0400',
                'name' => 'Крепеж КПП - задний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 389,
                'article' => 'H2.0500',
                'name' => 'Уровень масла КПП. Долив',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 390,
                'article' => 'H2.0600',
                'name' => 'Масляный радиатор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 391,
                'article' => 'H2.0700',
                'name' => 'Масляный радиатор. Впускная труба. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 392,
                'article' => 'H2.0800',
                'name' => 'Масляный радиатор. Выпускная труба. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 393,
                'article' => 'H2.0900',
                'name' => 'Сальник входной. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 394,
                'article' => 'H2.1000',
                'name' => 'Сальник выходной. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 395,
                'article' => 'H2.1100',
                'name' => 'Поддон и прокладка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 396,
                'article' => 'H2.1200',
                'name' => 'Маслозаборник. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 397,
                'article' => 'H2.1300',
                'name' => 'Главный масляный насос. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 398,
                'article' => 'H2.1400',
                'name' => 'Главный масляный насос. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 399,
                'article' => 'H3.0200',
                'name' => 'Электромагнитные клапаны. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 400,
                'article' => 'H3.0300',
                'name' => 'Ручной переключатель. Рычаг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 401,
                'article' => 'H3.0400',
                'name' => 'Ручной переключатель. Трос / тяга. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 402,
                'article' => 'H3.0500',
                'name' => 'Ручной переключатель. Трос / тяга. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 403,
                'article' => 'H3.0600',
            'name' => 'Переключение передачи (трос/тяга/переключатель). Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 404,
                'article' => 'H3.0700',
            'name' => 'Переключение передачи (трос/тяга/переключатель). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 405,
                'article' => 'H3.0800',
                'name' => 'Сервоуправление. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 406,
                'article' => 'H3.0900',
            'name' => 'Сервоуправление (заднее). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 407,
                'article' => 'H3.1000',
                'name' => 'Вакуумный контроль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 408,
                'article' => 'H3.1100',
                'name' => 'Регулятор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 409,
                'article' => 'H3.1200',
                'name' => 'Регулятор. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 410,
                'article' => 'H3.1300',
                'name' => 'АКПП. Гидроблок. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 411,
                'article' => 'H3.1400',
                'name' => 'АКПП. Гидроблок. РС.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 412,
                'article' => 'H4.0100',
                'name' => 'Привод спидометра ведущий. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 413,
                'article' => 'H4.0200',
                'name' => 'Привод спидометра ведомый. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 414,
                'article' => 'H4.0300',
                'name' => 'Лента тормоза. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 415,
                'article' => 'H4.0400',
                'name' => 'Парковка. Механизм. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 416,
                'article' => 'H4.0500',
                'name' => 'Парковка. Тяга стояночного тормоза. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 417,
                'article' => 'H6.2184',
                'name' => 'Привод РКПП. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'H',
            ),
            
            array (
                'id' => 418,
                'article' => 'J1.0000',
                'name' => 'СУ приводного вала',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 419,
                'article' => 'J1.0100',
            'name' => 'Карданный вал передний (отдиночный). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 420,
                'article' => 'J1.0200',
                'name' => 'Карданный вал задний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 421,
                'article' => 'J1.0300',
                'name' => 'Карданный вал в сборе. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 422,
                'article' => 'J1.0400',
                'name' => 'Карданный вал. Муфта/фланец. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 423,
                'article' => 'J1.0500',
            'name' => 'Карданный вал. Муфта/фланец (задняя). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 424,
                'article' => 'J1.0600',
                'name' => 'Карданный вал. Крестовина. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 425,
                'article' => 'J1.0700',
                'name' => 'Карданный вал. Шрус. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 426,
                'article' => 'J1.0800',
                'name' => 'Карданный вал. Пыльник шруса. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 427,
                'article' => 'J1.0900',
                'name' => 'Карданный вал. Центральный подшипник. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 428,
                'article' => 'J1.1000',
                'name' => 'Карданный вал. Опора центрального подшипника. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 429,
                'article' => 'J1.1100',
                'name' => 'Центральный дифференциал. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 430,
                'article' => 'J1.1200',
                'name' => 'Центральный дифференциал. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 431,
                'article' => 'J1.1300',
                'name' => 'Центральный дифференциал. Сальник переднего вала. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 432,
                'article' => 'J1.1400',
                'name' => 'Центральный дифференциал. Сальник заднего вала. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 433,
                'article' => 'J1.1500',
                'name' => 'Вязкостная муфта. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 434,
                'article' => 'J1.1600',
                'name' => 'Раздаточная коробка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 435,
                'article' => 'J1.1700',
                'name' => 'Раздаточная коробка. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 436,
                'article' => 'J1.1800',
                'name' => 'Раздаточная коробка. Рычаг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 437,
                'article' => 'J1.1900',
                'name' => 'Раздаточная коробка. Сальник переднего вала. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 438,
                'article' => 'J1.2000',
                'name' => 'Раздаточная коробка. Сальник заднего вала. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 439,
                'article' => 'J1.2100',
                'name' => 'Раздаточная коробка. Крепеж. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 440,
                'article' => 'J2.0100',
                'name' => 'Передняя ось в сборе. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 441,
                'article' => 'J2.0200',
                'name' => 'Передняя ось в сборе. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 442,
                'article' => 'J2.0300',
                'name' => 'Главная передача. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 443,
                'article' => 'J2.0400',
                'name' => 'Главная передача. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 444,
                'article' => 'J2.0500',
                'name' => 'Главная передача. Сальник ведущей шестерни. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 445,
                'article' => 'J2.0600',
            'name' => 'Приводной вал (левый). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 446,
                'article' => 'J2.0700',
            'name' => 'Приводной вал (правый). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 447,
                'article' => 'J2.0800',
            'name' => 'Приводной вал (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 448,
                'article' => 'J2.0900',
            'name' => 'Сальник приводного вала внутренний (левый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 449,
                'article' => 'J2.1000',
            'name' => 'Сальник приводного вала внутренний (правый). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 450,
                'article' => 'J2.1100',
            'name' => 'Сальник приводного вала внутренний (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 451,
                'article' => 'J2.1200',
            'name' => 'ШРУС (наружный левый). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 452,
                'article' => 'J2.1300',
            'name' => 'ШРУС (наружный правый). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 453,
                'article' => 'J2.1400',
            'name' => 'Шарнир приводного вала (внутренний левый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 454,
                'article' => 'J2.1500',
            'name' => 'Шарнир приводного вала (внутренний правый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 455,
                'article' => 'J2.1600',
            'name' => 'Шарниры приводного вала (оба левых). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 456,
                'article' => 'J2.1700',
            'name' => 'Шарниры приводного вала (оба правых). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 457,
                'article' => 'J2.1800',
            'name' => 'Шарниры приводного вала (все). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 458,
                'article' => 'J2.1900',
            'name' => 'Пыльник ПО (наружный левый). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 459,
                'article' => 'J2.1901',
                'name' => 'СУ пыльника приводного вала',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 460,
                'article' => 'J2.2000',
            'name' => 'Пыльник ПО (наружный правый). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 461,
                'article' => 'J2.2100',
            'name' => 'Пыльник ПО (внутренний левый). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 462,
                'article' => 'J2.2200',
            'name' => 'Пыльник ПО (внутренний правый). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 463,
                'article' => 'J2.2300',
            'name' => 'Пыльники шарниров приводного вала (оба левых). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 464,
                'article' => 'J2.2400',
            'name' => 'Пыльники шарниров приводного вала (оба правых). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 465,
                'article' => 'J2.2500',
            'name' => 'Пыльники шарниров приводного вала (все). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 466,
                'article' => 'J2.2600',
                'name' => 'Полуось. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 467,
                'article' => 'J2.2600',
                'name' => 'Полуось. Правая. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 468,
                'article' => 'J2.2700',
            'name' => 'Полуоси (обе). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 469,
                'article' => 'J2.2800',
                'name' => 'Подшипник колеса переднего. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 470,
                'article' => 'J2.2801',
                'name' => 'Подшипник приводного вала. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 471,
                'article' => 'J2.2900',
            'name' => 'Подшипник колеса переднего(оба). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 472,
                'article' => 'J2.3000',
                'name' => 'Регулировка подшипника ступицы. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 473,
                'article' => 'J2.3100',
            'name' => 'Регулировка подшипника ступицы - (оба). Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 474,
                'article' => 'J2.3200',
                'name' => 'Ступица в сборе. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 475,
                'article' => 'J2.3300',
            'name' => 'Ступица в сборе (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 476,
                'article' => 'J3.0100',
                'name' => 'Задняя ось в сборе. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 477,
                'article' => 'J3.0200',
                'name' => 'Задняя ось в сборе. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 478,
                'article' => 'J3.0300',
                'name' => 'Главная передача. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 479,
                'article' => 'J3.0301',
                'name' => 'Главная передача. Замена масла.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 480,
                'article' => 'J3.0400',
                'name' => 'Главная передача. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 481,
                'article' => 'J3.0500',
                'name' => 'Главная передача. Сальник ведущей шестерни. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 482,
                'article' => 'J3.0700',
            'name' => 'Приводной вал (правый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 483,
                'article' => 'J3.0800',
            'name' => 'Приводной вал (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 484,
                'article' => 'J3.0900',
            'name' => 'Сальник приводного вала внутренний (левый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 485,
                'article' => 'J3.1000',
            'name' => 'Сальник приводного вала внутренний (правый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 486,
                'article' => 'J3.1100',
            'name' => 'Сальник приводного вала внутренний (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 487,
                'article' => 'J3.1200',
            'name' => 'Шарнир приводного вала (наружный левый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 488,
                'article' => 'J3.1300',
            'name' => 'Шарнир приводного вала (наружный правый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 489,
                'article' => 'J3.1400',
            'name' => 'Шарнир приводного вала (внутренний левый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 490,
                'article' => 'J3.1500',
            'name' => 'Шарнир приводного вала (внутренний правый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 491,
                'article' => 'J3.1600',
            'name' => 'Шарниры приводного вала (оба левых). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 492,
                'article' => 'J3.1700',
            'name' => 'Шарниры приводного вала (оба правых). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 493,
                'article' => 'J3.1800',
            'name' => 'Шарниры приводного вала (все). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 494,
                'article' => 'J3.1900',
            'name' => 'Пыльник шарнира приводного вала (наружный левый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 495,
                'article' => 'J3.2000',
            'name' => 'Пыльник шарнира приводного вала (наружный правый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 496,
                'article' => 'J3.2100',
            'name' => 'Пыльник шарнира приводного вала (внутренний левый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 497,
                'article' => 'J3.2200',
            'name' => 'Пыльник шарнира приводного вала (внутренний правый). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 498,
                'article' => 'J3.2300',
            'name' => 'Пыльники шарниров приводного вала (оба левых). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 499,
                'article' => 'J3.2400',
            'name' => 'Пыльники шарниров приводного вала (оба правых). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 500,
                'article' => 'J3.2500',
            'name' => 'Пыльники шарниров приводного вала (все). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
        ));
        \DB::table('services')->insert(array (
            
            array (
                'id' => 501,
                'article' => 'J3.2600',
                'name' => 'Полуось. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 502,
                'article' => 'J3.2700',
            'name' => 'Полуоси (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 503,
                'article' => 'J3.2800',
                'name' => 'Подшипник колеса заднего. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 504,
                'article' => 'J3.2801',
            'name' => 'Подшипник колеса заднего(оба). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 505,
                'article' => 'J3.2900',
            'name' => 'Подшипники колеса (все с обеих сторон). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 506,
                'article' => 'J3.3000',
                'name' => 'Регулировка подшипника ступицы. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 507,
                'article' => 'J3.3100',
            'name' => 'Регулировка подшипника ступицы - (оба). Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 508,
                'article' => 'J3.3200',
                'name' => 'Поворотная ось ступицы. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 509,
                'article' => 'J3.3300',
            'name' => 'Поворотная ось ступицы - (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 510,
                'article' => 'J3.3400',
                'name' => 'Ступица в сборе. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 511,
                'article' => 'J3.3500',
            'name' => 'Ступица в сборе (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'J',
            ),
            
            array (
                'id' => 512,
                'article' => 'K1.0000',
                'name' => 'СУ 1 амортизатора',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 513,
                'article' => 'K1.0100',
                'name' => 'Передняя подвеска в сборе. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 514,
                'article' => 'K1.0102',
                'name' => 'Диагностика ходовой',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 515,
                'article' => 'K1.0103',
                'name' => 'Диагностика автомобиля',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 516,
                'article' => 'K1.0200',
                'name' => 'Передняя подвеска в сборе. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 517,
                'article' => 'K1.0300',
                'name' => 'Передняя подвеска одна сторона. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 518,
                'article' => 'K1.0400',
                'name' => 'Передняя подвеска одна сторона. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 519,
                'article' => 'K1.0500',
                'name' => 'Клиренс. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 520,
                'article' => 'K1.0600',
                'name' => 'Подрамник передний. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 521,
                'article' => 'K1.0700',
                'name' => 'Подрамник. Крепление. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 522,
                'article' => 'K1.0800',
                'name' => 'Стойка в сборе. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 523,
                'article' => 'K1.0900',
            'name' => 'Стойка в сборе (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 524,
                'article' => 'K1.1000',
                'name' => 'Стойка в сборе. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 525,
                'article' => 'K1.1100',
            'name' => 'Стойка в сборе (обе). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 526,
                'article' => 'K1.1200',
                'name' => 'Стойка. Верхняя опора. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 527,
                'article' => 'K1.1300',
            'name' => 'Стойка. Верхняя опора - (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 528,
                'article' => 'K1.1400',
                'name' => 'Пружина. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 529,
                'article' => 'K1.1500',
            'name' => 'Пружина - (все). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 530,
                'article' => 'K1.1600',
            'name' => 'Амортизатор передний(один). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 531,
                'article' => 'K1.1700',
            'name' => 'Амортизатор передний(пара). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 532,
                'article' => 'K1.1800',
                'name' => 'Газо-жидкостный уравнитель. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 533,
                'article' => 'K1.1900',
            'name' => 'Газо-жидкостный уравнитель - (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 534,
                'article' => 'K1.2000',
                'name' => 'Подвеска. Верхний рычаг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 535,
                'article' => 'K1.2100',
            'name' => 'Подвеска. Верхний рычаг - (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 536,
                'article' => 'K1.2200',
            'name' => 'Сайлентблоки верхнего рычага(перед). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 537,
                'article' => 'K1.2300',
            'name' => 'Сайлентблоки верхнего рычага(перед/оба). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 538,
                'article' => 'K1.2400',
            'name' => 'Нижний рычаг(перед-один). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 539,
                'article' => 'K1.2500',
            'name' => 'Нижний рычаг(перед-оба). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 540,
                'article' => 'K1.2600',
            'name' => 'Сайлентблоки нижнего рычага(перед). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 541,
                'article' => 'K1.2700',
            'name' => 'Сайлентблоки нижнего рычага(перед/оба). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 542,
                'article' => 'K1.2800',
                'name' => 'Шаровая опора. Верхняя. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 543,
                'article' => 'K1.2900',
            'name' => 'Шаровая опора. Верхняя - (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 544,
                'article' => 'K1.3000',
                'name' => 'Шаровая опора. Нижняя. Одна. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 545,
                'article' => 'K1.3100',
            'name' => 'Шаровая опора. Нижняя - (обе). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 546,
                'article' => 'K1.3200',
                'name' => 'Толкающий рычаг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 547,
                'article' => 'K1.3300',
            'name' => 'Толкающий рычаг - (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 548,
                'article' => 'K1.3400',
                'name' => 'Толкающий рычаг. Втулка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 549,
                'article' => 'K1.3500',
            'name' => 'Толкающий рычаг. Втулка - (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 550,
                'article' => 'K1.3600',
                'name' => 'Стабилизатор поперечной устойчивости. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 551,
                'article' => 'K1.3700',
                'name' => 'Стабилизатор. Втулка внешняя. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 552,
                'article' => 'K1.3800',
            'name' => 'Стабилизатор. Втулка (одна). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 553,
                'article' => 'K1.3900',
            'name' => 'Стабилизатор. Втулки (обе). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 554,
                'article' => 'K1.4000',
            'name' => 'Стабилизатор. Тяга (одна). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 555,
                'article' => 'K1.4100',
            'name' => 'Стабилизатор. Тяга (обе). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 556,
                'article' => 'K1.4200',
                'name' => 'Подвеска. Поперечина. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 557,
                'article' => 'K1.4300',
            'name' => 'Подвеска. Поперечина - (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 558,
                'article' => 'K1.4400',
                'name' => 'Шарнир ступицы в сборе. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 559,
                'article' => 'K1.4500',
            'name' => 'Шарнир ступицы в сборе - (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 560,
                'article' => 'K1.4600',
            'name' => 'Шкворень - (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 561,
                'article' => 'K1.4700',
            'name' => 'Серьга рессоры - (передняя). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 562,
                'article' => 'K1.4800',
            'name' => 'Серьга рессоры - (задняя). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 563,
                'article' => 'K1.4900',
            'name' => 'Серьга рессоры - (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 564,
                'article' => 'K1.5000',
            'name' => 'Серьга рессоры - (обе стороны). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 565,
                'article' => 'K1.5100',
            'name' => 'Шкворень - (с одной стороны). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 566,
                'article' => 'K1.5200',
            'name' => 'Шкворень - (с обеих сторон). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K1',
            ),
            
            array (
                'id' => 567,
                'article' => 'K2.0100',
                'name' => 'Задняя подвеска в сборе. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 568,
                'article' => 'K2.0200',
                'name' => 'Задняя подвеска в сборе, включая ось. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 569,
                'article' => 'K2.0300',
                'name' => 'Задняя подвеска в сборе. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 570,
                'article' => 'K2.0400',
                'name' => 'Задняя подвеска в сборе, включая ось. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 571,
                'article' => 'K2.0500',
                'name' => 'Задняя подвеска одна сторона. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 572,
                'article' => 'K2.0600',
                'name' => 'Задняя подвеска одна сторона. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 573,
                'article' => 'K2.0700',
                'name' => 'Клиренс. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 574,
                'article' => 'K2.0800',
                'name' => 'Подрамник. Задний. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 575,
                'article' => 'K2.0900',
                'name' => 'Подрамник. Крепление. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 576,
                'article' => 'K2.1000',
                'name' => 'Стойка в сборе. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 577,
                'article' => 'K2.1100',
            'name' => 'Стойка в сборе (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 578,
                'article' => 'K2.1200',
                'name' => 'Стойка в сборе. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 579,
                'article' => 'K2.1300',
            'name' => 'Стойка в сборе (обе). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 580,
                'article' => 'K2.1400',
                'name' => 'Стойка. Верхняя опора. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 581,
                'article' => 'K2.1500',
            'name' => 'Стойка. Верхняя опора - (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 582,
                'article' => 'K2.1600',
                'name' => 'Пружина задней подвески. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 583,
                'article' => 'K2.1603',
            'name' => 'Пружина задняя(обе). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 584,
                'article' => 'K2.1800',
            'name' => 'Амортизатор задний(один). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 585,
                'article' => 'K2.1900',
            'name' => 'Амортизатор задний(пара). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 586,
                'article' => 'K2.1901',
                'name' => 'Амортизатор. Все. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 587,
                'article' => 'K2.2000',
                'name' => 'Газо-жидкостный уравнитель. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 588,
                'article' => 'K2.2100',
            'name' => 'Газо-жидкостный уравнитель - (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 589,
                'article' => 'K2.2200',
                'name' => 'Верхний рычаг. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 590,
                'article' => 'K2.2300',
            'name' => 'Верхний рычаг (оба). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 591,
                'article' => 'K2.2400',
                'name' => 'Верхний рычаг. Сайлентблок. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 592,
                'article' => 'K2.2500',
            'name' => 'Верхний рычаг(оба). Сайлентблок. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 593,
                'article' => 'K2.2501',
            'name' => 'Сайлентблоки верхнего рычага(зад/оба). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 594,
                'article' => 'K2.2600',
                'name' => 'Нижний рычаг. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 595,
                'article' => 'K2.2700',
            'name' => 'Нижний рычаг. Продольный (оба). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 596,
                'article' => 'K2.2800',
            'name' => 'Сайлентблоки нижнего рычага(зад/оба). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 597,
                'article' => 'K2.2900',
            'name' => 'Сайлентблоки нижнего рычага(зад). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 598,
                'article' => 'K2.3000',
                'name' => 'Шаровая опора. Верхняя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 599,
                'article' => 'K2.3100',
            'name' => 'Шаровая опора. Верхняя - (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 600,
                'article' => 'K2.3200',
                'name' => 'Шаровая опора. Нижняя. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 601,
                'article' => 'K2.3300',
                'name' => 'Шаровая опора. Нижняя. Обе. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 602,
                'article' => 'K2.3328',
                'name' => 'Сайлентблоки задней подвески. Замена.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 603,
                'article' => 'K2.3400',
                'name' => 'Сочленение ось-труба оси. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 604,
                'article' => 'K2.3500',
            'name' => 'Сочленение ось-труба оси (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 605,
                'article' => 'K2.3600',
                'name' => 'Поворотный рычаг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 606,
                'article' => 'K2.3700',
            'name' => 'Толкающий рычаг - (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 607,
                'article' => 'K2.3800',
                'name' => 'Толкающий рычаг. Втулка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 608,
                'article' => 'K2.3900',
            'name' => 'Толкающий рычаг. Втулка - (все). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 609,
                'article' => 'K2.4000',
                'name' => 'Подвеска. Поперечина - верхняя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 610,
                'article' => 'K2.4100',
            'name' => 'Подвеска. Поперечина - верхняя (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 611,
                'article' => 'K2.4200',
                'name' => 'Подвеска. Поперечина - нижняя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 612,
                'article' => 'K2.4300',
            'name' => 'Подвеска. Поперечина - нижняя (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 613,
                'article' => 'K2.4400',
                'name' => 'Реактивный рычаг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 614,
                'article' => 'K2.4500',
                'name' => 'Реактивный рычаг. Втулки. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 615,
                'article' => 'K2.4600',
                'name' => 'А - образный рычаг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 616,
                'article' => 'K2.4700',
                'name' => 'А - образный рычаг. Оба. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 617,
                'article' => 'K2.4800',
                'name' => 'Полунаправляющий рычаг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 618,
                'article' => 'K2.4900',
            'name' => 'Полунаправляющий рычаг - (оба). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 619,
                'article' => 'K2.5000',
                'name' => 'Стабилизатор поперечной устойчивости. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 620,
                'article' => 'K2.5100',
                'name' => 'Стабилизатор. Втулка внешняя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 621,
                'article' => 'K2.5200',
                'name' => 'Стабилизатор. Втулка центральная. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 622,
                'article' => 'K2.5300',
            'name' => 'Стабилизатор задний. Втулки (обе). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 623,
                'article' => 'K2.5400',
                'name' => 'Стабилизатор. Тяга внешняя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 624,
                'article' => 'K2.5500',
            'name' => 'Стабилизатор. Тяга внешняя (обе). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 625,
                'article' => 'K2.5600',
                'name' => 'Поперечная реактивная тяга жесткости. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 626,
                'article' => 'K2.5700',
            'name' => 'Поперечная реактивная тяга жесткости - (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 627,
                'article' => 'K2.5800',
                'name' => 'Поперечная реактивная тяга жесткости. Втулки. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 628,
                'article' => 'K2.5900',
                'name' => 'Рычаг Уатта. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 629,
                'article' => 'K2.6000',
                'name' => 'Рычаг Уатта. Втулки. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 630,
                'article' => 'K2.6100',
            'name' => 'Серьга рессоры - (передняя). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 631,
                'article' => 'K2.6200',
            'name' => 'Серьга рессоры - (задняя). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 632,
                'article' => 'K2.6300',
            'name' => 'Серьга рессоры - (обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 633,
                'article' => 'K2.6400',
            'name' => 'Серьга рессоры - (обе стороны). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'K2',
            ),
            
            array (
                'id' => 634,
                'article' => 'L1.0100',
            'name' => 'Геометрия установки колес (всех). Проверить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 635,
                'article' => 'L1.0200',
            'name' => 'Геометрия установки колес (всех). ПиИ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 636,
                'article' => 'L1.0300',
            'name' => 'Геометрия установки колес (передних). Проверить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 637,
                'article' => 'L1.0301',
            'name' => 'Геометрия установки колес (передних). Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 638,
                'article' => 'L1.0400',
            'name' => 'Геометрия установки колес (задних). Проверить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 639,
                'article' => 'L1.0500',
                'name' => 'Схождение передних колес. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 640,
                'article' => 'L1.0600',
                'name' => 'Схождение задних колес. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 641,
                'article' => 'L1.0900',
                'name' => 'Рулевое колесо. Угол наклона. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 642,
                'article' => 'L1.1000',
                'name' => 'Рулевое колесо. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 643,
                'article' => 'L2.0100',
                'name' => 'Зазор в рулевом механизме. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 644,
                'article' => 'L2.0200',
                'name' => 'Рулевая рейка. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 645,
                'article' => 'L2.0300',
                'name' => 'Рулевая рейка. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 646,
                'article' => 'L2.0400',
                'name' => 'Пыльник рейки. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 647,
                'article' => 'L2.0500',
            'name' => 'Пыльник рейки(оба). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 648,
                'article' => 'L2.0600',
                'name' => 'Откидная рукоятка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 649,
                'article' => 'L2.0700',
                'name' => 'Механизм предотвращения "клевка" при торможении. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 650,
                'article' => 'L2.0800',
                'name' => 'Механизм предотвращения "клевка" при торможении. Шарнир. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 651,
                'article' => 'L2.0900',
                'name' => 'Паразитный привод рулевого управления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 652,
                'article' => 'L2.1000',
                'name' => 'Маятниковый рычаг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 653,
                'article' => 'L2.1100',
                'name' => 'Рулевая тяга. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 654,
                'article' => 'L2.1200',
            'name' => 'Рулевая тяга(обе). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 655,
                'article' => 'L2.1300',
            'name' => 'Наконечник рулевой тяги(один). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 656,
                'article' => 'L2.1400',
            'name' => 'Наконечник рулевой тяги(оба). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 657,
                'article' => 'L2.1500',
                'name' => 'Амортизатор рулевого механизма. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 658,
                'article' => 'L2.1600',
                'name' => 'Рычаг управления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 659,
                'article' => 'L2.1700',
                'name' => 'Поворотный кулак. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 660,
                'article' => 'L2.1800',
            'name' => 'Поворотный кулак - (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 661,
                'article' => 'L2.1900',
                'name' => 'Поворотный кулак. Рычаг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 662,
                'article' => 'L2.2000',
            'name' => 'Поворотный кулак. Рычаг - (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 663,
                'article' => 'L2.2100',
            'name' => 'Шаровой шарнир - (верхний). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 664,
                'article' => 'L2.2200',
            'name' => 'Шаровой шарнир - (нижний). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 665,
                'article' => 'L2.2300',
            'name' => 'Шаровой шарнир - (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 666,
                'article' => 'L3.0300',
                'name' => 'Рулевая колонка. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 667,
                'article' => 'L3.0400',
                'name' => 'Рулевая колонка. Верхние втулки/вкладыши. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 668,
                'article' => 'L3.0500',
                'name' => 'Рулевая колонка. Нижние втулки/вкладыши. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 669,
                'article' => 'L3.0600',
                'name' => 'Рулевая колонка. Крестовина. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 670,
                'article' => 'L3.0800',
                'name' => 'Механизм отключения поворотов. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 671,
                'article' => 'L4.0100',
                'name' => 'Насос ГУР. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 672,
                'article' => 'L4.0101',
                'name' => 'Насос ГУР. Шкив. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 673,
                'article' => 'L4.0200',
                'name' => 'Насос. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 674,
                'article' => 'L4.0201',
                'name' => 'Ремень привода гидроусилителя с кондиционером. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 675,
                'article' => 'L4.0300',
                'name' => 'Насос. Муфта. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 676,
                'article' => 'L4.0400',
                'name' => 'Ремень привода гидроусилителя. Проверка натяжения.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 677,
                'article' => 'L4.0500',
                'name' => 'Ремень привода гидроусилителя с генератором. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 678,
                'article' => 'L4.0600',
                'name' => 'Гидроцилиндр силовой. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 679,
                'article' => 'L4.0700',
                'name' => 'Гидроцилиндр силовой. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 680,
                'article' => 'L4.0800',
                'name' => 'Бачок насоса гидроусилителя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 681,
                'article' => 'L4.0900',
                'name' => 'ГУР. Шланг высокого давления. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 682,
                'article' => 'L4.1000',
                'name' => 'ГУР. Шланг низкого давления. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 683,
                'article' => 'L4.1001',
                'name' => 'ГУР. Шланг высокого давления. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 684,
                'article' => 'L4.1100',
                'name' => 'Редукционный клапан. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 685,
                'article' => 'L4.1200',
                'name' => 'Замена датчика давления ГУР',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 686,
                'article' => 'L4.1300',
                'name' => 'Жидкость ГУР. Замена.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'L',
            ),
            
            array (
                'id' => 687,
                'article' => 'M1.0100',
                'name' => 'Жидкость тормозная. Прокачка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 688,
                'article' => 'M1.0200',
            'name' => 'Бак для жидкости (Раздельный). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 689,
                'article' => 'M1.0300',
                'name' => 'Главный тормозной цилиндр - правый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 690,
                'article' => 'M1.0400',
            'name' => 'Главный тормозной цилиндр(LHD). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 691,
                'article' => 'M1.0500',
                'name' => 'Главный тормозной цилиндр - правый руль. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 692,
                'article' => 'M1.0600',
                'name' => 'Главный тормозной цилиндр - левый руль. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 693,
                'article' => 'M1.0700',
            'name' => 'Передний рабочий тормозной цилиндр (один). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 694,
                'article' => 'M1.0800',
            'name' => 'Передний рабочий тормозной цилиндр (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 695,
                'article' => 'M1.0900',
            'name' => 'Передний рабочий тормозной цилиндр (один). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 696,
                'article' => 'M1.1000',
            'name' => 'Передний рабочий тормозной цилиндр (оба). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 697,
                'article' => 'M1.1100',
            'name' => 'Рабочий тормозной цилиндр задний(один). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 698,
                'article' => 'M1.1200',
            'name' => 'Рабочий тормозной цилиндр задний(оба). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 699,
                'article' => 'M1.1300',
            'name' => 'Задний рабочий тормозной цилиндр (один). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 700,
                'article' => 'M1.1400',
            'name' => 'Задний рабочий тормозной цилиндр (оба). Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 701,
                'article' => 'M1.1500',
            'name' => 'Суппорт тормоза - (один). Передний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 702,
                'article' => 'M1.1600',
            'name' => 'Суппорт тормоза - (оба). Передний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 703,
                'article' => 'M1.1700',
            'name' => 'Суппорт тормоза - (один). Передний. РС',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 704,
                'article' => 'M1.1800',
            'name' => 'Суппорт тормоза - (оба). Передний. РС',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 705,
                'article' => 'M1.1900',
            'name' => 'Суппорт тормоза - (один). Задний. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 706,
                'article' => 'M1.2000',
            'name' => 'Суппорт тормоза - (оба). Задний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 707,
                'article' => 'M1.2100',
            'name' => 'Суппорт тормоза - (один). Задний. РС',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 708,
                'article' => 'M1.2200',
            'name' => 'Суппорт тормоза - (оба). Задний. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 709,
                'article' => 'M1.2300',
            'name' => 'Передний тормозной шланг (один). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 710,
                'article' => 'M1.2400',
            'name' => 'Передний тормозной шланг (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 711,
                'article' => 'M1.2500',
            'name' => 'Задний тормозной шланг (один). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 712,
                'article' => 'M1.2600',
            'name' => 'Задний тормозной шланг (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 713,
                'article' => 'M1.2700',
                'name' => 'Тормозной шланг к задней оси. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 714,
                'article' => 'M1.2800',
                'name' => 'Компенсатор давления торможения то нагрузки. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 715,
                'article' => 'M1.2900',
                'name' => 'Регулятор тормозных усилий. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 716,
                'article' => 'M1.3000',
                'name' => 'Скоба переднего тормоза. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 717,
                'article' => 'M1.3100',
                'name' => 'Скоба заднего тормоза. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 718,
                'article' => 'M1.3168',
                'name' => 'Тормозной трубопровод. Замена',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 719,
                'article' => 'M1.3200',
                'name' => 'Смазка пальцев 2-х плавающих скоб тормоза',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 720,
                'article' => 'M2.0100',
                'name' => 'Колодки тормозные. Передние. Заменить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 721,
                'article' => 'M2.0200',
            'name' => 'Колодки тормозные. Задние(Барабан). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 722,
                'article' => 'M2.0300',
            'name' => 'Передние тормозные колодки (все). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 723,
                'article' => 'M2.0400',
            'name' => 'Колодки тормозные. Задние(Диск). Заменить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 724,
                'article' => 'M2.0500',
            'name' => 'Регулятор тормоза (один). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 725,
                'article' => 'M2.0600',
            'name' => 'Передний тормозной диск (оба). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 726,
                'article' => 'M2.0700',
            'name' => 'Задний тормозной диск (оба). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 727,
                'article' => 'M2.0701',
            'name' => 'Задний тормозной диск (один). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 728,
                'article' => 'M2.0800',
            'name' => 'Передний тормозной барабан (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 729,
                'article' => 'M2.0900',
            'name' => 'Задний тормозной барабан (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 730,
                'article' => 'M2.1000',
            'name' => 'Щит тормоза - (один). Передний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 731,
                'article' => 'M2.1100',
            'name' => 'Щит тормоза - (один). Задний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 732,
                'article' => 'M3.0100',
                'name' => 'Педаль в сборе - правый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 733,
                'article' => 'M3.0200',
                'name' => 'Педаль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 734,
                'article' => 'M3.0300',
                'name' => 'Педаль. Втулка. - правый руль Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 735,
                'article' => 'M3.0400',
                'name' => 'Педаль. Втулка. - левый руль Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 736,
                'article' => 'M3.0500',
                'name' => 'Педаль. Возвратная пружина. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 737,
                'article' => 'M3.0600',
                'name' => 'Усилитель тормозов - правый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 738,
                'article' => 'M3.0700',
                'name' => 'Усилитель тормозов - левый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 739,
                'article' => 'M3.0800',
                'name' => 'Усилитель тормозов - правый руль. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 740,
                'article' => 'M3.0900',
                'name' => 'Усилитель тормозов - левый руль. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 741,
                'article' => 'M3.1000',
                'name' => 'Усилитель тормозов. Воздушный фильтр. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 742,
                'article' => 'M3.1100',
                'name' => 'Усилитель тормозов.Запирающий клапан. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 743,
                'article' => 'M3.1200',
                'name' => 'Тяга усилителя. Главный тормозной цилиндр. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 744,
                'article' => 'M3.1300',
                'name' => 'Вакуумный шланг к коллектору. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 745,
                'article' => 'M3.1400',
            'name' => 'Вакуумный насос (дизель). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 746,
                'article' => 'M4.0107',
                'name' => 'Диагностика тормозной системы',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 747,
                'article' => 'M4.0200',
                'name' => 'Модулятор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 748,
                'article' => 'M4.0300',
                'name' => 'Датчик хода педали. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 749,
                'article' => 'M4.0400',
                'name' => 'Колесный датчик - передний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 750,
                'article' => 'M4.0500',
            'name' => 'Колесный датчик - передний (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 751,
                'article' => 'M4.0600',
            'name' => 'Колесный датчик - задний (один). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 752,
                'article' => 'M4.0700',
            'name' => 'Колесный датчик - задний (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 753,
                'article' => 'M4.0800',
            'name' => 'Колесный датчик. Зазор (один). Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 754,
                'article' => 'M4.0900',
            'name' => 'Колесный датчик. Зазор (все). Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 755,
                'article' => 'M4.1000',
            'name' => 'Аккумулятор (бачок). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 756,
                'article' => 'M4.1100',
                'name' => 'Привод. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 757,
                'article' => 'M4.1200',
                'name' => 'Бак для жидкости. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 758,
                'article' => 'M4.1300',
                'name' => 'Двигатель и насос - правый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 759,
                'article' => 'M4.1400',
                'name' => 'Двигатель и насос - левый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 760,
                'article' => 'M4.1500',
                'name' => 'Выключатель лампы индикации отсутствия давления в контуре. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 761,
                'article' => 'M4.1600',
                'name' => 'Давление. Редукционный клапан. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 762,
                'article' => 'M5.0100',
                'name' => 'Свободный ход. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 763,
                'article' => 'M5.0200',
                'name' => 'Рычаг стояночного тормоза. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 764,
                'article' => 'M5.0300',
            'name' => 'Трос первичный (один). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 765,
                'article' => 'M5.0400',
                'name' => 'Трос вторичный. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 766,
                'article' => 'M5.0500',
            'name' => 'Трос стояночного тормоза (один). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 767,
                'article' => 'M5.0505',
            'name' => 'Трос стояночного тормоза(оба). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 768,
                'article' => 'M5.0600',
                'name' => 'Компенсатор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 769,
                'article' => 'M5.0700',
                'name' => 'Стояночный тормоз. Колодки. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 770,
                'article' => 'M5.0800',
            'name' => 'Диски / барабаны (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 771,
                'article' => 'M5.0900',
                'name' => 'Стояночный тормоз. Регулировка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'M',
            ),
            
            array (
                'id' => 772,
                'article' => 'N0.0100',
                'name' => 'Программирование систем автомобиля',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 773,
                'article' => 'N0.0343',
                'name' => 'Блокировка ЭБУ подушек безопасности',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 774,
                'article' => 'N0.0450',
                'name' => 'Восстановление кода программирования',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 775,
                'article' => 'N0.CLIP',
                'name' => 'CLIP',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 776,
                'article' => 'N0.X431',
                'name' => 'X431',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 777,
                'article' => 'N1.0100',
                'name' => 'АКБ. Проверка/зарядка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 778,
                'article' => 'N1.0101',
            'name' => 'Ремонт подрулевого переключателя(правый)',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 779,
                'article' => 'N1.0102',
            'name' => 'Ремонт подрулевого переключателя(левый)',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 780,
                'article' => 'N1.0200',
                'name' => 'АКБ. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 781,
                'article' => 'N10.0100',
                'name' => 'Стеклоочистители. Двигатель передний. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 782,
                'article' => 'N10.0200',
                'name' => 'Двигатель омывателя. Переднего. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 783,
                'article' => 'N10.0300',
                'name' => 'Стеклоочистители. Двигатель задний. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 784,
                'article' => 'N10.0400',
                'name' => 'Двигатель омывателя. Заднего. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 785,
                'article' => 'N10.0500',
            'name' => 'Фара. Двигатель щеток (один). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 786,
                'article' => 'N10.0600',
            'name' => 'Фара. Двигатель омывателя (один). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 787,
                'article' => 'N10.0700',
                'name' => 'Стеклоподъемник - передний. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 788,
                'article' => 'N10.0800',
                'name' => 'Стеклоподъемник - задний. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 789,
                'article' => 'N10.0900',
                'name' => 'Двигатель люка крыши. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 790,
                'article' => 'N10.1000',
                'name' => 'Двигатель движения сиденья вперед/назад. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 791,
                'article' => 'N10.1100',
                'name' => 'Двигатель регулировки высоты сиденья. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 792,
                'article' => 'N10.1200',
                'name' => 'Двигатель регулировки наклона спинки переднего сиденья. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 793,
                'article' => 'N10.1300',
                'name' => 'Электропривод зеркал. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 794,
                'article' => 'N10.1400',
                'name' => 'Центральный замок. Привод передний. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 795,
                'article' => 'N10.1401',
                'name' => 'Центральный замок. Привод. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 796,
                'article' => 'N10.1403',
                'name' => 'Центральный замок. Ремонт',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 797,
                'article' => 'N10.1500',
                'name' => 'Центральный замок. Привод задний. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 798,
                'article' => 'N10.1600',
                'name' => 'Фара. Двигатель регулировки. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 799,
                'article' => 'N10.1700',
                'name' => 'Привод крышки горловины бака. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 800,
                'article' => 'N11.0100',
                'name' => 'Центральный процессор. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 801,
                'article' => 'N11.0200',
                'name' => 'Бортовой компьютер. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 802,
                'article' => 'N11.0300',
                'name' => 'Центральный замок. Блок управления. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 803,
                'article' => 'N12.0200',
                'name' => 'Бачок переднего омывателя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 804,
                'article' => 'N12.0300',
                'name' => 'Бачок заднего омывателя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 805,
                'article' => 'N12.0400',
                'name' => 'Форсунка омывателя. Переднего. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 806,
                'article' => 'N12.0500',
                'name' => 'Форсунка омывателя. Заднего. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 807,
                'article' => 'N13.0400',
                'name' => 'Аудиосистема. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 808,
                'article' => 'N13.0401',
                'name' => 'Аудиосистема. Настройка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 809,
                'article' => 'N14.0600',
                'name' => 'Насос стеклоомывателя. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 810,
                'article' => 'N14.0700',
                'name' => 'Чистка форсунок стеклоомывателя',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 811,
                'article' => 'N2.0100',
                'name' => 'Система зарядки. Проверить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 812,
                'article' => 'N2.0200',
                'name' => 'Генератор. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 813,
                'article' => 'N2.0300',
                'name' => 'Генератор. РС.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 814,
                'article' => 'N2.0400',
                'name' => 'Генератор. Шкив. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 815,
                'article' => 'N2.0500',
                'name' => 'Генератор. Ремень привода. Проверить и исправить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 816,
                'article' => 'N2.0600',
                'name' => 'Генератор. Ремень привода. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 817,
                'article' => 'N2.0700',
                'name' => 'Генератор. Регулятор. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 818,
                'article' => 'N2.0800',
                'name' => 'Регулятор напряжения. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 819,
                'article' => 'N3.0100',
                'name' => 'Стартер. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 820,
                'article' => 'N3.0200',
                'name' => 'Стартер. РС.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 821,
                'article' => 'N3.0300',
                'name' => 'Стартер - инерционный. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 822,
                'article' => 'N3.0400',
                'name' => 'Стартер - с зацеплением. Разобрать и собрать.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 823,
                'article' => 'N3.0500',
                'name' => 'Втягивающее реле. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 824,
                'article' => 'N4.0100',
            'name' => 'Лампа (одна). СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 825,
                'article' => 'N4.0200',
                'name' => 'Фара. Лампа. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 826,
                'article' => 'N4.0300',
            'name' => 'Блок задних фонарей - (лампы). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 827,
                'article' => 'N4.0400',
                'name' => 'Приборная панель. Лампа. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 828,
                'article' => 'N4.0500',
                'name' => 'Приборная панель. Подсветка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 829,
                'article' => 'N4.0600',
                'name' => 'Лампа волоконной оптики. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 830,
                'article' => 'N5.0000',
                'name' => 'Свет фар. Регулировка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 831,
                'article' => 'N5.0001',
                'name' => 'Свет фар. Ремонт.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 832,
                'article' => 'N5.0100',
                'name' => 'Фара. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 833,
                'article' => 'N5.0300',
            'name' => 'Фара(обе). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 834,
                'article' => 'N5.0400',
                'name' => 'Габаритные огни. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 835,
                'article' => 'N5.0500',
                'name' => 'Указатель поворотов - передний. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 836,
                'article' => 'N5.0600',
                'name' => 'Лампа повторителя поворота. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 837,
                'article' => 'N5.0700',
            'name' => 'ПТФ(одна). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 838,
                'article' => 'N5.0800',
                'name' => 'Фонарь задний в сборе. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 839,
                'article' => 'N5.0900',
                'name' => 'Фонарь задний. Печатная плата. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 840,
                'article' => 'N5.1000',
                'name' => 'Задние противотуманные фары. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 841,
                'article' => 'N5.1200',
                'name' => 'Лампа багажника. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 842,
                'article' => 'N5.1300',
            'name' => 'Противотуманная фара(одна). СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 843,
                'article' => 'N5.1400',
                'name' => 'Лампа освещения салона. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 844,
                'article' => 'N5.1500',
                'name' => 'Лампа перчаточного ящика. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 845,
                'article' => 'N6.0100',
                'name' => 'Переключатель стартер/зажигание. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 846,
                'article' => 'N6.0200',
                'name' => 'Переключатель указателя поворотов. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 847,
                'article' => 'N6.0300',
                'name' => 'Переключатель дальнего света. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 848,
                'article' => 'N6.0400',
                'name' => 'Переключатель ближний/дальний/вспышка. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 849,
                'article' => 'N6.0500',
                'name' => 'Звуковой сигнал. Переключатель. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 850,
                'article' => 'N6.0600',
                'name' => 'Переключатель омыватель/стеклоочиститель. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 851,
                'article' => 'N6.0700',
                'name' => 'Аварийные сигналы. Включатель. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 852,
                'article' => 'N6.0800',
                'name' => 'Переключатель ингибитора. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 853,
                'article' => 'N6.0900',
                'name' => 'Включатель заднего хода. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 854,
                'article' => 'N6.1000',
                'name' => 'Переключатель стоп-сигнала. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 855,
                'article' => 'N6.1100',
                'name' => 'Переключатель индикации стояночного тормоза. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 856,
                'article' => 'N7.0100',
                'name' => 'Стабилизатор напряжения. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 857,
                'article' => 'N7.0300',
                'name' => 'Приборная панель. Печатная плата. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 858,
                'article' => 'N7.0400',
            'name' => 'Приборная панель. Блок ЖКИ (LCD). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 859,
                'article' => 'N7.0500',
                'name' => 'Спидометр. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 860,
                'article' => 'N7.0600',
                'name' => 'Спидометр. Трос - правый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 861,
                'article' => 'N7.0700',
                'name' => 'Спидометр. Трос - левый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 862,
                'article' => 'N7.0800',
                'name' => 'Тахометр. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 863,
                'article' => 'N7.0900',
            'name' => 'Указатель уровня топлива (Отдельно). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 864,
                'article' => 'N7.1000',
            'name' => 'Индикатор температуры антифриза (отдельно). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 865,
                'article' => 'N7.1100',
            'name' => 'Индикатор температуры антифриза (комбинированный). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 866,
                'article' => 'N7.1200',
                'name' => 'Часы. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 867,
                'article' => 'N7.1300',
                'name' => 'Прикуриватель. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 868,
                'article' => 'N7.1400',
                'name' => 'Указатель параметров наддува. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 869,
                'article' => 'N8.0100',
                'name' => 'Звуковой сигнал. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 870,
                'article' => 'N8.0101',
                'name' => 'Звуковой сигнал. Ремонт.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 871,
                'article' => 'N8.0110',
                'name' => 'Звуковой сигнал. Установка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 872,
                'article' => 'N8.0200',
            'name' => 'Звуковой сигнал (оба). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 873,
                'article' => 'N8.0300',
                'name' => 'Датчик температуры масла. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 874,
                'article' => 'N8.0400',
                'name' => 'Датчик давления масла. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 875,
                'article' => 'N8.0500',
                'name' => 'Датчик спидометра. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 876,
                'article' => 'N8.0600',
                'name' => 'Датчик температуры антифриза. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 877,
                'article' => 'N8.0700',
                'name' => 'Датчик уровня топлива. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 878,
                'article' => 'N9.0100',
                'name' => 'Предохранитель. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 879,
                'article' => 'N9.0200',
                'name' => 'Плата реле. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 880,
                'article' => 'N9.0300',
                'name' => 'Плата реле и предохранителей. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 881,
                'article' => 'N9.0400',
                'name' => 'Фара. Реле. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 882,
                'article' => 'N9.0500',
            'name' => 'Реле дального света (отдельно). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 883,
                'article' => 'N9.0600',
            'name' => 'Реле ближнего света (отдельно). Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 884,
                'article' => 'N9.0700',
                'name' => 'Габаритные огни. Реле. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 885,
                'article' => 'N9.0800',
                'name' => 'Реле/прерыватель указателя поворота. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 886,
                'article' => 'N9.0900',
                'name' => 'Аварийные сигналы. Реле. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 887,
                'article' => 'N9.1000',
                'name' => 'Реле стартера. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 888,
                'article' => 'N9.1100',
                'name' => 'Свечи накаливания. Реле. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 889,
                'article' => 'N9.1200',
                'name' => 'Свечи накаливания. Реле времени. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 890,
                'article' => 'N9.1300',
                'name' => 'Реле предварительного нагрева впускного коллектора. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 891,
                'article' => 'N9.1400',
                'name' => 'Реле прерывистого движения щеток. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 892,
                'article' => 'N9.1500',
                'name' => 'Реле прерывателя заднего стеклоочистителя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 893,
                'article' => 'N9.1600',
                'name' => 'Реле заднего омывателя/стеклоочистителя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 894,
                'article' => 'N9.1601',
                'name' => 'Патрубок заднего омывателя. Ремонт.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 895,
                'article' => 'N9.1700',
                'name' => 'Фара. Реле омывателя/щеток. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 896,
                'article' => 'N9.1800',
                'name' => 'Реле электровентилятора. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 897,
                'article' => 'N9.1900',
                'name' => 'Реле обогревателя заднего стекла. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 898,
                'article' => 'N9.2000',
                'name' => 'Звуковой сигнал. Реле. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 899,
                'article' => 'N9.2100',
                'name' => 'Привод стеклоподъемника. Реле. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 900,
                'article' => 'N9.2200',
                'name' => 'Центральный замок. Блокирующее реле. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 901,
                'article' => 'N9.2300',
                'name' => 'Реле ABS. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 902,
                'article' => 'N9.2400',
                'name' => 'Реле насоса ABS. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 903,
                'article' => 'N9.2500',
                'name' => 'Реле обогревателя зеркал. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 904,
                'article' => 'N9.2600',
                'name' => 'Реле обогревателя лобового стекла. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 905,
                'article' => 'N9.2700',
                'name' => 'Лампа освещения салона. Задерживающее реле. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 906,
                'article' => 'N9.2701',
                'name' => 'Лампа освещения номерного знака. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 907,
                'article' => 'N9.2800',
                'name' => 'Реле топливного насоса. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'N',
            ),
            
            array (
                'id' => 908,
                'article' => 'P1.0100',
                'name' => 'Блок отопителя салона. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 909,
                'article' => 'P1.0200',
                'name' => 'Обогреватель. Шланг от двигателя. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 910,
                'article' => 'P1.0300',
                'name' => 'Обогреватель. Шланг к двигателю. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 911,
                'article' => 'P1.0400',
                'name' => 'Обогреватель. Управляющий рычаг. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 912,
                'article' => 'P1.0500',
                'name' => 'Обогреватель. Тросы и тяги управления. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 913,
                'article' => 'P1.0600',
                'name' => 'Радиатор обогревателя - правый руль. Снять и установить.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 914,
                'article' => 'P1.0700',
                'name' => 'Радиатор обогревателя - левый руль. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 915,
                'article' => 'P1.0800',
                'name' => 'Двигатель вентилятора печки. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 916,
                'article' => 'P1.0900',
                'name' => 'Фильтр вентиляции салона. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 917,
                'article' => 'P1.1500',
                'name' => 'Чистка кондиционера',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 918,
                'article' => 'P1.2000',
                'name' => 'Диагностика системы кондиционирования',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 919,
                'article' => 'P2.0201',
                'name' => 'Кондиционер. Ремонт.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 920,
                'article' => 'P2.1000',
                'name' => 'Компрессор кондиционера. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 921,
                'article' => 'P2.1001',
                'name' => 'Компрессор кондиционера.Муфта. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 922,
                'article' => 'P2.1800',
                'name' => 'Компрессор кондиционера. Подшипник. Замена.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 923,
                'article' => 'P2.1900',
                'name' => 'Конденсор. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 924,
                'article' => 'P2.2200',
                'name' => 'Испаритель. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 925,
                'article' => 'P2.2900',
                'name' => 'Кондиционер. Датчик давления. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 926,
                'article' => 'P2.3200',
                'name' => 'Чистка дренажного отверстия',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'P',
            ),
            
            array (
                'id' => 927,
                'article' => 'P2.BOSCH',
                'name' => 'Кондиционер. Слив - заправка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => 'P2.0200',
                'group' => 'P',
            ),
            
            array (
                'id' => 928,
                'article' => 'R1.0100',
                'name' => 'Бампер передний. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 929,
                'article' => 'R1.0200',
                'name' => 'Бампер передний. РС',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 930,
                'article' => 'R1.0300',
                'name' => 'Бампер передний. Замена.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 931,
                'article' => 'R1.0400',
                'name' => 'Бампер передний. Окраска.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 932,
                'article' => 'R1.9997',
                'name' => 'Полировка крышки капота',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 933,
                'article' => 'R2.0400',
                'name' => 'Крыло переднее. Рихтовка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 934,
                'article' => 'R4.1400',
                'name' => 'Замена троса привода замка капота',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 935,
                'article' => 'R5.0500',
                'name' => 'Крыло переднее правое. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 936,
                'article' => 'R5.0600',
                'name' => 'Крыло переднее. Окраска.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 937,
                'article' => 'R5.1300',
                'name' => 'Подкрылок передний. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 938,
                'article' => 'R7.0100',
                'name' => 'Стекло ветровое. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 939,
                'article' => 'R7.0101',
                'name' => 'Стекло боковое преднее. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 940,
                'article' => 'R7.0102',
                'name' => 'Стекло заднее. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 941,
                'article' => 'R7.0103',
                'name' => 'Стекло боковое заднее. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'R',
            ),
            
            array (
                'id' => 942,
                'article' => 'S1.0300',
                'name' => 'Дверь. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'S',
            ),
            
            array (
                'id' => 943,
                'article' => 'S1.0400',
                'name' => 'Дверь. РС',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'S',
            ),
            
            array (
                'id' => 944,
                'article' => 'S1.2700',
                'name' => 'Замок боковой двери. Замена',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'S',
            ),
            
            array (
                'id' => 945,
                'article' => 'S1.2900',
                'name' => 'Ручка двери наружная. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'S',
            ),
            
            array (
                'id' => 946,
                'article' => 'S1.3000',
                'name' => 'Наружное зеркало заднего вида. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'S',
            ),
            
            array (
                'id' => 947,
                'article' => 'S1.3001',
                'name' => 'Наружное зеркало заднего вида. Стекло. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'S',
            ),
            
            array (
                'id' => 948,
                'article' => 'S1.5033',
                'name' => 'Ограничитель открытия двери. Замена',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'S',
            ),
            
            array (
                'id' => 949,
                'article' => 'S1.6314',
                'name' => 'Панель порога. Окраска.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'S',
            ),
            
            array (
                'id' => 950,
                'article' => 'S1.9971',
                'name' => 'Дверь передняя. Окраска.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'S',
            ),
            
            array (
                'id' => 951,
                'article' => 'S2.9992',
                'name' => 'Рихтовка порога',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'S',
            ),
            
            array (
                'id' => 952,
                'article' => 'S3.0100',
                'name' => 'Центральная консоль. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'S',
            ),
            
            array (
                'id' => 953,
                'article' => 'SU.0000',
                'name' => 'Доставка запчастей',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 954,
                'article' => 'SU.0100',
                'name' => 'Поставка расходных материалов',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 955,
                'article' => 'SU.0200',
            'name' => 'Мойка узлов и агрегатов(подряд)',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 956,
                'article' => 'SU.0201',
            'name' => 'Кондиционер. Ремонт(подряд)',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 957,
                'article' => 'SU.0201',
            'name' => 'Ремонт узлов и агрегатов(подряд)',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 958,
                'article' => 'SU.0300',
            'name' => 'Ремонт головки блока цилиндров(подряд)',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 959,
                'article' => 'SU.0400',
            'name' => 'Ремонт рулевой рейки(подряд)',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 961,
                'article' => 'SU.0600',
                'name' => 'Расточка блока цилиндров',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 962,
                'article' => 'SU.0601',
                'name' => 'Расточка постелей коленчатого вала',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 963,
                'article' => 'SU.0700',
            'name' => 'Изготовление чипа IMMO(подряд)',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 964,
                'article' => 'SU.0700',
                'name' => 'Шлифовка коленчатого вала двигателя',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 965,
                'article' => 'SU.0800',
                'name' => 'Восстановление вилки 5-ой передачи',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 966,
                'article' => 'SU.0900',
                'name' => 'Шлифовка стаканов клапанов',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 967,
                'article' => 'SU.1000',
                'name' => 'Ремонт стартера',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 968,
                'article' => 'SU.1001',
                'name' => 'Ремонт генератора',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 969,
                'article' => 'SU.1100',
                'name' => 'Кузовной ремонт, покраска автомобиля',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 970,
                'article' => 'SU.1300',
                'name' => 'Турбокомпрессор. Ремонт.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'SU',
            ),
            
            array (
                'id' => 973,
                'article' => 'T1.0100',
                'name' => 'Бампер задний. СУ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'T',
            ),
            
            array (
                'id' => 974,
                'article' => 'T1.0200',
                'name' => 'Бампер задний. РС.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'T',
            ),
            
            array (
                'id' => 975,
                'article' => 'T1.0400',
                'name' => 'Бампер задний. Окраска.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'T',
            ),
            
            array (
                'id' => 976,
                'article' => 'T1.0500',
                'name' => 'Бампер задний. Восстановление.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'T',
            ),
            
            array (
                'id' => 977,
                'article' => 'T1.0600',
                'name' => 'Бампер задний. Полировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'T',
            ),
            
            array (
                'id' => 978,
                'article' => 'T1.9991',
                'name' => 'Рихтовка задней панели',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'T',
            ),
            
            array (
                'id' => 979,
                'article' => 'T3.0300',
                'name' => 'Крышка багажника. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'T',
            ),
            
            array (
                'id' => 980,
                'article' => 'T3.0400',
                'name' => 'Крышка багажника. Окраска.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'T',
            ),
            
            array (
                'id' => 981,
                'article' => 'W1.0100',
                'name' => 'Шиномонтаж колес',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 982,
                'article' => 'W1.0200',
                'name' => 'Перестановка колеса',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 983,
                'article' => 'W1.0300',
                'name' => 'Ремонт шины UP3',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 984,
                'article' => 'W1.0301',
                'name' => 'Ремонт шины UP4,5',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 985,
                'article' => 'W1.0412',
                'name' => 'Колесо. 12". Балансировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 986,
                'article' => 'W1.0413',
                'name' => 'Колесо. 13". Балансировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 987,
                'article' => 'W1.0414',
                'name' => 'Колесо. 14". Балансировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 988,
                'article' => 'W1.0415',
                'name' => 'Колесо. 15". Балансировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 989,
                'article' => 'W1.0416',
                'name' => 'Колесо. 16". Балансировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 990,
                'article' => 'W1.0500',
                'name' => 'Рихтовка колеса',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 991,
                'article' => 'W1.0600',
                'name' => 'Ремонт бокового пореза',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 992,
                'article' => 'W1.1413',
                'name' => 'Колесо. 13". Балансировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 993,
                'article' => 'W1.1414',
                'name' => 'Колесо. 14". Балансировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 994,
                'article' => 'W1.1415',
                'name' => 'Колесо. 15". Балансировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 995,
                'article' => 'W1.1416',
                'name' => 'Колесо. 16". Балансировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 996,
                'article' => 'W1.1417',
                'name' => 'Колесо. 17". Балансировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 997,
                'article' => 'W1.1418',
                'name' => 'Колесо. 18". Балансировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 998,
                'article' => 'W1.1419',
                'name' => 'Колесо. 19". Балансировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 999,
                'article' => 'W1.1420',
                'name' => 'Колесо. 20". Балансировка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 1000,
                'article' => 'W1.AL13',
                'name' => 'Шиномонтаж легкосплав 13\'\'',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 1001,
                'article' => 'W1.AL14',
                'name' => 'Шиномонтаж легкосплав 14\'\'',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 1002,
                'article' => 'W1.AL15',
                'name' => 'Шиномонтаж легкосплав 15"',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 1003,
                'article' => 'W1.AL16',
                'name' => 'Шиномонтаж легкосплав 16"',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
        ));
        \DB::table('services')->insert(array (
            
            array (
                'id' => 1004,
                'article' => 'W1.AL17',
                'name' => 'Шиномонтаж легкосплав 17"',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 1005,
                'article' => 'W1.AL18',
                'name' => 'Шиномонтаж легкосплав 18\'\'',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 1006,
                'article' => 'W1.AL19',
                'name' => 'Шиномонтаж легкосплав 19\'\'',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 1007,
                'article' => 'W1.AL20',
                'name' => 'Шиномонтаж легкосплав 20\'\'',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 1008,
                'article' => 'W1.ST13',
                'name' => 'Шиномонтаж сталь 13\'\'',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 1009,
                'article' => 'W1.ST14',
                'name' => 'Шиномонтаж сталь 14\'\'',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 1010,
                'article' => 'W1.ST15',
                'name' => 'Шиномонтаж сталь 15\'\'',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 1011,
                'article' => 'W1.ST16',
                'name' => 'Шиномонтаж сталь 16\'\'',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 1012,
                'article' => 'W1.ST17',
                'name' => 'Шиномонтаж сталь 17\'\'',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'W',
            ),
            
            array (
                'id' => 1013,
                'article' => 'Z1.0000',
                'name' => 'Мелкий ремонт',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1014,
                'article' => 'Z1.0010',
                'name' => 'Сварочные работы',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1015,
                'article' => 'Z1.0048',
                'name' => 'ТО. Стандартное.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1016,
                'article' => 'Z1.0100',
                'name' => 'Установка датчика удара',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1017,
                'article' => 'Z1.0101',
                'name' => 'Слесарные работы',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1018,
                'article' => 'Z1.0102',
                'name' => 'Токарные работы',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1019,
                'article' => 'Z1.0125',
                'name' => 'Ремонт электропроводки',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1020,
                'article' => 'Z1.0129',
                'name' => 'Дорожное испытание. Простое',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1021,
                'article' => 'Z1.0145',
                'name' => 'Дорожное испытание. Сокращенное.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1022,
                'article' => 'Z1.0161',
                'name' => 'Сигнализация. Отключение.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1023,
                'article' => 'Z1.0200',
                'name' => 'Установка антенны',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1024,
                'article' => 'Z1.0300',
                'name' => 'Установка накладки',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1025,
                'article' => 'Z1.0400',
                'name' => 'Электрооборудование. Ремонт.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1026,
                'article' => 'Z1.0401',
                'name' => 'Установка чехлов из ткани',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1027,
                'article' => 'Z1.0408',
                'name' => 'Электрооборудование. Диагностика.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1028,
                'article' => 'Z1.0500',
                'name' => 'Установка протвотуманных фар',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1029,
                'article' => 'Z1.0501',
                'name' => 'Установка BEAR-LOCK',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1030,
                'article' => 'Z1.0514',
                'name' => 'ТО. Расширенное.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1031,
                'article' => 'Z1.0600',
                'name' => 'Установка зеркала',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1032,
                'article' => 'Z1.0800',
                'name' => 'Сигнализация. Установка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1033,
                'article' => 'Z1.0810',
                'name' => 'Сигнализация с турботаймером. Установка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1034,
                'article' => 'Z1.0820',
                'name' => 'Сигнализация с автозапуском. Установка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1035,
                'article' => 'Z1.0900',
                'name' => 'Парковочный радар. Установка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1036,
                'article' => 'Z1.1000',
                'name' => 'Установка датчика объема',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1037,
                'article' => 'Z1.1100',
                'name' => 'Установка защиты',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1038,
                'article' => 'Z1.1200',
                'name' => 'Доводчик. Установка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1039,
                'article' => 'Z1.1265',
                'name' => 'Сигнализация. Ремонт.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1040,
                'article' => 'Z1.1266',
                'name' => 'Сигнализация. Программирование.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1041,
                'article' => 'Z1.1299',
                'name' => 'Восстановление резьбы',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1042,
                'article' => 'Z1.1300',
                'name' => 'Установка динамиков',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1043,
                'article' => 'Z1.1400',
                'name' => 'Установка автомузыки',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1044,
                'article' => 'Z1.1500',
                'name' => 'Установка стеклоподъемников',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1045,
                'article' => 'Z1.1600',
                'name' => 'Установка ГБО',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1046,
                'article' => 'Z1.1700',
                'name' => 'Ксенон. Установка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1047,
                'article' => 'Z1.1701',
                'name' => 'Ксенон. Ремонт',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1048,
                'article' => 'Z1.1705',
                'name' => 'LED лампы. Установка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1049,
                'article' => 'Z1.1800',
                'name' => 'Автомагнитола. Установка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1050,
                'article' => 'Z1.1801',
                'name' => 'Автомагнитола. СУ.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1051,
                'article' => 'Z1.1806',
                'name' => 'Автомагнитола. Ремонт.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1052,
                'article' => 'Z1.1900',
                'name' => 'Сабвуфер. Установка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1053,
                'article' => 'Z1.1941',
                'name' => 'Ролик ремня навесного оборудования. Замена',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1054,
                'article' => 'Z1.1999',
                'name' => 'Ненормированные работы',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1055,
                'article' => 'Z1.2000',
                'name' => 'Видеорегистратор. Установка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1056,
                'article' => 'Z1.2100',
                'name' => 'Камера заднего хода. Установка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1057,
                'article' => 'Z1.2101',
                'name' => 'Установка брызговиков',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1058,
                'article' => 'Z1.2500',
                'name' => 'Установка навигатора',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1059,
                'article' => 'Z1.2600',
                'name' => 'Установка подкрылков',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1060,
                'article' => 'Z1.2800',
                'name' => 'Установка защиты радиатора',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1061,
                'article' => 'Z1.2900',
                'name' => 'Установка центрального замка',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1062,
                'article' => 'Z1.3000',
                'name' => 'Прокладка проводки',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1063,
                'article' => 'Z1.3100',
                'name' => 'Фильтр салона. Установка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1064,
                'article' => 'Z1.3200',
                'name' => 'Установка фаркопа',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1065,
                'article' => 'Z1.3300',
                'name' => 'Стеклоподъемник. Ремонт',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1066,
                'article' => 'Z1.3301',
                'name' => 'Стеклоподъемник. Кнопка. Ремонт',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1067,
                'article' => 'Z1.3350',
                'name' => 'Кнопка двери. Замена.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1068,
                'article' => 'Z1.5130',
                'name' => 'Электрооборудование. Подключение.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1069,
                'article' => 'Z1.5991',
                'name' => 'Стекло. Ремонт трещины.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1070,
                'article' => 'Z1.5992',
                'name' => 'Стекло. Ремонт скола.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1071,
                'article' => 'Z1.6000',
                'name' => 'Ветровики. Установка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1072,
                'article' => 'Z1.7777',
                'name' => 'Стекло. Снятие тонировки.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1073,
                'article' => 'Z1.8300',
                'name' => 'Установка декоративных дуг',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1074,
                'article' => 'Z1.8301',
                'name' => 'Установка декоративных накладок',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1075,
                'article' => 'Z1.8800',
                'name' => 'Тонирование. Автомобиль. Полностью.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1076,
                'article' => 'Z1.8801',
                'name' => 'Тонирование. Автомобиль. Задняя часть.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1077,
                'article' => 'Z1.8881',
                'name' => 'Тонирование. Лобовое стекло.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1078,
                'article' => 'Z1.8882',
                'name' => 'Тонирование. Два передних стекла.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1079,
                'article' => 'Z1.8883',
                'name' => 'Тонирование. Одно стекло.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1080,
                'article' => 'Z1.9009',
                'name' => 'Поклейка молдингов',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1081,
                'article' => 'Z1.9010',
                'name' => 'Поклейка наклеек',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1082,
                'article' => 'Z1.9903',
                'name' => 'Замок. Регулировка.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1083,
                'article' => 'Z1.9904',
                'name' => 'Ремонт зеркала',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1084,
                'article' => 'Z1.9905',
                'name' => 'Ремонт обогревателя салона',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1085,
                'article' => 'Z1.9908',
                'name' => 'Подбор краски',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1086,
                'article' => 'Z1.9999',
                'name' => 'Шумоизоляция автомобиля',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1087,
                'article' => 'Z1.DRL',
                'name' => 'Установка ходовых огней',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1088,
                'article' => 'Z4.1500',
                'name' => 'Вывоз стекла',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1089,
                'article' => 'Z4.9999',
                'name' => 'Выходной',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
            
            array (
                'id' => 1090,
                'article' => 'ZZ.1411',
                'name' => 'Замена датчика',
                'created_at' => NULL,
                'updated_at' => NULL,
                'comment' => NULL,
                'group' => 'Z',
            ),
        ));
        
        
    }
}