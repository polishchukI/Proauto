@extends('shop.template')

@section('content')
<!-- site__body -->
<div class="about">
	<div class="about__body">
		<div class="about__image">
			<div class="about__image-bg" style="background-image: url('images/about-1903x1903.jpg');"></div>
			<div class="decor about__image-decor decor--type--bottom">
				<div class="decor__body">
					<div class="decor__start"></div>
					<div class="decor__end"></div>
					<div class="decor__center"></div>
				</div>
			</div>
		</div>
		<div class="about__card">
			<div class="about__card-title">{{ __('shop.aboutus') }}</div>
			<div class="about__card-text">
				<p>{{ __('shop.company') }}</p>
				<p>{{ __('shop.mission') }}</p>
				<p>{{ __('shop.philosophy') }}</p>
				<p>{{ __('shop.goal') }}</p>
			</div>
			<div class="about__card-author">{{--setting('CEO')--}}</div>
			<!--div class="about__card-signature"><img src="images/signature.jpg" width="160" height="55" alt=""></div-->
		</div>
		<div class="about__indicators">
			<div class="about__indicators-body">
				<div class="about__indicators-item">
					<div class="about__indicators-item-value">{{--setting('stores_around_the_world')--}}</div>
					<div class="about__indicators-item-title">{{ __('shop.stores') }}</div>
				</div>
				<div class="about__indicators-item">
					<div class="about__indicators-item-value">{{--setting('original_auto_parts')--}}</div>
					<div class="about__indicators-item-title">{{ __('shop.partnames') }}</div>
				</div>
				<div class="about__indicators-item">
					<div class="about__indicators-item-value">{{--setting('satisfied_clients')--}}</div>
					<div class="about__indicators-item-title">{{ __('shop.clients') }}</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--divider-xl"></div>
@include('shop.block.testimonials')
<div class="block-space block-space--layout--divider-xl"></div>
@include('shop.block.testimonialsend')
<!-- site__body / end -->
@stop