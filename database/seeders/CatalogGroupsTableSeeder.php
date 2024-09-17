<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CatalogGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('catalog_groups')->delete();
        
        \DB::table('catalog_groups')->insert(array (
            
            array (
                'id' => 1,
                'name' => 'passenger',
                'description' => 'PassengerParts',
                'isactive' => 'True',
            ),
            
            array (
                'id' => 2,
                'name' => 'commercial',
                'description' => 'CommercialParts',
                'isactive' => 'True',
            ),
            
            array (
                'id' => 3,
                'name' => 'motorbike',
                'description' => 'MotorcycleParts',
                'isactive' => 'True',
            ),
            
            array (
                'id' => 4,
                'name' => 'engine',
                'description' => 'EngineParts',
                'isactive' => 'False',
            ),
            
            array (
                'id' => 5,
                'name' => 'axle',
                'description' => 'AxleParts',
                'isactive' => 'False',
            ),
        ));
        
        
    }
}