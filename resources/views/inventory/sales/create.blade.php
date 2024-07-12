@extends('inventory.layouts.app', ['page' => __('inventory.new_sale'), 'pageSlug' => 'sales-create', 'section' => 'documents', 'search' => 'sales'])

@section('content')
@include('inventory.alerts.error')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0">{{ __('inventory.new_sale') }}</h3>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('sales.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
			<form method="post" action="{{ route('sales.store') }}" autocomplete="off">
				<input type="hidden" name="user_id" value="{{ Auth::id() }}">
				@csrf
				<h6 class="heading-small text-muted mb-4">{{ __('inventory.client_information') }}</h6>
					@if(isset($client_order))
					<div class="row" hidden>
						<div class="col-lg-4">
						</div>
						<div class="col-lg-4">
							<input name="client_id" value="{{ $client_order->client->id }}">
						</div>
						<div class="col-lg-4">
							<input name="reference_type" value="client_order">
						</div>
						<div class="col-lg-4">
							<input name="reference_id" value="{{ $client_order->id }}">
						</div>
					</div>
					@endif
				<div class="row">
					<div class="col-lg-3">						
						<div class="form-group{{ $errors->has('client_id') ? ' has-danger' : '' }}">
							<label class="form-control-label" for="input-client">{{ __('inventory.client') }}</label>
							<select name="client_id" id="input-client" class="form-select form-control-alternative{{ $errors->has('client') ? ' is-invalid' : '' }}">
								@if(isset($client_order))
								<option value="{{$client_order->client_id}}" selected>{{$client_order->client->name}}</option>
								@else
								<option value="">{{ __('inventory.not_specified') }}</option>
								@foreach ($clients as $client)
								<option value="{{$client['id']}}">{{$client['name']}}</option>
								@endforeach
								@endif
							</select>
							@include('inventory.alerts.feedback', ['field' => 'client_id'])
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group{{ $errors->has('warehouse_id') ? ' has-danger' : '' }}">
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
							@include('inventory.alerts.feedback', ['field' => 'warehouse_id'])
						</div>
					</div>
					<div class="col-lg-3">						
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
					<div class="col-lg-3">
						<div class="text-center">
							<button type="submit" class="btn btn-success btn-simple btn-sm mt-4">{{ __('inventory.save') }}</button>
						</div>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
@endsection