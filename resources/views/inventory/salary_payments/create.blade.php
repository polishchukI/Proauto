@extends('inventory.layouts.app', ['page' => 'New Salary Payment', 'pageSlug' => 'salary_payments', 'section' => 'documents', 'search' => 'salary_payments'])

@section('content')
@include('inventory.alerts.error')
<div class="row">
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0">{{ __('inventory.new_salary_payment') }}</h3>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('salary_payments.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form method="post" action="{{ route('salary_payments.store') }}" autocomplete="off">
					<input type="hidden" name="user_id" value="{{ Auth::id() }}">
					@csrf
					<h6 class="heading-small text-muted mb-4">{{ __('inventory.salary_payments_information') }}</h6>
						<div class="row">
							<div class="col-lg-3">								
								<div class="form-group{{ $errors->has('currency') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-currency">{{ __('inventory.currency') }}</label>
									<select name="currency" id="input-currency" class="form-select form-control-alternative{{ $errors->has('currency') ? ' is-invalid' : '' }}">
										<option value="">{{ __('inventory.not_specified') }}</option>
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
						<div class="row">
						<div class="col-12">
							<div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-comment">comment</label>
								<input type="text" name="comment" id="input-comment" class="form-control form-control-alternative{{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="comment" value="{{ old('comment') }}">
								@include('inventory.alerts.feedback', ['field' => 'comment'])
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
@endsection