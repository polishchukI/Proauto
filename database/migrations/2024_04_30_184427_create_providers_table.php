<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('spares_provider')->default(0);
            $table->tinyInteger('services_provider')->default(0);
            $table->string('name', 64)->nullable();
            $table->string('provider_code', 6)->nullable();
            $table->char('hasprice', 12);
            $table->text('description')->nullable();
            $table->text('paymentinfo')->nullable();
            $table->string('email', 90)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('client_login', 32)->nullable();
            $table->string('client_password', 32)->nullable();
            $table->string('client_id', 64)->nullable();
            $table->char('price_type', 3)->default('in');
            $table->char('price_currency', 3)->nullable();
            $table->double('price_add', 12, 2)->default(0);
            $table->double('price_extra')->default(0);
            $table->integer('day_add')->nullable();
            $table->integer('min_availability')->default(0);
            $table->integer('max_day')->default(0);
            $table->tinyInteger('percentgive')->default(100);
            $table->char('active', 10)->default('0');
            $table->integer('get_direct_art_search')->default(0);
            $table->string('script', 32)->nullable();
            $table->char('cache', 10)->default('0');
            $table->integer('query_limit')->nullable();
            $table->integer('daily_limit')->nullable();
            $table->char('links_take', 3)->default('0');
            $table->char('links_side', 5)->default('0');
            $table->integer('refresh_time')->default(0);
            $table->string('column_separator')->nullable();
            $table->char('price_encoding', 10)->nullable();
            $table->char('remote', 20)->nullable();
            $table->string('file_path', 120)->nullable();
            $table->char('article_brand_side', 20)->nullable();
            $table->string('article_brand_separator', 12)->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_password')->nullable();
            $table->integer('start_from')->nullable();
            $table->integer('stop_before')->nullable();
            $table->char('delete_on_start', 3)->nullable();
            $table->char('delete_quotes', 3)->nullable();
            $table->integer('range_discount')->nullable();
            $table->char('consider_hot', 3)->nullable();
            $table->string('default_brand')->nullable();
            $table->integer('default_available')->nullable();
            $table->string('default_stock')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['hasprice', 'cache', 'active'], 'keys_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers');
    }
}
