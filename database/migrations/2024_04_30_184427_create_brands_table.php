<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('brand', 128)->nullable()->unique('brands_brand_index');
            $table->string('bkey', 128)->nullable()->unique('bkey');
            $table->enum('isactive', ['True', 'False'])->default('False')->index('isactive');
            $table->enum('isshowable', ['False', 'True'])->nullable();
            $table->enum('isprovider', ['True', 'False'])->default('False');
            $table->enum('ismanufacturer', ['True', 'False'])->nullable()->default('False')->index('ismanufacturer');
            $table->enum('ispassengercar', ['True', 'False'])->default('False');
            $table->enum('isaxle', ['True', 'False'])->default('False');
            $table->enum('ismotorbike', ['True', 'False'])->default('False');
            $table->enum('isengine', ['True', 'False'])->default('False');
            $table->enum('iscommercialvehicle', ['True', 'False'])->default('False');
            $table->text('brand_text')->nullable();
            $table->string('off_site', 160)->nullable();
            $table->string('catalog_url', 160)->nullable();
            $table->string('iso', 6)->nullable();
            $table->string('country', 30)->nullable();
            $table->string('slug', 150)->nullable();
            $table->string('logo', 150)->nullable();
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
        Schema::dropIfExists('brands');
    }
}
