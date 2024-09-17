<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sold_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sale_id')->index('sold_products_sale_id_foreign');
            $table->unsignedBigInteger('product_id')->index('sold_products_product_id_foreign');
            $table->decimal('quantity', 10)->default(0);
            $table->decimal('price', 10)->nullable()->default(0);
            $table->decimal('total', 10)->nullable()->default(0);
            $table->decimal('discount', 10)->nullable()->default(0);
            $table->char('currency', 3);
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->decimal('total_amount', 10)->nullable()->default(0);
            $table->timestamps();
            $table->unsignedBigInteger('client_order_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sold_products');
    }
}
