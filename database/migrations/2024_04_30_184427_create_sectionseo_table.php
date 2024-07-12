<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionseoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectionseo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sec_id')->nullable();
            $table->integer('lng_code')->nullable();
            $table->text('sec_seo')->nullable();
            $table->text('sec_seo_header')->nullable();
            $table->text('sec_seo_types')->nullable();
            $table->text('seo_service_life')->nullable();
            $table->text('sec_seo_failures')->nullable();
            $table->text('sec_seo_causes_failure')->nullable();
            $table->text('sec_seo_replacement')->nullable();
            $table->text('sec_seo_buy')->nullable();
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
        Schema::dropIfExists('sectionseo');
    }
}
