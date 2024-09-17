<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderWebserviceTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_webservice_time', function (Blueprint $table) {
            $table->integer('wsid')->nullable();
            $table->integer('time')->nullable();
            $table->string('pkey')->nullable();
            $table->string('sid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_webservice_time');
    }
}
