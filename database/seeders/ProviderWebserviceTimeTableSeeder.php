<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProviderWebserviceTimeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('provider_webservice_time')->delete();
        
        \DB::table('provider_webservice_time')->insert(array (
            
            array (
                'wsid' => 2,
                'time' => 1701196506,
                'pkey' => '25185276',
                'sid' => '',
            ),
            
            array (
                'wsid' => 2,
                'time' => 1701196509,
                'pkey' => '25185276',
                'sid' => '',
            ),
            
            array (
                'wsid' => 2,
                'time' => 1701197285,
                'pkey' => '25185276',
                'sid' => '',
            ),
            
            array (
                'wsid' => 2,
                'time' => 1701245922,
                'pkey' => '03D198819A',
                'sid' => '',
            ),
            
            array (
                'wsid' => 2,
                'time' => 1701245940,
                'pkey' => '03D198819A',
                'sid' => '',
            ),
        ));
        
        
    }
}