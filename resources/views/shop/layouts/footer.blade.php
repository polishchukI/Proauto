<!-- site__footer -->
<footer class="site__footer">
	<div class="site-footer">
		<div class="decor site-footer__decor decor--type--bottom">
			<div class="decor__body">
				<div class="decor__start"></div>
				<div class="decor__end"></div>
				<div class="decor__center"></div>
			</div>
		</div>
		<div class="site-footer__widgets">
			<div class="container">
				<div class="row">
					<div class="col-12 col-xl-4">
						<div class="site-footer__widget footer-contacts">
							<h5 class="footer-contacts__title">{{ __('footer.contactus') }}</h5>
							<div class="footer-contacts__text">{{ config('shop_settings.slogan') }}</div>
							<address class="footer-contacts__contacts">
								<dl>
									<dt>{{ __('footer.contacts') }}</dt>
									<dd>{{ config('shop_settings.phone') }}</dd>
									<dd>{{ config('shop_settings.phone2') }}</dd>
								</dl>
								<dl>
									<dt>{{ __('footer.mailto') }}</dt>
										<dd><a href="mailto:{{ config('shop_settings.email') }}">{{ config('shop_settings.emailname') }}</a></dd>
									</dl>
								@if(config('shop_settings.shop_address') == true)
								<dl>								
									<dt>{{ __('footer.ourlocation') }}</dt>
									<dd>{{ config('shop_settings.address') }}</dd>
									<dd>{{ config('shop_settings.city') }}</dd>
									<dd>{{ config('shop_settings.state') }}</dd>
									<dd>{{ config('shop_settings.country') }} {{ config('shop_settings.zipcode') }}</dd>
								</dl>
								@endif								
								<dl>
									<dt>{{ __('footer.workinghours') }}</dt>
									<dd>{{ config('shop_settings.workinghours') }}</dd>
									<dd>{{ config('shop_settings.day_off') }}</dd>
								</dl>
							</address>
						</div>
					</div>
					<div class="col-6 col-md-3 col-xl-2">
						<div class="site-footer__widget footer-links">
							<h5 class="footer-links__title">{{ __('footer.information') }}</h5>
							<ul class="footer-links__list">
								<li class="footer-links__item"><a href="{{ route('aboutpage') }}" class="footer-links__link">{{ __('footer.aboutus') }}</a></li>
								<li class="footer-links__item"><a href="{{ route('deliveryinfo') }}" class="footer-links__link">{{ __('footer.deliveryinfo') }}</a></li>
								<li class="footer-links__item"><a href="{{ route('privacypolicy') }}" class="footer-links__link">{{ __('footer.privacypolicy') }}</a></li>
								<li class="footer-links__item"><a href="{{ route('contactpage') }}" class="footer-links__link">{{ __('footer.contacts') }}</a></li>
								<li class="footer-links__item"><a href="{{ route('returns') }}" class="footer-links__link">{{ __('footer.returns') }}</a></li>
							</ul>
						</div>
					</div>
					<div class="col-6 col-md-3 col-xl-2">
						<div class="site-footer__widget footer-links">
							<h5 class="footer-links__title">{{ __('footer.links') }}</h5>
							<ul class="footer-links__list">
								<li class="footer-links__item"><a href="{{ route('catalog.groups') }}" class="footer-links__link">{{ __('footer.catalog') }}</a></li>
								<li class="footer-links__item"><a href="{{ route('special.lamps') }}" class="footer-links__link">{{ __('footer.lampscatalog') }}</a></li>
								<li class="footer-links__item"><a href="{{ route('blog') }}" class="footer-links__link">{{ __('footer.articles') }}</a></li>
								<li class="footer-links__item"><a href="{{ route('brandspage') }}" class="footer-links__link">{{ __('footer.brands') }}</a></li>
								<li class="footer-links__item"><a href="{{ route('sitemap') }}" class="footer-links__link">{{ __('footer.sitemap') }}</a></li>
							</ul>
						</div>
					</div>
					<div class="col-12 col-md-6 col-xl-4">
						<div class="site-footer__widget footer-newsletter">
							<h5 class="footer-newsletter__title">{{ __('footer.newsletter') }}</h5>
							<div class="footer-newsletter__text">{{ __('footer.newsletterslogan') }}</div>
							<form action="#" class="footer-newsletter__form">
								@csrf
								<label class="sr-only" for="footer-newsletter-address">E-mail</label>
								<input type="text" class="footer-newsletter__form-input" id="footer-newsletter-address" placeholder="E-mail...">
								<button class="footer-newsletter__form-button">{{ __('footer.subscribe') }}</button>
							</form>
							<div class="footer-newsletter__text footer-newsletter__text--social">{{ __('footer.socialnetworks') }}</div>
							<div class="footer-newsletter__social-links social-links">
								<ul class="social-links__list">
									<li class="social-links__item social-links__item--facebook"><a href="{{ config('shop_settings.facebook') }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
									<li class="social-links__item social-links__item--twitter"><a href="{{ config('shop_settings.twitter') }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
									<li class="social-links__item social-links__item--youtube"><a href="{{ config('shop_settings.youtube') }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
									<li class="social-links__item social-links__item--instagram"><a href="{{ config('shop_settings.instagram') }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
										{{-- <li class="social-links__item social-links__item--rss"><a href="{{ config('shop_settings.rss') }}" target="_blank"><i class="fas fa-rss"></i></a></li>--}}
											{{--<li class="social-links__item social-links__item--vk"><a href="{{ config('shop_settings.vk') }}" target="_blank"><i class="fab fa-vk"></i></a></li>--}}
									<li class="social-links__item social-links__item--telegram"><a href="{{ config('shop_settings.telegram') }}" target="_blank"><i class="fab fa-telegram-plane"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="site-footer__bottom">
			<div class="container">
				<div class="site-footer__bottom-row">
					<div class="site-footer__copyright">Powered by  - <a href="https://laravel.com/" target="_blank">LARAVEL</a></div>
					<div class="site-footer__payments">
						<img src="/images/payments.png" alt="payments">
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- site__footer / end-->