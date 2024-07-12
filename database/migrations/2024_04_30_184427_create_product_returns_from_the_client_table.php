<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReturnsFromTheClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_returns_from_the_client', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('return_from_the_client_id')->default(0);
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('warehouse_id')->default(0);
            $table->char('currency', 3);
            $table->decimal('quantity', 10)->default(0);
            $table->decimal('price', 10);
            $table->decimal('base_price', 10)->nullable();
            $table->decimal('total_amount', 10);
            $table->decimal('base_total_amount', 10)->nullable();
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
        Schema::dropIfExists('product_returns_from_the_client');
    }
}
