@if(count($testimonials)>0)
<div class="block block-reviews">
	<div class="container">
		<div class="block-reviews__title">{{ __('shop.testimonials') }}</div>
		<div class="block-reviews__subtitle">{{ __('shop.testimonialstext') }}</div>
		<div class="block-reviews__list">
			<div class="owl-carousel">
			@foreach($testimonials as $testimonial)
				<div class="block-reviews__item">
					<div class="block-reviews__item-avatar"><img src="{{$testimonial['avatar']}}" alt="{{$testimonial['firstname']}}"></div>
					<div class="block-reviews__item-content">
						<div class="block-reviews__item-text">{{$testimonial['review']}}</div>
						<div class="block-reviews__item-meta">
							<div class="block-reviews__item-rating">
								<div class="rating">
									<div class="rating__body">
										@for($i=1; $i<=$testimonial['rating']; $i++)
										<div class="rating__star rating__star--active"></div>
										@endfor
										{{--@for($i=1; $i<=$testimonial['rating_left']; $i++)
										<div class="rating__star"></div>
										@endfor--}}
									</div>
								</div>
							</div>
							<div class="block-reviews__item-author">{{$testimonial['firstname']}} @if($testimonial['lastname']){{$testimonial['lastname']}}@endif</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endif