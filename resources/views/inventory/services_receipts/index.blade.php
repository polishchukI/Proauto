@extends('inventory.layouts.app', ['page' => __('inventory.services_receipts'), 'pageSlug' => 'services_receipts', 'section' => 'services', 'search' => 'services_receipts'])

@section('content')
@include('inventory.alerts.success')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-8">
						<h4 class="card-title">{{ __('inventory.services_receipts') }}</h4>
					</div>
					<div class="col-4 text-right"><a href="{{ route('services_receipts.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a></div>
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
							<th>{{ __('inventory.delete') }}</th>
						</thead>
						<tbody>
							@foreach ($services_receipts as $services_receipt)
								<tr>
									<td>
										@if (!$services_receipt->finalized_at)
											<span class="text-danger"><i class="far fa-minus-square"></i></span>
										@else
											<span class="text-success"><i class="far fa-check-square"></i></span>
										@endif
									</td>
									<td>{{ $services_receipt->user->name }}</td>
									<td>
										<a href="{{ route('services_receipts.show', ['services_receipt' => $services_receipt]) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
											{{ __('inventory.services_receipt') }} №{{ $services_receipt->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($services_receipt->created_at)) }}
										</a>
									</td>
									<td><a href="{{ route('providers.show', $services_receipt->provider) }}">{{ $services_receipt->provider->name }}</td>
									<td>{{ $services_receipt->total_amount }} /{{ $services_receipt->currency }}/</td>
									<td>
										@if ($services_receipt->finalized_at)
											@if(($services_receipt->total_amount + $services_receipt->transactions->sum('amount'))==0)
												<span class="text-success"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
											@else
											<a href="{{ route('services_receipts.pay', $services_receipt) }}" data-toggle="tooltip" class="btn btn-simple bnt-sm btn-pay" data-placement="bottom" title="{{$services_receipt->total_amount + $services_receipt->transactions->sum('amount')}}" target="_blank">
												<i class="fas fa-dollar-sign" aria-hidden="true"></i>
											</a>
											@endif
										@else
											<span>{{-- $services_receipt->total_amount + $services_receipt->transactions->sum('amount') --}}</span>
										@endif
									</td>
									<td>
										<a href="{{ route('services_receipts.print', $services_receipt) }}" class="btn btn-sm btn-simple btn-print" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.print') }}" target="_blank">
											<i class="fas fa-print"></i>
										</a>
									</td>
									<td>
										<form action="{{ route('services_receipts.destroy', $services_receipt) }}" method="post" class="d-inline">
											@csrf
											@method('delete')
											<button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Вы действительно хотите удалить эту накладную? Все ваши записи будут безвозвратно удалены, если запас продуктов уже закончился, они останутся.') ? this.parentElement.submit() : ''">
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
			<div class="card-footer">
				<nav class="d-flex justify-content-end" aria-label="...">
					{{ $services_receipts->links() }}
				</nav>
			</div>
		</div>
	</div>
</div>
@endsection
