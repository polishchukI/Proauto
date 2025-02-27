<!-- site__mobile-header -->
<header class="site__mobile-header">
	<div class="mobile-header">
		<div class="container">
			<div class="mobile-header__body">
				<button class="mobile-header__menu-button" type="button">
					<svg xmlns="http://www.w3.org/2000/svg" width="18px" height="14px"><path d="M-0,8L-0,6L18,6L18,8L-0,8ZM-0,-0L18,-0L18,2L-0,2L-0,-0ZM14,14L-0,14L-0,12L14,12L14,14Z"/></svg>
				</button>
				<a class="mobile-header__logo" href="{{ route('home') }}">@include('shop.block.logo')</a>
				<div class="mobile-header__search mobile-search">
					<form class="mobile-search__body" id="mobileCatalogSearch">
						<input type="text" id="mobsearch" class="mobile-search__input" placeholder="{{ __('header.enterkeyword') }}">
						<button type="submit" class="mobile-search__button mobile-search__button--search">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
								<path d="M19.2,17.8c0,0-0.2,0.5-0.5,0.8c-0.4,0.4-0.9,0.6-0.9,0.6s-0.9,0.7-2.8-1.6c-1.1-1.4-2.2-2.8-3.1-3.9C10.9,14.5,9.5,15,8,15 c-3.9,0-7-3.1-7-7s3.1-7,7-7s7,3.1,7,7c0,1.5-0.5,2.9-1.3,4c1.1,0.8,2.5,2,4,3.1C20,16.8,19.2,17.8,19.2,17.8z M8,3C5.2,3,3,5.2,3,8 c0,2.8,2.2,5,5,5c2.8,0,5-2.2,5-5C13,5.2,10.8,3,8,3z"/>
							</svg>
						</button>
						<button type="button" class="mobile-search__button mobile-search__button--close">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
								<path d="M16.7,16.7L16.7,16.7c-0.4,0.4-1,0.4-1.4,0L10,11.4l-5.3,5.3c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L8.6,10L3.3,4.7 c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L10,8.6l5.3-5.3c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L11.4,10l5.3,5.3 C17.1,15.7,17.1,16.3,16.7,16.7z"/>
							</svg>
						</button>
						<div class="mobile-search__field"></div>
					</form>
				</div>
				<div class="mobile-header__indicators">
					<div class="mobile-indicator mobile-indicator--search d-md-none">
						<button type="button" class="mobile-indicator__button">
							<span class="mobile-indicator__icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
									<path d="M19.2,17.8c0,0-0.2,0.5-0.5,0.8c-0.4,0.4-0.9,0.6-0.9,0.6s-0.9,0.7-2.8-1.6c-1.1-1.4-2.2-2.8-3.1-3.9C10.9,14.5,9.5,15,8,15c-3.9,0-7-3.1-7-7s3.1-7,7-7s7,3.1,7,7c0,1.5-0.5,2.9-1.3,4c1.1,0.8,2.5,2,4,3.1C20,16.8,19.2,17.8,19.2,17.8z M8,3C5.2,3,3,5.2,3,8c0,2.8,2.2,5,5,5c2.8,0,5-2.2,5-5C13,5.2,10.8,3,8,3z"/>
								</svg>
							</span>
						</button>
					</div>
					<div class="mobile-indicator d-none d-md-block">
						<a href="{{route('account.login')}}" class="mobile-indicator__button">
							<span class="mobile-indicator__icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
									<path d="M20,20h-2c0-4.4-3.6-8-8-8s-8,3.6-8,8H0c0-4.2,2.6-7.8,6.3-9.3C4.9,9.6,4,7.9,4,6c0-3.3,2.7-6,6-6s6,2.7,6,6c0,1.9-0.9,3.6-2.3,4.7C17.4,12.2,20,15.8,20,20z M14,6c0-2.2-1.8-4-4-4S6,3.8,6,6s1.8,4,4,4S14,8.2,14,6z"/>
								</svg>
							</span>
						</a>
					</div>
					<div class="mobile-indicator d-none d-md-block">
						<a href="wishlist" class="mobile-indicator__button">
							<span class="mobile-indicator__icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
									<path d="M14,3c2.2,0,4,1.8,4,4c0,4-5.2,10-8,10S2,11,2,7c0-2.2,1.8-4,4-4c1,0,1.9,0.4,2.7,1L10,5.2L11.3,4C12.1,3.4,13,3,14,3 M14,1c-1.5,0-2.9,0.6-4,1.5C8.9,1.6,7.5,1,6,1C2.7,1,0,3.7,0,7c0,5,6,12,10,12s10-7,10-12C20,3.7,17.3,1,14,1L14,1z"/>
								</svg>
							</span>
						</a>
					</div>
					<div class="mobile-indicator">
						<a href="{{route('showcart')}}" class="mobile-indicator__button">
							<span class="mobile-indicator__icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
									<circle cx="7" cy="17" r="2"/><circle cx="15" cy="17" r="2"/><path d="M20,4.4V5l-1.8,6.3c-0.1,0.4-0.5,0.7-1,0.7H6.7c-0.4,0-0.8-0.3-1-0.7L3.3,3.9C3.1,3.3,2.6,3,2.1,3H0.4C0.2,3,0,2.8,0,2.6V1.4C0,1.2,0.2,1,0.4,1h2.5c1,0,1.8,0.6,2.1,1.6L5.1,3l2.3,6.8c0,0.1,0.2,0.2,0.3,0.2h8.6c0.1,0,0.3-0.1,0.3-0.2l1.3-4.4C17.9,5.2,17.7,5,17.5,5H9.4C9.2,5,9,4.8,9,4.6V3.4C9,3.2,9.2,3,9.4,3h9.2C19.4,3,20,3.6,20,4.4z"/>
								</svg>
									<span class="mobile-indicator__counter" name="cartCount" >(Session::has('cartCount')) ? {{ Session::get('cartCount')}} : 0</span>
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- site__mobile-header / end-->