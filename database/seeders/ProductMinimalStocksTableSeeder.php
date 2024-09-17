<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductMinimalStocksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_minimal_stocks')->delete();
        
        \DB::table('product_minimal_stocks')->insert(array (
            
            array (
                'id' => 1,
                'product_id' => 353,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-02-02 06:28:46',
                'updated_at' => '2024-02-02 17:08:12',
            ),
            
            array (
                'id' => 4,
                'product_id' => 531,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 08:11:14',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 5,
                'product_id' => 322,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 09:08:43',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 6,
                'product_id' => 543,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-02-02 12:52:21',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 7,
                'product_id' => 542,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-02-02 12:53:34',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 8,
                'product_id' => 106,
                'warehouse_id' => 1,
                'quantity' => 4,
                'created_at' => '2024-02-02 13:46:38',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 9,
                'product_id' => 544,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-02-02 15:39:56',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 10,
                'product_id' => 68,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-02-02 16:42:23',
                'updated_at' => '2024-02-02 16:42:35',
            ),
            
            array (
                'id' => 11,
                'product_id' => 77,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 16:43:06',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 12,
                'product_id' => 121,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-02-02 16:43:31',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 13,
                'product_id' => 133,
                'warehouse_id' => 1,
                'quantity' => 4,
                'created_at' => '2024-02-02 16:43:48',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 14,
                'product_id' => 316,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 16:45:29',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 15,
                'product_id' => 302,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 16:45:47',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 16,
                'product_id' => 281,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 16:46:04',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 17,
                'product_id' => 257,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-02-02 16:46:18',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 18,
                'product_id' => 216,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 16:46:34',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 19,
                'product_id' => 215,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 16:46:49',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 20,
                'product_id' => 149,
                'warehouse_id' => 1,
                'quantity' => 5,
                'created_at' => '2024-02-02 17:06:52',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 21,
                'product_id' => 340,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 17:08:03',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 22,
                'product_id' => 404,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 17:08:24',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 23,
                'product_id' => 428,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 17:08:35',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 24,
                'product_id' => 429,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 17:08:44',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 25,
                'product_id' => 436,
                'warehouse_id' => 1,
                'quantity' => 10,
                'created_at' => '2024-02-02 17:08:53',
                'updated_at' => '2024-03-02 17:08:53',
            ),
            
            array (
                'id' => 26,
                'product_id' => 325,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 17:10:09',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 27,
                'product_id' => 320,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 17:10:18',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 31,
                'product_id' => 541,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 18:53:45',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 32,
                'product_id' => 549,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-02-02 19:10:45',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 33,
                'product_id' => 534,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 19:19:29',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 34,
                'product_id' => 422,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 19:22:18',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 35,
                'product_id' => 551,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 19:29:34',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 36,
                'product_id' => 552,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-02 19:38:29',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 37,
                'product_id' => 553,
                'warehouse_id' => 1,
                'quantity' => 4,
                'created_at' => '2024-02-02 19:44:40',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 38,
                'product_id' => 556,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-03 13:32:20',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 39,
                'product_id' => 562,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-04 05:27:09',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 40,
                'product_id' => 573,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-02-05 04:23:40',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 41,
                'product_id' => 575,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-05 14:57:24',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 42,
                'product_id' => 577,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-05 18:55:20',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 43,
                'product_id' => 587,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-09 08:36:17',
                'updated_at' => '2024-02-09 08:36:31',
            ),
            
            array (
                'id' => 44,
                'product_id' => 586,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-02-09 08:36:57',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 45,
                'product_id' => 588,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-09 09:16:16',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 46,
                'product_id' => 589,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-02-09 09:34:18',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 47,
                'product_id' => 602,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-02-14 04:42:14',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 48,
                'product_id' => 629,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-02-18 19:14:05',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 49,
                'product_id' => 538,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-02-18 19:15:47',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 59,
                'product_id' => 3,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-04-12 13:24:21',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 60,
                'product_id' => 1122,
                'warehouse_id' => 1,
                'quantity' => 2,
                'created_at' => '2024-07-02 04:44:56',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 61,
                'product_id' => 768,
                'warehouse_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-07-02 05:10:33',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 62,
                'product_id' => 354,
                'warehouse_id' => 1,
                'quantity' => 12,
                'created_at' => '2024-07-08 12:04:11',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}