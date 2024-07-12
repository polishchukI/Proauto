<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 60)->default('');
            $table->string('title', 60)->default('');
            $table->string('reference', 60)->nullable();
            $table->unsignedBigInteger('client_id')->nullable()->index('transactions_client_id_foreign');
            $table->unsignedBigInteger('sale_id')->nullable()->index('transactions_sale_id_foreign');
            $table->unsignedBigInteger('receipt_id')->nullable();
            $table->unsignedBigInteger('return_from_the_client_id')->nullable();
            $table->unsignedBigInteger('services_receipt_id')->nullable()->default(0);
            $table->unsignedBigInteger('return_to_provider_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable()->index('transactions_provider_id_foreign');
            $table->unsignedBigInteger('transfer_id')->nullable()->index('transactions_transfer_id_foreign');
            $table->unsignedBigInteger('payment_method_id')->index('transactions_payment_method_id_foreign');
            $table->decimal('amount', 10);
            $table->unsignedBigInteger('user_id')->index('transactions_user_id_foreign');
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
        Schema::dropIfExists('transactions');
    }
}
