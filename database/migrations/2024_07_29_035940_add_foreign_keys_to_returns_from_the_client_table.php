<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToReturnsFromTheClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('returns_from_the_client', function (Blueprint $table) {
            $table->foreign(['client_id'], 'returns_from_the_client_ibfk_1')->references(['id'])->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('returns_from_the_client', function (Blueprint $table) {
            $table->dropForeign('returns_from_the_client_ibfk_1');
        });
    }
}
