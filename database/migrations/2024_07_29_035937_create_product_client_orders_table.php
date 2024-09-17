<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductClientOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_client_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_order_id')->index('product_client_ordereds_client_order_id_foreign');
            $table->unsignedBigInteger('product_id')->index('product_client_ordereds_product_id_foreign');
            $table->decimal('quantity', 10)->default(0);
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
        Schema::dropIfExists('product_client_orders');
    }
}
