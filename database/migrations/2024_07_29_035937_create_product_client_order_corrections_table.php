<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductClientOrderCorrectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_client_order_corrections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_order_correction_id')->default(0);
            $table->unsignedBigInteger('product_id');
            $table->decimal('quantity', 10)->default(0);
            $table->decimal('price', 10);
            $table->decimal('total_amount', 10);
            $table->unsignedBigInteger('warehouse_id');
            $table->char('currency', 3);
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('product_client_order_corrections');
    }
}
