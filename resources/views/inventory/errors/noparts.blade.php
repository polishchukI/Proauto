@extends('shop.template')

@section('content')

<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				<!--breadcrumbs-->
				@include('shop.layouts.breadcrumbs')
				<!--breadcrumbs-end-->
				<h1 class="block-header__title">{{ __('shop.search_part') }} @if(isset($number)){{$number}} @endif @if(isset($brand)){{ $brand }} @endif</h1>
			</div>
		</div>
		<div class="block block-split block-split--has-sidebar">
			<div class="container">
				<div class="block-split__row row no-gutters">
					<!--sidebar block-->
					@include('shop.block.sidebar')
					<!--sidebar block-->
					<!--product block-->
					<div class="block-split__item block-split__item-content col-auto">
						<div class="alert alert-primary alert-lg mb-3 alert-dismissible fade show">
						{{ __('shop.unfortunately') }}<br>
						{{ __('shop.working_hard') }}<br>
						{{ __('shop.want_to_be_first') }}<br>
						{{ __('shop.enter_email') }}<br>
						</div>
						<div class="container container--max--lg">
							<div class="card">
								<div class="card-body card-body--padding--2">
									<div class="row">
										<div class="col-12 col-lg-6 pb-4 pb-lg-0">
											<div class="mr-1">
												<div class="contact-us__address">
													<p>{{ __('shop.want_to_be_first') }} {{ __('shop.enter_email') }}</p>
													<p>{{ __('shop.does_it_fits') }}</p>
													<p><a href="{{ route('privacypolicy') }}">{{ __('shop.privacy_policy') }}</a></p>
												</div>
											</div>
										</div>
										<div class="col-12 col-lg-6">
											<div class="ml-1">
												@include('shop.block.recaptcha')
												<form  method="POST" action="{{ route('noparts.send') }}">
												@csrf													
													@if(isset($number)) <input type="hidden" name="number" value="{{$number}}"> @endif
													@if(isset($brand)) <input type="hidden" name="brand" value="{{$brand}}"> @endif
													<div class="form-group">
														<label for="form-name">{{ __('shop.search_part_contact') }}</label>
														@guest('clients')<input type="text" id="name" name="name" class="form-control" placeholder="{{ __('shop.search_part_contact') }}">@endguest
														@auth('clients')<input type="text" id="name" name="name" class="form-control" value="{{ Auth::guard('clients')->user()->firstname }}">@endauth
													</div>
													<div class="form-group">
														<label for="form-email">{{ __('shop.email') }}</label>
														@guest('clients')<input type="text" id="email" name="email" class="form-control" placeholder="{{ __('shop.email') }}">@endguest
														@auth('clients')<input type="text" id="email" name="email" class="form-control" value="{{ Auth::guard('clients')->user()->email }}">@endauth
													</div>
													<div class="form-group">
														<label for="form-comment">{{ __('shop.message') }}</label>
														<textarea id="message" name="message" class="form-control" rows="5"></textarea>
													</div>
													<button type="submit" class="btn btn-primary">{{ __('shop.send') }}</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="block-space block-space--layout--divider-nl"></div>
                    </div>
                    <!--product block end-->
				</div>
            </div>
			<div class="block-space block-space--layout--divider-nl"></div>
            @include('shop.blog.news')
            <div class="block-space block-space--layout--divider-nl"></div>
	</div>
</div>
@stop
