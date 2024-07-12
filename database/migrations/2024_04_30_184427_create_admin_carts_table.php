<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('admin_carts_user_id_foreign');
            $table->unsignedBigInteger('client_id')->nullable()->default(0)->index('admin_carts_client_id_foreign');
            $table->unsignedBigInteger('client_auto_id')->nullable()->default(0)->index('admin_carts_client_auto_id_foreign');
            $table->unsignedBigInteger('warehouse_id')->index('admin_carts_warehouse_id_foreign');
            $table->char('currency', 3);
            $table->string('barcode', 255)->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('total_amount', 10)->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('admin_carts');
    }
}
