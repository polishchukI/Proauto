<!DOCTYPE html>
<html dir="ltr" lang="ru">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">* { font-family: 'DejaVu Sans' !important; font-size: 12px;}</style>
		<title>{{ __('inventory_doc_print.sale') }} № {{$sale['id']}}</title>
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
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.organisation_name') }}</b> {{$sale["organisation_name"]}}<br /></td>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.client') }}</b> {{$client["name"]}}<br /></td>
							</tr>
							<tr>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.organisation_phone') }}</b> {{$sale["organisation_phone"]}}<br /></td>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.date') }}</b> {{date('j F, Y', strtotime($sale["created_at"]))}}<br /></td>
							</tr>
							<tr>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.organisation_phone') }}</b> {{$sale["organisation_phone2"]}}<br /></td>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.currency') }}</b> {{$sale["currency"]}}<br /></td>
							</tr>
							<tr>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.organisation_email') }}</b> {{$sale["organisation_email"]}}<br /></td>
								<td style="width: 50%;"><b>{{ __('inventory_doc_print.sale') }}</b> № {{$sale["id"]}}<br /></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div><br></div>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">
							<tr>
								<td><b>#</b></td>
								<td><b>{{ __('inventory_doc_print.product_article') }}</b></td>
								<td><b>{{ __('inventory_doc_print.product_brand') }}</b></td>
								<td><b>{{ __('inventory_doc_print.product_name') }}</b></td>
								<td class="text-right"><b>{{ __('inventory_doc_print.product_quantity') }}</b></td>
								<td class="text-right"><b>{{ __('inventory_doc_print.product_price') }}</b></td>
								@if($sale["discount"] != 0)
								<td class="text-right"><b>{{ __('inventory_doc_print.product_sum') }}</b></td>
								<td class="text-right"><b>{{ __('inventory_doc_print.discount') }}</b></td>
								@endif
								<td class="text-right"><b>{{ __('inventory_doc_print.product_total') }}</b></td>
							</tr>
						</thead>
						<tbody style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">
							@foreach ($products as $product)
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">
								<td class="text-right">{{ $loop->iteration }}</td>
								<td class="text-right">{{ $product['article'] }}</td>
								<td class="text-right">{{ $product['brand'] }}</td>
								<td class="text-right">{{ $product['name'] }}</td>
								<td class="text-right">{{ $product['quantity'] }}</td>
								<td class="text-right">{{ $product['price'] }}</td>
								@if($sale["discount"] != 0)
								<td class="text-right">{{ $product['total'] }}</td>
								<td class="text-right">{{ $product['discount'] }}</td>
								@endif
								<td class="text-right">{{ $product['total_amount'] }}</td>
							</tr>
							@endforeach
						</tbody>
						<tbody>
							@if($sale["total_amount"]!= $sale["subtotal"])
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">
								<td class="text-right" @if($sale["discount"] != 0) colspan="8" @else colspan="6" @endif><b>{{ __('inventory_doc_print.subtotal') }}</b></td>
								<td class="text-right"><b>{{$sale["subtotal"]}}</b></td>
							</tr>
							@endif
							@if($sale["discountValue"]>0)
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">
								<td class="text-right" @if($sale["discount"] != 0) colspan="8" @else colspan="6" @endif><b>{{ __('inventory_doc_print.discountValue') }}</b></td>
								<td class="text-right"><b>{{$sale["discountValue"]}}</b></td>
							</tr
							>@endif
							@if($sale["tax"]>0)
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">
								<td class="text-right" @if($sale["discount"] != 0) colspan="8" @else colspan="6" @endif><b>{{ __('inventory_doc_print.tax') }}</b></td>
								<td class="text-right"><b>{{$sale["tax"]}}</b></td>
							</tr>
							@endif
							@if($sale["deliverycost"]>0)
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">
								<td class="text-right" @if($sale["discount"] != 0) colspan="8" @else colspan="6" @endif><b>{{ __('inventory_doc_print.deliverycost') }}</b></td>
								<td class="text-right"><b>{{$sale["deliverycost"]??0}}</b></td>
							</tr>
							@endif
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">
								<td class="text-right" @if($sale["discount"] != 0) colspan="8" @else colspan="6" @endif><b>{{ __('inventory_doc_print.total') }}</b></td>
								<td class="text-right"><b>{{$sale["total_amount"]}}</b></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>