@extends('inventory.layouts.app', ['pageSlug' => 'dashboard', 'page' => __('inventory_dashboard.dashboard'), 'section' => '', 'search' => ''])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
    <div class="row">
        <div class="col-12">
           <ul class="nav nav-pills nav-pills-primary nav-pills-icons">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#graphics">{{__('inventory_dashboard.graphics')}}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#clients">{{__('inventory_dashboard.clients')}}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#providers">{{__('inventory_dashboard.providers')}}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#payments">{{__('inventory_dashboard.payments')}}</a></li>
            </ul>
            <div class="tab-content tab-space">
                <div class="tab-pane active" id="graphics">
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <blockquote>
                                        <p class="blockquote text-info">
                                            "I will be the leader of a company that ends up being worth billions of dollars, because I got the answers.<br>I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at."
                                            <br>                                    
                                            <small class="text-info">
                                                - NOAA
                                            </small>
                                        </p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <i class="fas fa-boxes"></i>{{ __('inventory_dashboard.product_stocks_report') }}
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
                                    <hr><div class="stats"><a class="nav-item dropdown-item text-info" href="{{ route('transactions.transaction_statistics_report')  }}" target="_blank"><i class="fas fa-chart-pie"></i>{{ __('inventory_dashboard.transaction_statistics_report') }}</a></div>
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
                                            <a class="nav-item dropdown-item text-info" href="{{ route('sales.by.clients')  }}" target="_blank">
                                                <i class="fas fa-users"></i>{{ __('inventory_dashboard.sales_by_clients_report') }}
                                            </a></div>
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
                </div>
                <!-- client orders/second tab -->
                <div class="tab-pane" id="clients">                    
                    <div class="row">
                        <!-- <online orders> -->
                        <div class="col-6">
                            <div class="card" style="height:369px;position:relative;">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-8">
                                            <h6 class="card-title"><a href="{{ route('online_client_orders.index') }}">{{ __('inventory_dashboard.pending_online_client_orders') }}</a></h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <!-- <a href="{{ route('client_orders.create') }}" class="btn btn-sm btn-simple btn-selector" data-toggle="tooltip" title="Create Client Order"><i class="fas fa-file-download"></i></a> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="max-height:100%;overflow:auto;">
                                    <div class="table-full-width table-responsive ps">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>{{ __('inventory_dashboard.client') }}</th>
                                                    <th>{{ __('inventory_dashboard.client_order_doc_id') }}</th>
                                                    <th>{{ __('inventory_dashboard.quantity') }}</th>
                                                    <th>{{ __('inventory_dashboard.to_sale') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($unfinished_client_orders as $order)
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="photo">
                                                            @if($order->client->avatar)
                                                            <img src="{{ $order->client->avatar }}" alt="photo">
                                                            @else
                                                            <img src="../images/avatars/clients/no_avatar.jpg" alt="photo">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('clients.show', $order->client) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory_dashboard.more_details') }}">
                                                            {{ $order->client->name }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{--<a href="{{ route('client_orders.show', $order->doc_id) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory_dashboard.more_details') }}">--}}
                                                        <a href="{{ route('client_orders.show', $order->id) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory_dashboard.more_details') }}">
                                                            {{ __('inventory_dashboard.client_order') }} {{ $order->doc_id }} {{ __('inventory_dashboard.from_date') }} {{ date('d-m-y', strtotime($order->created_at)) }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $order->quantity }}</td>
                                                    <td>
                                                        <button onclick="client_order_sale('{{$order->id}}');" class="btn btn-sm btn-simple btn-sale" data-toggle="tooltip" data-placement="bottom" title="Sale">
                                                            <i class="fas fa-file-invoice"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card" style="height:369px;position:relative;">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-8">
                                            <h6 class="card-title"><a href="{{ route('client_orders.index') }}">{{ __('inventory_dashboard.pending_client_orders') }}</a></h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <a href="{{ route('client_orders.create') }}" class="btn btn-sm btn-simple btn-selector" data-toggle="tooltip" title="Create Client Order"><i class="fas fa-file-download"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="max-height:100%;overflow:auto;">
                                    <div class="table-full-width table-responsive ps">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>{{ __('inventory_dashboard.client') }}</th>
                                                    <th>{{ __('inventory_dashboard.client_order_doc_id') }}</th>
                                                    <th>{{ __('inventory_dashboard.quantity') }}</th>
                                                    <th>{{ __('inventory_dashboard.to_sale') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($unfinished_client_orders as $order)
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="photo">
                                                            @if($order->client->avatar)
                                                            <img src="{{ $order->client->avatar }}" alt="photo">
                                                            @else
                                                            <img src="../images/avatars/clients/no_avatar.jpg" alt="photo">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('clients.show', $order->client) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory_dashboard.more_details') }}">
                                                            {{ $order->client->name }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('client_orders.show', $order->id) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory_dashboard.more_details') }}">
                                                            {{ __('inventory_dashboard.client_order') }} #{{ $order->id }} {{ __('inventory_dashboard.from_date') }} {{ date('d-m-y', strtotime($order->created_at)) }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $order->quantity }}</td>
                                                    <td>
                                                        <button onclick="client_order_sale('{{$order->id}}');" class="btn btn-sm btn-simple btn-sale" data-toggle="tooltip" data-placement="bottom" title="Sale">
                                                            <i class="fas fa-file-invoice"></i>
                                                        </button>
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
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card" style="height:369px;position:relative;">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-8">
                                            <h6 class="card-title"><a href="{{ route('sales.index') }}">{{ __('inventory_dashboard.pending_sales') }}</a></h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <a href="{{ route('sales.create') }}" class="btn btn-selector btn-simple btn-sm "><i class="fas fa-file-invoice"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="max-height:100%;overflow:auto;">
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
                                                            <a href="{{ route('sales.show', ['sale' => $sale]) }}"data-toggle="tooltip" data-placement="bottom" title="View Sale">
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
                            <div class="card" style="height:369px;position:relative;">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-8">
                                            <h6 class="card-title"><a href="{{ route('admincarts.index') }}">{{ __('inventory_dashboard.latest_carts') }}</a></h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <a href="{{ route('admincarts.create') }}" class="btn btn-selector btn-simple btn-sm "><i class="fas fa-cart-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="max-height:100%;overflow:auto;">
                                    <div class="table-full-width table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('inventory_dashboard.document_num') }}</th>
                                                    <th>{{ __('inventory_dashboard.client') }}</th>
                                                    <th>{{ __('inventory_dashboard.total') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($lastadmincarts as $admincart)
                                                    <tr>
                                                        <td>
                                                            @if (!$admincart->finalized_at)
                                                                <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                                            @else
                                                                <span class="text-success"><i class="far fa-check-square"></i></span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admincarts.show', ['admincart' => $admincart]) }}"data-toggle="tooltip" data-placement="bottom" title="View admincart">
                                                                {{ __('inventory_dashboard.admincart') }} {{ $admincart->id }} {{ __('inventory_dashboard.from_date') }} {{ date('d-m-y', strtotime($admincart->created_at)) }}
                                                            </a>
                                                        </td>
                                                        
                                                        <td>
                                                            <a href="{{ route('clients.show', $admincart->client) }}"data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory_dashboard.more_details') }}">
                                                                {{ $admincart->client->name }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $admincart->products->sum('total_amount') }} {{$admincart->currency }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- provider orders/third tab -->
                <div class="tab-pane" id="providers">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="height:369px;position:relative;">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-8">
                                            <h6 class="card-title"><a href="{{ route('to_provider_orders.index') }}">{{ __('inventory_dashboard.pending_to_provider_orders') }}</a></h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <a href="{{ route('to_provider_orders.create') }}" class="btn btn-selector btn-simple btn-sm "><i class="fas fa-file-upload"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="max-height:100%;overflow:auto;">
                                    <div class="table-full-width table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('inventory_dashboard.provider') }}</th>
                                                    <th>{{ __('inventory_dashboard.to_provider_order_doc_id') }}</th>
                                                    <th>{{ __('inventory_dashboard.product') }}</th>
                                                    <th>{{ __('inventory_dashboard.quantity') }}</th>
                                                    <th>{{ __('inventory_dashboard.to_receipt') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($unfinished_to_provider_orders as $order)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('providers.show', $order->provider) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory_dashboard.more_details') }}">
                                                                {{ $order->provider->name }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('to_provider_orders.show', $order->doc_id) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory_dashboard.more_details') }}">
                                                                {{ __('inventory_dashboard.to_provider_order') }} {{ $order->doc_id }} {{ __('inventory_dashboard.from_date') }} {{ date('d-m-y', strtotime($order->created_at)) }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('products.show', $order->product) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory_dashboard.more_details') }}">
                                                                {{ $order->product->full_name }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $order->quantity }}</td>
                                                        <td>                                                            
                                                            <button onclick="to_provider_order_receipt('{{$order->doc_id}}');" class="btn btn-sm btn-simple btn-receipt" data-toggle="tooltip" data-placement="bottom" title="receipt">
                                                                <i class="fas fa-receipt"></i>
                                                            </button>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="height:369px;position:relative;">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-8">
                                            <h6 class="card-title"><a href="{{ route('receipts.index') }}">{{ __('inventory_dashboard.pending_receipts') }}</a></h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <a href="{{ route('receipts.create') }}" class="btn btn-selector btn-simple btn-sm"><i class="fas fa-receipt"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="max-height:100%;overflow:auto;">
                                    <div class="table-full-width table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('inventory_dashboard.receipt') }}</th>
                                                    <th>{{ __('inventory_dashboard.provider') }}</th>
                                                    <th>{{ __('inventory_dashboard.products') }}</th>
                                                    <th>{{ __('inventory_dashboard.paid_out') }}</th>
                                                    <th>{{ __('inventory_dashboard.total') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($unfinishedreceipts as $receipt)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('receipts.show', ['receipt' => $receipt]) }}"data-toggle="tooltip" data-placement="bottom" title="View receipt">
                                                                {{ __('inventory_dashboard.receipt') }} {{ $receipt->id }} {{ __('inventory_dashboard.from_date') }} {{ date('d-m-y', strtotime($receipt->created_at)) }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $receipt->provider->name }}</td>
                                                        <td>{{ $receipt->products->count() }}</td>
                                                        <td>{{ $receipt->transactions->sum('amount') }} {{$receipt->currency }}</td>
                                                        <td>{{ $receipt->products->sum('total_amount') }} {{$receipt->currency }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- payments/fourth tab -->
                <div class="tab-pane" id="payments">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="height:768px;position:relative;">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-8">
                                            <h6 class="card-title">{{ __('inventory_dashboard.latest_transactions') }}</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <div class="btn-group">
                                                <button class="btn btn-selector btn-simple btn-sm dropdown-toggle" type="button" id="transactionsMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ __('inventory_dashboard.transactions_menu') }}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="transactionsMenu">
                                                    <a href="{{ route('transactions.create', ['type' => 'payment']) }}" class="dropdown-item">{{ __('inventory_dashboard.payment') }}</a>
                                                    <a href="{{ route('transactions.create', ['type' => 'income']) }}" class="dropdown-item">{{ __('inventory_dashboard.income') }}</a>
                                                    <a href="{{ route('transactions.create', ['type' => 'expense']) }}" class="dropdown-item">{{ __('inventory_dashboard.expense') }}</a>
                                                    <a href="{{ route('transfer.create') }}" class="dropdown-item">{{ __('inventory_dashboard.transfer') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="max-height:100%;overflow:auto;">
                                    <div class="table-full-width table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('inventory_dashboard.category') }}</th>
                                                    <th>{{ __('inventory_dashboard.transaction_title') }}</th>
                                                    <th>{{ __('inventory_dashboard.transaction_contragent') }}</th>
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
                                                            {{ __('inventory_dashboard.from_date') }} {{ date('d-m-y', strtotime($transaction->created_at)) }}
                                                        </td>
                                                        <td>
                                                            @if ($transaction->sale_id)
                                                            <a href="{{ route('sales.show', $transaction->sale_id) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory_dashboard.more_details') }}">
                                                                {{ $transaction->title }}
                                                            </a>
                                                            @elseif($transaction->receipt_id)
                                                            <a href="{{ route('receipts.show', $transaction->receipt_id) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory_dashboard.more_details') }}">
                                                                {{ $transaction->title }}
                                                            </a>
                                                            @else
                                                                {{ $transaction->title }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($transaction->client_id)
                                                            <a href="{{ route('clients.show', $transaction->client_id) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory_dashboard.more_details') }}">
                                                                {{ $transaction->client->name }}
                                                            </a>
                                                            @elseif($transaction->provider_id)
                                                            <a href="{{ route('providers.show', $transaction->provider_id) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory_dashboard.more_details') }}">
                                                                {{ $transaction->provider->name }}
                                                            </a>
                                                            @endif
                                                        </td>                                                        
                                                        <td>{{ $transaction->method->name }}</td>
                                                        <td>{{ $transaction->amount }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
