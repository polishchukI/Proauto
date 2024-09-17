<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductClientToProviderOrderControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_client_to_provider_order_control', function (Blueprint $table) {
            $table->foreign(['product_id'], 'product_client_to_provider_order_control_ibfk_1')->references(['id'])->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_client_to_provider_order_control', function (Blueprint $table) {
            $table->dropForeign('product_client_to_provider_order_control_ibfk_1');
        });
    }
}
