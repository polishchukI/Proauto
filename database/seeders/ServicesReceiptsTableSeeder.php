<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicesReceiptsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('services_receipts')->delete();
        
        \DB::table('services_receipts')->insert(array (
            
            array (
                'id' => 1,
                'currency' => 'RUB',
                'total_amount' => '1250.00',
                'warehouse_id' => 1,
                'provider_id' => 9,
                'provider_doc_number' => NULL,
                'provider_doc_date' => NULL,
                'barcode' => '2023 12 01 000009',
                'user_id' => 1,
                'reference_type' => NULL,
                'reference_id' => NULL,
                'finalized_at' => '2023-12-02 19:59:16',
                'created_at' => '2023-12-01 18:29:09',
                'updated_at' => '2023-12-02 19:59:16',
                'comment' => NULL,
            ),
        ));
        
        
    }
}