@extends('inventory.layouts.app', ['page' => __('inventory.new_services_receipt'), 'pageSlug' => 'services_receipts', 'section' => 'services', 'search' => 'services_receipts'])

@section('content')
@include('inventory.alerts.error')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0">{{ __('inventory.new_receipt') }}</h3>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('services_receipts.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form method="post" action="{{ route('services_receipts.store') }}" autocomplete="off">
					<input type="hidden" name="user_id" value="{{ Auth::id() }}">
					@csrf
					<h6 class="heading-small text-muted mb-4">{{ __('inventory.receipt_information') }}</h6>
						<div class="row">
							<div class="col-3">
								<div class="form-group{{ $errors->has('provider_doc_number') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-provider_doc_number">{{ __('inventory.provider_doc') }}</label>
									<input type="text" name="provider_doc_number" id="input-provider_doc_number" class="form-control form-control-alternative{{ $errors->has('provider_doc_number') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.provider_doc') }}" autofocus>
									@include('inventory.alerts.feedback', ['field' => 'provider_doc_number'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('provider_doc_date') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-provider_doc_date">{{ __('inventory.provider_sale_doc_date_create') }}</label>
									<input type="date" name="provider_doc_date" id="input-provider_doc_date" class="form-control form-control-alternative{{ $errors->has('provider_doc_date') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" autofocus>
									@include('inventory.alerts.feedback', ['field' => 'provider_doc_date'])
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-2">
								<div class="form-group{{ $errors->has('provider_id') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-provider">{{ __('inventory.provider') }}</label>
									<select name="provider_id" id="input-provider" class="form-select form-control-alternative{{ $errors->has('provider') ? ' is-invalid' : '' }}">
										@if(isset($to_provider_order))
										<option value="{{$to_provider_order->provider_id}}" selected>{{$to_provider_order->provider->name}}</option>
										@else
										<option value="">{{ __('inventory.not_specified') }}</option>
										@foreach ($providers as $provider)
										<option value="{{$provider['id']}}">{{$provider['name']}}</option>
										@endforeach
										@endif
									</select>
									@include('inventory.alerts.feedback', ['field' => 'provider_id'])
								</div>
							</div>
							<div class="col-1 mt-4">
								<button type="button" class="btn btn-sm btn-selector btn-simple" data-toggle="modal" data-target="#createNewProvider"><i class="fas fa-plus"></i></button>
							</div>
							<div class="col-3">
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
							<div class="col-3 mt-4 text-center">
								<button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.continue') }}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		</div>
		</div>
<!-- modal -->
<form id="form-services_receipt_create_new_provider_store" method="POST" action="{{ route('services_receipts.create.new.provider.store') }}" style="width:100%;">
	<div class="modal modal-black fade" id="createNewProvider" tabindex="-1" role="dialog" aria-labelledby="createNewProvider" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="createNewProviderLabel">{{ __('inventory.new_provider') }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<i class="fas fa-times"></i>
					</button>
				</div>
				<div class="modal-body">
				@csrf
					<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="input-name">{{ __('inventory.name') }}</label>
						<input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>
						@include('inventory.alerts.feedback', ['field' => 'name'])
					</div>

					<div class="form-group{{ $errors->has('hasprice') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="input-hasprice">{{ __('inventory.hasprice') }}</label>
						<select name="hasprice" id="input-hasprice" class="form-control form-control-alternative{{ $errors->has('hasprice') ? ' is-invalid' : '' }}" required>
							@foreach (['None', 'Price', 'Webservice'] as $hasprice)
								<option value="{{$hasprice}}">{{$hasprice}}</option>
							@endforeach
						</select>
						@include('inventory.alerts.feedback', ['field' => 'hasprice'])
					</div>

					<div class="form-group{{ $errors->has('provider_code') ? ' has-danger' : '' }}">
						<div><label for="provider_code" class="control-label">{{ __('inventory.provider_code') }}</label></div>
						<div><input class="form-control" required="required" name="provider_code" type="text" placeholder="Код поставщика" value="{{ old('provider_code') }}"></div>
						<div><span class="tiptext">Любое название (Eng.)</span></div>
						@include('inventory.alerts.feedback', ['field' => 'provider_code'])
					</div>

					<div class="form-group{{ $errors->has('spares_provider') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="input-spares_provider">Запчасти</label>
						<select name="spares_provider" id="input-spares_provider" class="form-control form-control-alternative{{ $errors->has('spares_provider') ? ' is-invalid' : '' }}" required>
							@foreach (['0'=>'No', '1'=>'Yes'] as $key=>$value)
							<option value="{{$key}}">{{$value}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group{{ $errors->has('services_provider') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="input-services_provider">Услуги</label>
						<select name="services_provider" id="input-services_provider" class="form-control form-control-alternative{{ $errors->has('services_provider') ? ' is-invalid' : '' }}" required>
							@foreach (['0'=>'No', '1'=>'Yes'] as $key=>$value)
							<option value="{{$key}}">{{$value}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="input-description">Description</label>
						<input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Description" value="{{ old('description') }}">
						@include('inventory.alerts.feedback', ['field' => 'description'])
					</div>
					
				</div>
				<div class="modal-footer">
					<button id="services_receipts-create-new-provider-store" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.create') }}</button>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection
