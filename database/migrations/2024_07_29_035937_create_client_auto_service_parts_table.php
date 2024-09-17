<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAutoServicePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_auto_service_parts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_auto_id')->default(0);
            $table->unsignedBigInteger('product_id')->default(0);
            $table->string('quantity', 5)->nullable();
            $table->string('comment', 300)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_auto_service_parts');
    }
}
