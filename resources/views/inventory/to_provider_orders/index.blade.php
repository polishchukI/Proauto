@extends('inventory.layouts.app', ['page' => __('inventory.to_provider_orders'), 'pageSlug' => 'to_provider_orders', 'section' => 'documents', 'search' => 'to_provider_orders'])

@section('content')
@include('inventory.alerts.success')
<div class="row">
	<div class="col-12">
		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="row">
					<div class="col-8">
						<h4 class="card-title">{{ __('inventory.to_provider_orders') }}</h4>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('to_provider_orders.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
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
							<th>{{ __('inventory.provider') }}</th>
							<th>{{ __('inventory.total') }}</th>							
							<th><i class="fas fa-money-bill-wave"></i></th>
							<th><i class="fas fa-print"></i></th>
							<th><i class="fa fa-download"></i></th>							
							<th>{{ __('inventory.delete') }}</th>
						</thead>
						<tbody>
							@foreach ($to_provider_orders as $to_provider_order)
							<tr>
								<td>
									@if (!$to_provider_order->finalized_at)
									<span class="text-danger"><i class="far fa-minus-square"></i></span>
									@else
									<span class="text-success"><i class="far fa-check-square"></i></span>
									@endif
								</td>
								<td>{{ $to_provider_order->user->name }}</td>
								<td>
									<a href="{{ route('to_provider_orders.show', ['to_provider_order' => $to_provider_order]) }}" data-toggle="tooltip" data-placement="bottom" @if (!$to_provider_order->finalized_at) title="{{ __('inventory.edit') }}"> @else  title="View order"> @endif
										{{ __('inventory.to_provider_order') }} №{{ $to_provider_order->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($to_provider_order->created_at)) }}
									</a>
								</td>
								<td><a href="{{ route('providers.show', $to_provider_order->provider) }}">{{ $to_provider_order->provider->name }}</a></td>
								<td>{{ $to_provider_order->total_amount }} /{{ $to_provider_order->currency }}/</td>
								<td>
									@if($to_provider_order->finalized_at)
									<a href="{{ route('to_provider_orders.pay', $to_provider_order) }}" class="btn btn-sm btn-simple btn-pay disabled" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.pay') }}" target="_blank">
										<i class="fas fa-dollar-sign"></i>
									</a>
									@endif
								</td>
								<td>
									<a href="{{ route('to_provider_orders.print', $to_provider_order) }}" class="btn btn-sm btn-simple btn-print" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.print') }}" target="_blank">
										<i class="fas fa-print"></i>
									</a>
								</td>
								<td>
									<button type="button" class="btn btn-sm btn-simple btn-receipt @if(!$to_provider_order->finalized_at) disabled @endif" OnClick="to_provider_order_receipt('{{$to_provider_order->id}}')"><i class="fas fa-plus"></i></button>									
								</td>		
								
								<td>
									<form action="{{ route('to_provider_orders.destroy', ['to_provider_order' => $to_provider_order]) }}" method="post" class="d-inline">
										@csrf
										@method('delete')
										<button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this to_provider_order? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
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
				<nav class="d-flex justify-content-end" aria-label="...">
					{{ $to_provider_orders->links() }}
				</nav>
			</div>
		</div>
	</div>
</div>
@endsection
