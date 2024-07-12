@extends('inventory.layouts.app', ['page' => __('inventory.new_payroll'), 'pageSlug' => 'payrolls', 'section' => 'documents', 'search' => 'payrolls'])

@section('content')
@include('inventory.alerts.error')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0">{{ __('inventory.new_payroll') }}</h3>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('payrolls.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form method="post" action="{{ route('payrolls.store') }}" autocomplete="off">
					<input type="hidden" name="user_id" value="{{ Auth::id() }}">
					@csrf
					<h6 class="heading-small text-muted mb-4">{{ __('inventory.payroll_information') }}</h6>
					<div class="row">
						<div class="col-3">
							<div class="form-group{{ $errors->has('period_start') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-period_start">{{ __('inventory.date_from') }}</label>
								<input type="date" name="period_start" id="input-period_start" class="form-control form-control-alternative{{ $errors->has('period_start') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.provider_doc') }}" autofocus>
								@include('inventory.alerts.feedback', ['field' => 'period_start'])
							</div>
						</div>
						<div class="col-3">
							<div class="form-group{{ $errors->has('period_end') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-period_end">{{ __('inventory.date_to') }}</label>
								<input type="date" name="period_end" id="input-period_end" class="form-control form-control-alternative{{ $errors->has('period_end') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" autofocus>
								@include('inventory.alerts.feedback', ['field' => 'period_end'])
							</div>
						</div>
					
						<div class="col-3">								
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
						<div class="col-lg-3 mt-4 text-center">
							<button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.continue') }}</button>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-comment">{{ __('inventory.comment') }}</label>
								<input type="text" name="comment" id="input-comment" class="form-control form-control-alternative{{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.comment') }}">
								@include('inventory.alerts.feedback', ['field' => 'comment'])
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection