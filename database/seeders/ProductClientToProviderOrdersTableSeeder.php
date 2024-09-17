<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductClientToProviderOrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_client_to_provider_orders')->delete();
        
        \DB::table('product_client_to_provider_orders')->insert(array (
            
            array (
                'id' => 20,
                'product_id' => 591,
                'quantity' => 1.0,
                'client_order_id' => 88,
                'to_provider_order_id' => 102,
                'created_at' => '2024-02-12 14:05:43',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 21,
                'product_id' => 590,
                'quantity' => 1.0,
                'client_order_id' => 88,
                'to_provider_order_id' => 102,
                'created_at' => '2024-02-12 14:05:43',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 26,
                'product_id' => 239,
                'quantity' => 1.0,
                'client_order_id' => 88,
                'to_provider_order_id' => 103,
                'created_at' => '2024-02-12 19:11:32',
                'updated_at' => '2024-02-12 19:11:32',
            ),
            
            array (
                'id' => 27,
                'product_id' => 522,
                'quantity' => 1.0,
                'client_order_id' => 89,
                'to_provider_order_id' => 104,
                'created_at' => '2024-02-13 13:30:48',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 28,
                'product_id' => 584,
                'quantity' => 1.0,
                'client_order_id' => 90,
                'to_provider_order_id' => 105,
                'created_at' => '2024-02-13 13:39:38',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 29,
                'product_id' => 604,
                'quantity' => 1.0,
                'client_order_id' => 91,
                'to_provider_order_id' => 106,
                'created_at' => '2024-02-14 07:27:01',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 30,
                'product_id' => 68,
                'quantity' => 2.0,
                'client_order_id' => 92,
                'to_provider_order_id' => 107,
                'created_at' => '2024-02-14 14:03:53',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 31,
                'product_id' => 606,
                'quantity' => 1.0,
                'client_order_id' => 92,
                'to_provider_order_id' => 107,
                'created_at' => '2024-02-14 14:03:53',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 32,
                'product_id' => 614,
                'quantity' => 1.0,
                'client_order_id' => 82,
                'to_provider_order_id' => 109,
                'created_at' => '2024-02-18 13:38:22',
                'updated_at' => '2024-02-18 13:38:22',
            ),
            
            array (
                'id' => 33,
                'product_id' => 635,
                'quantity' => 1.0,
                'client_order_id' => 93,
                'to_provider_order_id' => 110,
                'created_at' => '2024-02-20 20:11:05',
                'updated_at' => '2024-02-20 20:11:06',
            ),
            
            array (
                'id' => 34,
                'product_id' => 632,
                'quantity' => 1.0,
                'client_order_id' => 93,
                'to_provider_order_id' => 110,
                'created_at' => '2024-02-20 20:11:07',
                'updated_at' => '2024-02-20 20:11:07',
            ),
            
            array (
                'id' => 35,
                'product_id' => 563,
                'quantity' => 1.0,
                'client_order_id' => 93,
                'to_provider_order_id' => 110,
                'created_at' => '2024-02-20 20:11:08',
                'updated_at' => '2024-02-20 20:11:08',
            ),
            
            array (
                'id' => 36,
                'product_id' => 394,
                'quantity' => 1.0,
                'client_order_id' => 93,
                'to_provider_order_id' => 110,
                'created_at' => '2024-02-20 20:11:09',
                'updated_at' => '2024-02-20 20:11:09',
            ),
            
            array (
                'id' => 37,
                'product_id' => 611,
                'quantity' => 1.0,
                'client_order_id' => 93,
                'to_provider_order_id' => 110,
                'created_at' => '2024-02-20 20:11:10',
                'updated_at' => '2024-02-20 20:11:10',
            ),
            
            array (
                'id' => 38,
                'product_id' => 565,
                'quantity' => 1.0,
                'client_order_id' => 93,
                'to_provider_order_id' => 110,
                'created_at' => '2024-02-20 20:11:11',
                'updated_at' => '2024-02-20 20:11:11',
            ),
            
            array (
                'id' => 39,
                'product_id' => 643,
                'quantity' => 4.0,
                'client_order_id' => 94,
                'to_provider_order_id' => 111,
                'created_at' => '2024-02-23 17:12:11',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 40,
                'product_id' => 230,
                'quantity' => 1.0,
                'client_order_id' => 94,
                'to_provider_order_id' => 111,
                'created_at' => '2024-02-23 17:12:11',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 41,
                'product_id' => 645,
                'quantity' => 1.0,
                'client_order_id' => 94,
                'to_provider_order_id' => 111,
                'created_at' => '2024-02-23 17:12:11',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 42,
                'product_id' => 195,
                'quantity' => 1.0,
                'client_order_id' => 95,
                'to_provider_order_id' => 114,
                'created_at' => '2024-02-27 11:03:18',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 43,
                'product_id' => 673,
                'quantity' => 2.0,
                'client_order_id' => 96,
                'to_provider_order_id' => 114,
                'created_at' => '2024-02-27 12:21:15',
                'updated_at' => '2024-02-27 12:21:15',
            ),
            
            array (
                'id' => 44,
                'product_id' => 674,
                'quantity' => 2.0,
                'client_order_id' => 96,
                'to_provider_order_id' => 114,
                'created_at' => '2024-02-27 12:21:21',
                'updated_at' => '2024-02-27 12:21:21',
            ),
            
            array (
                'id' => 45,
                'product_id' => 675,
                'quantity' => 2.0,
                'client_order_id' => 96,
                'to_provider_order_id' => 114,
                'created_at' => '2024-02-27 12:21:24',
                'updated_at' => '2024-02-27 12:21:24',
            ),
            
            array (
                'id' => 46,
                'product_id' => 211,
                'quantity' => 1.0,
                'client_order_id' => 97,
                'to_provider_order_id' => 114,
                'created_at' => '2024-02-27 12:21:25',
                'updated_at' => '2024-02-27 12:21:25',
            ),
            
            array (
                'id' => 47,
                'product_id' => 676,
                'quantity' => 1.0,
                'client_order_id' => 97,
                'to_provider_order_id' => 114,
                'created_at' => '2024-02-27 12:21:26',
                'updated_at' => '2024-02-27 12:21:26',
            ),
            
            array (
                'id' => 48,
                'product_id' => 677,
                'quantity' => 1.0,
                'client_order_id' => 97,
                'to_provider_order_id' => 114,
                'created_at' => '2024-02-27 12:21:28',
                'updated_at' => '2024-02-27 12:21:28',
            ),
            
            array (
                'id' => 52,
                'product_id' => 212,
                'quantity' => 1.0,
                'client_order_id' => 97,
                'to_provider_order_id' => 115,
                'created_at' => '2024-02-27 12:23:08',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 53,
                'product_id' => 679,
                'quantity' => 1.0,
                'client_order_id' => 97,
                'to_provider_order_id' => 115,
                'created_at' => '2024-02-27 12:23:08',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 54,
                'product_id' => 685,
                'quantity' => 1.0,
                'client_order_id' => 99,
                'to_provider_order_id' => 116,
                'created_at' => '2024-02-27 13:37:56',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 55,
                'product_id' => 686,
                'quantity' => 4.0,
                'client_order_id' => 99,
                'to_provider_order_id' => 116,
                'created_at' => '2024-02-27 13:37:56',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 56,
                'product_id' => 687,
                'quantity' => 1.0,
                'client_order_id' => 99,
                'to_provider_order_id' => 116,
                'created_at' => '2024-02-27 13:37:56',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 57,
                'product_id' => 427,
                'quantity' => 1.0,
                'client_order_id' => 99,
                'to_provider_order_id' => 116,
                'created_at' => '2024-02-27 13:37:56',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 58,
                'product_id' => 662,
                'quantity' => 4.0,
                'client_order_id' => 100,
                'to_provider_order_id' => 119,
                'created_at' => '2024-02-28 14:29:48',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 59,
                'product_id' => 663,
                'quantity' => 1.0,
                'client_order_id' => 100,
                'to_provider_order_id' => 119,
                'created_at' => '2024-02-28 14:29:48',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 60,
                'product_id' => 667,
                'quantity' => 1.0,
                'client_order_id' => 100,
                'to_provider_order_id' => 119,
                'created_at' => '2024-02-28 14:29:48',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 61,
                'product_id' => 668,
                'quantity' => 1.0,
                'client_order_id' => 100,
                'to_provider_order_id' => 119,
                'created_at' => '2024-02-28 14:29:49',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 62,
                'product_id' => 670,
                'quantity' => 1.0,
                'client_order_id' => 100,
                'to_provider_order_id' => 119,
                'created_at' => '2024-02-28 14:29:49',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 63,
                'product_id' => 690,
                'quantity' => 1.0,
                'client_order_id' => 100,
                'to_provider_order_id' => 119,
                'created_at' => '2024-02-28 14:29:49',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 64,
                'product_id' => 691,
                'quantity' => 2.0,
                'client_order_id' => 101,
                'to_provider_order_id' => 120,
                'created_at' => '2024-02-28 15:56:44',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 65,
                'product_id' => 692,
                'quantity' => 2.0,
                'client_order_id' => 101,
                'to_provider_order_id' => 120,
                'created_at' => '2024-02-28 15:56:44',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 66,
                'product_id' => 669,
                'quantity' => 1.0,
                'client_order_id' => 102,
                'to_provider_order_id' => 121,
                'created_at' => '2024-03-01 08:05:48',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 67,
                'product_id' => 702,
                'quantity' => 1.0,
                'client_order_id' => 102,
                'to_provider_order_id' => 121,
                'created_at' => '2024-03-01 08:05:48',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 68,
                'product_id' => 701,
                'quantity' => 1.0,
                'client_order_id' => 102,
                'to_provider_order_id' => 121,
                'created_at' => '2024-03-01 08:05:48',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 69,
                'product_id' => 703,
                'quantity' => 1.0,
                'client_order_id' => 102,
                'to_provider_order_id' => 121,
                'created_at' => '2024-03-01 08:05:48',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 70,
                'product_id' => 695,
                'quantity' => 4.0,
                'client_order_id' => 103,
                'to_provider_order_id' => 122,
                'created_at' => '2024-03-03 14:31:04',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 71,
                'product_id' => 696,
                'quantity' => 1.0,
                'client_order_id' => 103,
                'to_provider_order_id' => 122,
                'created_at' => '2024-03-03 14:31:04',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 72,
                'product_id' => 208,
                'quantity' => 1.0,
                'client_order_id' => 103,
                'to_provider_order_id' => 122,
                'created_at' => '2024-03-03 14:31:04',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 73,
                'product_id' => 697,
                'quantity' => 1.0,
                'client_order_id' => 103,
                'to_provider_order_id' => 122,
                'created_at' => '2024-03-03 14:31:04',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 74,
                'product_id' => 698,
                'quantity' => 1.0,
                'client_order_id' => 103,
                'to_provider_order_id' => 122,
                'created_at' => '2024-03-03 14:31:04',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 75,
                'product_id' => 700,
                'quantity' => 1.0,
                'client_order_id' => 103,
                'to_provider_order_id' => 122,
                'created_at' => '2024-03-03 14:31:04',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 76,
                'product_id' => 707,
                'quantity' => 1.0,
                'client_order_id' => 103,
                'to_provider_order_id' => 122,
                'created_at' => '2024-03-03 14:31:04',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 77,
                'product_id' => 479,
                'quantity' => 1.0,
                'client_order_id' => 103,
                'to_provider_order_id' => 122,
                'created_at' => '2024-03-03 14:31:04',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 78,
                'product_id' => 710,
                'quantity' => 1.0,
                'client_order_id' => 104,
                'to_provider_order_id' => 123,
                'created_at' => '2024-03-04 08:51:03',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 79,
                'product_id' => 719,
                'quantity' => 1.0,
                'client_order_id' => 105,
                'to_provider_order_id' => 124,
                'created_at' => '2024-03-10 06:56:13',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 80,
                'product_id' => 720,
                'quantity' => 1.0,
                'client_order_id' => 105,
                'to_provider_order_id' => 124,
                'created_at' => '2024-03-10 06:56:13',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 81,
                'product_id' => 759,
                'quantity' => 2.0,
                'client_order_id' => 106,
                'to_provider_order_id' => 125,
                'created_at' => '2024-03-19 09:01:01',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 82,
                'product_id' => 785,
                'quantity' => 2.0,
                'client_order_id' => 108,
                'to_provider_order_id' => 126,
                'created_at' => '2024-03-26 09:16:49',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 83,
                'product_id' => 764,
                'quantity' => 1.0,
                'client_order_id' => 108,
                'to_provider_order_id' => 126,
                'created_at' => '2024-03-26 09:16:49',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 84,
                'product_id' => 787,
                'quantity' => 1.0,
                'client_order_id' => 108,
                'to_provider_order_id' => 126,
                'created_at' => '2024-03-26 09:16:49',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 85,
                'product_id' => 788,
                'quantity' => 2.0,
                'client_order_id' => 108,
                'to_provider_order_id' => 126,
                'created_at' => '2024-03-26 09:16:49',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 86,
                'product_id' => 834,
                'quantity' => 2.0,
                'client_order_id' => 109,
                'to_provider_order_id' => 127,
                'created_at' => '2024-04-08 14:30:32',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 87,
                'product_id' => 835,
                'quantity' => 1.0,
                'client_order_id' => 109,
                'to_provider_order_id' => 127,
                'created_at' => '2024-04-08 14:30:32',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 88,
                'product_id' => 836,
                'quantity' => 1.0,
                'client_order_id' => 109,
                'to_provider_order_id' => 127,
                'created_at' => '2024-04-08 14:30:32',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 89,
                'product_id' => 837,
                'quantity' => 2.0,
                'client_order_id' => 109,
                'to_provider_order_id' => 127,
                'created_at' => '2024-04-08 14:30:32',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 90,
                'product_id' => 838,
                'quantity' => 2.0,
                'client_order_id' => 109,
                'to_provider_order_id' => 127,
                'created_at' => '2024-04-08 14:30:32',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 91,
                'product_id' => 839,
                'quantity' => 2.0,
                'client_order_id' => 109,
                'to_provider_order_id' => 127,
                'created_at' => '2024-04-08 14:30:32',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 92,
                'product_id' => 840,
                'quantity' => 1.0,
                'client_order_id' => 109,
                'to_provider_order_id' => 127,
                'created_at' => '2024-04-08 14:30:32',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 93,
                'product_id' => 841,
                'quantity' => 1.0,
                'client_order_id' => 109,
                'to_provider_order_id' => 127,
                'created_at' => '2024-04-08 14:30:32',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 94,
                'product_id' => 848,
                'quantity' => 1.0,
                'client_order_id' => 109,
                'to_provider_order_id' => 127,
                'created_at' => '2024-04-08 14:30:32',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 95,
                'product_id' => 854,
                'quantity' => 1.0,
                'client_order_id' => 109,
                'to_provider_order_id' => 127,
                'created_at' => '2024-04-08 14:30:32',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 96,
                'product_id' => 855,
                'quantity' => 1.0,
                'client_order_id' => 109,
                'to_provider_order_id' => 127,
                'created_at' => '2024-04-08 14:30:32',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 97,
                'product_id' => 856,
                'quantity' => 2.0,
                'client_order_id' => 110,
                'to_provider_order_id' => 128,
                'created_at' => '2024-04-08 14:35:07',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 98,
                'product_id' => 211,
                'quantity' => 1.0,
                'client_order_id' => 112,
                'to_provider_order_id' => 129,
                'created_at' => '2024-04-10 10:10:08',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 99,
                'product_id' => 760,
                'quantity' => 1.0,
                'client_order_id' => 112,
                'to_provider_order_id' => 129,
                'created_at' => '2024-04-10 10:10:08',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 100,
                'product_id' => 761,
                'quantity' => 1.0,
                'client_order_id' => 112,
                'to_provider_order_id' => 129,
                'created_at' => '2024-04-10 10:10:08',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 101,
                'product_id' => 501,
                'quantity' => 1.0,
                'client_order_id' => 112,
                'to_provider_order_id' => 129,
                'created_at' => '2024-04-10 10:10:08',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 102,
                'product_id' => 865,
                'quantity' => 1.0,
                'client_order_id' => 112,
                'to_provider_order_id' => 129,
                'created_at' => '2024-04-10 10:10:08',
                'updated_at' => NULL,
            ),
            
            array (
                'id' => 103,
                'product_id' => 942,
                'quantity' => 1.0,
                'client_order_id' => 113,
                'to_provider_order_id' => 130,
                'created_at' => '2024-05-03 12:12:02',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}