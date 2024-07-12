@extends('shop.template')

@section('content')
<div class="site__body">
	<div class="block-space block-space--layout--after-header"></div>
	<div class="block">
		<div class="container container-lg">
			<div class="row justify-content-center">
				<div class="col-md-8 d-flex mt-4 mt-md-0">
					<div class="card flex-grow-1 mb-0 ml-0 ml-lg-3 mr-0 mr-lg-4">
						<div class="card-body card-body--padding--2"><h3 class="card-title">{{ __('account.register') }}</h3>
							<form method="POST" action="{{ route('account.register.send') }}">
								@csrf
								<div class="form-group row">
									<label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('account.firstname') }}</label>
									<input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="{{ __('account.firstname') }}">
									@error('first_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
								</div>
								<div class="form-group row">
									<label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('account.lastname') }}</label>
									<input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="{{ __('account.lastname') }}">
									@error('last_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
								</div>
								<div class="form-group row">
									<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('account.emailaddress') }}</label>
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email@example.com">
									@error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
								</div>
								<div class="form-group row">
									<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('account.password') }}</label>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('account.password') }}">
									@error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
								</div>
								<div class="form-group row">
									<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('account.passwordconfirm') }}</label>
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('account.passwordconfirm') }}">
								</div>
								<div class="form-group row mb-0">
									<button type="submit" class="btn btn-primary">{{ __('account.register') }}</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop