<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_autos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->nullable()->index('client_id');
            $table->string('vin', 17)->nullable();
            $table->string('url')->nullable();
            $table->string('name')->nullable();
            $table->string('engine')->nullable();
            $table->string('ccm')->nullable();
            $table->string('fuel')->nullable();
            $table->string('body')->nullable();
            $table->string('details')->nullable();
            $table->string('year', 4)->nullable();
            $table->string('plate', 18)->nullable();
            $table->string('color', 20)->nullable();
            $table->string('comment', 255)->nullable();
            $table->string('model_id', 8)->nullable();
            $table->string('modification_id', 8)->nullable();
            $table->string('group', 24)->nullable();
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
        Schema::dropIfExists('client_autos');
    }
}
