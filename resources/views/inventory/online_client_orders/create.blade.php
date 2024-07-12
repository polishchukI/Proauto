@extends('inventory.layouts.app', ['page' => 'Register client_order', 'pageSlug' => 'client_orders-create', 'section' => 'documents', 'search' => 'client_orders'])

@section('content')
    @include('inventory.alerts.error')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Register client_order</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('client_orders.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('client_orders.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Client information</h6>
							<div class="row">
								<div class="col-lg-3">
									<input type="hidden" name="user_id" value="{{ Auth::id() }}">
									<div class="form-group{{ $errors->has('client_id') ? ' has-danger' : '' }}">
										<label class="form-control-label" for="input-name">Client</label>
										<select name="client_id" id="input-category" class="form-select form-control-alternative{{ $errors->has('client') ? ' is-invalid' : '' }}" required>
											@foreach ($clients as $client)
												@if($client['id'] == old('client'))
													<option value="{{$client['id']}}" selected>{{$client['name']}}</option>
												@else
													<option value="{{$client['id']}}">{{$client['name']}}</option>
												@endif
											@endforeach
										</select>
										@include('inventory.alerts.feedback', ['field' => 'client_id'])
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group{{ $errors->has('currency') ? ' has-danger' : '' }}">
										<label class="form-control-label" for="input-currency">currency</label>
										<select name="currency" id="input-currency" class="form-select form-control-alternative{{ $errors->has('client') ? ' is-invalid' : '' }}">
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
									<input type="hidden" name="user_id" value="{{ Auth::id() }}">
									<div class="form-group{{ $errors->has('warehouse') ? ' has-danger' : '' }}">
										<label class="form-control-label" for="input-warehouse">warehouse</label>
										<select name="warehouse_id" id="input-warehouse" class="form-select form-control-alternative{{ $errors->has('client') ? ' is-invalid' : '' }}">
											<option value="">{{ __('modal.not_specified') }}</option>
											@foreach ($warehouses as $warehouse)
												@if($warehouse['id'] == old('warehouse_id'))
													<option value="{{$warehouse['id']}}" selected>{{$warehouse['name']}}</option>
												@else
													<option value="{{$warehouse['id']}}">{{$warehouse['name']}}</option>
												@endif
											@endforeach
										</select>
										@include('inventory.alerts.feedback', ['field' => 'warehouse'])
									</div>
								</div>
								<div class="col-lg-3">
									<button type="submit" class="btn btn-sm btn-simple btn-success">Continue</button>
								</div>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection