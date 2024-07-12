<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 120)->default('');
            $table->string('email', 120)->default('');
            $table->unsignedBigInteger('subject_id')->default(0);
            $table->string('order', 120)->nullable();
            $table->string('check_product', 120)->nullable();
            $table->string('vin', 17)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('message', 255)->default('');
            $table->unsignedBigInteger('client_id')->nullable()->default(0);
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
        Schema::dropIfExists('shop_messages');
    }
}
