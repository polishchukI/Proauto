<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderWebserviceCounterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_webservice_counter', function (Blueprint $table) {
            $table->integer('wsid')->nullable();
            $table->integer('time_stamp')->nullable();
            $table->integer('counter')->nullable();
            $table->integer('section_counter')->nullable();
            $table->integer('search_counter')->nullable();
            $table->integer('analog_counter')->nullable();
            $table->integer('sockets_counter')->nullable();
            $table->integer('cache_counter')->nullable();
            $table->string('available_counter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_webservice_counter');
    }
}
