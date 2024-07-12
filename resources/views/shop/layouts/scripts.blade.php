<!-- mobile-menu -->
<div class="mobile-menu">
	<div class="mobile-menu__backdrop"></div>
	<div class="mobile-menu__body">
		<button class="mobile-menu__close" type="button">
			 <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12">
				<path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6 c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4 C11.2,9.8,11.2,10.4,10.8,10.8z"/>
			</svg>
		</button>
		<div class="mobile-menu__panel">
			<div class="mobile-menu__panel-header">
				<div class="mobile-menu__panel-title">Menu</div>
			</div>
			<div class="mobile-menu__panel-body">
				<div class="mobile-menu__settings-list">
					<div class="mobile-menu__setting" data-mobile-menu-item>
						<button class="mobile-menu__setting-button" title="Language" data-mobile-menu-trigger>
						@if(is_null(Session::get('locale')))
							<span class="mobile-menu__setting-icon"><img src="/images/languages/{{ config('app.locale') }}.png" alt="{{ config('app.locale') }}"> </span>
						@else
							<span class="mobile-menu__setting-icon"><img src="/images/languages/{{Session::get('locale')}}.png" alt="{{Session::get('locale')}}"> </span>
						@endif
							<span class="mobile-menu__setting-arrow">
								<svg xmlns="http://www.w3.org/2000/svg" width="6px" height="9px">
									<path d="M0.3,7.4l3-2.9l-3-2.9c-0.4-0.3-0.4-0.9,0-1.3l0,0c0.4-0.3,0.9-0.4,1.3,0L6,4.5L1.6,8.7c-0.4,0.4-0.9,0.4-1.3,0l0,0C-0.1,8.4-0.1,7.8,0.3,7.4z"/>
								</svg>
							</span>
						</button>
						<div class="mobile-menu__setting-panel" data-mobile-menu-panel>
							<div class="mobile-menu__panel mobile-menu__panel--hidden">
								<div class="mobile-menu__panel-header">
									<button class="mobile-menu__panel-back" type="button">
										<svg xmlns="http://www.w3.org/2000/svg" width="7" height="11">
											<path d="M6.7,0.3L6.7,0.3c-0.4-0.4-0.9-0.4-1.3,0L0,5.5l5.4,5.2c0.4,0.4,0.9,0.3,1.3,0l0,0c0.4-0.4,0.4-1,0-1.3l-4-3.9l4-3.9C7.1,1.2,7.1,0.6,6.7,0.3z"/>
										</svg>
									</button>
									<div class="mobile-menu__panel-title">Language</div>
								</div>
								<div class="mobile-menu__panel-body">
									<ul class="mobile-menu__links"><img src="/images/languages/ru.png" alt="Russian"><span>Russian</span></ul>
								</div>
							</div>
						</div>
					</div>
					<div class="mobile-menu__setting" data-mobile-menu-item>
						<button class="mobile-menu__setting-button" title="Currency" data-mobile-menu-trigger>
							<span class="mobile-menu__setting-title">{{currency()->getUserCurrency()}}</span>
							<span class="mobile-menu__setting-arrow">
								<svg xmlns="http://www.w3.org/2000/svg" width="6px" height="9px">
									<path d="M0.3,7.4l3-2.9l-3-2.9c-0.4-0.3-0.4-0.9,0-1.3l0,0c0.4-0.3,0.9-0.4,1.3,0L6,4.5L1.6,8.7c-0.4,0.4-0.9,0.4-1.3,0l0,0C-0.1,8.4-0.1,7.8,0.3,7.4z"/>
								</svg>
							</span>
						</button>
						<div class="mobile-menu__setting-panel" data-mobile-menu-panel>
							<div class="mobile-menu__panel mobile-menu__panel--hidden">
								<div class="mobile-menu__panel-header">
									<button class="mobile-menu__panel-back" type="button">
										<svg xmlns="http://www.w3.org/2000/svg" width="7" height="11">
											<path d="M6.7,0.3L6.7,0.3c-0.4-0.4-0.9-0.4-1.3,0L0,5.5l5.4,5.2c0.4,0.4,0.9,0.3,1.3,0l0,0c0.4-0.4,0.4-1,0-1.3l-4-3.9l4-3.9C7.1,1.2,7.1,0.6,6.7,0.3z"/>
										</svg>
									</button>
									<div class="mobile-menu__panel-title">Currency</div>
								</div>
								<div class="mobile-menu__panel-body">
									<ul class="mobile-menu__links">
										<!-- <li data-mobile-menu-item><a href="?currency=eur" type="button" class="" data-mobile-menu-trigger><i class="fas fa-euro-sign"> {{ __('header.euro') }}</i></a></li> -->
										<!-- <li data-mobile-menu-item><a href="?currency=uah" type="button" class="" data-mobile-menu-trigger><i class="fas fa-dollar-sign"> {{ __('header.dollar') }}</i></a></li> -->
										<li data-mobile-menu-item><a href="?currency=usd" type="button" class="" data-mobile-menu-trigger><i class="fas fa-ruble-sign"> {{ __('header.ruble') }}</i></a></li>
										<!-- <li data-mobile-menu-item><a href="?currency=rub" type="button" class="" data-mobile-menu-trigger><i class="fas fa-hryvnia"> {{ __('header.hryvnia') }}</i></a></li> -->
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="mobile-menu__divider"></div>
				<div class="mobile-menu__indicators">
					<a class="mobile-menu__indicator" href="{{ route('wishlist.show') }}">
						<span class="mobile-menu__indicator-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
								<path d="M14,3c2.2,0,4,1.8,4,4c0,4-5.2,10-8,10S2,11,2,7c0-2.2,1.8-4,4-4c1,0,1.9,0.4,2.7,1L10,5.2L11.3,4C12.1,3.4,13,3,14,3 M14,1c-1.5,0-2.9,0.6-4,1.5C8.9,1.6,7.5,1,6,1C2.7,1,0,3.7,0,7c0,5,6,12,10,12s10-7,10-12C20,3.7,17.3,1,14,1L14,1z"/>
							</svg>
						</span>
						<span class="mobile-menu__indicator-title">Wishlist</span>
					</a>
					<a class="mobile-menu__indicator" href="{{ route('account.login') }}">
						<span class="mobile-menu__indicator-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
								<path d="M20,20h-2c0-4.4-3.6-8-8-8s-8,3.6-8,8H0c0-4.2,2.6-7.8,6.3-9.3C4.9,9.6,4,7.9,4,6c0-3.3,2.7-6,6-6s6,2.7,6,6c0,1.9-0.9,3.6-2.3,4.7C17.4,12.2,20,15.8,20,20z M14,6c0-2.2-1.8-4-4-4S6,3.8,6,6s1.8,4,4,4S14,8.2,14,6z"/>
							</svg>
						</span>
						<span class="mobile-menu__indicator-title">Account</span>
					</a>
					<a class="mobile-menu__indicator" href="{{route('showcart')}}">
						<span class="mobile-menu__indicator-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
								<circle cx="7" cy="17" r="2"/><circle cx="15" cy="17" r="2"/>
								<path d="M20,4.4V5l-1.8,6.3c-0.1,0.4-0.5,0.7-1,0.7H6.7c-0.4,0-0.8-0.3-1-0.7L3.3,3.9C3.1,3.3,2.6,3,2.1,3H0.4C0.2,3,0,2.8,0,2.6 V1.4C0,1.2,0.2,1,0.4,1h2.5c1,0,1.8,0.6,2.1,1.6L5.1,3l2.3,6.8c0,0.1,0.2,0.2,0.3,0.2h8.6c0.1,0,0.3-0.1,0.3-0.2l1.3-4.4 C17.9,5.2,17.7,5,17.5,5H9.4C9.2,5,9,4.8,9,4.6V3.4C9,3.2,9.2,3,9.4,3h9.2C19.4,3,20,3.6,20,4.4z"/>
							</svg>
							@if(Session::has('cartCount'))
							<span class="mobile-menu__indicator-counter">{{ Session::get('cartCount')}}</span>
							@else
							<span class="mobile-menu__indicator-counter" name="cartCount">0</span>
							@endif						
						</span>
						<span class="mobile-menu__indicator-title">Cart</span>
					</a>
					<a class="mobile-menu__indicator" href="account-garage">
						<span class="mobile-menu__indicator-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
								<path d="M6.6,2c2,0,4.8,0,6.8,0c1,0,2.9,0.8,3.6,2.2C17.7,5.7,17.9,7,18.4,7C20,7,20,8,20,8v1h-1v7.5c0,0.8-0.7,1.5-1.5,1.5h-1 c-0.8,0-1.5-0.7-1.5-1.5V16H5v0.5C5,17.3,4.3,18,3.5,18h-1C1.7,18,1,17.3,1,16.5V16V9H0V8c0,0,0.1-1,1.6-1C2.1,7,2.3,5.7,3,4.2 C3.7,2.8,5.6,2,6.6,2z M13.3,4H6.7c-0.8,0-1.4,0-2,0.7c-0.5,0.6-0.8,1.5-1,2C3.6,7.1,3.5,7.9,3.7,8C4.5,8.4,6.1,9,10,9 c4,0,5.4-0.6,6.3-1c0.2-0.1,0.2-0.8,0-1.2c-0.2-0.4-0.5-1.5-1-2C14.7,4,14.1,4,13.3,4z M4,10c-0.4-0.3-1.5-0.5-2,0 c-0.4,0.4-0.4,1.6,0,2c0.5,0.5,4,0.4,4,0C6,11.2,4.5,10.3,4,10z M14,12c0,0.4,3.5,0.5,4,0c0.4-0.4,0.4-1.6,0-2c-0.5-0.5-1.3-0.3-2,0 C15.5,10.2,14,11.3,14,12z"/>
							</svg>
						</span>
						<span class="mobile-menu__indicator-title">Garage</span>
					</a>
				</div>
				<div class="mobile-menu__divider"></div>
				<ul class="mobile-menu__links">
					<li data-mobile-menu-item><a href="{{ route('home') }}" class="" data-mobile-menu-trigger>Home</a></li>
					<li data-mobile-menu-item><a href="{{ route('catalog.groups') }}" class="" data-mobile-menu-trigger>Catalog</a></li>
					<li data-mobile-menu-item><a href="{{ route('special.lamps') }}" class="" data-mobile-menu-trigger>Lamps catalog</a></li>
					<li data-mobile-menu-item><a href="{{ route('blog') }}" class="" data-mobile-menu-trigger>Блог</a></li>
					<li data-mobile-menu-item><a href="{{ route('services') }}" class="" data-mobile-menu-trigger>Услуги</a></li>
					<li data-mobile-menu-item><a href="{{ route('serviceprices') }}" class="" data-mobile-menu-trigger>Цены на услуги</a></li>
					<li data-mobile-menu-item><a href="{{ route('aboutpage') }}" class="" data-mobile-menu-trigger>About Us</a></li>
				</ul>
				<div class="mobile-menu__spring"></div>
				<div class="mobile-menu__divider"></div>
				<a class="mobile-menu__contacts" href="#"><div class="mobile-menu__contacts-subtitle">Free call 24/7</div><div class="mobile-menu__contacts-title">+38 (071) 389-4160</div></a>
			</div>
		</div>
	</div>
</div>
<!-- mobile-menu / end -->

<!-- quickview-modal -->
<div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
<!-- quickview-modal / end -->

<!-- analogview-modal -->
<div id="analogview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
<!-- analogview-modal / end -->

<!-- applicability-modal -->
<div id="applicability-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
<!-- applicability-modal / end -->

<!-- pricesview-modal -->
<div id="pricesview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
<!-- pricesview-modal / end -->

<!-- askprice-modal -->
<div id="askprice-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
<!-- askprice-modal / end -->

<!-- add vehicle-modal -->
<div id="add-vehicle-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="add-vehicle-modal modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<button type="button" class="add-vehicle-modal__close">
				<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12">
					<path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4C11.2,9.8,11.2,10.4,10.8,10.8z"/>
				</svg>
			</button>
			<div class="add-vehicle-modal__body">
				<div class="add-vehicle-modal__title card-title">Add A Vehicle</div>
				<div class="vehicle-form vehicle-form--layout--modal">
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
							<option>3000</option>
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
				<div class="add-vehicle-modal__actions">
					<button class="btn btn-sm btn-secondary add-vehicle-modal__close-button" type="button">Cancel</button>
					<a href="#" class="btn btn-sm btn-primary">Add A Vehicle</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- add-vehicle-modal / end -->

<!-- photoswipe -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="pswp__bg"></div>
	<div class="pswp__scroll-wrap">
		<div class="pswp__container">
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
		</div>
		<div class="pswp__ui pswp__ui--hidden">
			<div class="pswp__top-bar">
				<div class="pswp__counter"></div>
				<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
				<button class="pswp__button pswp__button&#45;&#45;share" title="Share"></button>
				<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
				<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
				<div class="pswp__preloader">
					<div class="pswp__preloader__icn">
						<div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
				<div class="pswp__share-tooltip"></div>
			</div>
			<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
			<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
			<div class="pswp__caption">
				<div class="pswp__caption__center"></div>
			</div>
		</div>
	</div>
</div>
<!-- photoswipe / end -->
@stack('shopjs')
<script defer>
	var mybutton = document.getElementById("totopbutton");
	window.onscroll = function() {scrollFunction()};
	function scrollFunction() {if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {mybutton.style.display = "block";} else {mybutton.style.display = "none";}}
	function topFunction() {document.body.scrollTop = 0;document.documentElement.scrollTop = 0;}
</script>
