<?php

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
            0 => 
            array (
                'id' => 1,
                'name' => 'passenger',
                'description' => 'PassengerParts',
                'isactive' => 'True',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'commercial',
                'description' => 'CommercialParts',
                'isactive' => 'True',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'motorbike',
                'description' => 'MotorcycleParts',
                'isactive' => 'True',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'engine',
                'description' => 'EngineParts',
                'isactive' => 'True',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'axle',
                'description' => 'AxleParts',
                'isactive' => 'True',
            ),
        ));
        
        
    }
}