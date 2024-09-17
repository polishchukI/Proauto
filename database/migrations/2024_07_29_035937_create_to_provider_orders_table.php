<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToProviderOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('to_provider_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('provider_id')->nullable()->index('document_order_to_providers_provider_id_foreign');
            $table->string('barcode', 50)->nullable();
            $table->unsignedBigInteger('user_id')->index('document_order_to_providers_user_id_foreign');
            $table->unsignedBigInteger('warehouse_id')->index('document_order_to_providers_warehouse_id_foreign');
            $table->char('currency', 3);
            $table->integer('total_quantity')->nullable();
            $table->decimal('total_amount', 10)->nullable();
            $table->string('reference_type', 60)->nullable();
            $table->bigInteger('reference_id')->nullable();
            $table->timestamp('finalized_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->text('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('to_provider_orders');
    }
}
