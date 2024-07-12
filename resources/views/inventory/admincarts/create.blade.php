@extends('inventory.layouts.app', ['page' => __('inventory.new_admincart'), 'pageSlug' => 'admincarts', 'section' => 'admincarts', 'search' => 'admincarts'])

@section('content')
@include('inventory.alerts.error')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0">{{ __('inventory.register_cart') }}</h3>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('admincarts.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form method="post" action="{{ route('admincarts.store') }}" autocomplete="off">
					@csrf
					<h6 class="heading-small text-muted mb-4">{{ __('inventory.client_information') }}</h6>
					<div class="row">
						<div class="col-3">
							<div class="form-group{{ $errors->has('client_id') ? ' has-danger' : '' }}">
								<input type="hidden" name="user_id" value="{{ Auth::id() }}">
								<label class="form-control-label" for="input-name">{{ __('inventory.client') }}</label>
								<select name="client_id" id="input-client" class="form-select form-control-alternative{{ $errors->has('client_id') ? ' is-invalid' : '' }}" required>
											<option value="">{{ __('inventory.not_specified') }}</option>
									@foreach ($clients as $client)
										@if($client['id'] == old('client_id'))
											<option value="{{$client['id']}}" selected>{{$client['name']}}</option>
										@else
											<option value="{{$client['id']}}">{{$client['name']}}</option>
										@endif
									@endforeach
								</select>
								@include('inventory.alerts.feedback', ['field' => 'client_id'])
							</div>									
						</div>
						<div class="col-3">
							<div class="form-group{{ $errors->has('client_auto_id') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-name">{{ __('inventory.auto') }}</label>
								<select name="client_auto_id" id="input-auto" class="form-select form-control-alternative{{ $errors->has('client_auto_id') ? ' is-invalid' : '' }}">
									<option value="">{{ __('inventory.not_specified') }}</option>
								</select>
								@include('inventory.alerts.feedback', ['field' => 'client_auto_id'])
							</div>
						</div>
						<div class="col-3">
							<div class="form-group{{ $errors->has('currency') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-currency">{{ __('inventory.currency') }}</label>
								<select name="currency" id="input-currency" class="form-select form-control-alternative{{ $errors->has('currency') ? ' is-invalid' : '' }}">
									<option value="">{{ __('inventory.not_specified') }}</option>
									@foreach ($currencies as $currency)
									@if(auth()->user()->default_currency != null && $currency['code'] == auth()->user()->default_currency)
										<option value="{{$currency['code']}}" selected>{{$currency['name']}}</option>
									@else
											<option value="{{$currency['code']}}">{{$currency['name']}}</option>
										@endif
									@endforeach
								</select>
								@include('inventory.alerts.feedback', ['field' => 'currency'])
							</div>
						</div>
						<div class="col-3">
							<input type="hidden" name="user_id" value="{{ Auth::id() }}">
							<div class="form-group{{ $errors->has('warehouse') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-warehouse">{{ __('inventory.warehouse') }}</label>
								<select name="warehouse_id" id="input-warehouse" class="form-select form-control-alternative{{ $errors->has('warehouse') ? ' is-invalid' : '' }}">
									<option value="">{{ __('inventory.not_specified') }}</option>
									@foreach ($warehouses as $warehouse)
										@if(auth()->user()->default_warehouse_id != 0 && $warehouse['id'] == auth()->user()->warehouse->id)
											<option value="{{auth()->user()->warehouse->id}}" selected>{{ auth()->user()->warehouse->name }}</option>
										@else
											<option value="{{$warehouse['id']}}">{{$warehouse['name']}}</option>
										@endif
									@endforeach
								</select>
								@include('inventory.alerts.feedback', ['field' => 'warehouse'])
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-9">
							<div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
								<label class="form-control-label text-success" for="input-comment">{{ __('inventory.comment') }}</label>
								<input type="text" name="comment" id="input-comment" class="form-control form-control-alternative{{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.comment') }}" autofocus>
								@include('inventory.alerts.feedback', ['field' => 'comment'])
							</div>						
						</div>
						<div class="col-3 mt-4">
						<button type="submit" rel="tooltip" class="btn btn-success btn-sm btn-simple" title="{{ __('inventory.continue') }}">
							{{ __('inventory.continue') }} <i class="fa-solid fa-arrow-right"></i>
						</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection