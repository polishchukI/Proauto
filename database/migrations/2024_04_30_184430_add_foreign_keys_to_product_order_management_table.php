<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductOrderManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_order_management', function (Blueprint $table) {
            $table->foreign(['product_id'], 'product_order_management_ibfk_1')->references(['id'])->on('products');
            $table->foreign(['client_order_id'], 'product_order_management_ibfk_2')->references(['id'])->on('client_orders');
            $table->foreign(['to_provider_order_id'], 'product_order_management_ibfk_3')->references(['id'])->on('to_provider_orders');
            $table->foreign(['receipt_id'], 'product_order_management_ibfk_4')->references(['id'])->on('receipts');
            $table->foreign(['sale_id'], 'product_order_management_ibfk_5')->references(['id'])->on('sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_order_management', function (Blueprint $table) {
            $table->dropForeign('product_order_management_ibfk_1');
            $table->dropForeign('product_order_management_ibfk_2');
            $table->dropForeign('product_order_management_ibfk_3');
            $table->dropForeign('product_order_management_ibfk_4');
            $table->dropForeign('product_order_management_ibfk_5');
        });
    }
}
