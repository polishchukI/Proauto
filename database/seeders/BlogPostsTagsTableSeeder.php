<?php

use Illuminate\Database\Seeder;

class BlogPostsTagsTableSeeder extends Seeder
{
    public function run()
    {
        

        \DB::table('blog_posts_tags')->delete();
        
        \DB::table('blog_posts_tags')->insert(array (
            0 => 
            array (
                'id' => 6,
                'post_id' => 1,
                'tag_id' => 1,
            ),
            1 => 
            array (
                'id' => 7,
                'post_id' => 1,
                'tag_id' => 2,
            ),
            2 => 
            array (
                'id' => 8,
                'post_id' => 1,
                'tag_id' => 3,
            ),
            3 => 
            array (
                'id' => 9,
                'post_id' => 2,
                'tag_id' => 4,
            ),
            4 => 
            array (
                'id' => 12,
                'post_id' => 2,
                'tag_id' => 5,
            ),
            5 => 
            array (
                'id' => 13,
                'post_id' => 2,
                'tag_id' => 6,
            ),
            6 => 
            array (
                'id' => 15,
                'post_id' => 3,
                'tag_id' => 6,
            ),
            7 => 
            array (
                'id' => 20,
                'post_id' => 3,
                'tag_id' => 5,
            ),
            8 => 
            array (
                'id' => 21,
                'post_id' => 4,
                'tag_id' => 1,
            ),
        ));
        
        
    }
}