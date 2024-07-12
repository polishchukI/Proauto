<div class="block block-products-carousel" data-layout="horizontal">
	<div class="container">
		<div class="section-header">
			<div class="section-header__body">
				<h2 class="section-header__title">New Arrivals</h2>
				<div class="section-header__spring"></div>
				<div class="section-header__arrows">
					<div class="arrow section-header__arrow section-header__arrow--prev arrow--prev">
						<button class="arrow__button" type="button">
							<i class="fas fa-angle-left"></i>
						</button>
					</div>
					<div class="arrow section-header__arrow section-header__arrow--next arrow--next">
						<button class="arrow__button" type="button">
							<i class="fas fa-angle-right"></i>
						</button>
					</div>
				</div>
				<div class="section-header__divider"></div>
			</div>
		</div>
		<div class="block-products-carousel__carousel">
			<div class="block-products-carousel__carousel-loader"></div>
			<div class="owl-carousel">
				@foreach($newarrivals as $item)
				<div class="block-products-carousel__column">
					<div class="block-products-carousel__cell">
						<div class="product-card product-card--layout--horizontal">
							<div class="product-card__actions-list">
								<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">
									<input type="hidden" id="input" value="{{$item["brand"]}},{{$item["article"]}},{{$item["aid"]??0}}">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
										<path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3z M3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z"/>
									</svg>
								</button>
							</div>
							<div class="product-card__image"><a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}"><img src="{{$item["img_src"]}}" alt="{{$item["provider_product_name"]}}"></a></div>
							<div class="product-card__info">
								<div class="product-card__name">
									<div>
										<div class="product-card__badges">
										@foreach ($item["options"] as $key => $value)
											@if($value>0)
												<div class="tag-badge tag-badge--{{strtolower($key)}}">{{$key}}</div>
											@endif
										@endforeach
										</div>
										<a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}">{{$item["provider_product_name"]}}</a>
									</div>
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
									@if($item["reviewscount"]>0)
									<div class="product-card__rating-label">{{$item["rating"]}} on {{$item["reviewscount"]}} reviews</div>
									@endif
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
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>