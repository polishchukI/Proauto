<!DOCTYPE html>
<html dir="ltr" lang="ru">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ __('inventory_doc_print.admincart') }}{{$admincart['id']}}</title>
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
				<div class="table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.organization_name') }}</b> {{ config('inventory_settings.name') }}<br /></td>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.client') }}</b> {{$client["name"]}}<br /></td>
							</tr>
							<tr>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.organization_phone') }}</b> {{ config('inventory_settings.phone') }}<br /></td>
								<td style="width: 50%;"><b><b>{{ __('inventory_doc_print.date') }}</b> {{date('j F, Y', strtotime($admincart["created_at"]))}}<br /></td>
							</tr>
							<tr>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.organization_phone') }}</b> {{ config('inventory_settings.phone2') }}<br /></td>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.currency') }}</b> {{$admincart["currency"]}}<br /></td>
							</tr>
							<tr>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.organization_email') }}</b> {{ config('inventory_settings.email') }}<br /></td>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.admincart') }}</b> № {{$admincart["id"]}}<br /></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div><br></div>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<td style="width: 5%;"><b>#</b></td>
								<td style="width: 10%;"><b>{{ __('inventory_doc_print.product_article') }}</b></td>
								<td style="width: 10%;"><b>{{ __('inventory_doc_print.product_brand') }}</b></td>
								<td style="width: 30%;"><b>{{ __('inventory_doc_print.product_name') }}</b></td>
								<td style="width: 5%;"><b>{{ __('inventory_doc_print.product_quantity') }}</b></td>
								<td style="width: 10%;"><b>{{ __('inventory_doc_print.product_price') }}</b></td>
								<td style="width: 10%;"><b>{{ __('inventory_doc_print.product_sum') }}</b></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($products as $product)
							<tr>
								<td class="text-right">{{ $loop -> iteration }}</td>
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
							@if($admincart["total_amount"]!= $admincart["subtotal"])
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">>
								<td class="text-right" colspan="6"><b>{{ __('inventory_doc_print.subtotal') }}</b></td>
								<td class="text-right">{{$admincart["subtotal"] ?? 0}}</td>
							</tr>
							@endif
							@if($admincart["discountValue"]>0)
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">>
								<td class="text-right" colspan="6"><b>{{ __('inventory_doc_print.discountValue') }}</b></td>
								<td class="text-right">{{$admincart["discountValue"] ?? 0}}</td>
							</tr>
							@endif
							@if($admincart["tax"]>0)
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">>
								<td class="text-right" colspan="6"><b>{{ __('inventory_doc_print.tax') }}</b></td>
								<td class="text-right">{{$admincart["tax"] ?? 0}}</td>
							</tr>
							@endif
							@if($admincart["deliverycost"]>0)
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">>
								<td class="text-right" colspan="6"><b>{{ __('inventory_doc_print.deliverycost') }}</b></td>
								<td class="text-right">{{$admincart["deliverycost"] ?? 0}}</td>
							</tr>
							@endif
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">>
								<td class="text-right" colspan="4"><b>{{ __('inventory_doc_print.total') }}</b></td>
								<td class="text-right">{{$admincart["quantity"] ?? 0}}</td>
								<td class="text-right"></td>
								<td class="text-right">{{$admincart["total_amount"] ?? 0}}</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div><br></div>
				<div class="table-responsive">{{  config('inventory_settings.terms_of_delivery') }}</div>
			</div>
		</div>
	</body>
</html>