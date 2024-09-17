<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRepairOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_repair_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('repair_order_id')->default(0);
            $table->unsignedBigInteger('product_id');
            $table->decimal('quantity', 10)->default(0);
            $table->decimal('price', 10)->nullable()->default(0);
            $table->decimal('total', 10)->nullable()->default(0);
            $table->decimal('discount', 10)->nullable()->default(0);
            $table->char('currency', 3);
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->decimal('total_amount', 10)->nullable()->default(0);
            $table->unsignedBigInteger('client_order_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_repair_orders');
    }
}
