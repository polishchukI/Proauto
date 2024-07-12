<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_urls', function (Blueprint $table) {
            $table->unsignedBigInteger('model_id')->nullable()->default(0);
            $table->unsignedBigInteger('manufacturer_id')->nullable()->default(0);
            $table->string('url_name', 180)->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_urls');
    }
}
