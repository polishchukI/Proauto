<!DOCTYPE html>
<html dir="ltr" lang="ru">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">* { font-family: 'DejaVu Sans' !important; font-size: 12px;}</style>
		<title>{{ __('inventory_doc_print.product_stocks_report_on_date') }}: {{date('j F, Y', strtotime($product_stocks_header['report_date']))}}</title>
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
				<h1>{{ __('inventory_doc_print.product_stocks_report') }}</h1>
				<div class="table-responsive">
					<table class="table">
						<tbody>
							<tr><td style="width: 50%;"><b>{{ __('inventory_doc_print.warehouse') }}:</b></td><td style="width: 50%;"> {{$product_stocks_header['warehouse']}}</td></tr>
							<tr><td style="width: 50%;"><b>{{ __('inventory_doc_print.on_date') }}:</b></td><td style="width: 50%;"> {{date('j F, Y', strtotime($product_stocks_header['report_date']))}}</td></tr>
							<tr><td style="width: 50%;"><b>{{ __('inventory_doc_print.stocks_total') }}:</b></td><td style="width: 50%;"> {{ number_format($product_stocks_header['stocks_total'],2) }}</td></tr>
							<tr><td style="width: 50%;"><b>{{ __('inventory_doc_print.quantity_total') }}:</b></td><td style="width: 50%;">{{ number_format($product_stocks_header['quantity_total'],2) }}</td></tr>
							<tr><td style="width: 50%;"><b>{{ __('inventory_doc_print.currency') }}:</b></td><td style="width: 50%;">{{$product_stocks_header['currency']}}</td></tr>
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
								<td class="text-right"><b>{{ __('inventory_doc_print.product_sum') }}</b></td>
							</tr>
						</thead>
						<tbody style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">
							@foreach ($product_stocks as $product)
							<tr style="border-top: 1px solid #5a5c69;border-bottom: 1px solid #5a5c69;border-left: 1px solid #5a5c69;border-right: 1px solid #5a5c69;">>
								<td class="text-right">{{ $loop->iteration }}</td>
								<td class="text-right">{{ $product['article'] }}</td>
								<td class="text-right">{{ $product['brand'] }}</td>
								<td class="text-right">{{ $product['name'] }}</td>
								<td class="text-right">{{ $product['quantity'] }}</td>
								<td class="text-right">{{ number_format($product['price'],2) }}</td>
								<td class="text-right">{{ number_format($product['total'],2) }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>