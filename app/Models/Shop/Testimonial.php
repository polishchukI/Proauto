<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
	protected $table = 'testimonials';
	
	protected $primaryKey = 'id';
	
    protected $fillable = ['client_id', 'rating', 'review', 'approved'];
}
