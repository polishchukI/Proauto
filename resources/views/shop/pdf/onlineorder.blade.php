<!DOCTYPE html>
<html dir="ltr" lang="ru">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ __('online_invoice.invoice') }}-{{$order['invoice']}}-{{$order['id']}}</title>
		<style type="text/css">* { font-family: 'DejaVu Sans' !important; font-size: 12px;}</style>
	</head>
	<style>
		body {
			font-family: DejaVu Sans, sans-serif;
			font-size: 12px;
		}

		.header {
			width: 100%;
		}

		.number-order-barcode {
			margin-left: 470px;
			margin-top: -20px;
		}

		.info {
			width: 100%;
			border: 1px solid black;
			border-collapse: collapse;
		}

		table {
			width: 100%;
			border: 1px solid black;
			border-collapse: collapse;
		}
		th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}

		.title {
			font-weight: bold;
		}

		.wrap {
			margin: 0 0 0.65rem 0.65rem;
		}
		
		.descr {
			width: 100%;
			padding-left: 0.75rem;
			min-height: 50px;
			white-space: pre-wrap;
		}

		.service {
			margin-bottom: 10px;
		}

		.services-list {
			margin-top: 5px;
			margin-left: 50px;
			font-style: italic;
		}

		.total-price {
			font-weight: bold;
			font-style: italic;
			text-decoration: underline;
		}

		.mb {
			margin-bottom: 20px;
		}
		.signature {
			width: 100%;
			margin-top: 20px;
			font-weight: bold;
			margin-left: 0.75rem;
		}
	</style>
	<body>
		<div class="container">
			<div>
				<div>{!! $barcode !!}<br/></div>
				<h1>{{ __('online_invoice.invoice') }} {{$order['invoice']}}-{{$order['id']}}</h1>
				<div class="table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<td style="width: 50%;"><b>{{ __('online_invoice.organisation_name') }}</b> {{$order["organisation_name"]}}<br /></td>
								<td style="width: 50%;"><b>{{ __('online_invoice.client') }}</b> {{ $order["lastname"] }}  {{ $order["firstname"] }}<br /></td>
							</tr>
							<tr>
								<td style="width: 50%;"><b>{{ __('online_invoice.phone') }}</b> {{$order["organisation_phone"]}}<br /></td>
								<td style="width: 50%;"><b>{{ __('online_invoice.orderdate') }}</b> {{date('j F, Y', strtotime($order["created_at"]))}}<br /></td>
							</tr>
							<tr>
								<td style="width: 50%;"><b>{{ __('online_invoice.phone') }}</b> {{$order["organisation_phone2"]}}<br /></td>
								<td style="width: 50%;"><b>{{ __('online_invoice.currency') }}</b> {{$order["currency"]}}<br /></td>
							</tr>
							<tr>
								<td style="width: 50%;"><b>{{ __('online_invoice.email') }}</b> {{$order["organisation_email"]}}<br /></td>
								<td style="width: 50%;"><b>{{ __('online_invoice.orderid') }}</b> № {{$order["id"]}}<br /></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div><br></div>

				<div class="table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<td style="width: 50%;"><b>{{ __('online_invoice.billingaddress') }}</b><
									{{$billingaddress["street"]}}, {{$billingaddress["address"]}}, {{$billingaddress["city"]}}, {{$billingaddress["state"]}}, {{$billingaddress["country"]}}, {{$billingaddress["zipcode"]}}
								</td>
							</tr>
							<tr>
								<td style="width: 50%;"><b>{{ __('online_invoice.shippingaddress') }}</b>
									{{$shippingaddress["street"]}}, {{$shippingaddress["address"]}}, {{$shippingaddress["city"]}}, {{$shippingaddress["state"]}}, {{$shippingaddress["country"]}}, {{$shippingaddress["zipcode"]}}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div><br></div>

				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<td><b>{{ __('online_invoice.article') }}</b></td>
								<td><b>{{ __('online_invoice.brand') }}</b></td>
								<td><b>{{ __('online_invoice.product') }}</b></td>
								<td class="text-right"><b>{{ __('online_invoice.quantity') }}</b></td>
								<td class="text-right"><b>{{ __('online_invoice.price') }}</b></td>
								<td class="text-right"><b>{{ __('online_invoice.sum') }}</b></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($products as $product)
							<tr>
								<td>{{$product['article']}}</td>
								<td>{{$product['brand']}}</td>
								<td>{{$product['name']}}</td>							
								<td class="text-right">{{$product['quantity']}}</td>
								<td class="text-right">{{$product['price']}}</td>
								<td class="text-right">{{$product['total']}}</td>
							</tr>
							@endforeach
						</tbody>
						<tbody>
							<tr>
								<td class="text-right" colspan="5"><b>{{ __('online_invoice.subtotal') }}</b></td>
								<td class="text-right">{{$order["subtotal"]}}</td>
							</tr>
							<tr>
								<td class="text-right" colspan="5"><b>{{ __('online_invoice.tax') }}</b></td>
								<td class="text-right">{{$order["tax"]}}</td>
							</tr>
							<tr>
								<td class="text-right" colspan="5"><b>{{ __('online_invoice.deliverycost') }}</b></td>
								<td class="text-right">{{$order["shipping"]}}</td>
							</tr>
							<tr>
								<td class="text-right" colspan="5"><b>{{ __('online_invoice.total') }}</b></td>
								<td class="text-right">{{$order["total"]}}</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div><br></div>
			</div>
		</body>
		</html>