<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_order_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('online_order_id')->default(0);
            $table->string('product_uid', 32)->default('');
            $table->string('name');
            $table->string('model', 180)->default('');
            $table->integer('quantity');
            $table->decimal('price', 15, 4)->default(0);
            $table->decimal('provider_price', 15, 4)->default(0);
            $table->string('provider_currency', 3);
            $table->decimal('total', 15, 4)->default(0);
            $table->decimal('tax', 15, 4)->default(0);
            $table->integer('reward');
            $table->string('article', 32)->default('');
            $table->string('brand', 32)->default('');
            $table->string('bkey', 64)->default('');
            $table->string('akey', 64)->default('');
            $table->string('pkey', 160)->nullable()->index('pkey');
            $table->string('provider', 32)->default('');
            $table->string('stock', 32)->default('');
            $table->string('options', 128)->default('');
            $table->integer('day')->default(0);
            $table->string('code', 4)->nullable()->default('')->comment('Supplier Code');
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
        Schema::dropIfExists('online_order_products');
    }
}
