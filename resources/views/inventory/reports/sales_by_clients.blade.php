@extends('inventory.layouts.app', ['page' => __('inventory.sales_by_clients'), 'pageSlug' => 'sales_by_products', 'section' => 'reports', 'search' => ''])

@section('content')<div class="row">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('inventory.sales_by_clients') }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
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
                <div class="col-lg-2">
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
                <div class="col-lg-2">
                    <div class="form-group{{ $errors->has('date_from') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-date_from">{{ __('inventory.date_from') }}</label>
                        <input type="date" name="date_from" id="input-date_from" class="form-control form-control-alternative{{ $errors->has('date_from') ? ' is-invalid' : '' }}" placeholder="date_from">
                        @include('inventory.alerts.feedback', ['field' => 'date_from'])
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group{{ $errors->has('date_to') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-date_to">{{ __('inventory.date_to') }}</label>
                        <input type="date" name="date_to" id="input-date_to" class="form-control form-control-alternative{{ $errors->has('date_to') ? ' is-invalid' : '' }}" placeholder="date_to">
                        @include('inventory.alerts.feedback', ['field' => 'date_to'])
                    </div>
                </div>
                <div class="col-lg-2 mt-4">
                    <button type="button" class="btn btn-sm btn-simple btn-success" OnClick="sales_by_clients_show()">{{ __('inventory.report_show') }}</button>
                </div>
                <div class="col-lg-2 mt-4">
							<button type="button" class="btn btn-success btn-simple btn-sm" OnClick="sales_by_clients_print()">{{ __('inventory.report_print') }}</button>
						</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>{{ __('inventory.client') }}</th>
                        <th>{{ __('inventory.quantity') }}</th>
                        <th>{{ __('inventory.total_amount') }}</th>
                        <th>{{ __('inventory.discount_amount') }}</th>
                    </thead>
                    <tbody name="section"></tbody>
                    <tfoot name="sectionTotal"></tfoot>
                    <tfoot name="warehouseName"></tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
function sales_by_clients_show()
{
	var date_from = $('[name="date_from"]').val();
	var date_to = $('[name="date_to"]').val();
	var currency = $('[name="currency"]').val();
	var warehouse = $('[name="warehouse"]').val();
		
	$.ajax({
		url: '/reports/sales_by_clients_show',
		type: 'POST',
		data: {date_from:date_from,date_to:date_to,currency:currency,warehouse:warehouse},
		dataType: 'json',
		headers: {'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')},
		success:function(response)
		{
			$('[name = "section"]').html('');
			var html = "";
			for(var i = 0; i < response.data.length; i++)
			{
                html += '<tr class="collapse'+response.data[i].client_id+'" data-toggle="collapse" data-target="#collapse'+response.data[i].client_id+'">';
                    html += '<td>'+(i+1)+'</td>';
                    html += '<td><a href="/clients/'+response.data[i].client_id+'" target="_blank">'+response.data[i].name+'</a></td>';
                    html += '<td>'+response.data[i].salesCount+'</td>';
                    html += '<td>'+response.data[i].total_amount+'</td>';
                    html += '<td>'+response.data[i].discount_amount+'</td>';
                    html += '<td class="table-elipse" data-toggle="collapse" data-target="#collapse'+response.data[i].client_id+'"><i class="fas fa-expand-arrows-alt"></i></td>';
                html += '</tr>';

                html += '<tr class="hide-table-padding">';
                    html += '<td></td>';
                    html += '<td colspan="5">';
                        html += '<div id="collapse'+response.data[i].client_id+'" class="collapse in p-3">';
                        for(var k = 0; k < response.data[i].saleDocuments.length; k++)
                        {
                            html += '<div class="row">';
                                html += '<div class="col-4"><a href="/sales/'+response.data[i].saleDocuments[k].id+'" target="_blank">Sale #'+response.data[i].saleDocuments[k].id+' from '+response.data[i].saleDocuments[k].finalized_at+'</a></div>';
                                if(response.data[i].saleDocuments[k].comment != null)
                                {
                                    html += '<div class="col-4">'+response.data[i].saleDocuments[k].comment+'</div>';
                                }
                                else
                                {
                                    html += '<div class="col-4"></div>';

                                }
                                html += '<div class="col-2">'+response.data[i].saleDocuments[k].total_amount+'</div>';
                                if(response.data[i].saleDocuments[k].discount_amount != null)
                                {
                                    html += '<div class="col-2">'+response.data[i].saleDocuments[k].discount_amount+'</div>';
                                }                               
                                else
                                {
                                    html += '<div class="col-2"></div>';
                                }
                            html += '</div>';
                        }
                        html += '</div>';
                    html += '</td>';
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
				html += '</tr>';
				
			$('[name="sectionTotal"]').append(html);
		}
	});
};

function sales_by_clients_print()
{
	var date_from = $('[name="date_from"]').val();
	var date_to = $('[name="date_to"]').val();
	var currency = $('[name="currency"]').val();
	var warehouse = $('[name="warehouse"]').val();
	
	$.ajax({
		url: '/reports/sales_by_clients_print',
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