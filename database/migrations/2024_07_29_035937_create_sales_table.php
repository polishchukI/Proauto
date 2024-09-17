<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('sales_user_id_foreign');
            $table->string('reference_type', 20)->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->unsignedBigInteger('client_id')->index('sales_client_id_foreign');
            $table->unsignedBigInteger('warehouse_id')->default(0);
            $table->decimal('discount', 4, 0)->nullable();
            $table->string('barcode', 50)->nullable();
            $table->char('currency', 3)->default('');
            $table->decimal('total', 10)->default(0);
            $table->decimal('discount_amount', 10)->nullable();
            $table->decimal('total_amount', 10)->nullable();
            $table->text('comment')->nullable();
            $table->timestamp('finalized_at')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
