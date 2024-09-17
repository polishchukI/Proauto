<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            
            array (
                'id' => 1,
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => 1,
            ),
            
            array (
                'id' => 2,
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 1,
            ),
            
            array (
                'id' => 3,
                'migration' => '2019_08_19_000000_create_failed_jobs_table',
                'batch' => 1,
            ),
            
            array (
                'id' => 4,
                'migration' => '2019_11_02_214601_create_clients_table_migration',
                'batch' => 1,
            ),
            
            array (
                'id' => 5,
                'migration' => '2019_11_03_032131_create_products_categories_table_migration',
                'batch' => 1,
            ),
            
            array (
                'id' => 6,
                'migration' => '2019_11_03_032233_create_products_table_migration',
                'batch' => 1,
            ),
            
            array (
                'id' => 7,
                'migration' => '2019_11_04_000745_create_payment_methods_table_migration',
                'batch' => 1,
            ),
            
            array (
                'id' => 8,
                'migration' => '2019_11_04_001238_create_sales_table_migration',
                'batch' => 1,
            ),
            
            array (
                'id' => 9,
                'migration' => '2019_11_04_001246_create_sold_products_table_migration',
                'batch' => 1,
            ),
            
            array (
                'id' => 11,
                'migration' => '2019_12_23_065221_create_transfers_table',
                'batch' => 1,
            ),
            
            array (
                'id' => 12,
                'migration' => '2019_12_24_001440_create_transactions_table_migration',
                'batch' => 1,
            ),
            
            array (
                'id' => 13,
                'migration' => '2020_01_15_193356_create_receipts_table',
                'batch' => 1,
            ),
            
            array (
                'id' => 16,
                'migration' => '2020_03_01_000000_create_warehouses_table',
                'batch' => 2,
            ),
            
            array (
                'id' => 17,
                'migration' => '2020_03_01_141256_create_currencies_table',
                'batch' => 2,
            ),
            
            array (
                'id' => 18,
                'migration' => '2023_09_08_035014_create_product_stocks_table',
                'batch' => 2,
            ),
            
            array (
                'id' => 19,
                'migration' => '2023_09_08_055524_create_brands_table',
                'batch' => 3,
            ),
            
            array (
                'id' => 21,
                'migration' => '2023_09_08_141838_create_product_prices_table',
                'batch' => 4,
            ),
            
            array (
                'id' => 22,
                'migration' => '2020_01_15_193828_create_received_products_table',
                'batch' => 5,
            ),
            
            array (
                'id' => 23,
                'migration' => '2023_09_08_172008_create_settlements_table',
                'batch' => 6,
            ),
            
            array (
                'id' => 24,
                'migration' => '2023_09_09_102326_create_provider_price_columns_table',
                'batch' => 7,
            ),
            
            array (
                'id' => 25,
                'migration' => '2023_09_09_121645_create_provider_prices_table',
                'batch' => 7,
            ),
            
            array (
                'id' => 26,
                'migration' => '2019_11_04_001339_create_providers_table_migration',
                'batch' => 8,
            ),
            
            array (
                'id' => 27,
                'migration' => '2023_09_14_192353_create_client_phones_table',
                'batch' => 9,
            ),
            
            array (
                'id' => 30,
                'migration' => '2023_09_14_194201_create_client_autos_table',
                'batch' => 10,
            ),
            
            array (
                'id' => 31,
                'migration' => '2023_09_14_194301_create_client_addresses_table',
                'batch' => 10,
            ),
            
            array (
                'id' => 32,
                'migration' => '2023_09_15_043808_create_client_auto_colors_table',
                'batch' => 11,
            ),
            
            array (
                'id' => 33,
                'migration' => '2020_03_10_100001_create_brands_ratings_table',
                'batch' => 12,
            ),
            
            array (
                'id' => 34,
                'migration' => '2023_04_01_666666_create_product_ratings_table',
                'batch' => 12,
            ),
            
            array (
                'id' => 35,
                'migration' => '2023_09_16_120711_create_services_table',
                'batch' => 12,
            ),
            
            array (
                'id' => 41,
                'migration' => '2023_05_01_000000_create_online_orders_table',
                'batch' => 16,
            ),
            
            array (
                'id' => 42,
                'migration' => '2023_05_01_000000_create_order_statuses_table',
                'batch' => 16,
            ),
            
            array (
                'id' => 43,
                'migration' => '2023_05_01_111111_create_online_order_products_table',
                'batch' => 16,
            ),
            
            array (
                'id' => 44,
                'migration' => '2023_05_01_222222_create_online_order_histories_table',
                'batch' => 16,
            ),
            
            array (
                'id' => 45,
                'migration' => '2023_09_20_050211_create_product_groups_table',
                'batch' => 17,
            ),
            
            array (
                'id' => 46,
                'migration' => '2023_09_21_110921_create_model_urls_table',
                'batch' => 18,
            ),
            
            array (
                'id' => 51,
                'migration' => '2020_06_01_100000_create_blog_posts_table',
                'batch' => 19,
            ),
            
            array (
                'id' => 52,
                'migration' => '2020_06_01_100001_create_blog_posts_tags_table',
                'batch' => 19,
            ),
            
            array (
                'id' => 53,
                'migration' => '2020_06_01_100002_create_blog_posts_comments_table',
                'batch' => 19,
            ),
            
            array (
                'id' => 54,
                'migration' => '2020_06_01_100003_create_blog_tags_table',
                'batch' => 19,
            ),
            
            array (
                'id' => 55,
                'migration' => '2020_06_01_183756_create_blog_categories_table',
                'batch' => 19,
            ),
            
            array (
                'id' => 56,
                'migration' => '2023_09_24_070921_create_client_auto_service_parts_table',
                'batch' => 20,
            ),
            
            array (
                'id' => 57,
                'migration' => '2023_04_01_555555_create_product_categories_table',
                'batch' => 1,
            ),
            
            array (
                'id' => 58,
                'migration' => '2023_09_27_064534_create_client_order_statuses_table',
                'batch' => 21,
            ),
            
            array (
                'id' => 59,
                'migration' => '2023_09_29_181609_create_catalog_groups_table',
                'batch' => 1,
            ),
            
            array (
                'id' => 60,
                'migration' => '2023_10_01_093917_create_admin_carts_table',
                'batch' => 22,
            ),
            
            array (
                'id' => 61,
                'migration' => '2023_10_01_093938_create_product_admin_carts_table',
                'batch' => 22,
            ),
            
            array (
                'id' => 64,
                'migration' => '2023_10_01_152619_create_provider_webservice_times_table',
                'batch' => 23,
            ),
            
            array (
                'id' => 65,
                'migration' => '2023_10_01_152640_create_provider_webservice_counters_table',
                'batch' => 23,
            ),
            
            array (
                'id' => 66,
                'migration' => '2023_10_01_160555_create_product_crosses_table',
                'batch' => 24,
            ),
            
            array (
                'id' => 67,
                'migration' => '2023_10_13_132731_create_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 68,
                'migration' => '2023_10_13_132731_create_blog_categories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 69,
                'migration' => '2023_10_13_132731_create_blog_posts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 70,
                'migration' => '2023_10_13_132731_create_blog_posts_comments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 71,
                'migration' => '2023_10_13_132731_create_blog_posts_tags_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 72,
                'migration' => '2023_10_13_132731_create_blog_tags_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 73,
                'migration' => '2023_10_13_132731_create_brands_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 74,
                'migration' => '2023_10_13_132731_create_brands_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 75,
                'migration' => '2023_10_13_132731_create_catalog_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 76,
                'migration' => '2023_10_13_132731_create_client_addresses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 77,
                'migration' => '2023_10_13_132731_create_client_auto_colors_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 78,
                'migration' => '2023_10_13_132731_create_client_auto_service_parts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 79,
                'migration' => '2023_10_13_132731_create_client_autos_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 80,
                'migration' => '2023_10_13_132731_create_client_order_statuses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 81,
                'migration' => '2023_10_13_132731_create_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 82,
                'migration' => '2023_10_13_132731_create_client_phones_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 83,
                'migration' => '2023_10_13_132731_create_clients_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 84,
                'migration' => '2023_10_13_132731_create_currencies_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 85,
                'migration' => '2023_10_13_132731_create_failed_jobs_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 86,
                'migration' => '2023_10_13_132731_create_model_urls_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 87,
                'migration' => '2023_10_13_132731_create_online_order_histories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 88,
                'migration' => '2023_10_13_132731_create_online_order_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 89,
                'migration' => '2023_10_13_132731_create_online_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 90,
                'migration' => '2023_10_13_132731_create_order_statuses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 91,
                'migration' => '2023_10_13_132731_create_password_resets_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 92,
                'migration' => '2023_10_13_132731_create_payment_methods_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 93,
                'migration' => '2023_10_13_132731_create_product_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 94,
                'migration' => '2023_10_13_132731_create_product_categories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 95,
                'migration' => '2023_10_13_132731_create_product_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 96,
                'migration' => '2023_10_13_132731_create_product_crosses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 97,
                'migration' => '2023_10_13_132731_create_product_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 98,
                'migration' => '2023_10_13_132731_create_product_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 99,
                'migration' => '2023_10_13_132731_create_product_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 100,
                'migration' => '2023_10_13_132731_create_product_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 101,
                'migration' => '2023_10_13_132731_create_product_to_provider_order_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 102,
                'migration' => '2023_10_13_132731_create_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 103,
                'migration' => '2023_10_13_132731_create_provider_price_columns_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 104,
                'migration' => '2023_10_13_132731_create_provider_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 105,
                'migration' => '2023_10_13_132731_create_provider_webservice_counter_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 106,
                'migration' => '2023_10_13_132731_create_provider_webservice_time_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 107,
                'migration' => '2023_10_13_132731_create_providers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 108,
                'migration' => '2023_10_13_132731_create_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 109,
                'migration' => '2023_10_13_132731_create_received_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 110,
                'migration' => '2023_10_13_132731_create_sales_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 111,
                'migration' => '2023_10_13_132731_create_sectionseo_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 112,
                'migration' => '2023_10_13_132731_create_services_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 113,
                'migration' => '2023_10_13_132731_create_settlements_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 114,
                'migration' => '2023_10_13_132731_create_sold_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 115,
                'migration' => '2023_10_13_132731_create_tags_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 116,
                'migration' => '2023_10_13_132731_create_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 117,
                'migration' => '2023_10_13_132731_create_transactions_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 118,
                'migration' => '2023_10_13_132731_create_transfers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 119,
                'migration' => '2023_10_13_132731_create_users_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 120,
                'migration' => '2023_10_13_132731_create_warehouses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 121,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 122,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_blog_posts_comments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 123,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_brands_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 124,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 125,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_client_phones_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 126,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_product_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 127,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_product_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 128,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_product_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 129,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_product_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 130,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_product_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 131,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_provider_price_columns_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 132,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 133,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_received_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 134,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_sales_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 135,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_sold_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 136,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 137,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_transactions_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 138,
                'migration' => '2023_10_13_132733_add_foreign_keys_to_transfers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 139,
                'migration' => '2023_11_04_121716_create_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 140,
                'migration' => '2023_11_04_121716_create_blog_categories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 141,
                'migration' => '2023_11_04_121716_create_blog_posts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 142,
                'migration' => '2023_11_04_121716_create_blog_posts_comments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 143,
                'migration' => '2023_11_04_121716_create_blog_posts_tags_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 144,
                'migration' => '2023_11_04_121716_create_blog_tags_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 145,
                'migration' => '2023_11_04_121716_create_brands_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 146,
                'migration' => '2023_11_04_121716_create_brands_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 147,
                'migration' => '2023_11_04_121716_create_catalog_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 148,
                'migration' => '2023_11_04_121716_create_client_addresses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 149,
                'migration' => '2023_11_04_121716_create_client_auto_colors_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 150,
                'migration' => '2023_11_04_121716_create_client_auto_service_parts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 151,
                'migration' => '2023_11_04_121716_create_client_autos_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 152,
                'migration' => '2023_11_04_121716_create_client_order_statuses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 153,
                'migration' => '2023_11_04_121716_create_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 154,
                'migration' => '2023_11_04_121716_create_client_phones_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 155,
                'migration' => '2023_11_04_121716_create_clients_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 156,
                'migration' => '2023_11_04_121716_create_currencies_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 157,
                'migration' => '2023_11_04_121716_create_failed_jobs_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 158,
                'migration' => '2023_11_04_121716_create_inventory_settings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 159,
                'migration' => '2023_11_04_121716_create_model_urls_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 160,
                'migration' => '2023_11_04_121716_create_online_order_histories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 161,
                'migration' => '2023_11_04_121716_create_online_order_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 162,
                'migration' => '2023_11_04_121716_create_online_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 163,
                'migration' => '2023_11_04_121716_create_order_statuses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 164,
                'migration' => '2023_11_04_121716_create_password_resets_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 165,
                'migration' => '2023_11_04_121716_create_payment_methods_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 166,
                'migration' => '2023_11_04_121716_create_product_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 167,
                'migration' => '2023_11_04_121716_create_product_categories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 168,
                'migration' => '2023_11_04_121716_create_product_client_order_io_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 169,
                'migration' => '2023_11_04_121716_create_product_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 170,
                'migration' => '2023_11_04_121716_create_product_crosses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 171,
                'migration' => '2023_11_04_121716_create_product_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 172,
                'migration' => '2023_11_04_121716_create_product_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 173,
                'migration' => '2023_11_04_121716_create_product_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 174,
                'migration' => '2023_11_04_121716_create_product_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 175,
                'migration' => '2023_11_04_121716_create_product_to_provider_order_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 176,
                'migration' => '2023_11_04_121716_create_product_to_provider_order_io_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 177,
                'migration' => '2023_11_04_121716_create_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 178,
                'migration' => '2023_11_04_121716_create_provider_price_columns_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 179,
                'migration' => '2023_11_04_121716_create_provider_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 180,
                'migration' => '2023_11_04_121716_create_provider_webservice_counter_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 181,
                'migration' => '2023_11_04_121716_create_provider_webservice_time_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 182,
                'migration' => '2023_11_04_121716_create_providers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 183,
                'migration' => '2023_11_04_121716_create_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 184,
                'migration' => '2023_11_04_121716_create_received_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 185,
                'migration' => '2023_11_04_121716_create_sales_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 186,
                'migration' => '2023_11_04_121716_create_sectionseo_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 187,
                'migration' => '2023_11_04_121716_create_services_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 188,
                'migration' => '2023_11_04_121716_create_settlements_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 189,
                'migration' => '2023_11_04_121716_create_shop_settings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 190,
                'migration' => '2023_11_04_121716_create_sold_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 191,
                'migration' => '2023_11_04_121716_create_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 192,
                'migration' => '2023_11_04_121716_create_transactions_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 193,
                'migration' => '2023_11_04_121716_create_transfers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 194,
                'migration' => '2023_11_04_121716_create_users_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 195,
                'migration' => '2023_11_04_121716_create_warehouses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 196,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 197,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_blog_posts_comments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 198,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_brands_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 199,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 200,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_client_phones_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 201,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_product_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 202,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_product_client_order_io_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 203,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_product_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 204,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_product_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 205,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_product_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 206,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_product_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 207,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_provider_price_columns_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 208,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 209,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_received_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 210,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_sales_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 211,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_sold_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 212,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 213,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_transactions_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 214,
                'migration' => '2023_11_04_121719_add_foreign_keys_to_transfers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 215,
                'migration' => '2023_12_24_081729_create_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 216,
                'migration' => '2023_12_24_081729_create_blog_categories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 217,
                'migration' => '2023_12_24_081729_create_blog_posts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 218,
                'migration' => '2023_12_24_081729_create_blog_posts_comments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 219,
                'migration' => '2023_12_24_081729_create_blog_posts_tags_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 220,
                'migration' => '2023_12_24_081729_create_blog_tags_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 221,
                'migration' => '2023_12_24_081729_create_brands_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 222,
                'migration' => '2023_12_24_081729_create_brands_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 223,
                'migration' => '2023_12_24_081729_create_catalog_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 224,
                'migration' => '2023_12_24_081729_create_client_addresses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 225,
                'migration' => '2023_12_24_081729_create_client_auto_colors_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 226,
                'migration' => '2023_12_24_081729_create_client_auto_service_parts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 227,
                'migration' => '2023_12_24_081729_create_client_autos_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 228,
                'migration' => '2023_12_24_081729_create_client_order_statuses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 229,
                'migration' => '2023_12_24_081729_create_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 230,
                'migration' => '2023_12_24_081729_create_client_phones_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 231,
                'migration' => '2023_12_24_081729_create_clients_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 232,
                'migration' => '2023_12_24_081729_create_coupons_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 233,
                'migration' => '2023_12_24_081729_create_currencies_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 234,
                'migration' => '2023_12_24_081729_create_employees_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 235,
                'migration' => '2023_12_24_081729_create_failed_jobs_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 236,
                'migration' => '2023_12_24_081729_create_inventory_settings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 237,
                'migration' => '2023_12_24_081729_create_model_urls_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 238,
                'migration' => '2023_12_24_081729_create_online_order_histories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 239,
                'migration' => '2023_12_24_081729_create_online_order_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 240,
                'migration' => '2023_12_24_081729_create_online_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 241,
                'migration' => '2023_12_24_081729_create_order_statuses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 242,
                'migration' => '2023_12_24_081729_create_password_resets_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 243,
                'migration' => '2023_12_24_081729_create_payment_methods_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 244,
                'migration' => '2023_12_24_081729_create_payroll_employees_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 245,
                'migration' => '2023_12_24_081729_create_payrolls_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 246,
                'migration' => '2023_12_24_081729_create_pricetypes_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 247,
                'migration' => '2023_12_24_081729_create_product_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 248,
                'migration' => '2023_12_24_081729_create_product_categories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 249,
                'migration' => '2023_12_24_081729_create_product_client_order_io_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 250,
                'migration' => '2023_12_24_081729_create_product_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 251,
                'migration' => '2023_12_24_081729_create_product_client_to_provider_order_io_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 252,
                'migration' => '2023_12_24_081729_create_product_crosses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 253,
                'migration' => '2023_12_24_081729_create_product_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 254,
                'migration' => '2023_12_24_081729_create_product_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 255,
                'migration' => '2023_12_24_081729_create_product_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 256,
                'migration' => '2023_12_24_081729_create_product_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 257,
                'migration' => '2023_12_24_081729_create_product_to_provider_order_io_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 258,
                'migration' => '2023_12_24_081729_create_product_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 259,
                'migration' => '2023_12_24_081729_create_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 260,
                'migration' => '2023_12_24_081729_create_provider_price_columns_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 261,
                'migration' => '2023_12_24_081729_create_provider_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 262,
                'migration' => '2023_12_24_081729_create_provider_webservice_counter_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 263,
                'migration' => '2023_12_24_081729_create_provider_webservice_time_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 264,
                'migration' => '2023_12_24_081729_create_providers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 265,
                'migration' => '2023_12_24_081729_create_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 266,
                'migration' => '2023_12_24_081729_create_received_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 267,
                'migration' => '2023_12_24_081729_create_salary_management_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 268,
                'migration' => '2023_12_24_081729_create_salary_payment_employees_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 269,
                'migration' => '2023_12_24_081729_create_salary_payments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 270,
                'migration' => '2023_12_24_081729_create_sales_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 271,
                'migration' => '2023_12_24_081729_create_sectionseo_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 272,
                'migration' => '2023_12_24_081729_create_services_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 273,
                'migration' => '2023_12_24_081729_create_services_receipt_items_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 274,
                'migration' => '2023_12_24_081729_create_services_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 275,
                'migration' => '2023_12_24_081729_create_settlements_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 276,
                'migration' => '2023_12_24_081729_create_shop_settings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 277,
                'migration' => '2023_12_24_081729_create_sold_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 278,
                'migration' => '2023_12_24_081729_create_special_batteries_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 279,
                'migration' => '2023_12_24_081729_create_special_oils_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 280,
                'migration' => '2023_12_24_081729_create_special_rims_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 281,
                'migration' => '2023_12_24_081729_create_special_tools_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 282,
                'migration' => '2023_12_24_081729_create_special_tyres_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 283,
                'migration' => '2023_12_24_081729_create_testimonials_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 284,
                'migration' => '2023_12_24_081729_create_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 285,
                'migration' => '2023_12_24_081729_create_transactions_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 286,
                'migration' => '2023_12_24_081729_create_transfers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 287,
                'migration' => '2023_12_24_081729_create_users_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 288,
                'migration' => '2023_12_24_081729_create_warehouses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 289,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 290,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_blog_posts_comments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 291,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_brands_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 292,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 293,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_client_phones_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 294,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_product_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 295,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_product_client_order_io_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 296,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_product_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 297,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_product_client_to_provider_order_io_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 298,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_product_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 299,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_product_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 300,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_product_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 301,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_provider_price_columns_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 302,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 303,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_received_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 304,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_sales_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 305,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_sold_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 306,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 307,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_transactions_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 308,
                'migration' => '2023_12_24_081732_add_foreign_keys_to_transfers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 309,
                'migration' => '2020_10_26_160365_create_xb_rims_table',
                'batch' => 25,
            ),
            
            array (
                'id' => 310,
                'migration' => '2020_10_26_160365_create_special_rims_table',
                'batch' => 26,
            ),
            
            array (
                'id' => 311,
                'migration' => '2024_04_30_184337_create_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 312,
                'migration' => '2024_04_30_184337_create_blog_categories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 313,
                'migration' => '2024_04_30_184337_create_blog_posts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 314,
                'migration' => '2024_04_30_184337_create_blog_posts_comments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 315,
                'migration' => '2024_04_30_184337_create_blog_posts_tags_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 316,
                'migration' => '2024_04_30_184337_create_blog_tags_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 317,
                'migration' => '2024_04_30_184337_create_brand_renames_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 318,
                'migration' => '2024_04_30_184337_create_brands_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 319,
                'migration' => '2024_04_30_184337_create_brands_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 320,
                'migration' => '2024_04_30_184337_create_catalog_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 321,
                'migration' => '2024_04_30_184337_create_client_addresses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 322,
                'migration' => '2024_04_30_184337_create_client_auto_colors_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 323,
                'migration' => '2024_04_30_184337_create_client_auto_service_parts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 324,
                'migration' => '2024_04_30_184337_create_client_autos_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 325,
                'migration' => '2024_04_30_184337_create_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 326,
                'migration' => '2024_04_30_184337_create_client_phones_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 327,
                'migration' => '2024_04_30_184337_create_clients_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 328,
                'migration' => '2024_04_30_184337_create_coupons_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 329,
                'migration' => '2024_04_30_184337_create_currencies_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 330,
                'migration' => '2024_04_30_184337_create_employees_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 331,
                'migration' => '2024_04_30_184337_create_failed_jobs_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 332,
                'migration' => '2024_04_30_184337_create_inventory_settings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 333,
                'migration' => '2024_04_30_184337_create_model_urls_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 334,
                'migration' => '2024_04_30_184337_create_online_order_histories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 335,
                'migration' => '2024_04_30_184337_create_online_order_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 336,
                'migration' => '2024_04_30_184337_create_online_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 337,
                'migration' => '2024_04_30_184337_create_order_statuses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 338,
                'migration' => '2024_04_30_184337_create_password_resets_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 339,
                'migration' => '2024_04_30_184337_create_payment_methods_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 340,
                'migration' => '2024_04_30_184337_create_payroll_employees_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 341,
                'migration' => '2024_04_30_184337_create_payrolls_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 342,
                'migration' => '2024_04_30_184337_create_pricetypes_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 343,
                'migration' => '2024_04_30_184337_create_product_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 344,
                'migration' => '2024_04_30_184337_create_product_categories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 345,
                'migration' => '2024_04_30_184337_create_product_client_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 346,
                'migration' => '2024_04_30_184337_create_product_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 347,
                'migration' => '2024_04_30_184337_create_product_client_to_provider_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 348,
                'migration' => '2024_04_30_184337_create_product_client_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 349,
                'migration' => '2024_04_30_184337_create_product_crosses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 350,
                'migration' => '2024_04_30_184337_create_product_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 351,
                'migration' => '2024_04_30_184337_create_product_minimal_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 352,
                'migration' => '2024_04_30_184337_create_product_order_management_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 353,
                'migration' => '2024_04_30_184337_create_product_price_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 354,
                'migration' => '2024_04_30_184337_create_product_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 355,
                'migration' => '2024_04_30_184337_create_product_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 356,
                'migration' => '2024_04_30_184337_create_product_returns_from_the_client_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 357,
                'migration' => '2024_04_30_184337_create_product_returns_to_provider_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 358,
                'migration' => '2024_04_30_184337_create_product_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 359,
                'migration' => '2024_04_30_184337_create_product_to_provider_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 360,
                'migration' => '2024_04_30_184337_create_product_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 361,
                'migration' => '2024_04_30_184337_create_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 362,
                'migration' => '2024_04_30_184337_create_provider_price_columns_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 363,
                'migration' => '2024_04_30_184337_create_provider_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 364,
                'migration' => '2024_04_30_184337_create_provider_webservice_counter_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 365,
                'migration' => '2024_04_30_184337_create_provider_webservice_time_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 366,
                'migration' => '2024_04_30_184337_create_providers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 367,
                'migration' => '2024_04_30_184337_create_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 368,
                'migration' => '2024_04_30_184337_create_received_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 369,
                'migration' => '2024_04_30_184337_create_returns_from_the_client_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 370,
                'migration' => '2024_04_30_184337_create_returns_to_provider_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 371,
                'migration' => '2024_04_30_184337_create_salary_management_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 372,
                'migration' => '2024_04_30_184337_create_salary_payment_employees_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 373,
                'migration' => '2024_04_30_184337_create_salary_payments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 374,
                'migration' => '2024_04_30_184337_create_sales_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 375,
                'migration' => '2024_04_30_184337_create_sectionseo_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 376,
                'migration' => '2024_04_30_184337_create_services_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 377,
                'migration' => '2024_04_30_184337_create_services_receipt_items_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 378,
                'migration' => '2024_04_30_184337_create_services_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 379,
                'migration' => '2024_04_30_184337_create_settlements_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 380,
                'migration' => '2024_04_30_184337_create_shop_message_subjects_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 381,
                'migration' => '2024_04_30_184337_create_shop_messages_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 382,
                'migration' => '2024_04_30_184337_create_shop_settings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 383,
                'migration' => '2024_04_30_184337_create_sold_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 384,
                'migration' => '2024_04_30_184337_create_special_batteries_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 385,
                'migration' => '2024_04_30_184337_create_special_oils_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 386,
                'migration' => '2024_04_30_184337_create_special_rims_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 387,
                'migration' => '2024_04_30_184337_create_special_tools_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 388,
                'migration' => '2024_04_30_184337_create_special_tyres_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 389,
                'migration' => '2024_04_30_184337_create_testimonials_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 390,
                'migration' => '2024_04_30_184337_create_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 391,
                'migration' => '2024_04_30_184337_create_transactions_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 392,
                'migration' => '2024_04_30_184337_create_transfers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 393,
                'migration' => '2024_04_30_184337_create_users_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 394,
                'migration' => '2024_04_30_184337_create_warehouses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 395,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 396,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_blog_posts_comments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 397,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_brand_renames_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 398,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_brands_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 399,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 400,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_client_phones_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 401,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_product_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 402,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_product_client_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 403,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_product_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 404,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_product_client_to_provider_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 405,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_product_minimal_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 406,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_product_order_management_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 407,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_product_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 408,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_product_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 409,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_product_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 410,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_provider_price_columns_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 411,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 412,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_received_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 413,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_returns_from_the_client_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 414,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_sales_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 415,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_sold_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 416,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 417,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_transactions_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 418,
                'migration' => '2024_04_30_184340_add_foreign_keys_to_transfers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 419,
                'migration' => '2024_04_30_184427_create_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 420,
                'migration' => '2024_04_30_184427_create_blog_categories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 421,
                'migration' => '2024_04_30_184427_create_blog_posts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 422,
                'migration' => '2024_04_30_184427_create_blog_posts_comments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 423,
                'migration' => '2024_04_30_184427_create_blog_posts_tags_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 424,
                'migration' => '2024_04_30_184427_create_blog_tags_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 425,
                'migration' => '2024_04_30_184427_create_brand_renames_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 426,
                'migration' => '2024_04_30_184427_create_brands_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 427,
                'migration' => '2024_04_30_184427_create_brands_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 428,
                'migration' => '2024_04_30_184427_create_catalog_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 429,
                'migration' => '2024_04_30_184427_create_client_addresses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 430,
                'migration' => '2024_04_30_184427_create_client_auto_colors_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 431,
                'migration' => '2024_04_30_184427_create_client_auto_service_parts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 432,
                'migration' => '2024_04_30_184427_create_client_autos_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 433,
                'migration' => '2024_04_30_184427_create_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 434,
                'migration' => '2024_04_30_184427_create_client_phones_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 435,
                'migration' => '2024_04_30_184427_create_clients_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 436,
                'migration' => '2024_04_30_184427_create_coupons_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 437,
                'migration' => '2024_04_30_184427_create_currencies_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 438,
                'migration' => '2024_04_30_184427_create_employees_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 439,
                'migration' => '2024_04_30_184427_create_failed_jobs_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 440,
                'migration' => '2024_04_30_184427_create_inventory_settings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 441,
                'migration' => '2024_04_30_184427_create_model_urls_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 442,
                'migration' => '2024_04_30_184427_create_online_order_histories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 443,
                'migration' => '2024_04_30_184427_create_online_order_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 444,
                'migration' => '2024_04_30_184427_create_online_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 445,
                'migration' => '2024_04_30_184427_create_order_statuses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 446,
                'migration' => '2024_04_30_184427_create_password_resets_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 447,
                'migration' => '2024_04_30_184427_create_payment_methods_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 448,
                'migration' => '2024_04_30_184427_create_payroll_employees_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 449,
                'migration' => '2024_04_30_184427_create_payrolls_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 450,
                'migration' => '2024_04_30_184427_create_pricetypes_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 451,
                'migration' => '2024_04_30_184427_create_product_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 452,
                'migration' => '2024_04_30_184427_create_product_categories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 453,
                'migration' => '2024_04_30_184427_create_product_client_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 454,
                'migration' => '2024_04_30_184427_create_product_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 455,
                'migration' => '2024_04_30_184427_create_product_client_to_provider_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 456,
                'migration' => '2024_04_30_184427_create_product_client_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 457,
                'migration' => '2024_04_30_184427_create_product_crosses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 458,
                'migration' => '2024_04_30_184427_create_product_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 459,
                'migration' => '2024_04_30_184427_create_product_minimal_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 460,
                'migration' => '2024_04_30_184427_create_product_order_management_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 461,
                'migration' => '2024_04_30_184427_create_product_price_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 462,
                'migration' => '2024_04_30_184427_create_product_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 463,
                'migration' => '2024_04_30_184427_create_product_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 464,
                'migration' => '2024_04_30_184427_create_product_returns_from_the_client_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 465,
                'migration' => '2024_04_30_184427_create_product_returns_to_provider_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 466,
                'migration' => '2024_04_30_184427_create_product_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 467,
                'migration' => '2024_04_30_184427_create_product_to_provider_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 468,
                'migration' => '2024_04_30_184427_create_product_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 469,
                'migration' => '2024_04_30_184427_create_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 470,
                'migration' => '2024_04_30_184427_create_provider_price_columns_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 471,
                'migration' => '2024_04_30_184427_create_provider_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 472,
                'migration' => '2024_04_30_184427_create_provider_webservice_counter_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 473,
                'migration' => '2024_04_30_184427_create_provider_webservice_time_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 474,
                'migration' => '2024_04_30_184427_create_providers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 475,
                'migration' => '2024_04_30_184427_create_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 476,
                'migration' => '2024_04_30_184427_create_received_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 477,
                'migration' => '2024_04_30_184427_create_returns_from_the_client_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 478,
                'migration' => '2024_04_30_184427_create_returns_to_provider_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 479,
                'migration' => '2024_04_30_184427_create_salary_management_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 480,
                'migration' => '2024_04_30_184427_create_salary_payment_employees_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 481,
                'migration' => '2024_04_30_184427_create_salary_payments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 482,
                'migration' => '2024_04_30_184427_create_sales_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 483,
                'migration' => '2024_04_30_184427_create_sectionseo_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 484,
                'migration' => '2024_04_30_184427_create_services_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 485,
                'migration' => '2024_04_30_184427_create_services_receipt_items_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 486,
                'migration' => '2024_04_30_184427_create_services_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 487,
                'migration' => '2024_04_30_184427_create_settlements_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 488,
                'migration' => '2024_04_30_184427_create_shop_message_subjects_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 489,
                'migration' => '2024_04_30_184427_create_shop_messages_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 490,
                'migration' => '2024_04_30_184427_create_shop_settings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 491,
                'migration' => '2024_04_30_184427_create_sold_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 492,
                'migration' => '2024_04_30_184427_create_special_batteries_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 493,
                'migration' => '2024_04_30_184427_create_special_oils_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 494,
                'migration' => '2024_04_30_184427_create_special_rims_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 495,
                'migration' => '2024_04_30_184427_create_special_tools_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 496,
                'migration' => '2024_04_30_184427_create_special_tyres_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 497,
                'migration' => '2024_04_30_184427_create_testimonials_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 498,
                'migration' => '2024_04_30_184427_create_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 499,
                'migration' => '2024_04_30_184427_create_transactions_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 500,
                'migration' => '2024_04_30_184427_create_transfers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 501,
                'migration' => '2024_04_30_184427_create_users_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 502,
                'migration' => '2024_04_30_184427_create_warehouses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 503,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 504,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_blog_posts_comments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 505,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_brand_renames_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 506,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_brands_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 507,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 508,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_client_phones_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 509,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_product_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 510,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_product_client_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 511,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_product_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 512,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_product_client_to_provider_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 513,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_product_minimal_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 514,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_product_order_management_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 515,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_product_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 516,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_product_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 517,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_product_stocks_table',
                'batch' => 0,
            ),
        ));
        \DB::table('migrations')->insert(array (
            
            array (
                'id' => 518,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_provider_price_columns_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 519,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 520,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_received_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 521,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_returns_from_the_client_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 522,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_sales_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 523,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_sold_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 524,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 525,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_transactions_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 526,
                'migration' => '2024_04_30_184430_add_foreign_keys_to_transfers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 527,
                'migration' => '2024_07_28_175942_create_inventory_settings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 528,
                'migration' => '2024_07_29_035937_create_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 529,
                'migration' => '2024_07_29_035937_create_blog_categories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 530,
                'migration' => '2024_07_29_035937_create_blog_posts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 531,
                'migration' => '2024_07_29_035937_create_blog_posts_comments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 532,
                'migration' => '2024_07_29_035937_create_blog_posts_tags_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 533,
                'migration' => '2024_07_29_035937_create_blog_tags_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 534,
                'migration' => '2024_07_29_035937_create_brand_renames_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 535,
                'migration' => '2024_07_29_035937_create_brands_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 536,
                'migration' => '2024_07_29_035937_create_brands_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 537,
                'migration' => '2024_07_29_035937_create_catalog_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 538,
                'migration' => '2024_07_29_035937_create_client_addresses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 539,
                'migration' => '2024_07_29_035937_create_client_auto_colors_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 540,
                'migration' => '2024_07_29_035937_create_client_auto_service_parts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 541,
                'migration' => '2024_07_29_035937_create_client_autos_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 542,
                'migration' => '2024_07_29_035937_create_client_order_corrections_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 543,
                'migration' => '2024_07_29_035937_create_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 544,
                'migration' => '2024_07_29_035937_create_client_phones_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 545,
                'migration' => '2024_07_29_035937_create_clients_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 546,
                'migration' => '2024_07_29_035937_create_coupons_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 547,
                'migration' => '2024_07_29_035937_create_currencies_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 548,
                'migration' => '2024_07_29_035937_create_employees_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 549,
                'migration' => '2024_07_29_035937_create_failed_jobs_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 550,
                'migration' => '2024_07_29_035937_create_inventory_settings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 551,
                'migration' => '2024_07_29_035937_create_model_urls_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 552,
                'migration' => '2024_07_29_035937_create_online_order_histories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 553,
                'migration' => '2024_07_29_035937_create_online_order_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 554,
                'migration' => '2024_07_29_035937_create_online_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 555,
                'migration' => '2024_07_29_035937_create_order_statuses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 556,
                'migration' => '2024_07_29_035937_create_password_resets_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 557,
                'migration' => '2024_07_29_035937_create_payment_methods_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 558,
                'migration' => '2024_07_29_035937_create_payroll_employees_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 559,
                'migration' => '2024_07_29_035937_create_payrolls_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 560,
                'migration' => '2024_07_29_035937_create_pricetypes_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 561,
                'migration' => '2024_07_29_035937_create_product_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 562,
                'migration' => '2024_07_29_035937_create_product_categories_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 563,
                'migration' => '2024_07_29_035937_create_product_client_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 564,
                'migration' => '2024_07_29_035937_create_product_client_order_corrections_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 565,
                'migration' => '2024_07_29_035937_create_product_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 566,
                'migration' => '2024_07_29_035937_create_product_client_to_provider_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 567,
                'migration' => '2024_07_29_035937_create_product_client_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 568,
                'migration' => '2024_07_29_035937_create_product_crosses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 569,
                'migration' => '2024_07_29_035937_create_product_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 570,
                'migration' => '2024_07_29_035937_create_product_minimal_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 571,
                'migration' => '2024_07_29_035937_create_product_order_management_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 572,
                'migration' => '2024_07_29_035937_create_product_price_groups_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 573,
                'migration' => '2024_07_29_035937_create_product_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 574,
                'migration' => '2024_07_29_035937_create_product_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 575,
                'migration' => '2024_07_29_035937_create_product_repair_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 576,
                'migration' => '2024_07_29_035937_create_product_returns_from_the_client_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 577,
                'migration' => '2024_07_29_035937_create_product_returns_to_provider_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 578,
                'migration' => '2024_07_29_035937_create_product_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 579,
                'migration' => '2024_07_29_035937_create_product_to_provider_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 580,
                'migration' => '2024_07_29_035937_create_product_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 581,
                'migration' => '2024_07_29_035937_create_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 582,
                'migration' => '2024_07_29_035937_create_provider_price_columns_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 583,
                'migration' => '2024_07_29_035937_create_provider_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 584,
                'migration' => '2024_07_29_035937_create_provider_webservice_counter_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 585,
                'migration' => '2024_07_29_035937_create_provider_webservice_time_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 586,
                'migration' => '2024_07_29_035937_create_providers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 587,
                'migration' => '2024_07_29_035937_create_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 588,
                'migration' => '2024_07_29_035937_create_received_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 589,
                'migration' => '2024_07_29_035937_create_repair_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 590,
                'migration' => '2024_07_29_035937_create_returns_from_the_client_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 591,
                'migration' => '2024_07_29_035937_create_returns_to_provider_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 592,
                'migration' => '2024_07_29_035937_create_salary_management_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 593,
                'migration' => '2024_07_29_035937_create_salary_payment_employees_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 594,
                'migration' => '2024_07_29_035937_create_salary_payments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 595,
                'migration' => '2024_07_29_035937_create_sales_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 596,
                'migration' => '2024_07_29_035937_create_sectionseo_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 597,
                'migration' => '2024_07_29_035937_create_service_repair_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 598,
                'migration' => '2024_07_29_035937_create_services_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 599,
                'migration' => '2024_07_29_035937_create_services_receipt_items_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 600,
                'migration' => '2024_07_29_035937_create_services_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 601,
                'migration' => '2024_07_29_035937_create_settlements_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 602,
                'migration' => '2024_07_29_035937_create_shop_message_subjects_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 603,
                'migration' => '2024_07_29_035937_create_shop_messages_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 604,
                'migration' => '2024_07_29_035937_create_shop_settings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 605,
                'migration' => '2024_07_29_035937_create_sold_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 606,
                'migration' => '2024_07_29_035937_create_special_batteries_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 607,
                'migration' => '2024_07_29_035937_create_special_oils_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 608,
                'migration' => '2024_07_29_035937_create_special_rims_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 609,
                'migration' => '2024_07_29_035937_create_special_tools_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 610,
                'migration' => '2024_07_29_035937_create_special_tyres_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 611,
                'migration' => '2024_07_29_035937_create_testimonials_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 612,
                'migration' => '2024_07_29_035937_create_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 613,
                'migration' => '2024_07_29_035937_create_transactions_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 614,
                'migration' => '2024_07_29_035937_create_transfers_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 615,
                'migration' => '2024_07_29_035937_create_users_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 616,
                'migration' => '2024_07_29_035937_create_warehouses_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 617,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 618,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_blog_posts_comments_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 619,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_brand_renames_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 620,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_brands_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 621,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_client_order_corrections_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 622,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 623,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_client_phones_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 624,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_product_admin_carts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 625,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_product_client_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 626,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_product_client_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 627,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_product_client_to_provider_order_control_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 628,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_product_minimal_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 629,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_product_order_management_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 630,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_product_prices_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 631,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_product_ratings_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 632,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_product_stocks_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 633,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_provider_price_columns_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 634,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_receipts_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 635,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_received_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 636,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_returns_from_the_client_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 637,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_sales_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 638,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_service_repair_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 639,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_sold_products_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 640,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_to_provider_orders_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 641,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_transactions_table',
                'batch' => 0,
            ),
            
            array (
                'id' => 642,
                'migration' => '2024_07_29_035940_add_foreign_keys_to_transfers_table',
                'batch' => 0,
            ),
        ));
        
        
    }
}