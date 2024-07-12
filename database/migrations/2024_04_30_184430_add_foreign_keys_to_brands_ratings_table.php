<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBrandsRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands_ratings', function (Blueprint $table) {
            $table->foreign(['brand_id'])->references(['id'])->on('brands');
            $table->foreign(['client_id'])->references(['id'])->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands_ratings', function (Blueprint $table) {
            $table->dropForeign('brands_ratings_brand_id_foreign');
            $table->dropForeign('brands_ratings_client_id_foreign');
        });
    }
}
