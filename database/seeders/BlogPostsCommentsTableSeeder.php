<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogPostsCommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('blog_posts_comments')->delete();
        
        
        
    }
}