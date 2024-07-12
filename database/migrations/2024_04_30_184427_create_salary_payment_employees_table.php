<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryPaymentEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_payment_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('salary_payment_id')->nullable();
            $table->unsignedBigInteger('employee_id')->default(0);
            $table->char('currency', 3)->nullable();
            $table->float('salary', 10)->nullable();
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
        Schema::dropIfExists('salary_payment_employees');
    }
}
