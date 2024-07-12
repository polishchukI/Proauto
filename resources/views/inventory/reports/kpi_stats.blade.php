@extends('inventory.layouts.app', ['page' => __('inventory.kpi_stats_report'), 'pageSlug' => 'kpi_stats', 'section' => 'reports', 'search' => ''])

@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('inventory.kpi_stats_report') }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                </div>
                <div class="col-lg-3">
                    <div class="form-group{{ $errors->has('date_from') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-date_from">{{ __('inventory.date_from') }}</label>
                        <input type="date" name="date_from" id="input-date_from" class="form-control form-control-alternative{{ $errors->has('date_from') ? ' is-invalid' : '' }}" placeholder="date_from">
                        @include('inventory.alerts.feedback', ['field' => 'date_from'])
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group{{ $errors->has('date_to') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-date_to">{{ __('inventory.date_to') }}</label>
                        <input type="date" name="date_to" id="input-date_to" class="form-control form-control-alternative{{ $errors->has('date_to') ? ' is-invalid' : '' }}" placeholder="date_to">
                        @include('inventory.alerts.feedback', ['field' => 'date_to'])
                    </div>
                </div>
                <div class="col-lg-3 mt-4">
                    <button type="button" class="btn btn-sm btn-simple btn-success" OnClick="kpi_stats_show()">{{ __('inventory.report_show') }}</button>
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
                    <th>№</th>
                    <th>KPI name</th>
                    <th>Value</th>
                </thead>
                <tbody name="section"></tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
function kpi_stats_show()
{
	var date_from = $('[name="date_from"]').val();
	var date_to = $('[name="date_to"]').val();
		
	$.ajax({
		url: '/reports/kpi_stats_show',
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
				html += '<td>'+data[i].kpi_name+'</td>';
				html += '<td>'+data[i].kpi_value+'</td>';
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