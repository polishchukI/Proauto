@extends('inventory.layouts.app', ['page' => __('inventory.new_to_provider_order'), 'pageSlug' => 'to_provider_orders-create', 'section' => 'documents', 'search' => 'to_provider_orders'])

@section('content')
    @include('inventory.alerts.error')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('inventory.new_to_provider_order') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('to_provider_orders.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('to_provider_orders.store') }}" autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('inventory.to_provider_order_information') }}</h6>
							@if(isset($client_order))
							<div class="row" hidden>
								<div class="col-lg-4"></div>
								<div class="col-lg-4"><input name="client_id" value="{{ $client_order->client->id }}"></div>
								<div class="col-lg-4"><input name="reference_type" value="client_order"></div>
								<div class="col-lg-4"><input name="reference_id" value="{{ $client_order->id }}"></div>
							</div>
							@endif
							<div class="row">
								<div class="col-lg-3">
									<div class="form-group{{ $errors->has('provider_id') ? ' has-danger' : '' }}">
										<input type="hidden" name="user_id" value="{{ Auth::id() }}">
										<label class="form-control-label" for="input-name">{{ __('inventory.provider') }}</label>
										<select name="provider_id" id="input-category" class="form-select form-control-alternative{{ $errors->has('provider') ? ' is-invalid' : '' }}" required>
											@foreach ($providers as $provider)
													<option value="{{$provider['id']}}">{{$provider['name']}}</option>
											@endforeach
										</select>
										@include('inventory.alerts.feedback', ['field' => 'provider_id'])
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group{{ $errors->has('currency') ? ' has-danger' : '' }}">
										<label class="form-control-label" for="input-currency">{{ __('inventory.currency') }}</label>
										<select name="currency" id="input-currency" class="form-select form-control-alternative{{ $errors->has('provider') ? ' is-invalid' : '' }}">
											<option value="">{{ __('modal.not_specified') }}</option>
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
									<input type="hidden" name="user_id" value="{{ Auth::id() }}">
									<div class="form-group{{ $errors->has('warehouse') ? ' has-danger' : '' }}">
										<label class="form-control-label" for="input-warehouse">{{ __('inventory.warehouse') }}</label>
										<select name="warehouse_id" id="input-warehouse" class="form-select form-control-alternative{{ $errors->has('provider') ? ' is-invalid' : '' }}">
											<option value="">{{ __('modal.not_specified') }}</option>
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
								<div class="col-lg-3 mt-4 text-center">
									<button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.continue') }}</button>			
								</div>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection