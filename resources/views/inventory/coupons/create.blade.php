@extends('inventory.layouts.app', ['page' => 'New  Coupon', 'pageSlug' => 'coupons', 'section' => 'shop_settings', 'search' => 'coupons'])
@section('content')
	<div class="row">
		<div class="col-xl-12 order-xl-1">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">New Coupon</h3>
						</div>
						<div class="col-4 text-right">
							<a href="{{ route('coupons.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="{{ route('coupons.store') }}" autocomplete="off">
						@csrf
						<h6 class="heading-small text-muted mb-4">Coupon Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-code">Code</label>
                                    <input type="text" name="code" id="input-code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="Code" value="{{ old('code') }}" required autofocus>
                                    @include('inventory.alerts.feedback', ['field' => 'code'])
                                </div>
                                <!--price settings-->
								<div class="row">
                                    <div class="col-4">
										<label class="form-control-label" for="input-type">Coupon type</label>
										<select name="type" id="input-type" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
											@foreach (['fixed'=>'Fixed sum', 'percent'=>'Percent discount'] as $key=>$value)
													<option value="{{$key}}">{{$value}}</option>
											@endforeach
										</select>
										@include('inventory.alerts.feedback', ['field' => 'type'])
									</div>
									<div class="col-4">
										<div class="form-group">
											<div><label for="value" class="control-label">Value:</label></div>
											<div><input class="form-control" required="required" name="value" type="text" placeholder="Value" value="{{ old('value') }}"></div>
											@include('inventory.alerts.feedback', ['field' => 'value'])
										</div>
									</div>
									<div class="col-4">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.save') }}</button>
                                        </div>
									</div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
