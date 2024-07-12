<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('currency', 3)->default('');
            $table->text('comment')->nullable();
            $table->decimal('total_amount', 10)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('period_start')->nullable()->useCurrent();
            $table->timestamp('period_end')->nullable()->useCurrent();
            $table->timestamp('finalized_at')->nullable();
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
        Schema::dropIfExists('payrolls');
    }
}
