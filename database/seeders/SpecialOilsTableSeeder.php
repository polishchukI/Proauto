<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SpecialOilsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('special_oils')->delete();
        
        \DB::table('special_oils')->insert(array (
            
            array (
                'id' => 2,
                'article' => '159823',
                'akey' => '159823',
                'brand' => 'ELF',
                'bkey' => 'ELF',
                'name' => 'Evolution 700 ST',
                'type' => '1',
                'image' => NULL,
                'volume' => 4.0,
                'acea' => NULL,
                'sae' => '10W40',
                'oem' => NULL,
                'api' => 'SL/CF',
                'astm' => NULL,
                'ilsac' => NULL,
                'jaso' => NULL,
                'nato' => NULL,
                'global' => NULL,
                'zf' => NULL,
                'basis' => NULL,
            ),
            
            array (
                'id' => 3,
                'article' => 'XFFP4L',
                'akey' => 'XFFP4L',
                'brand' => 'COMMA',
                'bkey' => 'COMMA',
                'name' => 'XFLOW TYPE F PLUS',
                'type' => '1',
                'image' => NULL,
                'volume' => 4.0,
                'acea' => NULL,
                'sae' => '5W40',
                'oem' => NULL,
                'api' => NULL,
                'astm' => NULL,
                'ilsac' => NULL,
                'jaso' => NULL,
                'nato' => NULL,
                'global' => NULL,
                'zf' => NULL,
                'basis' => NULL,
            ),
        ));
        
        
    }
}