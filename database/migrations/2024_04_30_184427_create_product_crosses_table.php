<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCrossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_crosses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid', 60)->default('')->index('uid')->comment('group_identifier');
            $table->string('pkey', 180)->default('');
            $table->string('article', 60)->nullable()->index('product_crosses_akey2_index');
            $table->string('akey', 60)->nullable()->index('product_crosses_akey1_index');
            $table->string('brand', 120)->nullable();
            $table->string('bkey', 120)->nullable();
            $table->string('code')->nullable();
            $table->string('name', 160)->nullable();
            $table->boolean('main_by_group')->nullable()->default(false);
            $table->boolean('main_by_brand')->nullable()->default(false);

            $table->index(['uid', 'pkey'], 'uid_pkey');
            $table->index(['article', 'brand'], 'product_crosses_akey2_bkey2_index');
            $table->index(['akey', 'bkey'], 'product_crosses_akey1_bkey1_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_crosses');
    }
}
