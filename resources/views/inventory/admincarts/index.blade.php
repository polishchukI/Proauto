@extends('inventory.layouts.app', ['page' => __('inventory.admincarts'), 'pageSlug' => 'admincarts', 'section' => 'admincarts', 'search' => 'admincarts'])

@section('content')
@include('inventory.alerts.success')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-8">
						{{ $admincarts->links() }}
					</div>
					<div class="col-2">
						<form method="get" action="/admincarts" autocomplete="off">
							<input type="text" name="search" placeholder="{{ __('inventory.search') }}" value="{{ request('search') }}" class="form-control-sm" />
							<button class="btn btn-simple btn-sm btn-selector" type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<div class="col-2 text-right">
						<a href="{{ route('admincarts.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="">
					<table class="table">
						<thead>
							<th><i class="fas fa-flag-checkered"></i></th>
							<th>{{ __('inventory.user') }}</th>
							<th>{{ __('inventory.document') }}</th>
							<th>{{ __('inventory.client') }}</th>
							<th>{{ __('inventory.total') }}</th>
							<th><i class="fas fa-print"></i></th>
							<th><i class="fas fa-file-upload"></i></th>
							<th><i class="fas fa-file-invoice"></i></th>
							<th>{{ __('inventory.delete') }}</th>
						</thead>
						<tbody>
							@foreach ($admincarts as $admincart)
							<tr>
								<td>
									@if (!$admincart->finalized_at)
										<span class="text-danger"><i class="far fa-minus-square"></i></span>
									@else
										<span class="text-success"><i class="far fa-check-square"></i></span>
									@endif
								</td>
								<td>{{ $admincart->user->name }}</td>
								<td>
									<a href="{{ route('admincarts.show', ['admincart' => $admincart]) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
										{{ __('inventory.admincart') }} №{{ $admincart->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($admincart->created_at)) }}
									</a>
								</td>
								<td><a href="{{ route('clients.show', $admincart->client) }}">{{ $admincart->client->name }}</a>
								@if ($admincart->comment)
									<br><span class="text-muted">{{ $admincart->comment }}</span>
									@endif	
								</td>
								<td>{{ $admincart->products->sum('total_amount') }} /{{ $admincart->currency}}/</td>
								<td>
									<a href="{{ route('admincarts.print', $admincart) }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-sm btn-simple btn-print"  title="{{ __('inventory.print') }}" target="_blank">
										<i class="fas fa-print"></i>
									</a>
								</td>
								<td>
									<form method="post" action="{{ route('client_orders.store') }}">
										@csrf
										<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
										<input type="hidden" name="client_id" value="{{ $admincart->client_id }}">
										<input type="hidden" name="warehouse_id" value="{{ auth()->user()->default_warehouse_id }}">
										<input type="hidden" name="currency" value="{{ auth()->user()->default_currency }}">
										<input type="hidden" name="reference_id" value="{{ $admincart->id }}">
										<input type="hidden" name="reference_type" value="admincart">
										<button type="submit" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.client_order') }}" class="btn btn-simple btn-sm btn-sale @if(!$admincart->finalized_at) disabled @endif"><i class="fas fa-file-download"></i></button>
									</form>
								</td>
								<td>
									<form method="post" action="{{ route('sales.store') }}">
										@csrf
										<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
										<input type="hidden" name="client_id" value="{{ $admincart->client_id }}">
										<input type="hidden" name="warehouse_id" value="{{ auth()->user()->default_warehouse_id }}">
										<input type="hidden" name="currency" value="{{ auth()->user()->default_currency }}">
										<input type="hidden" name="reference_id" value="{{ $admincart->id }}">
										<input type="hidden" name="reference_type" value="admincart">
										<button type="submit" title="{{ __('inventory.sale') }}" class="btn btn-simple btn-sm btn-sale @if(!$admincart->finalized_at) disabled @endif"><i class="fas fa-file-invoice"></i></button>
									</form>
								</td>
								<td>
									<form action="{{ route('admincarts.destroy', ['admincart' => $admincart]) }}" method="post" class="d-inline">
										@csrf
										@method('delete')
										<button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('{{ __('inventory.document_confirm_delete') }}') ? this.parentElement.submit() : ''">
											<i class="fas fa-times" aria-hidden="true"></i>
										</button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer py-4">
				<div class="row">
						<div class="col-8">
						{{ $admincarts->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
