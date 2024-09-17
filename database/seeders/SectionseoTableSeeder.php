<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SectionseoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sectionseo')->delete();
        
        \DB::table('sectionseo')->insert(array (
            
            array (
                'id' => 1,
                'sec_id' => 10105,
                'lng_code' => 4,
                'sec_seo' => '<p>Car filters are the devices which main purpose is to remove impurities in the different systems of the vehicle.</p>',
                'sec_seo_header' => 'Filters car parts - all important information about operating method, mounting, diagnostics and service life',
                'sec_seo_types' => '<strong>Types of filters</strong><ul><li><strong>Air filter.</strong> Cleans the air entering the engine. Air filter is a part of air intake system.</li><li><strong>Fuel filter.</strong> It filters the fuel entering the engine. It is part of the fuel system.</li><li><strong>Cabin air filter.</strong> Removes contaminants from the air circulating in the cabin of the vehicle. It is a part of heating and air conditioning systems.</li><li><strong>Oil filter.</strong> Performs cleaning of gear, engine and lubricating oils. It is one of the components of the lubrication system.</li><li><strong>Hydraulic Filter.</strong> Removes contaminants from the hydraulic fluid. It is a part of transmission.</li><li><strong>Particulate filter.</strong> It cleans the exhaust gas from the soot and other contaminants. It is an element of the exhaust system of cars with diesel engines.</li></ul>',
                'seo_service_life' => '<strong>Filter service life</strong><p>We will try to answer very clearly on the most actual question, "In what time interval do I have to change the filter?".</p><ul><li>Replacement of the oil filter is to carry out every 10 000-15 000 km mileage.</li><li>Ideally, the service life of the air filter is 10 000 kilometers mileage, but if the vehicle is used in difficult operating conditions, the replacement of the filter can be carried out every 5 000-7 000 km.</li><li>Do not forget to replace the cabin filter, this should be carried out every 10 000 km.</li><li>It is necessary to change the fuel filter every 25 000-30 000 km.</li><li>The diesel particulate filter has an endless potential, it is designed for the life of the exhaust system.</li><li>Hydraulic filter is to be replaced after 10 000 km.</li></ul>',
                'sec_seo_failures' => '<strong>Filters failure</strong><ul><li>clogging of the filter;</li><li>malfunction.</li></ul>',
                'sec_seo_causes_failure' => '<strong>Causes of filters failures</strong><ul><li>fuel, oils, liquid quality;</li><li>level of air contamination;</li><li>operating conditions;</li><li>mechanical damage;</li><li>violation of the limiting operation terms;</li><li>not following time intervals between services;</li><li>incorrect repairs or replacement;</li><li>quality of filter components;</li><li>low competence in selecting filters.</li></ul>',
                'sec_seo_replacement' => '<strong>Filter replacement</strong><p>How do I change the filter? You no longer need to spend time searching for the answer to this question - we did it for you.</p><p>Filter malfunction means that it is time to buy a new part. Replacement of the filter is the only way out in this situation.</p><p>In order to replace air filter by yourself, you need to order a new item in our online shop, open the casing cover, dispose of the old filter, install a new one, close the casing cover, close the hood.</p><p>In order to change fuel filter, you need to turn off the fuel pump fuse, remove the fasteners of the filter protection block, disconnect clamp and fixations from this item, recycle old spare part, replace it by a new one, connect fixations and clamp, screw the protection block, turn on the fuse.</p><p>As a rule, the cabin filter replacement does not take a lot of time and effort. To get access to this detail at most part of vehicles you need only to remove the glove box, unscrew the filter housing and replace the old item to a new one.</p><p>As for hydraulic and oil filters replacement, it is better to let professionals do it. This will allows you not only to save your time but also save you from quite dirty and tiring process.</p>',
                'sec_seo_buy' => '<strong>Buy on our website - buy with us</strong><p>To buy a filter, you do not even need to leave the house. You open our website, you find the filter you need in the most complete filter catalogue, you make an order and arrange the delivery, and we will bring the item to your place in the shortest time possible. In order that you were calm and confident, we provide all the products available on our Internet site with guarantee. To buy spare parts online on our site is fast, convenient and profitable.  If you have any further questions, support service team is always ready to help and provide you with comprehensive information. Treat yourself with a comfortable shopping!</p>',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            
            array (
                'id' => 2,
                'sec_id' => 10105,
                'lng_code' => 16,
                'sec_seo' => '<p>Автомобильные фильтры - это устройства, основной целью которых является удаление загрязнений в различных системах автомобиля.</p>',
                'sec_seo_header' => 'Автозапчасть фильтры - вся важная информация о способе эксплуатации, монтаже, диагностике и сроке службы',
                'sec_seo_types' => '<strong>Типы фильтров</strong><ul><li><strong>Воздушный фильтр. </strong> Очищает воздух поступающий в двигатель. Является частью впускной системы.</li><li><strong>Топливный фильтр.</strong> Очищает топливо поступающее в двигатель. Является частью топливной системы.</li><li><strong>Салонный фильтр. </strong> Очищает воздух поступающий и циркулирующий в слоне автомобиля. Является частью системы кондиционирования и вентиляции салона.</li><li><strong>Масляный фильтр.</strong> Очищает масло, которое смазывает шестерни, двигатель. Является частью систем смазки агрегатов.</li><li><strong>Hydraulic Filter.</strong> Removes contaminants from the hydraulic fluid. It is a part of transmission.</li><li><strong>Particulate filter.</strong> It cleans the exhaust gas from the soot and other contaminants. It is an element of the exhaust system of cars with diesel engines.</li></ul>',
                'seo_service_life' => '<strong>Filter service life</strong><p>We will try to answer very clearly on the most actual question, "In what time interval do I have to change the filter?".</p><ul><li>Replacement of the oil filter is to carry out every 10 000-15 000 km mileage.</li><li>Ideally, the service life of the air filter is 10 000 kilometers mileage, but if the vehicle is used in difficult operating conditions, the replacement of the filter can be carried out every 5 000-7 000 km.</li><li>Do not forget to replace the cabin filter, this should be carried out every 10 000 km.</li><li>It is necessary to change the fuel filter every 25 000-30 000 km.</li><li>The diesel particulate filter has an endless potential, it is designed for the life of the exhaust system.</li><li>Hydraulic filter is to be replaced after 10 000 km.</li></ul>',
                'sec_seo_failures' => '<strong>Filters failure</strong><ul><li>clogging of the filter;</li><li>malfunction.</li></ul>',
                'sec_seo_causes_failure' => '<strong>Causes of filters failures</strong><ul><li>fuel, oils, liquid quality;</li><li>level of air contamination;</li><li>operating conditions;</li><li>mechanical damage;</li><li>violation of the limiting operation terms;</li><li>not following time intervals between services;</li><li>incorrect repairs or replacement;</li><li>quality of filter components;</li><li>low competence in selecting filters.</li></ul>',
                'sec_seo_replacement' => '<strong>Filter replacement</strong><p>How do I change the filter? You no longer need to spend time searching for the answer to this question - we did it for you.</p><p>Filter malfunction means that it is time to buy a new part. Replacement of the filter is the only way out in this situation.</p><p>In order to replace air filter by yourself, you need to order a new item in our online shop, open the casing cover, dispose of the old filter, install a new one, close the casing cover, close the hood.</p><p>In order to change fuel filter, you need to turn off the fuel pump fuse, remove the fasteners of the filter protection block, disconnect clamp and fixations from this item, recycle old spare part, replace it by a new one, connect fixations and clamp, screw the protection block, turn on the fuse.</p><p>As a rule, the cabin filter replacement does not take a lot of time and effort. To get access to this detail at most part of vehicles you need only to remove the glove box, unscrew the filter housing and replace the old item to a new one.</p><p>As for hydraulic and oil filters replacement, it is better to let professionals do it. This will allows you not only to save your time but also save you from quite dirty and tiring process.</p>',
                'sec_seo_buy' => '<strong>Buy on our website - buy with us</strong><p>To buy a filter, you do not even need to leave the house. You open our website, you find the filter you need in the most complete filter catalogue, you make an order and arrange the delivery, and we will bring the item to your place in the shortest time possible. In order that you were calm and confident, we provide all the products available on our Internet site with guarantee. To buy spare parts online on our site is fast, convenient and profitable.  If you have any further questions, support service team is always ready to help and provide you with comprehensive information. Treat yourself with a comfortable shopping!</p>',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}