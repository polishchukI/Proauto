<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop\Testimonial;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class TestimonialsController extends Controller
{
	static function testimonialsend(Request $request)
	{
		$request->validate([
			'client_id' => 'required',
			'rating' => 'required',			
			'review' => 'required',			
		]);
		
		$input = $request->all();

		Testimonial::create($input);

        return back();
	}
	
	public static function ShowTestimonials()
	{
		$testimonials = [];
		$testimonials = Testimonial::select('testimonials.*',
				'clients.lastname',
				'clients.firstname',
				'clients.email',
				'clients.avatar')
				
				->where('approved', '>', 0)
				->join('clients', 'testimonials.client_id', '=', 'clients.id')
				->inRandomOrder()
				->limit(5)
				->get()
				->toArray();
				
		return $testimonials;
	}
}