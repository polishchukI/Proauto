<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice')->nullable();
            $table->integer('order_status_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('firstname', 128)->nullable()->default('NULL');
            $table->string('lastname', 128)->nullable()->default('NULL');
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('currency', 4)->default('');
            $table->integer('delivery_id')->nullable();
            $table->integer('billing_address_id')->nullable();
            $table->integer('shipping_address_id')->nullable();
            $table->text('comment')->nullable();
            $table->string('track_status', 255)->nullable();
            $table->float('sum')->nullable();
            $table->string('count')->nullable();
            $table->decimal('shipping', 10)->nullable();
            $table->string('balance')->nullable();
            $table->decimal('subtotal', 10)->default(0);
            $table->decimal('tax', 10)->nullable()->default(0);
            $table->decimal('total', 10)->nullable()->default(0);
            $table->enum('payment_status', ['Paid', 'Unpaid'])->nullable();
            $table->string('payment_methods', 255)->nullable();
            $table->string('payment_details', 255)->nullable();
            $table->string('client_product_discount', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('finalized_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('online_orders');
    }
}
