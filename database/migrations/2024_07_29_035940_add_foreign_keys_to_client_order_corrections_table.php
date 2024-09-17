<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClientOrderCorrectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_order_corrections', function (Blueprint $table) {
            $table->foreign(['user_id'], 'client_order_corrections_ibfk_1')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['client_id'], 'client_order_corrections_ibfk_2')->references(['id'])->on('clients')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['warehouse_id'], 'client_order_corrections_ibfk_3')->references(['id'])->on('warehouses')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_order_corrections', function (Blueprint $table) {
            $table->dropForeign('client_order_corrections_ibfk_1');
            $table->dropForeign('client_order_corrections_ibfk_2');
            $table->dropForeign('client_order_corrections_ibfk_3');
        });
    }
}
