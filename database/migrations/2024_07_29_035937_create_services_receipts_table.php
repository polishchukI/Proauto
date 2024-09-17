<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('currency', 3)->nullable();
            $table->decimal('total_amount', 10)->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->string('provider_doc_number', 30)->nullable();
            $table->date('provider_doc_date')->nullable();
            $table->string('barcode', 50)->nullable();
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('services_receipts');
    }
}
