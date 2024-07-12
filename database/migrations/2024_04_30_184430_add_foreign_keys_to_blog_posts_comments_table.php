<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBlogPostsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_posts_comments', function (Blueprint $table) {
            $table->foreign(['client_id'])->references(['id'])->on('clients')->onDelete('CASCADE');
            $table->foreign(['post_id'])->references(['id'])->on('blog_posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_posts_comments', function (Blueprint $table) {
            $table->dropForeign('blog_posts_comments_client_id_foreign');
            $table->dropForeign('blog_posts_comments_post_id_foreign');
        });
    }
}
