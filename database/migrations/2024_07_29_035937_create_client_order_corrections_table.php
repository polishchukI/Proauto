<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientOrderCorrectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_order_corrections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->unsignedBigInteger('client_id')->index('client_id');
            $table->string('barcode', 50)->nullable();
            $table->unsignedBigInteger('warehouse_id')->index('warehouse_id');
            $table->char('currency', 3);
            $table->integer('quantity')->nullable();
            $table->decimal('total_amount', 10)->nullable();
            $table->text('comment')->nullable();
            $table->string('reference_type', 60)->nullable();
            $table->bigInteger('reference_id')->nullable();
            $table->timestamp('finalized_at')->nullable();
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
        Schema::dropIfExists('client_order_corrections');
    }
}
