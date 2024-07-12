@extends('inventory.layouts.app', ['page' => __('inventory.product_stocks_management'), 'pageSlug' => 'product_stocks_report', 'section' => 'reports', 'search' => ''])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h4 class="card-title">{{ __('inventory.product_stocks_management') }}</h4>
                </div>
                <div class="card-body">
					<div class="row">
						<input type="hidden" name="user_id" value="{{ Auth::id() }}">
						<div class="col-lg-2">
							<div class="form-group{{ $errors->has('all_products') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-all_products">{{ __('inventory.all_products') }}</label>
								<select name="all_products" id="input-all_products" class="form-control form-control-alternative{{ $errors->has('all_products') ? ' is-invalid' : '' }}">
									@foreach (['off'=>__('inventory.stocks_only'), 'on'=>__('inventory.all_products'), 'min'=>__('inventory.min_stocks')] as $key=>$value)
									<option value="{{$key}}">{{$value}}</option>
									@endforeach
								</select>
								@include('inventory.alerts.feedback', ['field' => 'all_products'])
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
                            <div class="form-group{{ $errors->has('report_date') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-report_date">{{ __('inventory.report_date') }}</label>
                                <input type="date" name="report_date" id="input-report_date" class="form-control form-control-alternative{{ $errors->has('report_date') ? ' is-invalid' : '' }}" placeholder="report_date">
                                @include('inventory.alerts.feedback', ['field' => 'report_date'])
                            </div>
                        </div>
						<div class="col-lg-2">
							<button type="button" class="btn btn-simple btn-sm btn-info mt-4" OnClick="product_stocks_management_calculate()">{{ __('inventory.report_show') }}</button>
						</div>
						<div class="col-lg-2">
							<button type="button" class="btn btn-simple btn-sm btn-info mt-4" OnClick="product_stocks_management_print()">{{ __('inventory.report_print') }}</button>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive ps">
						<table class="table table-striped">
							<thead class="text-primary">
								<tr>
									<th class="text-center">#</th>
									<th>{{ __('inventory.article') }}</th>
									<th>{{ __('inventory.brand') }}</th>
									<th>{{ __('inventory.name') }}</th>
									<th>{{ __('inventory.stock') }}</th>
									<th>{{ __('inventory.progress') }}</th>
									<th>{{ __('inventory.min_stock') }}</th>
									<th>{{ __('inventory.price') }}</th>
									<th>{{ __('inventory.total') }}</th>
								</tr>
							</thead>
							<tbody name="section"></tbody>
						</table>
					<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('js')
<script>
function product_stocks_management_print()
{
	var currency = $('[name="currency"]').val();
	var warehouse = $('[name="warehouse"]').val();
	var report_date = $('[name="report_date"]').val();
	var all_products = $('[name="all_products"]').val();
	
	$.ajax({
		url: '/product_stocks_management_print',
		type: 'GET',
		data: {warehouse:warehouse,currency:currency,report_date:report_date,all_products:all_products},
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


function product_stocks_management_calculate()
{
	var currency = $('[name="currency"]').val();
	var warehouse = $('[name="warehouse"]').val();
	var report_date = $('[name="report_date"]').val();
	var all_products = $('[name="all_products"]').val();
		
	$.ajax({
		url: '/product_stocks_management_calculate',
		type: 'POST',
		data: {warehouse:warehouse,currency:currency,report_date:report_date,all_products:all_products},
		dataType: 'json',
		headers: {'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')},
		success:function(response)
		{
			$('[name = "section"]').html('');
			var html = "";
			for(var i = 0; i < response.stocks_table.length; i++)
			{
				html += '<tr>';
				html += '<td class="text-center"><div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox"><span class="form-check-sign"></span></label></div></td>';
				html += '<td>'+response.stocks_table[i].article+'</td>';
				html += '<td>'+response.stocks_table[i].brand+'</td>';
				html += `<td style="width: 40%;"><a href="/products/`+response.stocks_table[i].id+`/edit" target="_blank">`+response.stocks_table[i].name+`</a></td>`;
				html += '<td>'+response.stocks_table[i].quantity+'</td>';
				html += `<td><div class="progress-container"><span class="progress-badge `+response.stocks_table[i].style+`">`+response.stocks_table[i].progress+`%</span><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: `+response.stocks_table[i].progress+`%;">`;
				html += `</div></div></div></td>`;
				html += '<td>'+response.stocks_table[i].min_stock+'</td>';
				html += '<td>'+response.stocks_table[i].price+'</td>';
				html += '<td>'+response.stocks_table[i].total+'</td>';
				html += '</tr>';
			}
			$('[name="section"]').append(html);
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