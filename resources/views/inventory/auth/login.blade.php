@extends('inventory.layouts.app', ['page' => __('inventory.login'), 'section' => 'auth'])

@section('content')
<div class="container">
	<div class="col-lg-4 col-md-6 ml-auto mr-auto">
		<form class="form" method="post" action="{{ route('login') }}">
			@csrf
			<div class="card card-login card-white">
				<div class="card-header">
					<img src="/images/login.png" alt="">
					<h1 class="card-title">{{ __('inventory.login') }}</h1>
				</div>
				<div class="card-body">
					<div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<i class="far fa-envelope"></i>
							</div>
						</div>
						<input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.email') }}">
						@include('inventory.alerts.feedback', ['field' => 'email'])
					</div>
					<div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<i class="fas fa-lock"></i>
							</div>
						</div>
						<input type="password" placeholder="{{ __('inventory.password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
						@include('inventory.alerts.feedback', ['field' => 'password'])
					</div>
				</div>
				<div class="card-footer">
					<div class="pull-left">
						<a class="btn btn-primary btn-link" href="{{ route('password.request') }}">{{ __('inventory.forgot_your_password') }}</a>
					</div>
					<div class="pull-right">
						<button type="submit" href="" class="btn btn-primary btn-simple btn-sm">{{ __('inventory.log_in') }}</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection