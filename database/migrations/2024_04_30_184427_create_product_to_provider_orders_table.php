<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductToProviderOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_to_provider_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->default(0);
            $table->char('client_ordered', 5)->nullable();
            $table->unsignedBigInteger('to_provider_order_id');
            $table->float('quantity', 10)->default(0);
            $table->decimal('price', 10);
            $table->decimal('total_amount', 10);
            $table->unsignedBigInteger('warehouse_id');
            $table->char('currency', 3);
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
        Schema::dropIfExists('product_to_provider_orders');
    }
}
