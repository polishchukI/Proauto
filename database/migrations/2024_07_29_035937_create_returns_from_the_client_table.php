<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnsFromTheClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returns_from_the_client', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('currency', 3)->nullable();
            $table->decimal('total_amount', 10)->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable()->index('client_id');
            $table->string('barcode', 50)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('reference_type', 20)->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->timestamp('finalized_at')->nullable();
            $table->timestamps();
            $table->text('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returns_from_the_client');
    }
}
