@extends('shop.template')

@section('content')
<div class="site__body">
	<div class="block-space block-space--layout--after-header"></div>
	<div class="block">
		<div class="container container-lg">
			<div class="row justify-content-center">
				<div class="col-md-8 d-flex mt-4 mt-md-0">
					<div class="card flex-grow-1 mb-md-0 mr-0 mr-lg-3 ml-0 ml-lg-4">
						<div class="card-body card-body--padding--2">
							<h3 class="card-title">{{ __('account.login') }}</h3>
							<form method="POST" action="{{ route('account.login.send') }}">
								@csrf
								<div class="form-group row">
									<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('account.emailaddress') }}</label>
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
									@error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
								</div>
								<div class="form-group row">
									<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('account.password') }}</label>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
									@error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
								</div>
								<div class="form-group row">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
										<label class="form-check-label" for="remember">{{ __('account.remember') }}</label>
									</div>
								</div>
								<div class="form-group row mb-0">
									<button type="submit" class="btn btn-primary">{{ __('account.login') }}</button>
									@if (Route::has('password.request'))<a class="btn btn-light btn-sm" href="{{ route('account.password.request') }}">{{ __('account.passwordforgot') }}</a>@endif
								</div>
							</form>
						</div>
					</div>
				</div>
				<!---->
				<div class="col-md-8 d-flex mt-4 mt-md-0">
					<div class="card flex-grow-1 mb-md-0 mr-0 mr-lg-3 ml-0 ml-lg-4">
						<div class="card-body card-body--padding--2">
							<a href="{{ route('account.registerpage') }}">{{ __('header.createanaccount') }}</a>
						</div>
					</div>
				</div>
				<!---->
				
			</div>
		</div>
	</div>
</div>
@stop