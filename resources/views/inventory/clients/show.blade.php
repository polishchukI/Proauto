@extends('inventory.layouts.app', ['page' => __('inventory.client_information'), 'pageSlug' => 'clients', 'section' => 'clients', 'search' => 'clients'])

@section('content')
@include('inventory.alerts.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-8"><h4 class="card-title">{{ __('inventory.client_information') }}</h4></div>
						<div class="col-4 text-right">
							<a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-simple btn-selector" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
								<i class="fas fa-edit"></i>
							</a>							
							<button type="button" class="btn btn-sm btn-simple btn-selector @if($client->created_at) disabled @endif" OnClick="renew_client_registration_date('{{$client->id}}')"><i class="fas fa-sync-alt"></i></button>
							<button type="button" class="btn btn-sm btn-simple btn-telegram @if($client->notified_at) disabled @endif" OnClick="client_notified('{{$client->id}}')"><i class="fab fa-telegram-plane"></i></button>
							<a href="{{ route('clients.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
						</div>
					</div>
				</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th></th>
                            <th>{{ __('inventory.client_name') }}</th>
                            <th>{{ __('inventory.phone') }}</th>
                            <th>{{ __('inventory.email') }}</th>
							<th>{{ __('inventory.settlements') }}</th>
                            <th>{{ __('inventory.balance') }}</th>
                            <th>{{ __('inventory.purchases') }}</th>
                            <th>{{ __('inventory.total_payments') }}</th>
                            <th>{{ __('inventory.last_purchase') }}</th>
                            <th>{{ __('inventory.notified') }}</th>
                            <th>{{ __('inventory.created_renewed') }}</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->email }}</td>
								<td>
                                    @if($client->settlements->sum('total_amount') > 0)
                                    <span class="text-success"><i class="fas fa-dollar-sign" aria-hidden="true">{{ $client->settlements->sum('total_amount') }}</i></span>
                                    @elseif($client->settlements->sum('total_amount') < 0)
                                    <span class="text-danger"><i class="fas fa-dollar-sign" aria-hidden="true">{{ $client->settlements->sum('total_amount') }}</i></span>
                                    @else
                                    <span><i class="fas fa-dollar-sign" aria-hidden="true">{{ $client->settlements->sum('total_amount') }}</i></span>
                                    @endif
                                </td>
                                <td>
                                    @if(($client->sales->sum('total_amount') - $client->transactions->sum('amount') - $client->returns_from_the_client->sum('total_amount')) > 0)
                                        <span class="text-danger">{{ number_format($client->sales->sum('total_amount') - $client->transactions->sum('amount') - $client->returns_from_the_client->sum('total_amount'),2)}}</span>
                                    @elseif(($client->sales->sum('total_amount') - $client->transactions->sum('amount') - $client->returns_from_the_client->sum('total_amount')) > 0)
                                        <span class="text-seccess">{{ number_format($client->sales->sum('total_amount') - $client->transactions->sum('amount') - $client->returns_from_the_client->sum('total_amount'),2)}}</span>
                                    @else
                                        {{ number_format($client->sales->sum('total_amount') - $client->transactions->sum('amount') - $client->returns_from_the_client->sum('total_amount'),2)}}
                                    @endif
                                </td>
                                <td>{{ $client->sales->count() }}</td>
                                <td>{{ $client->transactions->sum('amount') }}</td>
								<td>
									{{ ($client->sales->count()>0) ? date('d-m-y', strtotime($client->sales->reverse()->first()->finalized_at)) :  __('inventory.no_sales') }}
								</td>
                                <td>
									@if (!$client->notified_at)
									<span class="text-danger"><i class="far fa-minus-square"></i></span>
									@else
									<span class="text-success"><i class="far fa-check-square"></i></span>
									@endif
								</td>
                                <td>{{ $client->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-8"><h4 class="card-title">{{ __('inventory.phones') }}</h4></div>
						<div class="col-4 text-right"></div>
					</div>
				</div>
                <div class="card-body">
					<table class="table tablesorter " id="">
						<thead class=" text-primary">

						<tr>
								<th>{{__('inventory.phone')}}</th>
								<th><i class="fab fa-telegram"></i></th>
								<th><i class="fab fa-viber"></i></th>
								<th><i class="fab fa-whatsapp"></i></th>
								<th><i class="far fa-check-square"></i></th>
								<th>{{__('inventory.comment')}}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($client->phones as $phone)
							<tr>
								<td>{{ $phone->phone }}</td>
								<td>
									@if (!$phone->telegram)
										<span class="text-danger"><i class="far fa-minus-square"></i></span>
									@else
										<span class="text-success"><i class="far fa-check-square"></i></span>
									@endif
								</td>
								<td>
									@if (!$phone->viber)
										<span class="text-danger"><i class="far fa-minus-square"></i></span>
									@else
										<span class="text-success"><i class="far fa-check-square"></i></span>
									@endif
								</td>
								<td>
									@if (!$phone->whatsapp)
										<span class="text-danger"><i class="far fa-minus-square"></i></span>
									@else
										<span class="text-success"><i class="far fa-check-square"></i></span>
									@endif
								</td>
								<td>
									@if (!$phone->default)
										<span class="text-danger"><i class="far fa-minus-square"></i></span>
									@else
										<span class="text-success"><i class="far fa-check-square"></i></span>
									@endif
								</td>
								<td>{{ $phone->comment }}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-8"><h4 class="card-title">{{ __('inventory.autos') }}</h4></div>
						<div class="col-4 text-right"></div>
					</div>
				</div>
                <div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>{{ __('inventory.group') }}</th>
								<th>{{ __('inventory.model') }}</th>
								<th>{{ __('inventory.auto') }}</th>
								<th>{{ __('inventory.car_body') }}</th>
								<th>{{ __('inventory.color') }}</th>
								<th>{{ __('inventory.plate') }}</th>
								<th>{{ __('inventory.engine') }}</th>
								<th>{{ __('inventory.engine_capacity') }}</th>
								<th>{{ __('inventory.fuel') }}</th>
								<th>{{ __('inventory.year') }}</th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($client->automobiles as $auto)
								<tr>
									<td>{{ $auto->group }}</td>
									<td>{{ $auto->model_id }}</td>
									<td>
										<b>{{ $auto->name }}</b>
										</br>{{ $auto->vin }}
									</td>
									<td>{{ $auto->body }}</td>
									<td>{{ $auto->color }}</td>
									<td>{{ $auto->plate }}</td>
									<td>{{ $auto->engine }}</td>
									<td>{{ $auto->ccm }}</td>
									<td>{{ $auto->fuel }}</td>
									<td>{{ $auto->year }}</td>
									<td class="td-actions">
										<a href="{{ route('client_autos.show', $auto->id) }}" class="btn btn-sm btn-simple btn-service-parts"><i class='fa fa-cogs'></i></a>
									</td>
									<td>
										<form method="post" action="{{ route('admincarts.store') }}">
											@csrf
											<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
											<input type="hidden" name="client_id" value="{{ $client->id }}">
											<input type="hidden" name="client_auto_id" value="{{ $auto->id }}">
											<input type="hidden" name="warehouse_id" value="{{ auth()->user()->default_warehouse_id }}">
											<input type="hidden" name="currency" value="{{ auth()->user()->default_currency }}">
											<button type="submit" class="btn btn-simple btn-sm btn-selector"><i class="fas fa-cart-plus"></i></button>
										</form>
									</td>
									<td class="td-actions">
										<a href="{{ route('client_autos.edit', $auto->id) }}" class="btn btn-sm btn-simple btn-selector" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
											<i class="fas fa-edit"></i>
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<!-- Nav tabs -->
					<ul class="nav nav-pills nav-pills-primary nav-pills-icons">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#latest_sales">{{ __('inventory.sales') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#latest_returns_from_the_client">{{ __('inventory.returns_from_the_client') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#client_carts">{{ __('inventory.admincarts') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#client_orders">{{ __('inventory.client_orders') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#online_client_orders">{{ __('inventory.online_client_orders') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#latest_transactions">{{ __('inventory.transactions') }}</a></li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<!-- <latest_sales> -->
						<div class="tab-pane active" id="latest_sales">
							<div class="row">
							<div class="col-10"></div>
								<div class="col-2 text-right">
									<form method="post" action="{{ route('sales.store') }}">
										@csrf
										<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
										<input type="hidden" name="client_id" value="{{ $client->id }}">
										<input type="hidden" name="warehouse_id" value="{{ auth()->user()->default_warehouse_id }}">
										<input type="hidden" name="currency" value="{{ auth()->user()->default_currency }}">
										<button type="submit" class="btn btn-simple btn-sm btn-sale"><i class="fas fa-plus"></i></button>
									</form>
								</div>
							</div>
							<table class="table">
								<thead>
									<th></th>
									<th>{{ __('inventory.sale') }}</th>
									<th>{{ __('inventory.products') }}</th>
									<th>{{ __('inventory.quantity') }}</th>
									<th>{{ __('inventory.total_amount') }}</th>
								</thead>
								<tbody>
									@foreach ($client->sales->reverse()->take(25) as $sale)
										<tr>
											<td>
												@if (!$sale->finalized_at)
													<span class="text-danger"><i class="far fa-minus-square"></i></span>
												@else
													<span class="text-success"><i class="far fa-check-square"></i></span>
												@endif
											</td>
											<td><a href="{{ route('sales.show', $sale) }}">{{ __('inventory.sale') }} №{{ $sale->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($sale->created_at)) }}</a></td>
											<td>{{ $sale->products->count() }}</td>
											<td>{{ $sale->products->sum('quantity') }}</td>
											<td>{{ number_format($sale->products->sum('total_amount'),2) }}</td>
										</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>{{ number_format($client->sales->sum('total_amount'),2) }}</td>
									</tr>
								</tfoot>
							</table>
						</div>
						<!-- <latest_returns_from_the_client> -->
						<div class="tab-pane" id="latest_returns_from_the_client">
							<table class="table">
								<thead>
									<th></th>
									<th>{{ __('inventory.return_from_the_client') }}</th>
									<th>{{ __('inventory.products') }}</th>
									<th>{{ __('inventory.quantity') }}</th>
									<th>{{ __('inventory.total_amount') }}</th>
								</thead>
								<tbody>
									@foreach ($client->returns_from_the_client->reverse()->take(25) as $return_from_the_client)
										<tr>
											<td>
												@if (!$return_from_the_client->finalized_at)
													<span class="text-danger"><i class="far fa-minus-square"></i></span>
												@else
													<span class="text-success"><i class="far fa-check-square"></i></span>
												@endif
											</td>
											<td><a href="{{ route('returns_from_the_client.show', $return_from_the_client) }}">{{ __('inventory.return_from_the_client') }} №{{ $return_from_the_client->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($return_from_the_client->created_at)) }}</a></td>
											<td>{{ $return_from_the_client->products->count() }}</td>
											<td>{{ $return_from_the_client->products->sum('quantity') }}</td>
											<td>{{ $return_from_the_client->total_amount }}</td>
										</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>{{ number_format($client->returns_from_the_client->sum('total_amount'),2) }}</td>
									</tr>
								</tfoot>
							</table>
						</div>
						<!-- <client_carts> -->
						<div class="tab-pane fade" id="client_carts">
							<div class="row">
								<div class="col-10"></div>
								<div class="col-2 text-right"></div>
							</div>
							<table class="table">
								<thead>
									<th></th>
									<th>{{ __('inventory.admincart') }}</th>
									<th>{{ __('inventory.comment') }}</th>
									<th>{{ __('inventory.products') }}</th>
									<th>{{ __('inventory.quantity') }}</th>
									<th>{{ __('inventory.total_amount') }}</th>
								</thead>
								<tbody>
									@foreach ($client->client_carts->reverse()->take(25) as $admincart)
										<tr>
											<td>
												@if (!$admincart->finalized_at)
													<span class="text-danger"><i class="far fa-minus-square"></i></span>
												@else
													<span class="text-success"><i class="far fa-check-square"></i></span>
												@endif
											</td>
											<td><a href="{{ route('admincarts.show', $admincart) }}">{{ __('inventory.admincart') }} №{{ $admincart->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($admincart->created_at)) }}</td>
											<td>{{ $admincart->comment }}</td>
											<td>{{ $admincart->products->count() }}</td>
											<td>{{ $admincart->products->sum('quantity') }}</td>
											<td>{{ number_format($admincart->products->sum('total_amount'),2) }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>							
						</div>						
						<!-- <client_orders> -->
						<div class="tab-pane fade" id="client_orders">
							<div class="row">
								<div class="col-10"></div>
								<div class="col-2 text-right">
									<form method="post" action="{{ route('client_orders.store') }}">
										@csrf
										<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
										<input type="hidden" name="client_id" value="{{ $client->id }}">
										<input type="hidden" name="warehouse_id" value="{{ auth()->user()->default_warehouse_id }}">
										<input type="hidden" name="currency" value="{{ auth()->user()->default_currency }}">
										<button type="submit" class="btn btn-sm btn-simple btn-client-order"><i class="fas fa-plus"></i></button>
									</form>
								</div>
							</div>
							<table class="table">
								<thead>
									<th></th>
									<th>{{ __('inventory.client_order') }}</th>
									<th>{{ __('inventory.products') }}</th>
									<th>{{ __('inventory.quantity') }}</th>
									<th>{{ __('inventory.total_amount') }}</th>
								</thead>
								<tbody>
									@foreach ($client->client_orders->reverse()->take(25) as $client_order)
										<tr>
											<td>
												@if (!$client_order->finalized_at)
													<span class="text-danger"><i class="far fa-minus-square"></i></span>
												@else
													<span class="text-success"><i class="far fa-check-square"></i></span>
												@endif
											</td>
											<td><a href="{{ route('client_orders.show', $client_order) }}">{{ __('inventory.client_order') }} №{{ $client_order->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($client_order->created_at)) }}</td>
											<td>{{ $client_order->products->count() }}</td>
											<td>{{ $client_order->products->sum('quantity') }}</td>
											<td>{{ number_format($client_order->products->sum('total_amount'),2) }}</td>
										</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>{{ number_format($client->client_orders->sum('total_amount'),2) }}</td>
									</tr>
								</tfoot>
							</table>							
						</div>
						
						<div class="tab-pane fade" id="online_client_orders">
							<div class="row">
								<div class="col-10"></div>
								<div class="col-2 text-right">
									<form method="post" action="{{ route('online_client_orders.store') }}">
										@csrf
										<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
										<input type="hidden" name="client_id" value="{{ $client->id }}">
										<input type="hidden" name="warehouse_id" value="{{ auth()->user()->default_warehouse_id }}">
										<input type="hidden" name="currency" value="{{ auth()->user()->default_currency }}">
										<button type="submit" class="btn btn-sm btn-simple btn-client-order"><i class="fas fa-plus"></i></button>
									</form>
								</div>
							</div>
							<table class="table">
								<thead>
									<th></th>
									<th>{{ __('inventory.online_client_order') }}</th>
									<th>{{ __('inventory.products') }}</th>
									<th>{{ __('inventory.quantity') }}</th>
									<th>{{ __('inventory.total_amount') }}</th>
								</thead>
								<tbody>
									@foreach ($client->online_client_orders->reverse()->take(25) as $client_order)
										<tr>
											<td>
												@if (!$client_order->finalized_at)
													<span class="text-danger"><i class="far fa-minus-square"></i></span>
												@else
													<span class="text-success"><i class="far fa-check-square"></i></span>
												@endif
											</td>
											<td><a href="{{ route('online_client_orders.show', $client_order) }}">{{ __('inventory.online_client_order') }} №{{ $client_order->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($client_order->created_at)) }}</td>
											<td>{{ $client_order->products->count() }}</td>
											<td>{{ $client_order->products->sum('quantity') }}</td>
											<td>{{ number_format($client_order->products->sum('total'),2) }} /{{ $client_order->currency }}/</td>

										</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>{{ $client->online_client_orders->sum('total_amount') }}</td>
									</tr>
								</tfoot>
							</table>							
						</div>
						
						<div class="tab-pane fade" id="latest_transactions">
							<table class="table">
								<thead>
									<th>{{ __('inventory.transaction') }}</th>
									<th>{{ __('inventory.method') }}</th>
									<th>{{ __('inventory.total_amount') }}</th>
								</thead>
								<tbody>
									@foreach ($client->transactions->reverse()->take(25) as $transaction)
										<tr>
											<td><a href="{{ route('transactions.show', $transaction) }}">{{ __('inventory.transaction') }} №{{ $transaction->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($transaction->created_at)) }}</a></td>
											<td><a href="{{ route('methods.show', $transaction->method) }}">{{ $transaction->method->name }}</a></td>
											<td>{{ number_format($transaction->amount, 2) }}</td>
										</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td></td>
										<td>{{ number_format($client->transactions->sum('amount'), 2) }}</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
					<!-- Tabs content -->
				</div>
			</div>
		</div>
	</div>
@endsection

@push('js')
<script>
function renew_client_registration_date(client_id)
{
	$.ajax({
		url: '/clients/renewRregistrationDate',
		type: 'POST',
		data: {client_id: client_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			location.reload();
		}
	});
}

function client_notified(client_id)
{
	$.ajax({
		url: '/clients/notifyClient',
		type: 'POST',
		data: {client_id: client_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			location.reload();
		}
	});
}
</script>
@endpush