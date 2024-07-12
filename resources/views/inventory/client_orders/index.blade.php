@extends('inventory.layouts.app', ['page' => __('inventory.client_orders'), 'pageSlug' => 'client_orders', 'section' => 'documents', 'search' => 'client_orders'])

@section('content')
@include('inventory.alerts.success')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-8">
						{{ $client_orders->links() }}
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('client_orders.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
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
							<th><i class="fas fa-money-bill-wave"></i></th>
							<th><i class="fas fa-print"></i></th>
							<th><i class="fas fa-file-upload"></i></th>
							<th><i class="fas fa-file-invoice"></i></th>							
							<th>{{ __('inventory.delete') }}</th>
						</thead>
						<tbody>
							@foreach ($client_orders as $client_order)
							<tr>
								<td>
									@if (!$client_order->finalized_at)
										<span class="text-danger"><i class="far fa-minus-square"></i></span>
									@else
										<span class="text-success"><i class="far fa-check-square"></i></span>
									@endif
								</td>
								<td>{{ $client_order->user->name }}</td>
								<td>
									<a href="{{ route('client_orders.show', ['client_order' => $client_order]) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
										{{ __('inventory.client_order') }} №{{ $client_order->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($client_order->created_at)) }}
									</a>
								</td>
								<td><a href="{{ route('clients.show', $client_order->client) }}">{{ $client_order->client->name }}</a></td>
								<td>{{ $client_order->total_amount }} /{{ $client_order->currency }}/</td>
								<td>
									@if ($client_order->finalized_at)
									<a href="{{ route('client_orders.pay', $client_order) }}" class="btn btn-simple btn-sm btn-pay disabled" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.pay') }}" target="_blank">
										<i class="fas fa-dollar-sign"></i>
									</a>
									@endif
								</td>
								<td>
									<a href="{{ route('client_orders.print', $client_order) }}" class="btn btn-print btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.print') }}" target="_blank">
										<i class="fas fa-print"></i>
									</a>
								</td>
								<td>
									@if ($client_order->finalized_at)
									<a href="{{ route('client_orders.to_provider', $client_order) }}" class="btn btn-simple btn-to-provider-order btn-sm" data-toggle="tooltip" data-placement="bottom" title="Order to provider" target="_blank">
										<i class="fas fa-file-upload"></i>
									</a>
									@endif
								</td>
								<td>
									@if ($client_order->finalized_at)
										<a href="#" onclick="client_order_sale('{{$client_order->id}}');" class="btn btn-sale btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="Sale">
										<i class="fas fa-file-invoice"></i>
										</a>
									@endif
								</td>
								<td>
									<form action="{{ route('client_orders.destroy', $client_order) }}" method="post" class="d-inline">
										@csrf
										@method('delete')
										<button type="button" class="btn btn-delete btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this client_order? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
											<i class="fas fa-times"></i>
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
				{{ $client_orders->links() }}
			</div>
		</div>
	</div>
</div>
@endsection
