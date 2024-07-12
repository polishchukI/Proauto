@extends('shop.template')

@section('content')

<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<!--breadcrumbs-->
			@include('shop.layouts.breadcrumbs')
			<!--breadcrumbs-end-->
			<h1 class="block-header__title">Checkout</h1>
		</div>
	</div>
	<div class="checkout block">
		<div class="container container-xl">
			<form action="{{ route('placeorder') }}" method="POST" id="payment-form">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-12 col-lg-6 col-xl-7">
						<div class="card mb-lg-0">
							<div class="card-body card-body--padding--2">
								<h3 class="card-title">Billing details</h3>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="checkout_firstname">First Name</label>
										<input type="text" class="form-control" id="checkout_firstname" name="checkout_firstname" disabled="disabled" placeholder="{{ Auth::guard('clients')->user()->firstname }}">
									</div>
									<div class="form-group col-md-6">
										<label for="checkout_lastname">Last Name</label>
										<input type="text" class="form-control" id="checkout_lastname" name="checkout_lastname" disabled="disabled" placeholder="{{ Auth::guard('clients')->user()->lastname }}">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="checkout_email">Email address</label>
										<input type="email" class="form-control" id="checkout_email" name="checkout_email" disabled="disabled" placeholder="{{ Auth::guard('clients')->user()->email }}">
									</div>
									<div class="form-group col-md-6">
										<label for="checkout_phone">Phone</label>
										@if(!empty(Auth::guard('clients')->user()->telephone))
										<input type="text" class="form-control" id="checkout_phone" name="checkout_phone" disabled="disabled" placeholder="{{ Auth::guard('clients')->user()->telephone }}">
										@else
										<input type="text" class="form-control" id="checkout_phone" name="checkout_phone" placeholder="+38 050 999 88 77">
										@endif
									</div>
								</div>
								<div class="form-group">
									<label for="checkout_address">Billing address</label>
									<select id="checkout_address" name="checkout_address" class="form-control form-control-select2">
									@foreach($billingaddresses as $billingaddress)
										<option value="{{$billingaddress['id']}}">{{$billingaddress['name']}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="card-divider"></div>
							<div class="card-body card-body--padding--2">
								<h3 class="card-title">Shipping Details</h3>
								<div class="form-group">
									<label for="shipping_address">Shipping address</label>
									<select id="shipping_address" name="shipping_address" class="form-control form-control-select2">
									@foreach($shippingaddresses as $shippingaddress)
										<option value="{{$shippingaddress['id']}}">{{$shippingaddress['name']}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="card-divider"></div>
							<div class="card-body card-body--padding--2">
								<h3 class="card-title">Order notes <span class="text-muted">(Optional)</span></h3>
								<div class="form-group">
									<textarea id="checkout_comment" name="checkout_comment" class="form-control" rows="4"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-6 col-xl-5 mt-4 mt-lg-0">
						<div class="card mb-0">
							<div class="card-body card-body--padding--2">
								<h3 class="card-title">{{ __('checkout.yourorder') }}</h3>
								<table class="checkout__totals">
									<thead class="checkout__totals-header">
										<tr>
											<th>{{ __('checkout.product') }}</th>
											<th>{{ __('checkout.total') }}</th>
										</tr>
									</thead>
									<tbody class="checkout__totals-products">
										@foreach ($cart as $item)
										<tr>
											<td>{{$item["article"]}} - {{$item["brand"]}} × {{$item["quantity"]}}</td>
											<td>{{$item["sum_formated"]}} {{Session::get('currency_symbol')}}</td>
										</tr>
										@endforeach
									</tbody>
									<tbody class="checkout__totals-subtotals">
										<tr>
											<th>{{ __('checkout.subtotal') }}</th>
											<td>{{Session::get('currency_symbol')}} {{$cartSumCount}}</td>
										</tr>
										@if($clientBalance!=0)
										<tr>
											<th>{{ __('checkout.clientBalance') }}</th>
											<td>{{Session::get('currency_symbol')}} {{$clientBalance}}</td>
										</tr>
										@endif
										@if($cartShipping>0)
										<tr>
											<th>{{ __('checkout.shipping') }}</th>
											<td>{{Session::get('currency_symbol')}} {{$cartShipping}}<div><a href="#">Calculate shipping</a></div></td>
										</tr>
										@endif
									</tbody>
									<tfoot class="checkout__totals-footer">
										<tr>
											<th>{{ __('checkout.total') }}</th>
											<td>{{Session::get('currency_symbol')}} {{$cartTotal}}</td>
										</tr>
									</tfoot>
								</table>
								<div class="checkout__payment-methods payment-methods">
									<ul class="payment-methods__list">
									@foreach($paymentmethods as $method)
										<li class="payment-methods__item">
											<label class="payment-methods__item-header">
												<span class="payment-methods__item-radio input-radio">
													<span class="input-radio__body">
														<input class="input-radio__input" name="checkout_payment_method" type="radio">
														<span class="input-radio__circle"></span>
													</span>
												</span>
												<span class="payment-methods__item-title">{{ $method['name'] }}</span>
											</label>
											<div class="payment-methods__item-container">
												<div class="payment-methods__item-details text-muted">{{ $method['description'] }}</div>
											</div>
										</li>
									@endforeach
									</ul>
								</div>
								<div class="checkout__agree form-group">
									<div class="form-check">
										<span class="input-check form-check-input">
											<span class="input-check__body">
												<input class="input-check__input" type="checkbox" id="checkout_terms">
												<span class="input-check__box"></span> <span class="input-check__icon">
													<svg xmlns="http://www.w3.org/2000/svg" width="9px" height="7px">
														<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/>
													</svg>
												</span>
											</span>
										</span>
										<label class="form-check-label" for="checkout_terms">I have read and agree to the website <a target="_blank" href="#">terms and conditions</a></label>
									</div>
								</div>
								<button type="submit" class="btn btn-primary btn-xl btn-block">Place Order</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop