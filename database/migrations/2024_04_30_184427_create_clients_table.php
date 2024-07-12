<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lastname', 120)->nullable();
            $table->string('firstname', 120)->nullable();
            $table->string('secondname', 120)->nullable();
            $table->string('name', 128)->default('');
            $table->string('email', 128)->nullable();
            $table->string('password', 120)->nullable();
            $table->rememberToken();
            $table->string('phone', 15)->nullable();
            $table->boolean('active')->nullable()->default(false);
            $table->boolean('newsletter')->nullable()->default(false);
            $table->string('avatar', 150)->nullable();
            $table->date('birthday')->nullable();
            $table->decimal('product_discount', 4, 1)->default(0);
            $table->decimal('service_discount', 4, 1)->default(0);
            $table->text('comment')->nullable();
            $table->timestamp('last_purchase')->nullable();
            $table->unsignedInteger('total_purchases')->default(0);
            $table->unsignedDecimal('total_paid')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('telegram_notifications')->nullable()->default(0);
            $table->timestamp('notified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
