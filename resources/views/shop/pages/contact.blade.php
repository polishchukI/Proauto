@extends('shop.template')

@section('content')
<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<!--breadcrumbs-->
			@include('shop.layouts.breadcrumbs')
			<!--breadcrumbs-end-->
			<h1 class="block-header__title">{{ __('messages.contact_us') }}</h1>
		</div>
	</div>
</div>

<div class="block">
	<div class="container container-lg">
		<div class="card contacts">
			<div class="contacts__map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2653.966918175645!2d37.99297001560428!3d48.30348767923701!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40e079bd23b814ff%3A0x8f80addb21ec3320!2z0LLRg9C70LjRhtGPINCe0YHRgtCw0L_QtdC90LrQsCwgMTYsINCT0L7RgNC70ZbQstC60LAsINCU0L7QvdC10YbRjNC60LAg0L7QsdC70LDRgdGC0YwsIDg0NjE5!5e0!3m2!1suk!2sua!4v1589736485670!5m2!1suk!2sua" scrolling="no" marginheight="0" marginwidth="0" frameborder="0"></iframe>
			</div>
			<div class="card-body card-body--padding--2">

				@if (session($key ?? 'status'))
				<div class="alert alert-success" role="alert">
					<i class="far fa-bell"></i>
					<button type="button" class="close" data-dismiss="alert">×</button>
					{!! session($key ?? 'status') !!}
				</div>
				@endif
				<div class="row">
					<div class="col-12 col-lg-6 pb-4 pb-lg-0">
						<div class="mr-1">
							<h4 class="contact-us__header card-title">{{ __('messages.our_address') }}</h4>
							<div class="contact-us__address">
								<p>{{ config('shop_settings.address') }}<br>
								{{ config('shop_settings.city') }}<br>
								{{ config('shop_settings.state') }}<br>
								{{ config('shop_settings.country') }}<br>
								{{ config('shop_settings.zipcode') }}<br>
								{{ __('messages.mailto') }}:<a href="mailto:{{ config('shop_settings.email') }}">{{ config('shop_settings.email') }}</a>
								<br>{{ __('messages.phones') }}: {{ config('shop_settings.phone') }}; {{ config('shop_settings.phone2') }}</p>
								<p><strong>{{ __('messages.workinghours') }}</strong><br>{{ config('shop_settings.workinghours') }}<br>{{ config('shop_settings.day_off') }}</p>
								<p><strong>{{ __('messages.comment') }}</strong><br>
								{{ __('messages.we_are') }}<br>
								{{ __('messages.our_warehouses') }}</p>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-6">
						<div class="ml-1">
							<h4 class="contact-us__header card-title">{{ __('messages.leave_us_a_message') }}</h4>
							@include('shop.block.recaptcha')
							<form  method="POST" action="{{ route('contact.send') }}">
								@csrf
								<div class="form-group">
									<label for="form-name">{{ __('messages.name') }}</label>
									<input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.name') }}" requested>
								</div>
								<div class="form-group">
									<label for="form-email">{{ __('messages.email') }}</label>
									<input type="email" id="email" name="email" class="form-control" placeholder="{{ __('messages.email') }}" requested>
								</div>
								<div class="form-group">
									<label for="form-subject">{{ __('messages.subject') }}</label>
									<select class="form-control" id="subject" name="subject_id" class="form-control">
										<option value="">{{ __('messages.select_subject') }}</option>
										@foreach($subjects as $item)
										<option value="{{$item['id']}}">{{$item['subject']}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="form-order">{{ __('messages.order_number') }}</label>
									<input type="text" id="order" name="order" class="form-control" placeholder="{{ __('messages.order_number') }}">
								</div>
								<div class="form-group">
									<label for="form-check_product">{{ __('messages.check_product') }}</label>
									<input type="text" id="check_product" name="check_product" class="form-control" placeholder="{{ __('messages.check_product') }}">
								</div>
								<div class="form-group">
									<label for="form-vin">{{ __('messages.enter_vin') }}</label>
									<input type="text" id="vin" name="vin" class="form-control" placeholder="VIN">
									<div class="alert alert-info mb-3">
										<p>{{ __('messages.vin_comment') }}</p>
										<img src="/images/vin.png" alt="">
									</div>
								</div>
								<div class="form-group">
									<label for="form-message">{{ __('messages.message') }}</label>
									<textarea id="message" name="message"  class="form-control" rows="4" requested></textarea>
								</div>
								<div class="form-group">
									<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
									@error('recaptcha_response')
										<span class="invalid-feedback d-block mb-5" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<button type="submit" class="btn btn-primary">{{ __('messages.send_message') }}</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop