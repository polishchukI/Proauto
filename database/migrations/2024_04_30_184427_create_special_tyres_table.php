<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialTyresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_tyres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('article', 60)->default('');
            $table->string('akey', 60)->default('');
            $table->string('brand', 60)->default('');
            $table->string('bkey', 60)->default('');
            $table->char('width', 10)->default('');
            $table->char('height', 10)->nullable()->default('');
            $table->char('size', 10)->default('');
            $table->char('type', 10)->default('');
            $table->char('load_index', 10)->default('');
            $table->char('speed_rating', 10)->default('');
            $table->string('car_type', 160)->default('');
            $table->string('season', 60)->default('');
            $table->string('rim_protection', 90)->default('');
            $table->string('run_flat', 60)->default('');
            $table->string('spikes', 60)->default('');
            $table->string('extra_load_reinforced', 60)->default('');
            $table->string('c_type', 60)->default('');
            $table->string('name', 60)->default('');
            $table->string('model', 60)->default('');
            $table->string('image', 255)->default('');
            $table->string('ean', 13)->nullable();

            $table->unique(['bkey', 'akey'], 'bkey');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_tyres');
    }
}
