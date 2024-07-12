<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ProductCategoriesTableSeeder::class);
        $this->call(ProductGroupsTableSeeder::class);
        $this->call(ProductPriceGroupsTableSeeder::class);
		$this->call(CurrenciesTableSeeder::class);
		$this->call(BrandsTableSeeder::class);
        $this->call(BlogCategoriesTableSeeder::class);
        $this->call(BlogPostsTableSeeder::class);
		$this->call(BlogPostsTagsTableSeeder::class);
		$this->call(BlogTagsTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);
        $this->call(PricetypesTableSeeder::class);
        $this->call(WarehousesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(ClientAutoColorsTableSeeder::class);
        $this->call(CatalogGroupsTableSeeder::class);
        
    }
}
