<div class="products-view__options view-options view-options--offcanvas--mobile">
	<div class="view-options__body">
		<button type="button" class="view-options__filters-button filters-button">
			<span class="filters-button__icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"><path d="M7,14v-2h9v2H7z M14,7h2v2h-2V7z M12.5,6C12.8,6,13,6.2,13,6.5v3c0,0.3-0.2,0.5-0.5,0.5h-2C10.2,10,10,9.8,10,9.5v-3C10,6.2,10.2,6,10.5,6H12.5z M7,2h9v2H7V2z M5.5,5h-2C3.2,5,3,4.8,3,4.5v-3C3,1.2,3.2,1,3.5,1h2C5.8,1,6,1.2,6,1.5v3C6,4.8,5.8,5,5.5,5z M0,2h2v2H0V2z M9,9H0V7h9V9z M2,14H0v-2h2V14z M3.5,11h2C5.8,11,6,11.2,6,11.5v3C6,14.8,5.8,15,5.5,15h-2C3.2,15,3,14.8,3,14.5v-3C3,11.2,3.2,11,3.5,11z"></path></svg>
			</span>
			<span class="filters-button__title">Filters</span>
		</button>
		<div class="view-options__legend">Showing {{count($Numbers)}} of {{$total}} products</div>
		<div class="view-options__spring"></div>
	</div>
</div>
<div class="products-view__list products-list products-list--grid--4" data-layout="list" data-with-features="false">
	<div class="products-list__head">
		<div class="products-list__column products-list__column--image">Image</div>
		<div class="products-list__column products-list__column--meta">SKU</div>
		<div class="products-list__column products-list__column--product">Product</div>
		<div class="products-list__column products-list__column--rating">rating</div>
		<div class="products-list__column products-list__column--price">Price</div>
	</div>
	<div class="products-list__content">
		@foreach ($Numbers as $Number)
		<!--product start-->
		<div class="products-list__item">
			<div class="product-card">
				<div class="product-card__actions-list">
					<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view" name="{{ $Number["brand"] }}-{{ $Number["article"] }}">
						<input type="hidden" id="input" value="{{$Number["brand"]}}, {{$Number["article"]}}, {{$Number["uaid"] ?? 0}}">
						<svg width="16" height="16">
							<path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3z M3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z"></path>
						</svg>
					</button>
				</div>
				<div class="product-card__image lazyload">
					<img data-src="{{$Number["img_src"]}}" class="lazyload" alt="{{ $Number["brand"] }} - {{ $Number["article"] }}">
				</div>
				<div class="product-card__info">
					<div class="product-card__name">
						<div>
							<div class="product-card__badges">
							@if($Number["prices_count"]>0)
								@foreach ($ResultArray["prices"][$Number["pkey"]] as $Price)
									@foreach ($Price["options"] as $key => $value)
									@if($value>0)
									<div class="tag-badge tag-badge--{{strtolower($key)}}">{{$key}}</div>
									@endif
									@endforeach
								@break
								@endforeach
							@endif
							</div>
							<div class="BrandArticleWrapper">
								<div class="BrandArticleBlock">
									<div class="BrandBlock" style="background-color:#6c757d;">{{ $Number["brand"] }}</div>
									<span class="ArticleBlock" style="color:#6c757d;border:1px solid #6c757d;">{{ $Number["article"] }}</span>
								</div>
							</div>
							<a href="{{ route('product.page', ['brand' => $Number["bkey"], 'number' => $Number["akey"]]) }}">{{$Number["name"]}}</a>
							<br>
							@if(isset($Number["aid"]))
							<div class="aid">{{ $Number["aid"] }}</div>
							@endif
							@if(isset($Number["rating"]))
							<div class="product-card__rating">
								<div class="rating product-card__rating-stars">
									<div class="rating__body">
										@for($i=1; $i<=$Number["rating"]; $i++)
										<div class="rating__star rating__star--active"></div>
										@endfor
										@for($i=1; $i<=$Number["rating_left"]; $i++)
										<div class="rating__star"></div>
										@endfor
									</div>
								</div>
								@if($Number["reviewscount"]>0)
								<div class="product-card__rating-label">{{$Number["rating"]}} on {{$Number["reviewscount"]}} reviews</div>
								@endif
							</div>
							@endif
						</div>
					</div>
					@if(isset($Number["kind"]) && $Number["kind"]!="3" && $Number["superseded"]!="")
					<span class="superseded" title="Замененный {{ $Number["superseded"] }}"> Замененный: {{ $Number["superseded"] }}</span>
					@endif
					@if(isset($Number["kind"]))
						@if ($Number["kind"] == 2)<div class="artkind_trade" style="padding-top:5px;">Trade</div>@endif
						@if ($Number["kind"] == 3)<div class="artkind_original" style="padding-top:5px;">Original</div>@endif
						@if ($Number["kind"] == 4)<div class="artkind_analog" style="padding-top:5px;">Analog</div>@endif
						@if ($Number["kind"] == 5)<div class="artkind_barcode" style="padding-top:5px;">Barcode</div>@endif
					@endif
					<!--//-->
					<div class="form-group" style="padding:5px;">
						<button class="btn btn-primary btn-sm btn-icon" OnClick="analogview('{{$Number["brand"]}}','{{$Number["article"]}}','{{$Number["uaid"]??0}}')">
							<i class="fas fa-info"></i>
						</button>
						<button class="btn btn-secondary btn-sm btn-icon" OnClick="applicability('{{$Number["brand"]}}','{{$Number["article"]}}','{{$Number["uaid"]??0}}')">
							<i class="fas fa-car"></i>
						</button>
						<button class="btn btn-secondary btn-sm btn-icon" onclick="location.href='{{-- $Number["search_url"] --}}';">
							<i class="fas fa-search"></i>
						</button>
						@if($Number["prices_count"]>1)
						<button class="btn btn-primary btn-sm" OnClick="moreprices('{{$Number["brand"]}}','{{$Number["article"]}}')">
							<i class="fas fa-chart-bar"></i>{{__('catalog.moreprices')}}
						</button>
						@endif
					</div>
					<!--//-->
					<div class="product-card__features">
						<ul>
						@if(isset($Number["properties"]))
							@foreach ($Number["properties"] as $PName=>$PValue)
							@if(!is_null($PValue))
							<li><span>{{ $PName }}</span>:<span>{{$PValue}}</span></li>
							@endif
							@endforeach
						@endif
						</ul>
					</div>
				</div>

				<div class="product-card__footer">
				@if($Number["prices_count"]>0)
					@foreach ($ResultArray["prices"][$Number["pkey"]] as $PriceArray)
					<div class="product-card__prices" style="color: green;" >
						<div class="product-card__price product-card__price--current">{{Session::get('currency_symbol')}} {{$PriceArray["price_formated"]}}</div>
					</div>
					<div class="form-group" style="font-size: 12px; color: #737373;">
					@if ($PriceArray["day"]==0)
						<div class="status-badge status-badge--style--success status-badge--has-icon">
							<div class="status-badge__body">
								<div class="status-badge__icon"><svg width="13" height="13"><path d="M12,4.4L5.5,11L1,6.5l1.4-1.4l3.1,3.1L10.6,3L12,4.4z"></path></svg></div>
								<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="" data-original-title="In Stock"></div>
							</div>
						</div>
						@else
						<div class="status-badge status-badge--style--warning status-badge--has-text">
							<div class="status-badge__body">
								<div class="status-badge__text">{{$PriceArray["day"]}} day(s) in office</div>
								<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="" data-original-title="On Order"></div>
							</div>
						</div>
					@endif
					</div>
					<div class="form-group">
						<div class="alert alert-primary mb-3">Warehouse: {{$PriceArray["provider_code"]}}<sup style="color:#fff;padding:2px;background: #ff6502;border-radius: 8px;width: 80px;height: 16px;text-align: center;font-weight: 500;">{{$PriceArray["options"]["percentgive"]}}%</sup></div>
					</div>
					<div class="form-group">
						<div class="status-badge__body">
							<div class="status-badge__text">available: {{$PriceArray["available"]}}</div>
							<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="available" data-original-title="available"></div>
						</div>
					</div>
					<div class="input-number mb-3">
						<input class="form-control input-number__input" type="number" min="1" value="1" max="{{$PriceArray["available"]}}">
						<div class="input-number__add"></div>
						<div class="input-number__sub"></div>
					</div>
					<button type="button" class="product-card__addtocart-full" OnClick="addtocart(this,'{{$PriceArray["uid"]}}')">Add to cart</button>

					<button class="product-card__wishlist" type="button" OnClick="addtowishlist('{{$PriceArray["uid"]}}')">
						<svg width="16" height="16">
							<path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z"></path>
						</svg>
						<span>Add to wishlist</span>
					</button>
					@break
					@endforeach
				@else
					<div class="PriceBlock">
						<div class="AvalAsk" data-artnum="{{ $Number["article"] }}" data-brand="{{ $Number["brand"] }}">
							<div class="alert alert-danger mb-3">
								<svg class="CmAvalOnPage CmColorFi" viewBox="0 0 24 24">
									<path d="M16.677 17.868l-.343.195v-1.717l.343-.195v1.717zm2.823-3.325l-.342.195v1.717l.342-.195v-1.717zm3.5-7.602v11.507l-9.75 5.552-12.25-6.978v-11.507l9.767-5.515 12.233 6.941zm-13.846-3.733l9.022 5.178 1.7-.917-9.113-5.17-1.609.909zm2.846 9.68l-9-5.218v8.19l9 5.126v-8.098zm3.021-2.809l-8.819-5.217-2.044 1.167 8.86 5.138 2.003-1.088zm5.979-.943l-2 1.078v2.786l-3 1.688v-2.856l-2 1.078v8.362l7-3.985v-8.151zm-4.907 7.348l-.349.199v1.713l.349-.195v-1.717zm1.405-.8l-.344.196v1.717l.344-.196v-1.717zm.574-.327l-.343.195v1.717l.343-.195v-1.717zm.584-.333l-.35.199v1.717l.35-.199v-1.717z"></path>
								</svg>
								<span>{{ __('shop.not_available') }}</span>
							</div>
							<button class="btn btn-primary" type="button" OnClick="askprice('{{$Number["brand"]}}','{{$Number["article"]}}')">Запросить цену</button>
						</div>
					</div>
				@endif
				</div>
			</div>
		</div>
		<!--product end-->
		@endforeach
<!--Pagination-->
<div class="products-view__pagination">
	<nav aria-label="Page navigation example">
		<ul class="pagination">
			<li class="page-item disabled"><a class="page-link page-link--with-arrow" href="" aria-label="Previous"><span class="page-link__arrow page-link__arrow--left" aria-hidden="true"><svg width="7" height="11"><path d="M6.7,0.3L6.7,0.3c-0.4-0.4-0.9-0.4-1.3,0L0,5.5l5.4,5.2c0.4,0.4,0.9,0.3,1.3,0l0,0c0.4-0.4,0.4-1,0-1.3l-4-3.9l4-3.9C7.1,1.2,7.1,0.6,6.7,0.3z"></path></svg></span></a></li>
			<li class="page-item"><a class="page-link" href="#">1</a></li>
			<li class="page-item active" aria-current="page"><span class="page-link">2 <span class="sr-only">(current)</span></span></li>
			<li class="page-item"><a class="page-link" href="#">3</a></li>
			<li class="page-item"><a class="page-link" href="#">4</a></li>
			<li class="page-item page-item--dots"><div class="pagination__dots"></div></li>
			<li class="page-item"><a class="page-link" href="#">9</a></li>
			<li class="page-item">
				<a class="page-link page-link--with-arrow" href="" aria-label="Next">
					<span class="page-link__arrow page-link__arrow--right" aria-hidden="true">
						<svg width="7" height="11">
							<path d="M0.3,10.7L0.3,10.7c0.4,0.4,0.9,0.4,1.3,0L7,5.5L1.6,0.3C1.2-0.1,0.7,0,0.3,0.3l0,0c-0.4,0.4-0.4,1,0,1.3l4,3.9l-4,3.9C-0.1,9.8-0.1,10.4,0.3,10.7z"></path>
						</svg>
					</span>
				</a>
			</li>
		</ul>
	</nav>
	<div class="products-view__pagination-legend">Showing 6 of 98 products</div>
</div>
<!--div class="products-view__pagination">
	<nav aria-label="Page navigation example">
		<ul class="pagination">{{$Numbers->links()}}</ul></nav>
	<div class="products-view__pagination-legend">Showing {{count($Numbers)}} of {{$total}} products</div>
</div-->
<!--pagination-end-->