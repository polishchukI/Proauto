<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign(['client_id'])->references(['id'])->on('clients');
            $table->foreign(['client_order_correction_id'], 'transactions_ibfk_1')->references(['id'])->on('client_order_corrections')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['payment_method_id'])->references(['id'])->on('payment_methods');
            $table->foreign(['provider_id'])->references(['id'])->on('providers');
            $table->foreign(['sale_id'])->references(['id'])->on('sales')->onDelete('CASCADE');
            $table->foreign(['transfer_id'])->references(['id'])->on('transfers')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('transactions_client_id_foreign');
            $table->dropForeign('transactions_ibfk_1');
            $table->dropForeign('transactions_payment_method_id_foreign');
            $table->dropForeign('transactions_provider_id_foreign');
            $table->dropForeign('transactions_sale_id_foreign');
            $table->dropForeign('transactions_transfer_id_foreign');
            $table->dropForeign('transactions_user_id_foreign');
        });
    }
}
