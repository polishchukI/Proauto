@extends('inventory.layouts.app', ['page' => __('inventory.new_receipt'), 'pageSlug' => 'receipts', 'section' => 'documents', 'search' => 'receipts'])

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
						<a href="{{ route('receipts.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form method="post" action="{{ route('receipts.store') }}" autocomplete="off">
					<input type="hidden" name="user_id" value="{{ Auth::id() }}">
					@csrf
					<h6 class="heading-small text-muted mb-4">{{ __('inventory.receipt_information') }}</h6>
					@if(isset($to_provider_order))
					<input type="hidden" name="provider_id" value="{{ $to_provider_order->provider_id }}">
					<input type="hidden" name="reference_type" value="to_provider_order">
					<input type="hidden" name="reference_id" value="{{ $to_provider_order->id }}">
					<input type="hidden" name="warehouse_id" value="{{ $to_provider_order->warehouse_id }}">
					<input type="hidden" name="currency" value="{{ $to_provider_order->currency }}">
					@endif
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
								<input type="date" name="provider_doc_date" id="input-provider_doc_date" class="form-control form-control-alternative{{ $errors->has('provider_doc_date') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.provider_sale_doc_date_create`') }}" autofocus>
								@include('inventory.alerts.feedback', ['field' => 'provider_doc_date'])
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2">								
							<div class="form-group{{ $errors->has('provider_id') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-provider">{{ __('inventory.provider') }}</label>
								<select name="provider_id" id="input-provider" class="form-select form-control-alternative{{ $errors->has('provider') ? ' is-invalid' : '' }}" required>
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
						<div class="col-lg-3">
							<div class="form-group{{ $errors->has('warehouse_id') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-warehouse">{{ __('inventory.warehouse') }}</label>
								<select name="warehouse_id" id="input-warehouse" class="form-select form-control-alternative{{ $errors->has('warehouse') ? ' is-invalid' : '' }}" required>
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
								<select name="currency" id="input-currency" class="form-select form-control-alternative{{ $errors->has('currency') ? ' is-invalid' : '' }}" required>
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
						<div class="col-lg-3"></div>
					</div>
					<div class="row">
						<div class="col-10">
							<div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
								<label class="form-control-label text-success" for="input-comment">{{ __('inventory.comment') }}</label>
								<input type="text" name="comment" id="input-comment" class="form-control form-control-alternative{{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.comment') }}" autofocus>
								@include('inventory.alerts.feedback', ['field' => 'comment'])
							</div>						
						</div>
						<div class="col-2">
							<div class="form-group">
								<label class="form-control-label text-success" for="input-is_gratuitous">{{ __('inventory.is_gratuitous') }}</label>
								<select name="is_gratuitous" id="input-is_gratuitous" class="form-select form-control-alternative{{ $errors->has('is_gratuitous') ? ' is-invalid' : '' }}" required>
									@foreach (['0'=> __('inventory.no'), '1'=> __('inventory.yes')] as $key=>$value)
										<option value="{{$key}}">{{$value}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">
							<label class="form-control-label" for="input-setup_prices">{{ __('inventory.setup_prices_create') }}</label>
							<select name="setup_prices" id="input-setup_prices" class="form-select form-control-alternative{{ $errors->has('setup_prices') ? ' is-invalid' : '' }}" required>
								@foreach (['0'=> __('inventory.no'), '1'=> __('inventory.yes')] as $key=>$value)
										<option value="{{$key}}">{{$value}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-lg-3">
							<label class="form-control-label" for="input-surcharge">{{ __('inventory.surcharge') }}</label>
							<select name="surcharge" id="input-surcharge" class="form-select form-control-alternative{{ $errors->has('surcharge') ? ' is-invalid' : '' }}" required>
								@foreach (['0'=>'0%', '5'=>'5%','10'=>'10%', '15'=>'15%','20'=>'20%', '25'=>'25%','30'=>'30%','35'=>'35%','40'=>'40%','45'=>'45%','50'=>'50%'] as $key=>$value)
										<option value="{{$key}}">{{$value}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-lg-3">
							<label class="form-control-label" for="input-surcharge_coefficient">{{ __('inventory.surcharge_coefficient') }}</label>
							<select name="surcharge_coefficient" id="input-surcharge_coefficient" class="form-select form-control-alternative{{ $errors->has('surcharge_coefficient') ? ' is-invalid' : '' }}" required>
								@foreach (['1'=>'1', '5'=>'5','10'=>'10', '50'=>'50'] as $key=>$value)
										<option value="{{$key}}">{{$value}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-lg-3 mt-4 text-center">
							<button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.continue') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- modal -->
<form id="form-receipt_create_new_provider_store" method="POST" action="{{ route('receipts.create.new.provider.store') }}" style="width:100%;">
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
						<label class="form-control-label" for="input-name">{{ __('inventory.provider_name') }}</label>
						<input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.provider_name') }}" required autofocus>
						@include('inventory.alerts.feedback', ['field' => 'name'])
					</div>

					<div class="form-group{{ $errors->has('hasprice') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="input-hasprice">{{ __('inventory.price_type') }}</label>
						<select name="hasprice" id="input-hasprice" class="form-control form-control-alternative{{ $errors->has('hasprice') ? ' is-invalid' : '' }}" required>
							@foreach (['None', 'Price', 'Webservice'] as $hasprice)
								<option value="{{$hasprice}}">{{$hasprice}}</option>
							@endforeach
						</select>
						@include('inventory.alerts.feedback', ['field' => 'hasprice'])
					</div>

					<div class="form-group{{ $errors->has('provider_code') ? ' has-danger' : '' }}">
						<div><label for="provider_code" class="control-label">{{ __('inventory.provider_code') }}</label></div>
						<div><input class="form-control" required="required" name="provider_code" type="text" placeholder="{{ __('inventory.provider_code') }}"></div>
						@include('inventory.alerts.feedback', ['field' => 'provider_code'])
					</div>

					<div class="form-group{{ $errors->has('spares_provider') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="input-spares_provider">{{ __('inventory.provider_spares_provider') }}</label>
						<select name="spares_provider" id="input-spares_provider" class="form-control form-control-alternative{{ $errors->has('spares_provider') ? ' is-invalid' : '' }}" required>
							@foreach (['0'=>'No', '1'=>'Yes'] as $key=>$value)
							<option value="{{$key}}">{{$value}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group{{ $errors->has('services_provider') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="input-services_provider">{{ __('inventory.provider_services_provider') }}</label>
						<select name="services_provider" id="input-services_provider" class="form-control form-control-alternative{{ $errors->has('services_provider') ? ' is-invalid' : '' }}" required>
							@foreach (['0'=>'No', '1'=>'Yes'] as $key=>$value)
							<option value="{{$key}}">{{$value}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="input-description">{{ __('inventory.description') }}</label>
						<input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}">
						@include('inventory.alerts.feedback', ['field' => 'description'])
					</div>
					
				</div>
				<div class="modal-footer">
					<button id="receipts-create-new-provider-store" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.create') }}</button>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection




