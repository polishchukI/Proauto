<div class="block block-products-carousel" data-layout="grid-5">
	<div class="container">
		<div class="section-header">
			<div class="section-header__body">
				<h2 class="section-header__title">Featured Products</h2>
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
				<!---->
				@foreach($featured as $item)
				<div class="block-products-carousel__column">
					<div class="block-products-carousel__cell">
						<div class="product-card product-card--layout--grid">
							<div class="product-card__actions-list">
								<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view">
									<input type="hidden" id="input" value="{{$item["brand"]}},{{$item["article"]}},{{$item["aid"]??0}}">
									<svg width="16" height="16">
										<path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3z M3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z"></path>
									</svg>
								</button>
								<button class="product-card__action product-card__action--wishlist" type="button" OnClick="addtowishlist('{{$item["uid"]}}')" aria-label="Add to wish list">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
										<path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z"/>
									</svg>
								</button>
							</div>
							<div class="product-card__image">
								<a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}">
									<img style="max-height:262px;width:100%;height:100%;object-fit: cover;" src="{{$item["img_src"]}}" alt="{{$item["provider_product_name"]}} - {{$item["brand"]}} - {{$item["article"]}}">
								</a>
							</div>
							<div class="product-card__info">
								<div class="product-card__meta"><span class="product-card__meta-title">SKU: </span>{{$item["article"]}}</div>
								<div class="product-card__name">
									<div>
										<div class="product-card__badges">
										@foreach ($item["options"] as $key => $value)
											@if($value>0)
												<div class="tag-badge tag-badge--{{strtolower($key)}}">{{$key}}</div>
											@endif
										@endforeach
										</div>
										<a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}">{{$item["provider_product_name"]}} - {{$item["brand"]}} - {{$item["article"]}}</a>
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
								<button class="product-card__addtocart-icon" type="button" OnClick="addtocart(this,'{{$item["uid"]}}')" aria-label="Add to cart">
									<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
										<circle cx="7" cy="17" r="2"/><circle cx="15" cy="17" r="2"/>
										<path d="M20,4.4V5l-1.8,6.3c-0.1,0.4-0.5,0.7-1,0.7H6.7c-0.4,0-0.8-0.3-1-0.7L3.3,3.9C3.1,3.3,2.6,3,2.1,3H0.4C0.2,3,0,2.8,0,2.6V1.4C0,1.2,0.2,1,0.4,1h2.5c1,0,1.8,0.6,2.1,1.6L5.1,3l2.3,6.8c0,0.1,0.2,0.2,0.3,0.2h8.6c0.1,0,0.3-0.1,0.3-0.2l1.3-4.4C17.9,5.2,17.7,5,17.5,5H9.4C9.2,5,9,4.8,9,4.6V3.4C9,3.2,9.2,3,9.4,3h9.2C19.4,3,20,3.6,20,4.4z"/>
									</svg>
								</button>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				<!---->
			</div>
		</div>
	</div>
</div>