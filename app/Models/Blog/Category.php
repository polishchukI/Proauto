<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'blog_categories';

    protected $primaryKey = 'id';

    protected $fillable = ['title', 'slug'];

    protected $appends = ['num_posts'];

    public function getNumPostsAttribute()
    {
        return $this->posts()->count();
    }
	
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
