@extends('inventory.layouts.app', ['pageSlug' => 'transaction_statistics', 'page' => __('inventory.transaction_statistics_report'), 'section' => 'statistics', 'search' => ''])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory.transaction_statistics') }}</h4>
                        </div>
                        <div class="col-4 text-right"></div>
                    </div>
                </div>
                <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>{{ __('inventory.period') }}</th>
                                <th>{{ __('inventory.transactions') }}</th>
                                <th>{{ __('inventory.income') }}</th>
                                <th>{{ __('inventory.expenses') }}</th>
                                <th>{{ __('inventory.payments') }}</th>
                                <th>{{ __('inventory.cash_balance') }}</th>
                                <th>{{ __('inventory.total_balance') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($transactionsperiods as $period => $data)
                                    <tr>
                                        <td>{{ $period }}</td>
                                        <td>{{ $data->count() }}</td>
                                        <td>{{ number_format($data->where('type', 'income')->sum('amount'),2) }}</td>
                                        <td>{{ number_format($data->where('type', 'expense')->sum('amount'),2) }}</td>
                                        <td>{{ number_format($data->where('type', 'payment')->sum('amount'),2) }}</td>
                                        <td>{{ number_format($data->where('payment_method_id', optional($methods->where('name', 'Cash')->first())->id)->sum('amount'),2) }}</td>
                                        <td>{{ number_format($data->sum('amount'),2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-tasks">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory.pending_balances') }}</h4>
                        </div>
                        <div class="col-4 text-right"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>{{ __('inventory.client') }}</th>
                                <th>{{ __('inventory.purchases') }}</th>
                                <th>{{ __('inventory.transactions') }}</th>
                                <th>{{ __('inventory.balance') }}</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td><a href="{{ route('clients.show', $client) }}">{{ $client->name }}<br>{{ $client->document_type }}-{{ $client->document_id }}</a></td>
                                        <td>{{ $client->sales->count() }}</td>
                                        <td>{{ number_format($client->transactions->sum('amount'),2) }}</td>
                                        <td>
                                            @if ($client->balance > 0)
                                                <span class="text-success">{{ number_format($client->balance,2) }}</span>
                                            @elseif ($client->balance < 0.00)
                                                <span class="text-danger">{{ number_format($client->balance,2) }}</span>
                                            @else
                                                {{ number_format($client->balance,2) }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('clients.transactions.add', $client) }}" class="btn btn-link btn-sm" data-toggle="tooltip" data-placement="bottom" title="Register Transation">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                            <a href="{{ route('clients.show', $client) }}" class="btn btn-link btn-sm" data-toggle="tooltip" data-placement="bottom" title="See Client">
                                                <i class="fas fa-search"></i>
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
        <div class="col-md-6">
            <div class="card card-tasks">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory.statistics_by_method') }}</h4>
                        </div>
                        <div class="col-4 text-right"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>{{ __('inventory.method') }}</th>
                                <th>{{ __('inventory.transactions') }} {{ $date->year }}</th>
                                <th>{{ __('inventory.balance') }} {{ $date->year }}</th>
                            </thead>
                            <tbody>
                                @foreach($methods as $method)
                                    <tr>
                                        <td><a href="{{ route('methods.show', $method) }}">{{ $method->name }}</a></td>
                                        <td>{{ number_format($transactionsperiods['Year']->where('payment_method_id', $method->id)->count()) }}</td>
                                        <td>{{ number_format($transactionsperiods['Year']->where('payment_method_id', $method->id)->sum('amount'),2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">{{ __('inventory.sales_statistics') }}</h4>
                    </div>
                    <div class="col-4 text-right"></div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
						<th>{{ __('inventory.period') }}</th>
						<th>{{ __('inventory.sales') }}</th>
						<th>{{ __('inventory.clients') }}</th>
						<th>{{ __('inventory.total_stocks') }}</th>
						<th>{{ __('inventory.average_c_v') }}</th>
						<th>{{ __('inventory.billed_amount') }}</th>
						<th>{{ __('inventory.to_finalize') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($salesperiods as $period => $data)
                            <tr>
                                <td>{{ $period }}</td>
                                <td>{{ $data->count() }}</td>
                                <td>{{ $data->groupBy('client_id')->count() }}</td>
                                <td>{{ $data->where('finalized_at', '!=', null)->map(function ($sale) {return $sale->products->sum('quantity');})->sum() }}</td>
                                <td>{{ number_format($data->avg('total_amount'),2) }}</td>
                                <td>{{ number_format($data->where('finalized_at', '!=', null)->map(function ($sale) {return $sale->products->sum('total_amount');})->sum(),2) }}</td>
                                <td>{{ $data->where('finalized_at', null)->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
@endsection