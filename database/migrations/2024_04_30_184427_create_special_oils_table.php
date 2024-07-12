<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialOilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_oils', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('article', 60)->nullable();
            $table->string('akey', 60)->default('');
            $table->string('brand', 60)->nullable();
            $table->string('bkey', 60)->default('');
            $table->string('name', 120)->nullable();
            $table->string('type', 60)->default('');
            $table->string('image', 255)->nullable();
            $table->float('volume', 3, 0)->unsigned()->nullable();
            $table->string('acea', 60)->nullable();
            $table->string('sae', 10)->nullable();
            $table->string('oem', 180)->nullable();
            $table->string('api', 18)->nullable();
            $table->string('astm', 12)->nullable();
            $table->string('ilsac', 24)->nullable();
            $table->string('jaso', 24)->nullable();
            $table->string('nato', 24)->nullable();
            $table->string('global', 24)->nullable();
            $table->string('zf', 24)->nullable();
            $table->string('basis', 60)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_oils');
    }
}
