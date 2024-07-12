<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClientPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_phones', function (Blueprint $table) {
            $table->foreign(['client_id'], 'client_phones_ibfk_1')->references(['id'])->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_phones', function (Blueprint $table) {
            $table->dropForeign('client_phones_ibfk_1');
        });
    }
}
