<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToReceivedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('received_products', function (Blueprint $table) {
            $table->foreign(['warehouse_id'], 'received_products_ibfk_1')->references(['id'])->on('warehouses');
            $table->foreign(['product_id'])->references(['id'])->on('products');
            $table->foreign(['receipt_id'])->references(['id'])->on('receipts')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('received_products', function (Blueprint $table) {
            $table->dropForeign('received_products_ibfk_1');
            $table->dropForeign('received_products_product_id_foreign');
            $table->dropForeign('received_products_receipt_id_foreign');
        });
    }
}
