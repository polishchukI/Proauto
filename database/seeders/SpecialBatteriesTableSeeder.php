<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SpecialBatteriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('special_batteries')->delete();
        
        \DB::table('special_batteries')->insert(array (
            
            array (
                'id' => 1,
                'article' => '0092S30050',
                'akey' => '0092S30050',
                'brand' => 'BOSCH',
                'bkey' => 'BOSCH',
                'pkey' => 'BOSCH0092S30050',
                'voltage' => '12',
                'capacity' => '56',
                'polarity' => NULL,
                'starting_current' => '480',
                'width' => '245',
                'height' => '175',
                'length' => '190',
            ),
        ));
        
        
    }
}