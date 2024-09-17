<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAdminCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_admin_carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admincart_id')->default(0)->index('product_admin_carts_admin_cart_id_foreign');
            $table->unsignedBigInteger('product_id')->index('product_admin_carts_product_id_foreign');
            $table->decimal('quantity', 10)->nullable();
            $table->decimal('price', 10)->nullable();
            $table->decimal('total_amount', 10)->nullable();
            $table->unsignedBigInteger('warehouse_id');
            $table->char('currency', 3);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_admin_carts');
    }
}
