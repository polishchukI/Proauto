<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('currency', 3)->nullable();
            $table->decimal('total_amount', 10)->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable()->index('receipts_provider_id_foreign');
            $table->string('provider_doc_number', 30)->nullable();
            $table->date('provider_doc_date')->nullable();
            $table->string('barcode', 50)->nullable();
            $table->unsignedBigInteger('user_id')->index('receipts_user_id_foreign');
            $table->boolean('setup_prices')->default(false);
            $table->boolean('is_gratuitous')->default(false);
            $table->tinyInteger('surcharge')->default(0);
            $table->tinyInteger('surcharge_coefficient')->default(0);
            $table->string('reference_type', 20)->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->timestamp('finalized_at')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('receipts');
    }
}
