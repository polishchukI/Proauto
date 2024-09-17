<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialBatteriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_batteries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('article', 60)->default('');
            $table->string('akey', 60)->default('');
            $table->string('brand', 60)->default('');
            $table->string('bkey', 60)->default('');
            $table->string('pkey', 180)->default('');
            $table->string('voltage', 6)->nullable();
            $table->string('capacity', 20)->nullable();
            $table->string('polarity', 20)->nullable();
            $table->string('starting_current', 255)->nullable();
            $table->char('width', 60)->default('');
            $table->char('height', 60)->nullable()->default('');
            $table->string('length', 60)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_batteries');
    }
}
