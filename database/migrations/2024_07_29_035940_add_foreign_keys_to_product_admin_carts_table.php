<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductAdminCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_admin_carts', function (Blueprint $table) {
            $table->foreign(['admincart_id'], 'product_admin_carts_admin_cart_id_foreign')->references(['id'])->on('admin_carts')->onDelete('CASCADE');
            $table->foreign(['product_id'])->references(['id'])->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_admin_carts', function (Blueprint $table) {
            $table->dropForeign('product_admin_carts_admin_cart_id_foreign');
            $table->dropForeign('product_admin_carts_product_id_foreign');
        });
    }
}
