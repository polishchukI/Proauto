<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductMinimalStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_minimal_stocks', function (Blueprint $table) {
            $table->foreign(['product_id'], 'product_minimal_stocks_ibfk_1')->references(['id'])->on('products');
            $table->foreign(['warehouse_id'], 'product_minimal_stocks_ibfk_2')->references(['id'])->on('warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_minimal_stocks', function (Blueprint $table) {
            $table->dropForeign('product_minimal_stocks_ibfk_1');
            $table->dropForeign('product_minimal_stocks_ibfk_2');
        });
    }
}
