<!-- site__header -->
<header class="site__header">
	<div class="header">
		<div class="header__megamenu-area megamenu-area"></div>
		<div class="header__topbar-classic-bg"></div>
		<div class="header__topbar-classic">
			<div class="topbar topbar--classic">
				<div class="topbar__item-text"><a class="topbar__link" href="{{ route('aboutpage') }}">{{ __('header.aboutus') }}</a></div>
				<div class="topbar__item-text"><a class="topbar__link" href="{{ route('contactpage') }}">{{ __('header.contacts') }}</a></div>
				<div class="topbar__item-text"><a class="topbar__link" href="{{ route('trackorder') }}">{{ __('header.trackorder') }}</a></div>
				<div class="topbar__item-spring"></div>
				<div class="topbar__item-button topbar__menu">
					<button class="topbar__button topbar__button--has-arrow topbar__menu-button" type="button">
						<span class="topbar__button-label">{{ __('header.currency') }}:</span>
						<span class="topbar__button-title">{{currency()->getUserCurrency()}}</span>
						<span class="topbar__button-arrow">
							<svg width="7px" height="5px">
								<path d="M0.280,0.282 C0.645,-0.084 1.238,-0.077 1.596,0.297 L3.504,2.310 L5.413,0.297 C5.770,-0.077 6.363,-0.084 6.728,0.282 C7.080,0.634 7.088,1.203 6.746,1.565 L3.504,5.007 L0.262,1.565 C-0.080,1.203 -0.072,0.634 0.280,0.282 Z"/>
							</svg>
						</span>
					</button>
					<div class="topbar__menu-body">
						<!-- <a class="topbar__menu-item" href="?currency=eur"><i class="fas fa-euro-sign"> {{ __('header.euro') }}</i></a> -->
						<!-- <a class="topbar__menu-item" href="?currency=usd"><i class="fas fa-dollar-sign"> {{ __('header.dollar') }}</i></a> -->
						<a class="topbar__menu-item" href="?currency=rub"><i class="fas fa-ruble-sign"> {{ __('header.ruble') }}</i></a>
						<!-- <a class="topbar__menu-item" href="?currency=uah"><i class="fas fa-hryvnia"> {{ __('header.hryvnia') }}</i></a> -->
					</div>
				</div>
				<div class="topbar__menu">
					<button class="topbar__button topbar__button--has-arrow topbar__menu-button" type="button">
						<span class="topbar__button-label">{{ __('header.language') }}:</span>
						@if(is_null(Session::get('locale')))
							<span class="topbar__button-title"><img src="/images/languages/{{ config('app.locale') }}.png" alt="{{ config('app.locale') }}"></span>
						@else
							<span class="topbar__button-title"><img src="/images/languages/{{Session::get('locale')}}.png" alt="{{Session::get('locale')}}"></span>
						@endif
						<span class="topbar__button-arrow">
							<svg width="7px" height="5px">
								<path d="M0.280,0.282 C0.645,-0.084 1.238,-0.077 1.596,0.297 L3.504,2.310 L5.413,0.297 C5.770,-0.077 6.363,-0.084 6.728,0.282 C7.080,0.634 7.088,1.203 6.746,1.565 L3.504,5.007 L0.262,1.565 C-0.080,1.203 -0.072,0.634 0.280,0.282 Z"/>
							</svg>
						</span>
					</button>
					<div class="topbar__menu-body">@include('shop.block.language_selector')</div>
				</div>
			</div>
		</div>
		<div class="header__navbar">
			{{-- @include('shop.layouts.megamenu') --}}
			<div class="header__navbar-menu">
				<div class="main-menu">
				@include('shop.layouts.menulist')
				</div>
			</div>
			<div class="header__navbar-phone phone"><a href="" class="phone__body"><div class="phone__title">{{ __('header.callus') }}:</div><div class="phone__number">{{ config('shop_settings.phone') }}</div></a></div>
		</div>
		<div class="header__logo">
			<a href="{{ route('home') }}" class="logo">
				<div class="logo__slogan">{{ __('header.slogan') }}</div>
				<div class="logo__image">
					@include('shop.block.logo')
				</div>
			</a>
		</div>
		<div class="header__search">
			<div class="search">
				<form id="catalogSearch" class="search__body">
					<div class="search__shadow"></div>
					<input class="search__input" type="text" id="numsearch" placeholder="{{ __('header.enterkeyword') }}">
					<button class="search__button search__button--start" type="button">
						<span class="search__button-icon">
							<svg width="20" height="20">
								<path d="M6.6,2c2,0,4.8,0,6.8,0c1,0,2.9,0.8,3.6,2.2C17.7,5.7,17.9,7,18.4,7C20,7,20,8,20,8v1h-1v7.5c0,0.8-0.7,1.5-1.5,1.5h-1c-0.8,0-1.5-0.7-1.5-1.5V16H5v0.5C5,17.3,4.3,18,3.5,18h-1C1.7,18,1,17.3,1,16.5V16V9H0V8c0,0,0.1-1,1.6-1C2.1,7,2.3,5.7,3,4.2 C3.7,2.8,5.6,2,6.6,2z M13.3,4H6.7c-0.8,0-1.4,0-2,0.7c-0.5,0.6-0.8,1.5-1,2C3.6,7.1,3.5,7.9,3.7,8C4.5,8.4,6.1,9,10,9 c4,0,5.4-0.6,6.3-1c0.2-0.1,0.2-0.8,0-1.2c-0.2-0.4-0.5-1.5-1-2C14.7,4,14.1,4,13.3,4z M4,10c-0.4-0.3-1.5-0.5-2,0 c-0.4,0.4-0.4,1.6,0,2c0.5,0.5,4,0.4,4,0C6,11.2,4.5,10.3,4,10z M14,12c0,0.4,3.5,0.5,4,0c0.4-0.4,0.4-1.6,0-2c-0.5-0.5-1.3-0.3-2,0 C15.5,10.2,14,11.3,14,12z"/>
							</svg>
						</span>
						<span class="search__button-title">Select Vehicle</span>
					</button>
					<button class="search__button search__button--end" type="submit">
						<span class="search__button-icon">
							<svg width="20" height="20">
								<path d="M19.2,17.8c0,0-0.2,0.5-0.5,0.8c-0.4,0.4-0.9,0.6-0.9,0.6s-0.9,0.7-2.8-1.6c-1.1-1.4-2.2-2.8-3.1-3.9C10.9,14.5,9.5,15,8,15 c-3.9,0-7-3.1-7-7s3.1-7,7-7s7,3.1,7,7c0,1.5-0.5,2.9-1.3,4c1.1,0.8,2.5,2,4,3.1C20,16.8,19.2,17.8,19.2,17.8z M8,3C5.2,3,3,5.2,3,8 c0,2.8,2.2,5,5,5c2.8,0,5-2.2,5-5C13,5.2,10.8,3,8,3z"/>
							</svg>
						</span>
					</button>
					<div class="search__box"></div>
					<div class="search__decor">
						<div class="search__decor-start"></div>
						<div class="search__decor-end"></div>
					</div>
					<div class="search__dropdown search__dropdown--vehicle-picker vehicle-picker">
						<div class="search__dropdown-arrow"></div>
						<div class="vehicle-picker__panel vehicle-picker__panel--list vehicle-picker__panel--active" data-panel="list">
							<div class="vehicle-picker__panel-body">
								<div class="vehicle-picker__text">Select a vehicle to find exact fit parts</div>
								<div class="vehicles-list">
									<div class="vehicles-list__body">
									@if(isset($garage))
										@foreach($garage as $item)
											<label class="vehicles-list__item">
												<span class="vehicles-list__item-info">
													<span class="vehicles-list__item-name">{{$item["name"]}}</span>
													<span class="vehicles-list__item-details">{{$item["details"]}}</span>
													<span class="vehicles-list__item-details" style="text-transform: uppercase;">VIN: {{$item["vin"]}}</span>
													<span class="vehicles-list__item-links"><a href="{{$item["url"]}}" target="_blank">Show Parts</a></span>
												</span>
												<button type="button"  onclick="deletegarage('{{$item["vin"]}}')" class="vehicles-list__item-remove">
													<svg width="16" height="16">
														<path d="M2,4V2h3V1h6v1h3v2H2z M13,13c0,1.1-0.9,2-2,2H5c-1.1,0-2-0.9-2-2V5h10V13z"/>
													</svg>
												</button>
											</label>
											@endforeach
										@endif
									</div>
								</div>
								<div class="vehicle-picker__actions">
									<button type="button" class="btn btn-primary btn-sm" data-to-panel="form">Add A Vehicle</button>
								</div>
							</div>
						</div>
						<div class="vehicle-picker__panel vehicle-picker__panel--form" data-panel="form">
							<div class="vehicle-picker__panel-body">
								<div class="vehicle-form vehicle-form--layout--search">
									<div class="vehicle-form__item vehicle-form__item--select">
										<select class="form-control form-control-select2" aria-label="Year">
											<option value="none">Select Year</option>
											<option>2010</option>
											<option>2011</option>
											<option>2012</option>
											<option>2013</option>
											<option>2014</option>
											<option>2015</option>
											<option>2016</option>
											<option>2017</option>
											<option>2018</option>
											<option>2019</option>
											<option>2020</option>
										</select>
									</div>
									<div class="vehicle-form__item vehicle-form__item--select">
										<select class="form-control form-control-select2" aria-label="Brand" disabled="disabled">
											<option value="none">Select Brand</option>
											<option>Audi</option>
											<option>BMW</option>
											<option>Ferrari</option>
											<option>Ford</option>
											<option>KIA</option>
											<option>Nissan</option>
											<option>Tesla</option>
											<option>Toyota</option>
										</select>
									</div>
									<div class="vehicle-form__item vehicle-form__item--select">
										<select class="form-control form-control-select2" aria-label="Model" disabled="disabled">
											<option value="none">Select Model</option>
											<option>Explorer</option>
											<option>Focus S</option>
											<option>Fusion SE</option>
											<option>Mustang</option>
										</select>
									</div>
									<div class="vehicle-form__item vehicle-form__item--select">
										<select class="form-control form-control-select2" aria-label="Engine" disabled="disabled">
											<option value="none">Select Engine</option>
											<option>Gas 1.6L 125 hp AT/L4</option>
											<option>Diesel 2.5L 200 hp AT/L5</option>
											<option>Diesel 3.0L 250 hp MT/L5</option>
										</select>
									</div>
									<div class="vehicle-form__divider">Or</div>
									<div class="vehicle-form__item">
										<input type="text" class="form-control" placeholder="Enter VIN number" aria-label="VIN number">
									</div>
								</div>
								<div class="vehicle-picker__actions">
									<div class="search__car-selector-link"><a href="" data-to-panel="list">Back to vehicles list</a></div>
									<button type="button" class="btn btn-primary btn-sm" disabled="disabled">Add A Vehicle</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="header__indicators">
			<div class="indicator">
			@auth('clients')
				<a href="{{ route('wishlist.show') }}" class="indicator__button">
					<span class="indicator__icon">
						<svg width="32" height="32">
							<path d="M23,4c3.9,0,7,3.1,7,7c0,6.3-11.4,15.9-14,16.9C13.4,26.9,2,17.3,2,11c0-3.9,3.1-7,7-7c2.1,0,4.1,1,5.4,2.6l1.6,2l1.6-2 C18.9,5,20.9,4,23,4 M23,2c-2.8,0-5.4,1.3-7,3.4C14.4,3.3,11.8,2,9,2c-5,0-9,4-9,9c0,8,14,19,16,19s16-11,16-19C32,6,28,2,23,2L23,2z"/>
						</svg>
					</span>
				</a>
			@endauth
			</div>
			<!--account-->
			<div class="indicator indicator--trigger--click">
				<a class="indicator__button">
					<span class="indicator__icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32">
							<path d="M16,18C9.4,18,4,23.4,4,30H2c0-6.2,4-11.5,9.6-13.3C9.4,15.3,8,12.8,8,10c0-4.4,3.6-8,8-8s8,3.6,8,8c0,2.8-1.5,5.3-3.6,6.7C26,18.5,30,23.8,30,30h-2C28,23.4,22.6,18,16,18z M22,10c0-3.3-2.7-6-6-6s-6,2.7-6,6s2.7,6,6,6S22,13.3,22,10z"/>
						</svg>
					</span>
					@guest('clients')
					<span class="indicator__title">{{ __('header.hello') }}, {{ __('header.login') }}</span>
					@endguest
					@auth('clients')
					<span class="indicator__title">{{ __('header.hello') }}, <b>{{ Auth::guard('clients')->user()->firstname }}</b></span>
					@endauth
					<span class="indicator__value">{{ __('header.myaccount') }}</span>
				</a>
				<div class="indicator__content">
					<div class="account-menu">
						@guest('clients')
						<form class="account-menu__form" method="POST" action="{{ route('account.login.send') }}">
							@csrf
							<div class="account-menu__form-title">{{ __('header.logintoyouraccount') }}</div>
							<div class="form-group">
								<label for="header-signin-email" class="sr-only">{{ __('header.logintoyouraccount') }}</label>
								<input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('header.emailaddress') }}">
								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="header-signin-password" class="sr-only">{{ __('header.password') }}</label>
								<div class="account-menu__form-forgot">
									<input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('header.password') }}">
									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									@if (Route::has('password.request'))
										<a class="account-menu__form-forgot-link" href="{{ route('account.password.request') }}">
										{{ __('header.forgot') }}
										</a>
									@endif
								</div>
							</div>
							<div class="form-group account-menu__form-button">
								<button type="submit" class="btn btn-primary btn-sm">{{ __('header.login') }}</button>
							</div>
							<div class="account-menu__form-link"><a href="{{ route('account.registerpage') }}">{{ __('header.createanaccount') }}</a></div>
						</form>
						@endguest
						<!--only user-->
						<!--only auth-->
						@auth('clients')
						<a class="account-menu__user">
							<div class="account-menu__user-avatar"><img src="{{ Auth::guard('clients')->user()->avatar }}" alt="{{ Auth::guard('clients')->user()->firstname }}"></div>
							<div class="account-menu__user-info">
								<div class="account-menu__user-name">{{ Auth::guard('clients')->user()->firstname }}</div>
								<div class="account-menu__user-email">{{ Auth::guard('clients')->user()->email }}</div>
							</div>
						</a>
						<div class="account-menu__divider"></div>
						<ul class="account-menu__links">
							<li><a href="{{ route('account.dashboard') }}">{{ __('account.dashboard') }}</a></li>
							<li><a href="{{ route('account.garage') }}">{{ __('account.garage') }}</a></li>
							<li><a href="{{ route('account.profile') }}">{{ __('account.profile') }}</a></li>
							<li><a href="{{ route('account.orders') }}">{{ __('account.orders') }}</a></li>
							<li><a href="{{ route('account.addresses') }}">{{ __('account.addresses') }}</a></li>
						</ul>
						<div class="account-menu__divider"></div>
						<ul class="account-menu__links">
							<li>
								<a href="{{ route('account.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('account.logout') }}</a>
								<form id="logout-form" action="{{ route('account.logout') }}" method="POST" style="display: none;">@csrf</form>
							</li>
						</ul>
						@endauth
						<!--only auth-->
					</div>
				</div>
			</div>
			<!--account-->
			<div class="indicator indicator">
				<a href="{{route('showcart')}}" class="indicator__button">
					<span class="indicator__icon">
						<svg width="32" height="32">
							<circle cx="10.5" cy="27.5" r="2.5"/>
							<circle cx="23.5" cy="27.5" r="2.5"/>
							<path d="M26.4,21H11.2C10,21,9,20.2,8.8,19.1L5.4,4.8C5.3,4.3,4.9,4,4.4,4H1C0.4,4,0,3.6,0,3s0.4-1,1-1h3.4C5.8,2,7,3,7.3,4.3 l3.4,14.3c0.1,0.2,0.3,0.4,0.5,0.4h15.2c0.2,0,0.4-0.1,0.5-0.4l3.1-10c0.1-0.2,0-0.4-0.1-0.4C29.8,8.1,29.7,8,29.5,8H14 c-0.6,0-1-0.4-1-1s0.4-1,1-1h15.5c0.8,0,1.5,0.4,2,1c0.5,0.6,0.6,1.5,0.4,2.2l-3.1,10C28.5,20.3,27.5,21,26.4,21z"/>
						</svg>
						@if(Session::has('cartCount'))
						<span class="indicator__counter" name="cartCount">{{ Session::get('cartCount')}}</span>
						@else
						<span class="indicator__counter" name="cartCount">0</span>
						@endif
					</span>
					<span class="indicator__title">{{ __('header.shoppingcart') }}</span>
					@if(Session::has('cartSumCount'))
					<span class="indicator__value"  name="cartSumCount">{{ Session::get('cartSumCount')}} {{Session::get('currency_symbol')}}</span>
					@else
					<span class="indicator__value" name="cartSumCount">{{ __('header.basketempty') }}</span>
					@endif
				</a>
			</div>
		</div>
	</div>
</header>
<!-- site__header / end-->