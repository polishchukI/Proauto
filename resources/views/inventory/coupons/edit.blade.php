@extends('inventory.layouts.app', ['page' => 'Edit Coupon', 'pageSlug' => 'coupons', 'section' => 'shop_settings', 'search' => 'coupons'])
@section('content')

	<div class="row">
		<div class="col-xl-12 order-xl-1">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">Edit Coupon</h3>
						</div>
						<div class="col-4 text-right">
							<a href="{{ route('coupons.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="POST" action="{{ route('coupons.update', $coupon) }}" autocomplete="off">
						@csrf
						@method('put')
						<h6 class="heading-small text-muted mb-4">Coupon Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-code">Code</label>
                                    <input type="text" name="code" id="input-code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="Code" value="{{ old('code', $coupon->code) }}" required autofocus>
                                    @include('inventory.alerts.feedback', ['field' => 'code'])
                                </div>
                                <!--price settings-->
								<div class="row">
                                    <div class="col-4">
										<label class="form-control-label" for="input-type">Coupon type</label>
										<select name="type" id="input-type" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
											@foreach (['fixed'=>'Fixed sum', 'percent'=>'Percent discount'] as $key => $value)
											@if($key == old($coupon->type) or $key == $coupon->type)
											<option value="{{$key}}" selected>{{$value}}</option>
											@else
											<option value="{{$key}}">{{$value}}</option>
											@endif
											@endforeach
										</select>
										@include('inventory.alerts.feedback', ['field' => 'type'])
									</div>
									<div class="col-4">
										<div class="form-group">
											<label class="form-control-label" for="input-value">Coupon value</label>
											<input type="number" name="value" id="input-value" class="form-control form-control-alternative{{ $errors->has('value') ? ' is-invalid' : '' }}" placeholder="Code" value="{{ old('value', $coupon->value) }}" required autofocus>
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
