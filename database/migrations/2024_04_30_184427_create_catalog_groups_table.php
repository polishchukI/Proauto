<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 12)->default('');
            $table->string('description', 20)->default('');
            $table->enum('isactive', ['False', 'True'])->default('False');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_groups');
    }
}
