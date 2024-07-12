<!DOCTYPE html>
<html dir="ltr" lang="ru">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">* { font-family: 'DejaVu Sans' !important; font-size: 12px;}</style>
		<title>{{ __('saleinvoice.saleinvoice') }} № {{$sale['id']}}</title>
    </head>
	<body>
		<div class="container">
			<div>
				<h1>{{ __('saleinvoice.saleinvoice') }} № {{$sale['id']}}</h1>
				<div class="table-responsive">
					<table class="table table-bsaleed">
						<thead>
							<tr>
								<td colspan="2">{{ __('saleinvoice.saleinvoice') }}</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="width: 50%;">
									<b>{{ __('saleinvoice.name') }}</b> {{ __('contactdetails.name') }}<br />
									<b>{{ __('saleinvoice.phone') }}</b> {{ __('contactdetails.phone') }}<br />
									<b>{{ __('saleinvoice.phone') }}</b> {{ __('contactdetails.phone2') }}<br />
									<b>{{ __('saleinvoice.email') }}</b> {{ __('contactdetails.email') }}<br />
								</td>
								<td style="width: 50%;">
									<b>{{ __('saleinvoice.customer') }}</b> {{$customer["name"]}}<br />
									<b>{{ __('saleinvoice.saledate') }}</b> {{date('j F, Y', strtotime($sale["created_at"]))}}<br />
									<b>{{ __('saleinvoice.saleid') }}</b> № {{$sale["id"]}}<br />
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="table-responsive">
					<table class="table table-bsaleed" >
						<thead>
							<tr>
								<td style="width: 50%;"><b>{{ __('saleinvoice.billingaddress') }}</b></td>
								<td style="width: 50%;"><b>{{ __('saleinvoice.shippingaddress') }}</b></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="width: 50%;">
									<address>

									</address>
								</td>
								<td style="width: 50%;">

								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">
							<tr>
								<td><b>{{ __('saleinvoice.product_article') }}</b></td>
								<td><b>{{ __('saleinvoice.product_brand') }}</b></td>
								<td><b>{{ __('saleinvoice.product_name') }}</b></td>
								<td class="text-right"><b>{{ __('saleinvoice.product_quantity') }}</b></td>
								<td class="text-right"><b>{{ __('saleinvoice.product_price') }}</b></td>
								<td class="text-right"><b>{{ __('saleinvoice.product_sum') }}</b></td>
							</tr>
						</thead>
						<tbody style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">
							@foreach ($products as $product)
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">>
								<td class="text-right">{{ $product['article'] }}</td>
								<td class="text-right">{{ $product['brand'] }}</td>
								<td class="text-right">{{ $product['name'] }}</td>
								<td class="text-right">{{ $product['quantity'] }}</td>
								<td class="text-right">{{ $product['price'] }}</td>
								<td class="text-right">{{ $product['total'] }}</td>
							</tr>
							@endforeach
						</tbody>
						<tbody>
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">>
								<td class="text-right" colspan="4"><b>{{ __('saleinvoice.subtotal') }}</b></td>
								<td class="text-right">{{$sale["subtotal"]}}</td>
							</tr>
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">>
								<td class="text-right" colspan="4"><b>{{ __('saleinvoice.tax') }}</b></td>
								<td class="text-right">{{$sale["tax"]}}</td>
							</tr>
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">>
								<td class="text-right" colspan="4"><b>{{ __('saleinvoice.total') }}</b></td>
								<td class="text-right">{{$sale["total_amount"]}} ({{$sale["currency"]}})</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>