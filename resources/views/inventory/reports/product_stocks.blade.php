@extends('inventory.layouts.app', ['page' => __('inventory.product_stocks_report'), 'pageSlug' => 'product_stocks_report', 'section' => 'reports', 'search' => ''])

@section('content')
<div class="row">
	<div class="card shadow mb-4">
		<div class="card-header">
			<h4 class="card-title">{{ __('inventory.product_stocks_by_quantity') }}</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-1 mt-4">
					<input type="hidden" name="user_id" value="{{ Auth::id() }}">
					<div id="report_loader" class="search-ring hidden" style="width:15px;height:15px;"><img src="/images/admincart-search.gif"></div>
				</div>
				<div class="col-2">
					<div class="form-group{{ $errors->has('warehouse') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="input-warehouse">{{ __('inventory.warehouse') }}</label>
						<select name="warehouse" id="input-warehouse" class="form-select form-control-alternative{{ $errors->has('warehouse') ? ' is-invalid' : '' }}">
							<option value="">{{ __('inventory.not_specified') }}</option>
							@foreach ($warehouses as $warehouse)
								@if($warehouse['id'] == old('warehouse'))
									<option value="{{$warehouse['id']}}" selected>{{$warehouse['name']}}</option>
								@else
									<option value="{{$warehouse['id']}}">{{$warehouse['name']}}</option>
								@endif
							@endforeach
						</select>
						@include('inventory.alerts.feedback', ['field' => 'warehouse'])
					</div>
				</div>
				<div class="col-2">								
					<div class="form-group{{ $errors->has('currency') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="input-currency">{{ __('inventory.currency') }}</label>
						<select name="currency" id="input-currency" class="form-select form-control-alternative{{ $errors->has('currency') ? ' is-invalid' : '' }}">
							<option value="">{{ __('inventory.not_specified') }}</option>
							@foreach ($currencies as $currency)
								@if($currency['code'] == old('currency'))
									<option value="{{$currency['code']}}" selected>{{$currency['name']}}</option>
								@else
									<option value="{{$currency['code']}}">{{$currency['name']}}</option>
								@endif
							@endforeach
						</select>
						@include('inventory.alerts.feedback', ['field' => 'currency'])
					</div>
				</div>
				<div class="col-2">
					<div class="form-group{{ $errors->has('report_date') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="input-report_date">{{ __('inventory.report_date') }}</label>
						<input type="date" name="report_date" id="input-report_date" class="form-control form-control-alternative{{ $errors->has('report_date') ? ' is-invalid' : '' }}" placeholder="report_date">
						@include('inventory.alerts.feedback', ['field' => 'report_date'])
					</div>
				</div>
				<div class="col-2 mt-4">
					<button type="button" class="btn btn-success btn-simple btn-sm" OnClick="product_stocks_report_show()">{{ __('inventory.report_show') }}</button>					
				</div>
				<div class="col-2 mt-4">
					<button type="button" class="btn btn-success btn-simple btn-sm" OnClick="product_stocks_report_print()">{{ __('inventory.report_print') }}</button>
				</div>
				<div class="col-1 mt-4"></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
<div class="card shadow mb-4">
	<div class="card-body">
		<table class="table">
			<thead>
				<th>#</th>
				<th>{{ __('inventory.article') }}</th>
				<th>{{ __('inventory.brand') }}</th>
				<th>{{ __('inventory.name') }}</th>
				<th>{{ __('inventory.stock') }}</th>
				<th>{{ __('inventory.price') }}</th>
				<th>{{ __('inventory.total') }}</th>
			</thead>
			<tbody name="section"></tbody>
			<tfoot name="sectionTotal"></tfoot>
			<tfoot name="warehouseName"></tfoot>
		</table>
	</div>
</div>
</div>
@endsection
@push('js')
<style>
    .search-ring.hidden
    {
        display: none;
    }
</style>
<script>
function product_stocks_report_print()
{
	var currency = $('[name="currency"]').val();
	var warehouse = $('[name="warehouse"]').val();
	var report_date = $('[name="report_date"]').val();
	
	$.ajax({
		url: '/reports/product_stocks_report_print',
		type: 'GET',
		data: {warehouse:warehouse,currency:currency,report_date:report_date},
		headers: {'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')},
		xhrFields:
		{
			responseType: 'blob'
		},
		success: function(response)
		{
			var blob = new Blob([response]);
			var link = document.createElement('a');
			link.href = window.URL.createObjectURL(blob);
			link.download = "product-stocks-report.pdf";
			link.click();
		},
		error: function(blob)
		{
			console.log(blob);
		}
	});
};


function product_stocks_report_show()
{
	var currency = $('[name="currency"]').val();
	var warehouse = $('[name="warehouse"]').val();
	var report_date = $('[name="report_date"]').val();
		
	$.ajax({
		url: '/reports/product_stocks_report_show',
		type: 'POST',
		data: {warehouse:warehouse,currency:currency,report_date:report_date},
		dataType: 'json',
		headers: {'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')},
		beforeSend: function ()
		{
			$('#report_loader').removeClass('hidden');			
		},
		success:function(response)
		{
			$('[name = "section"]').html('');
			var html = "";
			for(var i = 0; i < response.stocks_table.length; i++)
			{
				html += '<tr>';
				html += '<td>'+response.stocks_table[i].count+'</td>';
				html += '<td>'+response.stocks_table[i].article+'</td>';
				html += '<td>'+response.stocks_table[i].brand+'</td>';
				html += `<td style="width: 40%;"><a href="/products/`+response.stocks_table[i].id+`" target="_blank">`+response.stocks_table[i].name+`</a></td>`;
				html += '<td>'+response.stocks_table[i].quantity+'</td>';
				html += '<td>'+response.stocks_table[i].price+'</td>';
				html += '<td>'+response.stocks_table[i].total+'</td>';
				html += '</tr>';
			}
			$('[name="section"]').append(html);
            //////////footer
			$('[name = "sectionTotal"]').html('');
			var html = "";
				html += '<tr>';
				html += '<td></td>';
				html += '<td></td>';
				html += '<td></td>';
				html += '<td><span class="text-success">Остатки по складу: </span>'+response.warehouse+'<span class="text-success"> В валюте: </span>'+response.currency+'</td>';
				html += '<td>'+response.quantity_total+'</td>';
				html += '<td></td>';
				html += '<td>'+response.stocks_total+'</td>';
				html += '</tr>';
				
			$('[name="sectionTotal"]').append(html);
		},
		complete: function ()
		{
			$('#report_loader').addClass('hidden')
		},
		error: function(xhr, textStatus, thrownError)
		{
			alert(xhr.status);
			alert(thrownError);
		}
	});
};
</script>
@endpush