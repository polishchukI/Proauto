<?php

use App\Models\Inventory\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
	 *'US Dollar','USD','$','1!0.00','1',1,'2020-02-03 08:15:02','2020-05-18 14:00:00',NULL
	 *'Euro','EUR','€','1!0.00','0.921044',1,'2020-02-03 08:15:02','2020-05-18 14:00:00',NULL
	 *'Russian Ruble','RUB','P','1!0.00','72.7565',1,'2020-02-03 08:15:02','2020-05-18 14:00:00',NULL
	 *'Ukraine, Hryvnia','UAH','₴','1!0.00','26.572922',1,'2020-02-03 08:15:02','2020-05-18 14:00:00',NULL
     */
    public function run()
    {
        Currency::create(['name' => 'US Dollar','code' => 'USD','symbol' => '$','format' => '1!0.00','exchange_rate' => '1','active' => '1','created_at' => now(),'updated_at' => now()]);
        Currency::create(['name' => 'Euro','code' => 'EUR','symbol' => '€','format' => '1!0.00','exchange_rate' => '0.921044','active' => '1','created_at' => now(),'updated_at' => now()]);
        Currency::create(['name' => 'Russian Ruble','code' => 'RUB','symbol' => 'P','format' => '1!0.00','exchange_rate' => '72.7565','active' => '1','created_at' => now(),'updated_at' => now()]);
        Currency::create(['name' => 'Ukraine, Hryvnia','code' => 'UAH','symbol' => '₴','format' => '1!0.00','exchange_rate' => '26.572922','active' => '1','created_at' => now(),'updated_at' => now()]);
    }
}
