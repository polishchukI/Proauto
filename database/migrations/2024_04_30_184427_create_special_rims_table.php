<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialRimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_rims', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('article', 60)->default('');
            $table->string('akey', 60)->default('');
            $table->string('brand', 60)->default('');
            $table->string('bkey', 60)->default('');
            $table->string('model', 192)->nullable();
            $table->string('width', 20)->default('0');
            $table->string('size', 20)->default('0');
            $table->string('bolt_hole_circle', 20)->default('0');
            $table->string('rim_hole_number', 20)->default('0');
            $table->string('offset', 20)->default('0');
            $table->string('material', 60)->nullable()->default('NULL');
            $table->string('product_line', 180)->nullable()->default('NULL');
            $table->string('colour', 60)->nullable()->default('NULL');
            $table->string('centering_diameter', 30)->nullable()->default('NULL');
            $table->string('condition', 30)->nullable()->default('NULL');
            $table->string('ean', 20)->default('0');
            $table->string('image', 180)->nullable()->default('NULL');
            $table->string('type', 60)->default('');

            $table->index(['akey', 'bkey']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_rims');
    }
}
