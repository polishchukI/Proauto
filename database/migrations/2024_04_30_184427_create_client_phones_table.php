<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_phones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->index('client_id');
            $table->string('phone', 20)->default('');
            $table->boolean('telegram')->default(false);
            $table->string('telegram_chat_id', 180)->nullable();
            $table->boolean('viber')->default(false);
            $table->string('viber_chat_id', 180)->nullable();
            $table->boolean('whatsapp')->default(false);
            $table->string('whatsapp_chat_id', 180)->nullable();
            $table->boolean('default')->nullable();
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
        Schema::dropIfExists('client_phones');
    }
}
