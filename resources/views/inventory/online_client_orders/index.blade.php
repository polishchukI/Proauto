@extends('inventory.layouts.app', ['page' => __('inventory.online_client_orders'), 'pageSlug' => 'online_client_orders', 'section' => 'documents', 'search' => 'online_client_orders'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
@include('inventory.alerts.info')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-8">
						<h4 class="card-title">{{ __('inventory.online_client_orders') }}</h4>
					</div>
					<div class="col-4 text-right"></div>
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
							<th><i class="fas fa-money-bill-wave"></i></th>
							<th><i class="fas fa-print"></i></th>
							<th><i class="fas fa-file-download"></i></th>
							<th>{{ __('inventory.delete') }}</th>
						</thead>
						<tbody>
							@foreach ($online_client_orders as $online_client_order)
							<tr>
								<td>
									@if (!$online_client_order->finalized_at)
										<span class="text-danger"><i class="far fa-minus-square"></i></span>
									@else
										<span class="text-success"><i class="far fa-check-square"></i></span>
									@endif
								</td>
								<td>{{ $online_client_order->client->email }}</td>
								<td>
									<a href="{{ route('online_client_orders.show', ['online_client_order' => $online_client_order]) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
										{{ __('inventory.online_client_order') }} №{{ $online_client_order->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($online_client_order->created_at)) }}
									</a>			
								</td>
								<td><a href="{{ route('clients.show', $online_client_order->client) }}">{{ $online_client_order->client->name }}</a></td>
								<td>{{ $online_client_order->subtotal }} /{{ $online_client_order->currency }}/
								<br>{{ $online_client_order->total }} /{{ $online_client_order->currency }}/</td>
								<td>
									@if ($online_client_order->finalized_at)
									<a href="{{ route('online_client_orders.pay', $online_client_order) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.pay') }}" target="_blank">
										<i class="fas fa-dollar-sign" aria-hidden="true"></i>
									</a>
									@endif
								</td>
								<td>
									<a href="{{ route('online_client_orders.print', $online_client_order) }}" class="btn btn-simple btn-sm btn-print" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.print') }}" target="_blank">
										<i class="fas fa-print"></i>
									</a>
								</td>
								<td>									
									<a href="{{ route('online_client_orders.client_order', ['online_client_order' => $online_client_order]) }}" class="btn btn-simple btn-sm @if($online_client_order->finalized_at) disabled @endif" data-toggle="tooltip" data-placement="bottom" title="Client order" target="_blank">
										<i class="fas fa-file-download"></i>
									</a>
								</td>
								<td>
									<form action="{{ route('online_client_orders.destroy', ['online_client_order' => $online_client_order]) }}" method="post" class="d-inline">
										@csrf
										@method('delete')
										<button type="button" class="btn btn-simple btn-sm btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this online_client_order? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
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
				<nav class="d-flex justify-content-end" aria-label="...">
					{{ $online_client_orders->links() }}
				</nav>
			</div>
		</div>
	</div>
</div>
@endsection
