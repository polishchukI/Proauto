@extends('inventory.layouts.app', ['page' => 'New Auto', 'pageSlug' => 'client_autos', 'section' => 'inventory', 'search' => 'client_autos'])
@section('content')
	<div class="row">
		<div class="col-xl-12 order-xl-1">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">New Provider</h3>
						</div>
						<div class="col-4 text-right">
							<a href="{{ route('client_autos.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="{{ route('client_autos.store') }}" autocomplete="off">
						@csrf
						<h6 class="heading-small text-muted mb-4">Provider Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Name</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @include('inventory.alerts.feedback', ['field' => 'name'])
                                </div>


                                <!--price settings-->
								<div class="row">
                                    <div class="col-4">
										<label class="form-control-label" for="input-hasprice">Has price</label>
										<select name="hasprice" id="input-hasprice" class="form-control form-control-alternative{{ $errors->has('hasprice') ? ' is-invalid' : '' }}" required>
											@foreach (['None', 'Price', 'Webservice'] as $hasprice)
													<option value="{{$hasprice}}">{{$hasprice}}</option>
											@endforeach
										</select>
										@include('inventory.alerts.feedback', ['field' => 'hasprice'])
									</div>
									<div class="col-4">
										<div class="form-group">
											<div><label for="provider_code" class="control-label">Код поставщика: </label></div>
											<div><input class="form-control" required="required" name="provider_code" type="text" placeholder="Description" value="{{ old('provider_code') }}"></div>
											<div><span class="tiptext">Любое название (Eng.)</span></div>
											@include('inventory.alerts.feedback', ['field' => 'provider_code'])
										</div>
									</div>
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">Description</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Description" value="{{ old('description') }}">
                                    @include('inventory.alerts.feedback', ['field' => 'description'])
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">Email</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{ old('email') }}">
                                    @include('inventory.alerts.feedback', ['field' => 'email'])
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone">Telephone</label>
                                    <input type="phone" name="phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="Telephone" value="{{ old('phone') }}">
                                    @include('inventory.alerts.feedback', ['field' => 'phone'])
                                </div>
                                <div class="form-group{{ $errors->has('paymentinfo') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-paymentinfo">Payment information</label>
                                    <textarea name="paymentinfo" id="input-paymentinfo" class="form-control form-control-alternative{{ $errors->has('paymentinfo') ? ' is-invalid' : '' }}" placeholder="Payment information" value="{{ old('paymentinfo') }}"></textarea>
                                    @include('inventory.alerts.feedback', ['field' => 'paymentinfo'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
