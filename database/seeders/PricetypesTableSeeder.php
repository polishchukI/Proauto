<?php

use App\Models\Inventory\Pricetype;

use Illuminate\Database\Seeder;

class PricetypesTableSeeder extends Seeder
{
    public function run()
    {
        Pricetype::create(['price_type' => 'Розничный','price_discount' => '0','price_view' => '1','created_at' => now(),'updated_at' => now()]);
        Pricetype::create(['price_type' => 'Оптовый','price_discount' => '-10','price_view' => '2','created_at' => now(),'updated_at' => now()]);
        Pricetype::create(['price_type' => 'Партнер','price_discount' => '-12','price_view' => '2','created_at' => now(),'updated_at' => now()]);
        Pricetype::create(['price_type' => 'Дилер','price_discount' => '-15','price_view' => '2','created_at' => now(),'updated_at' => now()]);
        Pricetype::create(['price_type' => 'Менеджер','price_discount' => '-20','price_view' => '2','created_at' => now(),'updated_at' => now()]);
        Pricetype::create(['price_type' => 'Распродажа','price_discount' => '0','price_view' => '1','created_at' => now(),'updated_at' => now()]);
    }
}
