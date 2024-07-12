@extends('shop.template')

@section('content')
<div class="site__body">
	<div class="block-space block-space--layout--after-header"></div>
	<div class="block">
		<div class="container container--max--xl">
			<div class="row">
			@include('shop.block.profileNav')
				<div class="col-12 col-lg-9 mt-4 mt-lg-0">
					<div class="card">
						<div class="card-header">
							<div class="order-header__actions">
								<a href="{{url('account/orders')}}" class="btn btn-xs btn-secondary">{{ __('account.backtolist') }}</a>
								<button class="btn btn-xs btn-primary" onclick="window.open('{{ route('print.invoice', $order['id']) }}');">{{ __('account.print_invoice') }}</button>
							</div>
							<h5 class="order-header__title">{{ __('account.order') }} #{{$order["invoice"]}}-{{$order["id"]}}</h5>
							<div class="order-header__subtitle">Was placed on <mark>{{$order["created_at"]}}</mark> and is currently <mark>{{$order["order_status"]}}</mark>.</div>
						</div>
						<div class="card-divider"></div>
						<div class="card-table">
							<div class="table-responsive-sm">
								<table>
									<thead>
										<tr>
											<th>{{ __('account.product') }}</th>
											<th>{{ __('account.total') }}</th>
										</tr>
									</thead>
									<tbody class="card-table__body card-table__body--merge-rows">
										@if(isset($ordersproducts))
										@foreach($ordersproducts as $item)
										<tr>
											<td>{{$item["brand"]}} {{$item["article"]}} {{$item["name"]}} × {{$item["quantity"]}}</td>
											<td>{{$order["currency"]}} {{ number_format($item["row_total"], 4) }}</td>
										</tr>
										@endforeach
										@endif
									</tbody>
                                    <tbody class="card-table__body card-table__body--merge-rows">
										<tr>
											<th>{{ __('account.subtotal') }}</th>
											<td>{{$order["currency"]}} {{number_format($order["subtotal"], 4)}}</td>
										</tr>
										<tr>
											<th>{{ __('account.shipping') }}</th>
											<td>{{$order["currency"]}} {{number_format($order["shipping"], 4)}}</td>
										</tr>
										<tr>
											<th>{{ __('account.tax') }}</th>
											<td>{{$order["currency"]}} {{number_format($order["tax"], 4)}}</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<th>{{ __('account.total') }}</th>
											<td>{{$order["currency"]}} {{number_format($order["total"], 4)}}</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
					<div class="row mt-3 no-gutters mx-n2">
						<div class="col-sm-6 col-12 px-2">
							<div class="card address-card address-card--featured">
								<div class="address-card__badge tag-badge tag-badge--theme">{{ __('account.shippingaddress') }}</div>
								<div class="address-card__body">
									<div class="address-card__name">Ryan Ford</div>
									<div class="address-card__row">{{$shippingaddress['country']}}<br>
									{{$shippingaddress['zipcode']}}, {{$shippingaddress['city']}}<br>
									{{$shippingaddress['street']}}, {{$shippingaddress['address']}}</div>
									<div class="address-card__row"><div class="address-card__row-title">Phone Number</div><div class="address-card__row-content">38 972 588-42-36</div></div>
									<div class="address-card__row"><div class="address-card__row-title">Email Address</div><div class="address-card__row-content">stroyka@example.com</div></div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-12 px-2 mt-sm-0 mt-3">
							<div class="card address-card address-card--featured">
								<div class="address-card__badge tag-badge tag-badge--theme">{{ __('account.billingaddress') }}</div>
								<div class="address-card__body"><div class="address-card__name">Ryan Ford</div>
								<div class="address-card__row">{{$billingaddress['country']}}<br>
									{{$billingaddress['zipcode']}}, {{$billingaddress['city']}}<br>
									{{$billingaddress['street']}}, {{$billingaddress['address']}}</div>
								<div class="address-card__row">
									<div class="address-card__row-title">Phone Number</div>
									<div class="address-card__row-content">38 972 588-42-36</div>
								</div>
								<div class="address-card__row">
									<div class="address-card__row-title">Email Address</div>
									<div class="address-card__row-content">stroyka@example.com</div>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
