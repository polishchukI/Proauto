<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductClientOrderControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_client_order_control', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_uid', 32)->default('')->comment('operation md5');
            $table->unsignedBigInteger('client_id')->default(0)->index('client_id');
            $table->unsignedBigInteger('product_id')->default(0)->index('product_id');
            $table->char('doc_type', 30)->nullable()->default('')->comment('order/sale');
            $table->unsignedBigInteger('doc_id')->nullable()->comment('order_id/sale_id');
            $table->float('quantity', 10)->nullable()->comment('order/sale quantity');
            $table->unsignedBigInteger('warehouse_id')->index('warehouse_id');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_client_order_control');
    }
}
