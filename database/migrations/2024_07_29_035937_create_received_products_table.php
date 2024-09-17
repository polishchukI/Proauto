<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('receipt_id')->index('received_products_receipt_id_foreign');
            $table->unsignedBigInteger('product_id')->index('received_products_product_id_foreign');
            $table->unsignedBigInteger('warehouse_id')->default(0)->index('warehouse_id');
            $table->char('currency', 3);
            $table->unsignedBigInteger('to_provider_order_id')->nullable();
            $table->decimal('price', 10);
            $table->integer('quantity');
            $table->decimal('total_amount', 10);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('received_products');
    }
}
