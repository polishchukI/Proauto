<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    protected $table = 'blog_posts';

    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];

	public function tag()
    {
        return $this->belongsToMany('App\Models\Blog\Tag', 'blog_posts_tags');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Blog\Comment')->whereNull('parent_id');
    }

    public function approvedComments()
    {
        return $this->hasMany('App\Models\Blog\Comment', 'post_id')->with('user', 'post')->where('approved', 1);
    }

    public function getDateFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('F d, Y');
    }

    public function category()
    {
		return $this->belongsTo('App\Models\Blog\Category');
	}
	
    public function author()
    {
		return $this->belongsTo(\App\User::class,'author_id','id');
	}

    public function scopeLastMonth(Builder $query, int $limit = 5): Builder
    {
        return $query->whereBetween('created_at', [now()->subMonth(), now()])
                     ->latest()
                     ->limit($limit);
    }

    public function scopeLastWeek(Builder $query): Builder
    {
        return $query->whereBetween('created_at', [now()->subWeek(), now()])
                     ->latest();
    }
}
