<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProviderPriceColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provider_price_columns', function (Blueprint $table) {
            $table->foreign(['provider_id'])->references(['id'])->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provider_price_columns', function (Blueprint $table) {
            $table->dropForeign('provider_price_columns_provider_id_foreign');
        });
    }
}
