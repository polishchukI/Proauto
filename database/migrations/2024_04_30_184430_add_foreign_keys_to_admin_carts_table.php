<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAdminCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_carts', function (Blueprint $table) {
            $table->foreign(['client_auto_id'])->references(['id'])->on('client_autos');
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
        Schema::table('admin_carts', function (Blueprint $table) {
            $table->dropForeign('admin_carts_client_auto_id_foreign');
            $table->dropForeign('admin_carts_client_id_foreign');
            $table->dropForeign('admin_carts_user_id_foreign');
            $table->dropForeign('admin_carts_warehouse_id_foreign');
        });
    }
}
