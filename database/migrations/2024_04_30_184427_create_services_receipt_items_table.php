<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesReceiptItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_receipt_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('services_receipt_id')->default(0);
            $table->unsignedBigInteger('service_id')->default(0);
            $table->unsignedBigInteger('warehouse_id')->default(0);
            $table->char('currency', 3);
            $table->decimal('price', 10);
            $table->integer('quantity')->default(0);
            $table->decimal('total_amount', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_receipt_items');
    }
}
