@extends('inventory.layouts.app', ['page' => __('inventory.profit_by_sales'), 'pageSlug' => 'sales_by_products', 'section' => 'reports', 'search' => ''])

@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('inventory.profit_by_sales') }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-1 mt-4">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <div id="report_loader" class="search-ring hidden" style="width:15px;height:15px;"><img src="/images/admincart-search.gif"></div>
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
                    <div class="form-group{{ $errors->has('date_from') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-date_from">{{ __('inventory.date_from') }}</label>
                        <input type="date" name="date_from" id="input-date_from" class="form-control form-control-alternative{{ $errors->has('date_from') ? ' is-invalid' : '' }}" placeholder="date_from">
                        @include('inventory.alerts.feedback', ['field' => 'date_from'])
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group{{ $errors->has('date_to') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-date_to">{{ __('inventory.date_to') }}</label>
                        <input type="date" name="date_to" id="input-date_to" class="form-control form-control-alternative{{ $errors->has('date_to') ? ' is-invalid' : '' }}" placeholder="date_to">
                        @include('inventory.alerts.feedback', ['field' => 'date_to'])
                    </div>
                </div>
                <div class="col-1 mt-4">
                    <button type="button" class="btn btn-sm btn-simple btn-success" OnClick="profit_by_sales_show()">{{ __('inventory.report_show') }}</button>
                </div>
                <div class="col-1 mt-4">
                    <button type="button" class="btn btn-success btn-simple btn-sm" OnClick="profit_by_sales_print()">{{ __('inventory.print') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>{{ __('inventory.article') }}</th>
                    <th>{{ __('inventory.brand') }}</th>
                    <th>{{ __('inventory.name') }}</th>
                    <th>{{ __('inventory.sold_quantity') }}</th>
                    <th>{{ __('inventory.bought_total') }}</th>
                    <th>{{ __('inventory.sold_total') }}</th>
                    <th>{{ __('inventory.profit') }}</th>
                    <th>{{ __('inventory.markup') }}</th>
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
function profit_by_sales_show()
{
	var date_from = $('[name="date_from"]').val();
	var date_to = $('[name="date_to"]').val();
	var currency = $('[name="currency"]').val();
	var warehouse = $('[name="warehouse"]').val();
		
	$.ajax({
		url: '/reports/profit_by_sales_show',
		type: 'POST',
		data: {date_from:date_from,date_to:date_to,currency:currency,warehouse:warehouse},
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
			for(var i = 0; i < response.data.length; i++)
			{
				html += '<tr>';
				html += '<td>'+response.data[i].count+'</td>';
				html += '<td>'+response.data[i].article+'</td>';
				html += '<td>'+response.data[i].brand+'</td>';
                html += `<td><a href="/products/`+response.data[i].id+`" target="_blank">`+response.data[i].name+`</a></td>`;
				html += '<td>'+response.data[i].products_quantity+'</td>';
				html += '<td>'+response.data[i].products_total+'</td>';
				html += '<td>'+response.data[i].products_total_out+'</td>';
				html += '<td>'+response.data[i].profit+'</td>';
				html += '<td>'+response.data[i].markup+'</td>';
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
				html += '<td><span class="text-success">Продажи по складу: </span>'+response.warehouse+'<span class="text-success"> В валюте: </span>'+response.currency+'</td>';
				html += '<td>'+response.quantity_total+'</td>';
				html += '<td>'+response.bought_total+'</td>';
				html += '<td>'+response.sold_total+'</td>';
				html += '<td>'+response.profit_total+'</td>';
				html += '<td>'+response.avgmarkup+'</td>';
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

function profit_by_sales_print()
{
	var date_from = $('[name="date_from"]').val();
	var date_to = $('[name="date_to"]').val();
	var currency = $('[name="currency"]').val();
	var warehouse = $('[name="warehouse"]').val();
	
	$.ajax({
		url: '/reports/profit_by_sales_print',
		type: 'GET',
		data: {date_from:date_from,date_to:date_to,currency:currency,warehouse:warehouse},
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
			link.download = "profit-by-sales-report.pdf";
			link.click();
		},
		error: function(blob)
		{
			console.log(blob);
		}
	});
};
</script>
@endpush