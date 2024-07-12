<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_management', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('salary_payment_id')->default(0);
            $table->unsignedBigInteger('payroll_id')->default(0);
            $table->unsignedBigInteger('employee_id')->default(0);
            $table->char('currency', 3);
            $table->float('total', 10)->default(0);
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
        Schema::dropIfExists('salary_management');
    }
}
