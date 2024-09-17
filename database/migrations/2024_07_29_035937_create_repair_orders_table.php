<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('reference_type', 20)->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('warehouse_id')->default(0);
            $table->decimal('discount', 4, 0)->nullable();
            $table->decimal('service_discount', 4, 0)->default(0);
            $table->string('barcode', 50)->nullable();
            $table->char('currency', 3)->default('');
            $table->decimal('total', 10)->default(0);
            $table->decimal('discount_amount', 10)->default(0);
            $table->decimal('total_amount', 10)->default(0);
            $table->text('comment')->nullable();
            $table->timestamp('finalized_at')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('client_auto_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_orders');
    }
}
