<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClientOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_orders', function (Blueprint $table) {
            $table->foreign(['client_id'])->references(['id'])->on('clients');
            $table->foreign(['user_id'])->references(['id'])->on('users');
            $table->foreign(['warehouse_id'])->references(['id'])->on('warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_orders', function (Blueprint $table) {
            $table->dropForeign('client_orders_client_id_foreign');
            $table->dropForeign('client_orders_user_id_foreign');
            $table->dropForeign('client_orders_warehouse_id_foreign');
        });
    }
}
