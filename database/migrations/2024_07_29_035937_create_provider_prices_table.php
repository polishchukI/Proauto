<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_prices', function (Blueprint $table) {
            $table->date('date')->default('2020-12-31');
            $table->string('akey', 64)->default('')->index();
            $table->string('bkey', 128)->default('');
            $table->string('pkey', 192)->default('')->index();
            $table->string('uid', 128)->primary();
            $table->string('article', 64)->default('');
            $table->string('provider_product_name', 160)->nullable();
            $table->string('brand', 96)->default('');
            $table->double('price', 12, 2);
            $table->double('src', 12, 2);
            $table->char('type', 3)->default('in');
            $table->char('currency', 3);
            $table->unsignedInteger('day');
            $table->unsignedInteger('available')->nullable();
            $table->string('provider', 32)->default('')->index('provider_prices_supplier_index');
            $table->string('stock', 32);
            $table->string('options', 112);
            $table->string('provider_code', 4)->index('provider_prices_code_index');

            $table->index(['akey', 'bkey', 'type']);
            $table->index(['akey', 'bkey', 'article', 'brand', 'provider_product_name'], 'provider_prices_akey_bkey_article_brand_alt_name_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_prices');
    }
}
