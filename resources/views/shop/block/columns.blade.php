<div class="block block-products-columns">
	<div class="container">
		<div class="row">
			<div class="col-4">
				<div class="block-products-columns__title">{{ __('shop.top_rated') }}</div>
				<div class="block-products-columns__list">
				@foreach($toprated as $item)
					<div class="block-products-columns__list-item">
						<div class="product-card">
							<div class="product-card__actions-list">
								<button class="product-card__action product-card__action--quickview" type="button" aria-label="{{ __('shop.quickview') }}">
									<input type="hidden" id="input" value="{{$item["brand"]}},{{$item["article"]}},{{$item["aid"]??0}}">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
										<path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3zM3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z"></path>
									</svg>
								</button>
							</div>
							<div class="product-card__image"><a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}"><img src="{{$item["img_src"]}}" alt="{{$item["name"]}}"></a></div>
							<div class="product-card__info">
								<div class="product-card__name">
									<div><a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}">{{$item["name"]}}</a></div>
								</div>
								@if(isset($item["rating"]))
								<div class="product-card__rating">
									<div class="rating product-card__rating-stars">
										<div class="rating__body">
										@for($i=1; $i<=$item["rating"]; $i++)
											<div class="rating__star rating__star--active"></div>
										@endfor
										@for($i=1; $i<=$item["rating_left"]; $i++)
											<div class="rating__star"></div>
										@endfor
										</div>
									</div>
									<div class="product-card__rating-label">{{$item["rating"] ?? 0}} {{ __('shop.reviews_on') }} {{$item["reviewscount"] ?? 0}} {{ __('shop.reviews') }}</div>
								</div>
								@endif
							</div>
							<div class="product-card__footer">
								<div class="product-card__prices">
									<div class="product-card__price product-card__price--current">{{Session::get('currency_symbol')}} {{$item["price_formated"] ?? "0.00"}}</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach					
				</div>
			</div>
			<div class="col-4">
				<div class="block-products-columns__title">{{ __('shop.special_offers') }}</div>
				<div class="block-products-columns__list">
					@foreach($specialoffers as $item)
					<div class="block-products-columns__list-item">
						<div class="product-card">
							<div class="product-card__actions-list">
								<button class="product-card__action product-card__action--quickview" type="button" aria-label="{{ __('shop.quickview') }}">
									<input type="hidden" id="input" value="{{$item["brand"]}},{{$item["article"]}},{{$item["aid"]??0}}">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
										<path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3zM3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z"></path>
									</svg>
								</button>
							</div>
							<div class="product-card__image"><a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}"><img src="{{$item["img_src"]}}" alt="{{$item["name"]}}"></a></div>
							<div class="product-card__info">
								<div class="product-card__name">
									<div><a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}">{{$item["name"]}}</a></div>
								</div>
								@if(isset($item["rating"]))
								<div class="product-card__rating">
									<div class="rating product-card__rating-stars">
										<div class="rating__body">
											@for($i=1; $i<=$item["rating"]; $i++)
											<div class="rating__star rating__star--active"></div>
											@endfor
											@for($i=1; $i<=$item["rating_left"]; $i++)
											<div class="rating__star"></div>
											@endfor
										</div>
									</div>
									<div class="product-card__rating-label">{{$item["rating"] ?? 0}} {{ __('shop.reviews_on') }} {{$item["reviewscount"] ?? 0}} {{ __('shop.reviews') }}</div>
								</div>
								@endif
							</div>
							<div class="product-card__footer">
								<div class="product-card__prices">
									<div class="product-card__price product-card__price--current">{{Session::get('currency_symbol')}} {{$item["price_formated"]}}</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-4">
				<div class="block-products-columns__title">{{ __('shop.bestsellers') }}</div>
				<div class="block-products-columns__list">
					@foreach($bestsellers as $item)
					<div class="block-products-columns__list-item">
						<div class="product-card">
							<div class="product-card__actions-list">
								<button class="product-card__action product-card__action--quickview" type="button" aria-label="{{ __('shop.quickview') }}">
									<input type="hidden" id="input" value="{{$item["brand"]}},{{$item["article"]}},{{$item["aid"]??0}}">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
										<path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3zM3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z"></path>
									</svg>
								</button>
							</div>
							<div class="product-card__image"><a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}"><img src="{{$item["img_src"]}}" alt="{{$item["name"]}}"></a></div>
							<div class="product-card__info">
								<div class="product-card__name">
									<div><a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}">{{$item["name"]}}</a></div>
								</div>
								@if(isset($item["rating"]))
								<div class="product-card__rating">
									<div class="rating product-card__rating-stars">
										<div class="rating__body">
											@for($i=1; $i<=$item["rating"]; $i++)
											<div class="rating__star rating__star--active"></div>
											@endfor
											@for($i=1; $i<=$item["rating_left"]; $i++)
											<div class="rating__star"></div>
											@endfor
										</div>
									</div>
									<div class="product-card__rating-label">{{$item["rating"] ?? 0}} {{ __('shop.reviews_on') }} {{$item["reviewscount"] ?? 0}} {{ __('shop.reviews') }}</div>
								</div>
								@endif
							</div>
							<div class="product-card__footer">
								<div class="product-card__prices">
									<div class="product-card__price product-card__price--current">{{Session::get('currency_symbol')}} {{$item["price_formated"]}}</div>
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