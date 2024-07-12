@extends('inventory.layouts.app', ['page' => __('inventory.edit_provider'), 'pageSlug' => 'providers', 'section' => 'providers', 'search' => 'providers'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col-8">
						<h6 class="heading-small text-info mb-4">{{ __('inventory.provider_information') }}</h6>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('providers.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form method="post" action="{{ route('providers.update', $provider) }}" autocomplete="off">
					@csrf
					@method('put')                            
					<div class="pl-lg-4">
						<!--price settings-->
						<div class="row">
							<div class="col-4">
								<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-name">{{ __('inventory.provider_name') }}</label>
									<input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $provider->name) }}" required autofocus>
									@include('inventory.alerts.feedback', ['field' => 'name'])
								</div>
							</div>
							<div class="col-4">
								<label class="form-control-label" for="input-hasprice">{{ __('inventory.provider_hasprice') }}</label>
								<select name="hasprice" id="input-hasprice" class="form-control form-control-alternative{{ $errors->has('hasprice') ? ' is-invalid' : '' }}" required>
									@foreach (['None', 'Price', 'Webservice'] as $hasprice)
										@if($hasprice == old('hasprice') or $hasprice == $provider->hasprice)
											<option value="{{$hasprice}}" selected>{{$hasprice}}</option>
										@else
											<option value="{{$hasprice}}">{{$hasprice}}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label for="provider_code" class="control-label">{{ __('inventory.provider_provider_code') }}</label>
									<input class="form-control" required name="provider_code" type="text"  placeholder="{{ __('inventory.price_any_name') }}" value="{{ old('provider_code', $provider->provider_code) }}"></div>
									@include('inventory.alerts.feedback', ['field' => 'provider_code'])
								</div>
							</div>
						</div>
						<!--login/password/client_id-->
						<hr style="border: 1px solid blue;">
						<div class="row">
							<div class="col-3">
								<div class="form-group{{ $errors->has('client_login') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-client_login">{{ __('inventory.provider_client_login') }}</label>
									<input type="text" name="client_login" id="input-client_login" class="form-control form-control-alternative{{ $errors->has('client_login') ? ' is-invalid' : '' }}" value="{{ old('client_login', $provider->client_login) }}">
									@include('inventory.alerts.feedback', ['field' => 'client_login'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('client_password') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-client_password">{{ __('inventory.provider_client_password') }}</label>
									<input type="text" name="client_password" id="input-client_password" class="form-control form-control-alternative{{ $errors->has('client_password') ? ' is-invalid' : '' }}" value="{{ old('client_password', $provider->client_password) }}" >
									@include('inventory.alerts.feedback', ['field' => 'client_password'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('client_id') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-client_id">{{ __('inventory.provider_client_id') }}</label>
									<input type="client_id" name="client_id" id="input-client_id" class="form-control form-control-alternative{{ $errors->has('client_id') ? ' is-invalid' : '' }}" value="{{ old('client_id', $provider->client_id) }}" >
									@include('inventory.alerts.feedback', ['field' => 'client_id'])
								</div>
							</div>
							<div class="col-3">
								<label class="form-control-label" for="input-active">{{ __('inventory.active') }}</label>
								<select name="active" id="input-active" class="form-control form-control-alternative{{ $errors->has('active') ? ' is-invalid' : '' }}" required>
									@foreach (['0'=>'Не активен', '1' => 'Активен'] as $key=>$value)
									@if($key == old('active') or $key == $provider->active)
									<option value="{{$key}}" selected>{{$value}}</option>
									@else
									<option value="{{$key}}">{{$value}}</option>
									@endif
									@endforeach
								</select>
							</div>
						</div>
						<!--price settings-->
						<div class="row">
							<div class="col-3">
								<div class="form-group{{ $errors->has('price_type') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-price_type">{{ __('inventory.provider_price_type') }}</label>
									<select name="price_type" id="input-price_type" class="form-control form-control-alternative{{ $errors->has('price_type') ? ' is-invalid' : '' }}" required>
									@foreach (['in'=>'Закупочная', 'out'=>'Розничная'] as $type=>$name)
											<option value="{{$type}}">{{$name}}</option>
									@endforeach
								</select>@include('inventory.alerts.feedback', ['field' => 'price_type'])
								</div>
							</div>
							<div class="col-3">
								<label class="form-control-label" for="input-price_currency">{{ __('inventory.provider_price_currency') }}</label>
								<select name="price_currency" id="input-price_currency" class="form-control form-control-alternative{{ $errors->has('price_currency') ? ' is-invalid' : '' }}" required>
									@foreach ($currencies as $price_currency)
										@if($price_currency == old('price_currency') or $price_currency == $provider->price_currency)
											<option value="{{$price_currency}}" selected>{{$price_currency}}</option>
										@else
											<option value="{{$price_currency}}">{{$price_currency}}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('price_add') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-price_add">{{ __('inventory.provider_price_add') }}</label>
									<input type="number" name="price_add" id="input-price_add" class="form-control form-control-alternative{{ $errors->has('price_add') ? ' is-invalid' : '' }}" value="{{ old('price_add', $provider->price_add) }}">
									@include('inventory.alerts.feedback', ['field' => 'price_add'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('price_extra') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-price_extra">{{ __('inventory.provider_price_extra') }}</label>
									<input type="number" name="price_extra" id="input-price_extra" class="form-control form-control-alternative{{ $errors->has('price_extra') ? ' is-invalid' : '' }}" value="{{ old('price_extra', $provider->price_extra) }}">
									@include('inventory.alerts.feedback', ['field' => 'price_extra'])
								</div>
							</div>
						</div>
						<!--delivery settings-->
						<div class="row">
							<div class="col-3">
								<div class="form-group{{ $errors->has('day_add') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-day_add">{{ __('inventory.provider_day_add') }}</label>
									<input type="number" name="day_add" id="input-day_add" class="form-control form-control-alternative{{ $errors->has('day_add') ? ' is-invalid' : '' }}" value="{{ old('day_add', $provider->day_add) }}">
									@include('inventory.alerts.feedback', ['field' => 'day_add'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('min_availability') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-min_availability">{{ __('inventory.provider_min_availability') }}</label>
									<input type="number" name="min_availability" id="input-min_availability" class="form-control form-control-alternative{{ $errors->has('min_availability') ? ' is-invalid' : '' }}" value="{{ old('min_availability', $provider->min_availability) }}">
									@include('inventory.alerts.feedback', ['field' => 'min_availability'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('max_day') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-max_day">{{ __('inventory.provider_max_day') }}</label>
									<input type="number" name="max_day" id="input-max_day" class="form-control form-control-alternative{{ $errors->has('max_day') ? ' is-invalid' : '' }}" value="{{ old('max_day', $provider->max_day) }}">
									@include('inventory.alerts.feedback', ['field' => 'max_day'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('percentgive') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-percentgive">{{ __('inventory.provider_percentgive') }}</label>
									<input type="number" name="percentgive" id="input-percentgive" class="form-control form-control-alternative{{ $errors->has('percentgive') ? ' is-invalid' : '' }}" value="{{ old('percentgive', $provider->percentgive) }}">
									@include('inventory.alerts.feedback', ['field' => 'percentgive'])
								</div>
							</div>
						</div>								
						@if($provider->hasprice == "Price")
							@include('inventory.providers.settings_price')
						@endif
						@if($provider->hasprice == "Webservice")
							@include('inventory.providers.settings_webservice')
						@endif
						<div class="row">
							<div class="col-4">
								<div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-description">{{ __('inventory.description') }}</label>
									<input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('description', $provider->description) }}">
									@include('inventory.alerts.feedback', ['field' => 'description'])
								</div>
							</div>
							<div class="col-4">
								<div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-phone">{{ __('inventory.phone') }}</label>
									<input type="text" name="phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone', $provider->phone) }}" >
									@include('inventory.alerts.feedback', ['field' => 'phone'])
								</div>
							</div>
							<div class="col-4">
								<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-email">{{ __('inventory.email') }}</label>
									<input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $provider->email) }}" >
									@include('inventory.alerts.feedback', ['field' => 'email'])
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group{{ $errors->has('paymentinfo') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-paymentinfo">{{ __('inventory.provider_paymentinfo') }}</label>
									<textarea name="paymentinfo" id="input-paymentinfo" class="form-control form-control-alternative{{ $errors->has('paymentinfo') ? ' is-invalid' : '' }}">{{ old('paymentinfo', $provider->paymentinfo) }}</textarea>
									@include('inventory.alerts.feedback', ['field' => 'paymentinfo'])
								</div>
							</div>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.save') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@if(isset($provider))
	@if($provider->hasprice == "Price")
		@include('inventory.providers.settings_columns')
	@endif
@endif
@endsection
