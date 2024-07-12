@extends('shop.template')

@section('content')
<div class="block block-products-columns">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<div class="block-products-columns__title">Top Rated Products</div>
						<div class="block-products-columns__list">
							<div class="block-products-columns__list-item">
								<div class="product-card">
									<div class="product-card__actions-list">
										<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
												<path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3z M3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z"></path>
											</svg>
										</button>
									</div>
									<div class="product-card__image"><a href="product-full"><img src="/images/products/product-2-245x245.jpg" alt=""></a></div>
									<div class="product-card__info">
										<div class="product-card__name">
											<div><a href="product-full">Brandix Brake Kit BDX-750Z370-S</a></div>
										</div>
										<div class="product-card__rating">
											<div class="rating product-card__rating-stars">
												<div class="rating__body">
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
												</div>
											</div>
											<div class="product-card__rating-label">5 on 22 reviews</div>
										</div>
									</div>
									<div class="product-card__footer">
										<div class="product-card__prices">
											<div class="product-card__price product-card__price--current">$224.00</div>
										</div>
									</div>
								</div>
							</div>
							<div class="block-products-columns__list-item">
								<div class="product-card">
									<div class="product-card__actions-list">
										<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
												<path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3z M3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z"></path>
											</svg>
										</button>
									</div>
									<div class="product-card__image"><a href="product-full"><img src="/images/products/product-3-245x245.jpg" alt=""></a></div>
									<div class="product-card__info">
										<div class="product-card__name">
											<div>
												<div class="product-card__badges">
													<div class="tag-badge tag-badge--sale">sale</div>
												</div>
												<a href="product-full">Left Headlight Of Brandix Z54</a>
											</div>
										</div>
										<div class="product-card__rating">
											<div class="rating product-card__rating-stars">
												<div class="rating__body">
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star"></div>
													<div class="rating__star"></div>
												</div>
											</div>
											<div class="product-card__rating-label">3 on 14 reviews</div>
										</div>
									</div>
									<div class="product-card__footer">
										<div class="product-card__prices">
											<div class="product-card__price product-card__price--new">$349.00</div>
											<div class="product-card__price product-card__price--old">$415.00</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
				<div class="col-4">
					<div class="block-products-columns__title">Special Offers</div>
					<div class="block-products-columns__list">
						<div class="block-products-columns__list-item">
							<div class="product-card">
								<div class="product-card__actions-list">
									<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
											<path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3zM3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z"></path>
										</svg>
									</button>
								</div>
								<div class="product-card__image"><a href="product-full"><img src="/images/products/product-4-245x245.jpg" alt=""></a></div>
								<div class="product-card__info">
									<div class="product-card__name">
										<div>
											<div class="product-card__badges">
												<div class="tag-badge tag-badge--hot">hot</div>
											</div>
											<a href="product-full">Glossy Gray 19" Aluminium Wheel AR-19</a>
										</div>
									</div>
									<div class="product-card__rating">
										<div class="rating product-card__rating-stars">
											<div class="rating__body">
												<div class="rating__star rating__star--active"></div>
												<div class="rating__star rating__star--active"></div>
												<div class="rating__star rating__star--active"></div>
												<div class="rating__star rating__star--active"></div>
												<div class="rating__star"></div>
											</div>
										</div>
										<div class="product-card__rating-label">4 on 26 reviews</div>
									</div>
								</div>
								<div class="product-card__footer">
									<div class="product-card__prices">
										<div class="product-card__price product-card__price--current">$589.00</div>
									</div>
								</div>
							</div>
						</div>
						<div class="block-products-columns__list-item">
							<div class="product-card">
								<div class="product-card__actions-list">
									<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
											<path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3zM3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z"></path>
										</svg>
									</button>
								</div>
								<div class="product-card__image"><a href="product-full"><img src="/images/products/product-5-245x245.jpg" alt=""></a></div>
								<div class="product-card__info">
									<div class="product-card__name">
										<div><a href="product-full">Twin Exhaust Pipe From Brandix Z54</a></div>
									</div>
									<div class="product-card__rating">
										<div class="rating product-card__rating-stars">
											<div class="rating__body">
												<div class="rating__star rating__star--active"></div>
												<div class="rating__star rating__star--active"></div>
												<div class="rating__star rating__star--active"></div>
												<div class="rating__star rating__star--active"></div>
												<div class="rating__star"></div>
											</div>
										</div>
										<div class="product-card__rating-label">4 on 9 reviews</div>
									</div>
								</div>
								<div class="product-card__footer">
									<div class="product-card__prices">
										<div class="product-card__price product-card__price--current">$749.00</div>
									</div>
								</div>
							</div>
						</div>
						<div class="block-products-columns__list-item">
							<div class="product-card">
								<div class="product-card__actions-list">
									<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
											<path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3zM3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z"></path>
										</svg>
									</button>
								</div>
								<div class="product-card__image">
									<a href="product-full"><img src="/images/products/product-6-245x245.jpg" alt=""></a></div>
									<div class="product-card__info">
										<div class="product-card__name">
											<div><a href="product-full">Motor Oil Level 5</a></div>
										</div>
										<div class="product-card__rating">
											<div class="rating product-card__rating-stars">
												<div class="rating__body">
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
												</div>
											</div>
											<div class="product-card__rating-label">5 on 2 reviews</div>
										</div>
									</div>
									<div class="product-card__footer">
										<div class="product-card__prices">
											<div class="product-card__price product-card__price--current">$23.00</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="block-products-columns__title">Bestsellers</div>
						<div class="block-products-columns__list">
						@foreach($bestsellers as $item)
							<div class="block-products-columns__list-item">
								<div class="product-card">
									<div class="product-card__actions-list">
										<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
												<path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3zM3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z"></path>
											</svg>
										</button>
									</div>
									<div class="product-card__image"><a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}"><img src="{{$item["img_src"]}}" alt=""></a></div>
									<div class="product-card__info">
										<div class="product-card__name">
											<div><a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}">{{$item["name"]}}</a></div>
										</div>
										<div class="product-card__rating">
											<div class="rating product-card__rating-stars">
												<div class="rating__body">
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star"></div>
												</div>
											</div>
											<div class="product-card__rating-label">4 on 6 reviews</div>
										</div>
									</div>
									<div class="product-card__footer">
										<div class="product-card__prices">
											<div class="product-card__price product-card__price--current">{{$item["price_formated"]}}</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
@stop