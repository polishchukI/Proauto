<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductClientOrderControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_client_order_control', function (Blueprint $table) {
            $table->foreign(['client_id'], 'product_client_order_control_ibfk_1')->references(['id'])->on('clients')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['product_id'], 'product_client_order_control_ibfk_2')->references(['id'])->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['warehouse_id'], 'product_client_order_control_ibfk_3')->references(['id'])->on('warehouses')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_client_order_control', function (Blueprint $table) {
            $table->dropForeign('product_client_order_control_ibfk_1');
            $table->dropForeign('product_client_order_control_ibfk_2');
            $table->dropForeign('product_client_order_control_ibfk_3');
        });
    }
}
