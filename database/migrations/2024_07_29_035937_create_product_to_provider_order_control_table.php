<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductToProviderOrderControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_to_provider_order_control', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('order_uid', 32)->default('')->comment('operation md5');
            $table->unsignedBigInteger('provider_id')->default(0);
            $table->unsignedBigInteger('product_id')->default(0);
            $table->char('doc_type', 30)->default('')->comment('order/receipt');
            $table->unsignedBigInteger('doc_id')->nullable()->comment('order_id/sale_id');
            $table->bigInteger('quantity')->default(0)->comment('order/sale quantity');
            $table->unsignedBigInteger('warehouse_id');
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
        Schema::dropIfExists('product_to_provider_order_control');
    }
}
