<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPriceGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_price_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 120)->default('');
            $table->string('comment', 120)->nullable();
            $table->decimal('surcharge', 4, 1)->default(0);
            $table->decimal('surcharge_coefficient', 4, 1)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_price_groups');
    }
}
