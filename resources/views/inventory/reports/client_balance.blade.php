@extends('inventory.layouts.app', ['page' => 'Product Stocks Report', 'pageSlug' => 'product_stocks', 'section' => 'reports', 'search' => ''])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h4 class="card-title">Product stocks by Quantity</h4>
                </div>
                <div class="card-body">
					<div class="row">
						<div class="col-lg-3">
							<input type="hidden" name="user_id" value="{{ Auth::id() }}">
						</div>
                        <div class="col-lg-3">
                            <div class="form-group{{ $errors->has('date_from') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-date_from">date_from</label>
                                <input type="date" name="date_from" id="input-date_from" class="form-control form-control-alternative{{ $errors->has('date_from') ? ' is-invalid' : '' }}" placeholder="date_from">
                                @include('inventory.alerts.feedback', ['field' => 'date_from'])
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group{{ $errors->has('date_to') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-date_to">date_to</label>
                                <input type="date" name="date_to" id="input-date_to" class="form-control form-control-alternative{{ $errors->has('date_to') ? ' is-invalid' : '' }}" placeholder="date_to">
                                @include('inventory.alerts.feedback', ['field' => 'date_to'])
                            </div>
                        </div>
						<div class="col-lg-3">
							<button type="button" class="btn btn-sm btn-primary" OnClick="product_stocks_show()">Report show</button>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>№</th>
                            <th>Article</th>
                            <th>Brand</th>
                            <th>Name</th>
                            <th>quantity</th>
                        </thead>
						<tbody name="section"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
function product_stocks_show()
{
	var date_from = $('[name="date_from"]').val();
	var date_to = $('[name="date_to"]').val();
		
	$.ajax({
		url: '/reports/product_stocks_show',
		type: 'POST',
		data: {date_from:date_from,date_to:date_to},
		dataType: 'json',
		headers: {'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')},
		success:function(data)
		{
			$('[name = "section"]').html('');
			var html = "";
			for(var i = 0; i < data.length; i++)
			{
				html += '<tr>';
				html += '<td>'+data[i].count+'</td>';
				html += '<td>'+data[i].article+'</td>';
				html += '<td>'+data[i].brand+'</td>';
				html += '<td>'+data[i].name+'</td>';
				html += '<td>'+data[i].quantity+'</td>';
				html += '</td>';
			}
			$('[name="section"]').append(html)
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