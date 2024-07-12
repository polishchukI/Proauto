<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model
{
	protected $table = 'blog_posts_comments';
	
    protected $primaryKey = 'id';
	
    protected $guarded = ['id'];
	
	protected $appends = ['date_formatted'];
 
    public function post()
    {
        return $this->belongsTo('App\Models\Blog\Post', 'post_id');
    }
 
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
 
    public function getDateFormattedAttribute()
    {
		return \Carbon\Carbon::parse($this->created_at)->format('Y/m/d h:i a');
	}

    public function scopeLastWeek(Builder $query): Builder
    {
        return $query->whereBetween('created_at', [now()->subWeek(), now()])->latest();
    }
	
	public function replies()
	{
		return $this->hasMany(Comment::class, 'parent_id');
	}
}
