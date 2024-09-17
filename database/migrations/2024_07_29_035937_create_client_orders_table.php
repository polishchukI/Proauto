<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('client_orders_user_id_foreign');
            $table->unsignedBigInteger('client_id')->index('client_orders_client_id_foreign');
            $table->string('barcode', 50)->nullable();
            $table->unsignedBigInteger('warehouse_id')->index('client_orders_warehouse_id_foreign');
            $table->char('currency', 3);
            $table->integer('quantity')->nullable();
            $table->decimal('total_amount', 10)->nullable();
            $table->text('comment')->nullable();
            $table->string('reference_type', 60)->nullable();
            $table->bigInteger('reference_id')->nullable();
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
        Schema::dropIfExists('client_orders');
    }
}
