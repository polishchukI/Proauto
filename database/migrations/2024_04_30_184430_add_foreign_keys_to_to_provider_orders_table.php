<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToToProviderOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('to_provider_orders', function (Blueprint $table) {
            $table->foreign(['provider_id'], 'document_order_to_providers_provider_id_foreign')->references(['id'])->on('providers');
            $table->foreign(['user_id'], 'document_order_to_providers_user_id_foreign')->references(['id'])->on('users');
            $table->foreign(['warehouse_id'], 'document_order_to_providers_warehouse_id_foreign')->references(['id'])->on('warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('to_provider_orders', function (Blueprint $table) {
            $table->dropForeign('document_order_to_providers_provider_id_foreign');
            $table->dropForeign('document_order_to_providers_user_id_foreign');
            $table->dropForeign('document_order_to_providers_warehouse_id_foreign');
        });
    }
}
