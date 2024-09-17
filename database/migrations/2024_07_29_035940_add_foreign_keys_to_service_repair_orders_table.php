<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToServiceRepairOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_repair_orders', function (Blueprint $table) {
            $table->foreign(['employee_id'], 'service_repair_orders_ibfk_1')->references(['id'])->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_repair_orders', function (Blueprint $table) {
            $table->dropForeign('service_repair_orders_ibfk_1');
        });
    }
}
