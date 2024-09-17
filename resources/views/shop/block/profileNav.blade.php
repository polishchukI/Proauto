<div class="col-12 col-lg-3 d-flex">
	<div class="account-nav flex-grow-1">
		<h4 class="account-nav__title">{{ __('account.navigation') }}</h4>
		<ul class="account-nav__list">
			<li class="account-nav__item {{ (request()->is('account/dashboard')) ? 'account-nav__item--active' : '' }}"><a href="{{ route('account.dashboard') }}">{{ __('account.dashboard') }}</a></li>
			<li class="account-nav__item {{ (request()->is('account/garage')) ? 'account-nav__item--active' : '' }}"><a href="{{ route('account.garage') }}">{{ __('account.garage') }}</a></li>
			<li class="account-nav__item {{ (request()->is('account/profile')) ? 'account-nav__item--active' : '' }}"><a href="{{ route('account.profile') }}">{{ __('account.profile') }}</a></li>
			<li class="account-nav__item {{ (request()->is('account/orders')) ? 'account-nav__item--active' : '' }}"><a href="{{ route('account.orders') }}">{{ __('account.orders') }}</a></li>
			{{-- <li class="account-nav__item {{ (request()->is('account/sales')) ? 'account-nav__item--active' : '' }}"><a href="{{ route('account.sales') }}">{{ __('account.sales') }}</a></li>--}}
			<li class="account-nav__item {{ (request()->is('account/addresses')) ? 'account-nav__item--active' : '' }}"><a href="{{ route('account.addresses') }}">{{ __('account.addresses') }}</a></li>
			<li class="account-nav__item {{ (request()->is('account/password')) ? 'account-nav__item--active' : '' }}"><a href="{{ route('account.changepassword') }}">{{ __('account.changepassword') }}</a></li>
			<li class="account-nav__divider" role="presentation"></li>
			<li class="account-nav__item">
				<a href="{{ route('account.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('account.logout') }}</a>
				<form id="logout-form" action="{{ route('account.logout') }}" method="POST" style="display: none;">@csrf</form>
			</li>
		</ul>
	</div>
</div>