<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->index('blog_posts_comments_client_id_foreign');
            $table->unsignedBigInteger('post_id')->index('blog_posts_comments_post_id_foreign');
            $table->unsignedInteger('parent_id')->nullable();
            $table->mediumText('comment');
            $table->tinyInteger('approved')->default(0)->comment('0=pending 1=approved 2=disapproved');
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
        Schema::dropIfExists('blog_posts_comments');
    }
}
