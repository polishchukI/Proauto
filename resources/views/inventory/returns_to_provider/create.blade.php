@extends('inventory.layouts.app', ['page' => 'Register Sale', 'pageSlug' => 'sales-create', 'section' => 'documents', 'search' => 'sales'])

@section('content')
@include('inventory.alerts.error')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0">Register Sale</h3>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('sales.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
			<form method="post" action="{{ route('sales.store') }}" autocomplete="off">
				<input type="hidden" name="user_id" value="{{ Auth::id() }}">
				@csrf
				<h6 class="heading-small text-muted mb-4">{{ __('inventory.provider_information') }}</h6>
				@if(isset($provider_order))
					<div class="row" hidden>
						<div class="col-lg-4">
						</div>
						<div class="col-lg-4">
							<input name="provider_id" value="{{ $provider_order->provider->id }}">
						</div>
						<div class="col-lg-4">
							<input name="reference_type" value="provider_order">
						</div>
						<div class="col-lg-4">
							<input name="reference_id" value="{{ $provider_order->id }}">
						</div>
					</div>
					@endif
				<div class="row">
					<div class="col-lg-3">
						
						<div class="form-group{{ $errors->has('provider_id') ? ' has-danger' : '' }}">
							<label class="form-control-label" for="input-provider">provider</label>
							<select name="provider_id" id="input-provider" class="form-select form-control-alternative{{ $errors->has('provider') ? ' is-invalid' : '' }}">

								@if(isset($provider_order))
								<option value="{{$provider_order->provider_id}}" selected>{{$provider_order->provider->name}}</option>
								@else
								<option value="">{{ __('modal.not_specified') }}</option>
								@foreach ($providers as $provider)
								@if($provider['id'] == old('provider_id'))
								<option value="{{$provider['id']}}" selected>{{$provider['name']}}</option>
								@else
								<option value="{{$provider['id']}}">{{$provider['name']}}</option>
								@endif
								@endforeach
								@endif
							</select>
							@include('inventory.alerts.feedback', ['field' => 'provider_id'])
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group{{ $errors->has('warehouse_id') ? ' has-danger' : '' }}">
							<label class="form-control-label" for="input-warehouse">Warehouse</label>
							<select name="warehouse_id" id="input-warehouse" class="form-select form-control-alternative{{ $errors->has('warehouse') ? ' is-invalid' : '' }}">
								<option value="">{{ __('modal.not_specified') }}</option>
								@foreach ($warehouses as $warehouse)
									@if($warehouse['id'] == old('warehouse_id'))
										<option value="{{$warehouse['id']}}" selected>{{$warehouse['name']}}</option>
									@else
										<option value="{{$warehouse['id']}}">{{$warehouse['name']}}</option>
									@endif
								@endforeach
							</select>
							@include('inventory.alerts.feedback', ['field' => 'warehouse_id'])
						</div>
					</div>
					<div class="col-lg-3">
						
						<div class="form-group{{ $errors->has('currency') ? ' has-danger' : '' }}">
							<label class="form-control-label" for="input-currency">currency</label>
							<select name="currency" id="input-currency" class="form-select form-control-alternative{{ $errors->has('currency') ? ' is-invalid' : '' }}">
								<option value="">{{ __('modal.not_specified') }}</option>
								@foreach ($currencies as $currency)
									@if($currency['code'] == old('currency'))
										<option value="{{$currency['code']}}" selected>{{$currency['name']}}</option>
									@else
										<option value="{{$currency['code']}}">{{$currency['name']}}</option>
									@endif
								@endforeach
							</select>
							@include('inventory.alerts.feedback', ['field' => 'currency'])
						</div>
					</div>
				<div class="col-lg-3">

					<div class="text-center">
						<button type="submit" class="btn btn-sm btn-simple btn-success">Continue</button>
					</div>
				</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
@endsection