@extends('inventory.layouts.app', ['page' => __('inventory.receipts'), 'pageSlug' => 'receipts', 'section' => 'documents', 'search' => 'receipts'])

@section('content')
@include('inventory.alerts.success')
<div class="row">
    <div class="col-12">
		<div class="card ">
			<div class="card-header">
				<div class="row">
					<div class="col-8">{{ $receipts->links() }}</div>
					<div class="col-2">
						<form method="get" action="/receipts" autocomplete="off">
							<input type="text" name="search" placeholder="{{ __('inventory.search') }}" value="{{ request('search') }}" class="form-control-sm" />
							<button class="btn btn-simple btn-sm btn-selector" type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<div class="col-2 text-right">
						<a href="{{ route('receipts.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
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
							<th>{{ __('inventory.delete') }}</th>
						</thead>
						<tbody>
							@foreach ($receipts as $receipt)
								<tr>
									<td>
										@if (!$receipt->finalized_at)
											<span class="text-danger"><i class="far fa-minus-square"></i></span>
										@else
											<span class="text-success"><i class="far fa-check-square"></i></span>
										@endif
									</td>
									<td>{{ $receipt->user->name }}</td>
									<td>
										<a href="{{ route('receipts.show', ['receipt' => $receipt]) }}" data-toggle="tooltip" data-placement="bottom" title="Show Receipt">
											{{ __('inventory.receipt') }} №{{ $receipt->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($receipt->created_at)) }}
										</a>
									</td>
									<td><a href="{{ route('providers.show', $receipt->provider) }}">{{ $receipt->provider->name }}</td>
									<td>{{ $receipt->total_amount }} /{{ $receipt->currency }}/</td>
									<td>
									@if ($receipt->finalized_at)
										@if(($receipt->total_amount + $receipt->transactions->sum('amount'))==0)
											<span class="text-success"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
										@else
										<a href="{{ route('receipts.pay', $receipt) }}" data-toggle="tooltip" class="btn btn-simple bnt-sm btn-pay" data-placement="bottom" title="{{$receipt->total_amount + $receipt->transactions->sum('amount')}}" target="_blank">
											<span class="text-danger"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
										</a>
										@endif
										@else
											<span>{{-- $receipt->total_amount + $receipt->transactions->sum('amount') --}}</span>
										@endif
									</td>
									<td>
										<a href="{{ route('receipts.print', $receipt) }}" data-toggle="tooltip" class="btn btn-sm btn-simple btn-print" data-placement="bottom" title="{{ __('inventory.print') }}" target="_blank">
										<i class="fas fa-print"></i>
										</a>
									</td>
									<td>
										<form action="{{ route('receipts.destroy', ['receipt' => $receipt]) }}" method="post" class="d-inline">
											@csrf
											@method('delete')
											<button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Вы действительно хотите удалить эту накладную? Все ваши записи будут безвозвратно удалены, если запас продуктов уже закончился, они останутся.') ? this.parentElement.submit() : ''">
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
			<div class="card-footer">
				<div class="row">
						<div class="col-8">{{ $receipts->links() }}</div>
						<div class="col-4 text-right"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
