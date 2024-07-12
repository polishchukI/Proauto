@extends('shop.template')

@section('content')

<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				<!--breadcrumbs-->
				@include('shop.layouts.breadcrumbs')
				<!--breadcrumbs-end-->
				<h1 class="block-header__title">{{ __('cart.shoppingcart') }}</h1>
			</div>
		</div>
	</div>
	<div class="block">
		<div class="container">
			@if($cartCount > 0)
			<div class="cart">
				<div class="cart__table cart-table">
					<table class="cart-table__table">
						<thead class="cart-table__head">
							<tr class="cart-table__row">
								<th class="cart-table__column cart-table__column--image">{{ __('cart.image') }}</th>
								<th class="cart-table__column cart-table__column--product">{{ __('cart.product') }}</th>
								<th class="cart-table__column cart-table__column--price">{{ __('cart.price') }}</th>
								<th class="cart-table__column cart-table__column--quantity">{{ __('cart.quantity') }}</th>
								<th class="cart-table__column cart-table__column--total">{{ __('cart.total') }}</th>
								<th class="cart-table__column cart-table__column--remove"></th>
							</tr>
						</thead>
						<tbody class="cart-table__body">
							<!---->
							@foreach ($cart as $item)
							<tr class="cart-table__row">
								<td class="cart-table__column cart-table__column--image">
									<a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}"><img src="{{$item["image"]}}" alt="{{$item["provider_product_name"]}}"></a>
								</td>
								<td class="cart-table__column cart-table__column--product">
									<a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["akey"]]) }}" class="cart-table__product-name">{{$item["provider_product_name"]}}</a>
									<ul class="cart-table__options">
										<li>Brand: {{$item["brand"]}}</li>
										<li>Article: {{$item["article"]}}</li>
										<li>Stock: {{$item["stock"]}}</li>
									</ul>
								</td>
								<td class="cart-table__column cart-table__column--price" data-title="{{ __('cart.price') }}">{{Session::get('currency_symbol')}} {{$item["price_formated"]}}</td>
								<td class="cart-table__column cart-table__column--quantity" data-title="{{ __('cart.quantity') }}">
									<div class="cart-table__quantity input-number">
										<input class="form-control input-number__input" type="number" min="1" value="{{$item["quantity"]}}">
										<div class="input-number__add"></div>
										<div class="input-number__sub"></div>
									</div>
								</td>
								<td class="cart-table__column cart-table__column--total" data-title="{{ __('cart.total') }}">{{Session::get('currency_symbol')}} {{$item["sum_formated"]}}</td>
								<td class="cart-table__column cart-table__column--remove">
									<button type="button"  onclick="deletefromcart('{{$item["uid"]}}')" class="cart-table__remove btn btn-sm btn-icon btn-muted">
										<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12">
											<path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4C11.2,9.8,11.2,10.4,10.8,10.8z"/>
										</svg>
									</button>
								</td>
							</tr>
							@endforeach
							<!---->
						</tbody>
						<tfoot class="cart-table__foot">
							<tr>
								<td colspan="6">
									<div class="cart-table__actions">
										<!--no coupon-->
										@if (! session()->has('coupon'))
										<form class="cart-table__coupon-form form-row" action="{{ route('coupon.addcoupon') }}" method="POST">
											{{ csrf_field() }}
											<div class="form-group mb-0 col flex-grow-1">
												<input type="text" name="coupon_code" id="coupon_code" class="form-control form-control-sm" placeholder="{{ __('cart.couponcode') }}" >
											</div>
											<div class="form-group mb-0 col-auto">
												<button type="submit" class="btn btn-sm btn-primary">{{ __('cart.applycoupon') }}</button>
											</div>
										</form>
										@endif
										<!--has coupon-->
										@if (session()->has('coupon'))											
										<form class="cart-table__coupon-form form-row" action="{{ route('coupon.deletecoupon') }}" method="POST">
											{{ csrf_field() }}
											{{ method_field('delete') }}
											<div class="form-group mb-0 col flex-grow-1">
												<div class="tag-badge tag-badge--theme">Coupon code ({{ session()->get('coupon')['name'] }})</div>
											</div>
											<div class="form-group mb-0 col-auto">
												<button type="submit" class="btn btn-sm btn-secondary">{{ __('cart.deletecoupon') }}</button>
											</div>
										</form>
										@endif
										<div class="cart-table__update-button">
											<a class="btn btn-sm btn-primary" href="#">{{ __('cart.updatecart') }}</a>
											<a class="btn btn-sm btn-secondary" href="#" onclick="return clearcart();">{{ __('cart.clearcart') }}</a>
										</div>
									</div>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="cart__totals">
					<div class="card">
						<div class="card-body card-body--padding--2">
							<h3 class="card-title">{{ __('cart.carttotals') }}</h3>
							<table class="cart__totals-table">
								<thead>
									<tr>
										<th>{{ __('cart.subtotal') }}</th>
										<td>{{Session::get('currency_symbol')}} {{$cartSumCount}}</td>
									</tr>
								</thead>
								<tbody>
									@if($cartCount>0)
									<tr>
										<th>{{ __('cart.items') }}</th>
										<td>{{$cartCount}} {{ __('cart.items') }}</td>
									</tr>
									@endif
									@if(isset($cartDiscount))
									<tr>
										<th>{{ __('cart.discount') }}</th>
										<td>{{Session::get('currency_symbol')}} {{$cartDiscount}}</td>
									</tr>
									@endif
									@if($cartShipping>0)
									<tr>
										<th>{{ __('cart.shipping') }}</th>
										<td>{{Session::get('currency_symbol')}} {{$cartShipping}}<div><a href="#">Calculate shipping</a></div></td>
									</tr>
									@endif
									@if($cartTax>0)
									<tr>
										<th>{{ __('cart.tax') }}</th>
										<td>{{Session::get('currency_symbol')}} {{$cartTax}}</td>
									</tr>
									@endif
									@if (session()->has('coupon'))
									<tr>
										<th>{{ __('cart.discount') }}</th>
										@if(session()->get('coupon')['type']=='fixed')
										<td>{{Session::get('currency_symbol')}} {{session()->get('coupon')['value']}}</td>
										@elseif(session()->get('coupon')['type']=='percent')
										<td>{{session()->get('coupon')['value']}} %</td>
										@endif
									</tr>
									@endif
								</tbody>
								<tfoot>
									<tr>
										<th>{{ __('cart.total') }}</th>
										<td>{{Session::get('currency_symbol')}} {{$cartTotal}}</td>
									</tr>
								</tfoot>
							</table>
							<a class="btn btn-primary btn-xl btn-block" href="{{url('checkout')}}">{{ __('cart.proceedtocheckout') }}</a>
						</div>
					</div>
				</div>
            </div>
		</div>
    </div>
    @else
    <div class="cart">
        <div class="not-found__content" style="text-align: center">
            <h1 class="not-found__title">{{ __('cart.yourcatrisempty') }}</h1>
			<img src="/images/cart_is_empty.png">
			<p class="not-found__text">{{ __('cart.tryrepeatserach') }}</p>
			<p class="not-found__text">{{ __('cart.getbacktomain') }}</p>
			<a class="btn btn-secondary btn-sm" href="{{ route('home') }}">{{ __('cart.gotomainbutton') }}</a>
        </div>
    </div>
    @endif
</div>
@stop