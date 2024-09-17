<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventorySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_settings', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->char('default_currency', 3)->default('RUB');
            $table->text('terms_of_delivery');
            $table->timestamps();
            $table->softDeletes();
            $table->char('organisation_name', 120)->default('');
            $table->string('organisation_email', 120)->nullable();
            $table->string('organisation_phone', 120)->nullable();
            $table->string('organisation_phone2', 120)->nullable();
            $table->string('slogan', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_settings');
    }
}
