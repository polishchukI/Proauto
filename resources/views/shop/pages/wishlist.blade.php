@extends('shop.template')

@section('content')
<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				<!--breadcrumbs-->
				@include('shop.layouts.breadcrumbs')
				<!--breadcrumbs-end-->
				<h1 class="block-header__title">Wishlist</h1>
			</div>
		</div>
	</div>
	<div class="block">
		<div class="container container-xl">
			@if($wishlistCount > 0)
			<div class="wishlist">
				<table class="wishlist__table">
					<thead class="wishlist__head">
						<tr class="wishlist__row wishlist__row--head">
							<th class="wishlist__column wishlist__column--head wishlist__column--image">Image</th>
							<th class="wishlist__column wishlist__column--head wishlist__column--product">Product</th>
							<th class="wishlist__column wishlist__column--head wishlist__column--stock">Stock status</th>
							<th class="wishlist__column wishlist__column--head wishlist__column--price">Price</th>
							<th class="wishlist__column wishlist__column--head wishlist__column--button"></th>
							<th class="wishlist__column wishlist__column--head wishlist__column--remove"></th>
						</tr>
					</thead>
					<tbody class="wishlist__body">
						<!---->
						@foreach($wishlist as $item)
						<tr class="wishlist__row wishlist__row--body">
							<td class="wishlist__column wishlist__column--body wishlist__column--image">
								<a href="{{$item["URL"]}}"><img src="{{$item["IMAGE"]}}" alt="{{$item["provider_product_name"]}}"></a>
							</td>
							<td class="wishlist__column wishlist__column--body wishlist__column--product">
								<div class="wishlist__product-name"><a href="{{$item["URL"]}}">{{$item["provider_product_name"]}}</a></div>
								@if(isset($item["RATING"]))
								<div class="wishlist__product-rating">
									<div class="wishlist__product-rating-stars">
										<div class="rating">
											<div class="rating__body">
											@for($i=1; $i<=$item["RATING"]; $i++)
												<div class="rating__star rating__star--active"></div>
											@endfor
											@for($i=1; $i<=$item["RATING_LEFT"]; $i++)
												<div class="rating__star"></div>
											@endfor
											</div>
										</div>
									</div>
									@if($item["REVIEWSCOUNT"]>0)
									<div class="wishlist__product-rating-title">{{$item["RATING"]}} on {{$item["REVIEWSCOUNT"]}} reviews</div>
									@endif
								</div>
								@endif
								<!--ul class="cart-table__options">
									<li>Brand: {{$item["brand"]}}</li>
									<li>Article: {{$item["article"]}}</li>
									<li>Stock: {{$item["stock"]}}</li>
								</ul-->
							</td>
							<td class="wishlist__column wishlist__column--body wishlist__column--stock">
							@if($item["code"]=="MY")
								<div class="status-badge status-badge--style--success status-badge--has-text">
									<div class="status-badge__body">
										<div class="status-badge__text">In Stock</div>
									</div>
								</div>
							@else
								<div class="status-badge status-badge--style--success status-badge--has-text">
									<div class="status-badge__body">
										<div class="status-badge__text">{{$item["day"]}} day(s)</div>
									</div>
								</div>
							@endif
							</td>
							<td class="wishlist__column wishlist__column--body wishlist__column--price">{{$item["price_formated"]}} {{Session::get('currency_symbol')}}</td>
							<td class="wishlist__column wishlist__column--body wishlist__column--button">
								<button type="button" OnClick="addtocart(this,'{{$item["uid"]}}')" class="btn btn-sm btn-primary">Add to cart</button>
							</td>
							<td class="wishlist__column wishlist__column--body wishlist__column--remove">
								<button type="button" onclick="deletefromwishlist('{{$item["uid"]}}')" class="wishlist__remove btn btn-sm btn-muted btn-icon">
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12">
										<path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4C11.2,9.8,11.2,10.4,10.8,10.8z"></path>
									</svg>
								</button>
							</td>
						</tr>
						@endforeach						
					</tbody>
				</table>
			</div>
		</div>
		@else
			<div class="cart">
				<div class="not-found__content" style="text-align: center">
					<h1 class="not-found__title">{{ __('whishlist.yourwhishlistisempty') }}</h1>
					<img src="/images/wishlist_is_empty.png">
					<p class="not-found__text">{{ __('whishlist.tryrepeatserach') }}</p>
					<p class="not-found__text">{{ __('whishlist.getbacktomain') }}</p>
					<a class="btn btn-secondary btn-sm" href="{{ route('home') }}">{{ __('whishlist.gotomainbutton') }}</a>
				</div>
			</div>
			@endif
	</div>
</div>
@stop