<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrderManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_order_management', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->default(0);
            $table->decimal('quantity', 10)->default(0);
            $table->unsignedBigInteger('client_order_id')->nullable()->index('client_order_id');
            $table->unsignedBigInteger('to_provider_order_id')->nullable()->index('to_provider_order_id');
            $table->unsignedBigInteger('receipt_id')->nullable()->index('receipt_id');
            $table->unsignedBigInteger('sale_id')->nullable()->index('sale_id');

            $table->unique(['product_id', 'to_provider_order_id'], 'product_provider');
            $table->unique(['product_id', 'client_order_id'], 'product_client');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_order_management');
    }
}
