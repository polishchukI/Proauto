<div class="card widget widget-products d-none d-lg-block">
	<div class="widget__header"><h4>{{ __('shop.randomproducts') }}</h4></div>
	<div class="widget-products__list">
	@foreach($ResultArray["randomproducts"] as $lp)
		<div class="widget-products__item">
			<div class="widget-products__image"><img  style="max-width:64px;max-height:64px;object-fit:cover;" src="{{$lp["img_src"]}}" alt="{{$lp["provider_product_name"]}} - {{$lp["brand"]}} - {{$lp["article"]}}"></div>
			<div class="widget-products__info">
				<div class="widget-products__name"><a href="{{ route('product.page', ['brand' => $lp["brand"], 'number' => $lp["akey"]]) }}">{{$lp["provider_product_name"]}} {{$lp["article"]}}</a></div>
				<div class="widget-products__prices">
					<div class="widget-products__price widget-products__price--current">{{Session::get('currency_symbol')}} {{$lp["price_formated"]}}</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>