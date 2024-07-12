<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('article', 60)->nullable();
            $table->string('akey', 60)->nullable()->index('akey');
            $table->string('brand', 60)->nullable();
            $table->string('bkey', 60)->nullable();
            $table->string('pkey', 150)->nullable()->unique('pkey');
            $table->unsignedBigInteger('product_category_id')->default(0)->index('products_product_category_id_foreign');
            $table->integer('product_group_id')->default(0);
            $table->string('name', 120)->default('');
            $table->string('full_name', 180)->nullable();
            $table->text('description')->nullable();
            $table->string('parameters', 240)->nullable();
            $table->string('weight', 30)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('product_price_group_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
