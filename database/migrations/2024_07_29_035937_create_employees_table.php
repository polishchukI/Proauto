<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lastname', 120)->nullable();
            $table->string('firstname', 120)->nullable();
            $table->string('secondname', 120)->nullable();
            $table->string('fullname', 255)->default('');
            $table->enum('isuser', ['False', 'True'])->nullable()->default('False');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('fired_at')->nullable();
            $table->timestamps();
            $table->enum('isworker', ['False', 'True'])->default('False');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
