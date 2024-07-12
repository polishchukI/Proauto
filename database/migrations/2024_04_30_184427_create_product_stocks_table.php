<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index('product_stocks_product_id_foreign');
            $table->char('doc_type', 30)->default('receipt');
            $table->unsignedBigInteger('doc_id')->default(0);
            $table->string('batch', 128);
            $table->unsignedBigInteger('warehouse_id')->index('product_stocks_warehouse_id_foreign');
            $table->bigInteger('quantity')->nullable();
            $table->char('currency', 3);
            $table->double('price', 10, 2)->nullable();
            $table->double('total', 10, 2)->nullable();
            $table->char('currency_out', 3)->nullable();
            $table->double('price_out', 10, 2)->nullable();
            $table->string('discount_out', 10)->nullable();
            $table->double('total_out', 10, 2)->nullable();
            $table->timestamp('finalized_at')->nullable();
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
        Schema::dropIfExists('product_stocks');
    }
}
