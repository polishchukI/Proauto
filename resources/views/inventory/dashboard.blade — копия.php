@extends('inventory.layouts.app', ['pageSlug' => 'dashboard', 'page' => __('inventory.dashboard'), 'section' => '', 'search' => ''])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">{{ __('inventory_dashboard.total_sales') }}</h5>
                            <h2 class="card-title">{{ __('inventory_dashboard.annual_yield') }}</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
								<label class="btn btn-sm btn-light btn-simple active" id="0">
									<input type="radio" name="options" checked>
									<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">{{ __('inventory_dashboard.products') }}</span>
									<span class="d-block d-sm-none">
										<i class="far fa-user"></i>
									</span>
								</label>
								</label>
								<label class="btn btn-sm btn-light btn-simple" id="1">
									<input type="radio" class="d-none d-sm-none" name="options">
									<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">{{ __('inventory_dashboard.purchases') }}</span>
									<span class="d-block d-sm-none">
										<i class="fas fa-gift"></i>
									</span>
								</label>
								<label class="btn btn-sm btn-light btn-simple" id="2">
									<input type="radio" class="d-none" name="options">
									<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">{{ __('inventory_dashboard.clients') }}</span>
									<span class="d-block d-sm-none">
										<i class="fas fa-hand-point-up"></i>
									</span>
								</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartBig1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- second row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5"><div class="info-icon text-center icon-warning"><i class="fas fa-warehouse"></i></div></div>
                        <div class="col-7"><div class="numbers"><p class="card-category">{{ __('inventory_dashboard.productStocksTotal') }}</p><h3 class="card-title">{{ number_format($productStocksTotal,2) }}</h3></div></div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <a class="nav-item dropdown-item text-info" href="{{ route('inventory.inventory_report')  }}" target="_blank">
                            <i class="fas fa-boxes"></i>{{ __('inventory.inventory_report') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5"><div class="info-icon text-center icon-primary"><i class="fas fa-coins"></i></div></div>
                        <div class="col-7"><div class="numbers"><p class="card-category">{{ __('inventory_dashboard.moneysTotal') }}</p><h3 class="card-title">{{ number_format($moneysTotal,2) }}</h3></div></div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr><div class="stats"><a class="nav-item dropdown-item text-info" href="{{ route('transactions.transaction_statistics')  }}" target="_blank"><i class="fas fa-chart-pie"></i>{{ __('inventory.transaction_statistics') }}</a></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5"><div class="info-icon text-center icon-success"><i class="far fa-money-bill-alt"></i></div></div>
                        <div class="col-7"><div class="numbers">
                            <p class="card-category">{{ __('inventory_dashboard.totalCost') }}</p>
                            <h3 class="card-title">{{number_format($totalCost,2) }}</h3>
                        </div>
                    </div>
                </div></div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i class="tim-icons icon-trophy"></i> Customers feedback
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="info-icon text-center icon-danger"><i class="fab fa-telegram-plane"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">{{ __('inventory_dashboard.notifiedClients') }}</p>
                                <h3 class="card-title">{{number_format($notifiedClients,2) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i class="tim-icons icon-watch-time"></i> In the last hours
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- third row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">{{ __('inventory_dashboard.half_year_income') }}</h5>
                    <h3 class="card-title"><i class="far fa-money-bill-alt"></i>{{ number_format($semesterincomes,2) }}</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLinePurple"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">{{ __('inventory_dashboard.monthly_balance') }}</h5>
                    <h3 class="card-title"><i class="fas fa-piggy-bank"></i> {{ number_format($monthlybalance,2) }}</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="CountryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">{{ __('inventory_dashboard.half_year_expenditures') }}</h5>
                    <h3 class="card-title"><i class="fas fa-coins"></i> {{ number_format($semesterexpenses,2) }}</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLineGreen"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fourth row -->
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory_dashboard.pending_client_orders') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a onclick="client_order_create_modal();" class="btn btn-simple btn-sm"><i class="fas fa-file-download"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('inventory_dashboard.document_num') }}</th>
                                    <th>{{ __('inventory_dashboard.client') }}</th>
                                    <th>{{ __('inventory_dashboard.product') }}</th>
                                    <th>{{ __('inventory_dashboard.quantity') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unfinished_client_orders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('client_orders.show', $order->doc_id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                {{ $order->doc_id }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('clients.show', $order->client) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                {{ $order->client->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('products.show', $order->product) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                {{ $order->product->full_name }}
                                            </a>
                                        </td>
                                        <td>{{ $order->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory_dashboard.pending_to_provider_orders') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('to_provider_orders.create') }}" class="btn btn-simple btn-sm"><i class="fas fa-file-upload"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('inventory_dashboard.document_num') }}</th>
                                    <th>{{ __('inventory_dashboard.provider') }}</th>
                                    <th>{{ __('inventory_dashboard.product') }}</th>
                                    <th>{{ __('inventory_dashboard.quantity') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unfinished_to_provider_orders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('to_provider_orders.show', $order->doc_id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                {{ $order->doc_id }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('providers.show', $order->provider) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                {{ $order->provider->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('products.show', $order->product) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                {{ $order->product->full_name }}
                                            </a>
                                        </td>
                                        <td>{{ $order->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fourth row -->
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory_dashboard.pending_sales') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="#" class="btn btn-simple btn-sm" onclick="sale_create_modal();"><i class="fas fa-file-invoice"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('inventory_dashboard.document_num') }}</th>
                                    <th>{{ __('inventory_dashboard.client') }}</th>
                                    <th>{{ __('inventory_dashboard.products') }}</th>
                                    <th>{{ __('inventory_dashboard.paid_out') }}</th>
                                    <th>{{ __('inventory_dashboard.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unfinishedsales as $sale)
                                    <tr>
                                        <td>
                                            <a href="{{ route('sales.show', ['sale' => $sale]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="View Sale">
                                                {{ __('inventory_dashboard.sale') }} {{ $sale->id }} {{ __('inventory_dashboard.from_date') }} {{ date('d-m-y', strtotime($sale->created_at)) }}
                                            </a>
                                        </td>
                                        <td>{{ $sale->client->name }}</td>
                                        <td>{{ $sale->products->count() }}</td>
                                        <td>{{ $sale->transactions->sum('amount') }} {{$sale->currency }}</td>
                                        <td>{{ $sale->products->sum('total_amount') }} {{$sale->currency }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
                <div class="card-header">
                <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory_dashboard.latest_transactions') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <div class="btn-group">
                                <button class="btn btn-simple btn-sm dropdown-toggle" type="button" id="transactionsMane" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('inventory_dashboard.transactions_menu') }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="transactionsMane">
                                    <a href="{{ route('transactions.create', ['type' => 'payment']) }}" class="dropdown-item">{{ __('inventory_dashboard.payment') }}</a>
                                    <a href="{{ route('transactions.create', ['type' => 'income']) }}" class="dropdown-item">{{ __('inventory_dashboard.income') }}</a>
                                    <a href="{{ route('transactions.create', ['type' => 'expense']) }}" class="dropdown-item">{{ __('inventory_dashboard.expense') }}</a>
                                    <a href="{{ route('transfer.create') }}" class="dropdown-item">{{ __('inventory_dashboard.transfer') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('inventory_dashboard.category') }}</th>
                                    <th>{{ __('inventory_dashboard.transaction_title') }}</th>
                                    <th>{{ __('inventory_dashboard.transaction_method') }}</th>
                                    <th>{{ __('inventory_dashboard.total') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($lasttransactions as $transaction)
                                    <tr> 
                                        <td>
                                            @if($transaction->type == 'expense')
                                            {{ __('inventory_dashboard.expense') }}
                                            @elseif($transaction->type == 'sale')
                                            {{ __('inventory_dashboard.sale') }}
                                            @elseif($transaction->type == 'payment')
                                            {{ __('inventory_dashboard.payment') }}
                                            @elseif($transaction->type == 'income')
                                            {{ __('inventory_dashboard.income') }}
                                            @else
                                                {{ $transaction->type }}
                                            @endif
                                            
                                        </td>
                                        <td>{{ $transaction->title }}</td>
                                        <td>{{ $transaction->method->name }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td class="td-actions text-right">
                                            @if ($transaction->sale_id)
                                                <a href="{{ route('sales.show', $transaction->sale_id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
        var lastmonths = [];

        @foreach ($lastmonths as $id => $month)
            lastmonths.push('{{ strtoupper($month) }}')
        @endforeach

        var lastincomes = {{ $lastincomes }};
        var lastexpenses = {{ $lastexpenses }};
        var anualsales = {{ $anualsales }};
        var anualclients = {{ $anualclients }};
        var anualproducts = {{ $anualproducts }};
        var methods = [];
        var methods_stats = [];

        @foreach($monthlybalancebymethod as $method => $balance)
            methods.push('{{ $method }}');
            methods_stats.push('{{ $balance }}');
        @endforeach
    </script>
@endpush
