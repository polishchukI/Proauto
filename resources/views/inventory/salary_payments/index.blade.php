@extends('inventory.layouts.app', ['page' => __('inventory.salary_payments'), 'pageSlug' => 'salary_payments', 'section' => 'salary_management', 'search' => 'salary_payments'])

@section('content')
@include('inventory.alerts.success')
<div class="row">
	<div class="card ">
		<div class="card-header">
			<div class="row">
				<div class="col-8">
					<h4 class="card-title">{{ __('inventory.salary_payments') }}</h4>
				</div>
				<div class="col-4 text-right">
					<a href="{{ route('salary_payments.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
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
						<th>{{ __('inventory.total') }}</th>
						<th><i class="fas fa-print"></i></th>
						<th>{{ __('inventory.delete') }}</th>
					</thead>
					<tbody>
						@foreach ($salary_payments as $salary_payment)
							<tr>
								<td>
									@if (!$salary_payment->finalized_at)
									<span class="text-danger"><i class="far fa-minus-square"></i></span>
									@else
									<span class="text-success"><i class="far fa-check-square"></i></span>
									@endif
								</td>
								<td>{{ $salary_payment->user->name }}</td>
								<td>
									<a href="{{ route('salary_payments.show', ['salary_payment' => $salary_payment]) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
									{{ __('inventory.salary_payments') }} №{{ $salary_payment->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($salary_payment->created_at)) }}
									</a>
								</td>
								<td>{{ $salary_payment->total_amount }} /{{ $salary_payment->currency }}/</td>
								<td>
									<a href="{{ route('salary_payments.print', ['salary_payment' => $salary_payment]) }}" class="btn btn-sm btn-simple btn-print" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.print') }}" target="_blank">
										<i class="fas fa-print"></i>
									</a>
								</td>								
								<td>
									<form action="{{ route('salary_payments.destroy', ['salary_payment' => $salary_payment]) }}" method="post" class="d-inline">
										@csrf
										@method('delete')
										<button type="button" class="btn btn-simple btn-sm btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Вы действительно хотите удалить эту накладную? Все ваши записи будут безвозвратно удалены, если запас продуктов уже закончился, они останутся.') ? this.parentElement.submit() : ''">
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
				{{ $salary_payments->links() }}
			</nav>
		</div>
	</div>
</div>
@endsection
