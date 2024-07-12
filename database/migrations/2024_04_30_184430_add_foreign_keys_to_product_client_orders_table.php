<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductClientOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_client_orders', function (Blueprint $table) {
            $table->foreign(['client_order_id'], 'product_client_ordereds_client_order_id_foreign')->references(['id'])->on('client_orders')->onDelete('CASCADE');
            $table->foreign(['product_id'], 'product_client_ordereds_product_id_foreign')->references(['id'])->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_client_orders', function (Blueprint $table) {
            $table->dropForeign('product_client_ordereds_client_order_id_foreign');
            $table->dropForeign('product_client_ordereds_product_id_foreign');
        });
    }
}
