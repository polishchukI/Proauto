<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->default(0);
            $table->string('zipcode', 8)->nullable();
            $table->string('country', 30)->nullable();
            $table->string('state', 60)->nullable();
            $table->string('city', 60)->nullable();
            $table->string('settlement', 60)->nullable();
            $table->string('street', 60)->nullable();
            $table->string('address', 20)->nullable();
            $table->string('housing', 20)->nullable();
            $table->string('apartment', 10)->nullable();
            $table->string('name', 300)->nullable();
            $table->boolean('default')->default(false);
            $table->tinyInteger('shipping')->nullable();
            $table->tinyInteger('billing')->nullable();
            $table->string('comment', 300)->nullable();
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
        Schema::dropIfExists('client_addresses');
    }
}
