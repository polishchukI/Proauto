<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->index('product_ratings_client_id_foreign');
            $table->string('akey', 64)->default('');
            $table->string('bkey', 64)->default('');
            $table->string('pkey', 128);
            $table->string('name', 180)->default('');
            $table->enum('rating', ['1', '2', '3', '4', '5']);
            $table->text('review');
            $table->string('email');
            $table->timestamps();
            $table->softDeletes();
            $table->string('article', 64)->default('');
            $table->string('brand', 64)->default('');
            $table->double('price', 10, 2)->default(0);
            $table->char('currency', 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_ratings');
    }
}
