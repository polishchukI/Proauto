<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductClientToProviderOrderControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_client_to_provider_order_control', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->default(0)->index('product_id');
            $table->float('quantity', 10)->unsigned()->default(0);
            $table->string('client_order_uid', 32)->default('')->comment('operation md5');
            $table->string('to_provider_order_uid', 32)->default('')->comment('operation md5');
            $table->unsignedBigInteger('client_order_id');
            $table->unsignedBigInteger('to_provider_order_id');
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
        Schema::dropIfExists('product_client_to_provider_order_control');
    }
}
