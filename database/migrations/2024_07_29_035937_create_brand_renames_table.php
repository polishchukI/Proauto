<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandRenamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_renames', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->unsignedBigInteger('user_id')->default(0)->index('user_id');
            $table->string('name', 120)->default('');
            $table->string('bkey', 60)->default('');
            $table->string('rename_from', 120)->default('');
            $table->string('rename_from_bkey', 120)->default('')->unique('rename_from_bkey');
            $table->string('rename_to', 120)->default('');
            $table->string('rename_to_bkey', 120)->default('');
            $table->string('comment', 240)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_renames');
    }
}
