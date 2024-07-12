@extends('inventory.layouts.app', ['page' => __('inventory.provider_information'), 'pageSlug' => 'providers', 'section' => 'providers', 'search' => 'providers'])

@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
        <div class="row">
                <div class="col-8"><h4 class="card-title">{{ __('inventory.provider_information') }}</h4></div>
                <div class="col-4 text-right">
                    <a href="{{ route('providers.edit', $provider) }}" class="btn btn-simple btn-selector btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('providers.index') }}" class="btn btn-simple btn-sm btn-back"><i class="fas fa-arrow-left"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>{{ __('inventory.provider_id') }}</th>
                    <th>{{ __('inventory.provider_name') }}</th>
                    <th>{{ __('inventory.provider_code') }}</th>
                    <th>{{ __('inventory.price_type') }}</th>
                    <th>{{ __('inventory.provider_price_extra') }}</th>
                    <th>{{ __('inventory.price_items') }}</th>
                    <th>{{ __('inventory.payments_made') }}</th>
                    <th>{{ __('inventory.settlements') }}</th>
                    <th>{{ __('inventory.money_balance') }}</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $provider->id }}</td>
                        <td>{{ $provider->name }}</td>
                        <td>{{ $provider->provider_code }}</td>
                        <td>{{ $provider->hasprice }}</td>
                        <td>{{ $provider->price_extra }}</td>
                        <td>{{ $provider->supplierprices->count() }}</td>
                        <td>{{ $provider->transactions->count() }}</td>
                        <td>
                            @if($provider->settlements->sum('total_amount') > 0)
                            <span class="text-success"><i class="fas fa-dollar-sign" aria-hidden="true">{{ $provider->settlements->sum('total_amount') }}</i></span>
                            @elseif($provider->settlements->sum('total_amount') < 0)
                            <span class="text-danger"><i class="fas fa-dollar-sign" aria-hidden="true">{{ $provider->settlements->sum('total_amount') }}</i></span>
                            @else
                            <span><i class="fas fa-dollar-sign" aria-hidden="true">{{ $provider->settlements->sum('total_amount') }}</i></span>
                            @endif
                        </td>
                        <td>
                            @if (($provider->receipts->sum('total_amount') + $provider->service_receipts->sum('total_amount') - $provider->returns_to_provider->sum('total_amount') + $provider->transactions->sum('amount')) == 0)
                            <span><i class="fas fa-dollar-sign" aria-hidden="true">
                                {{$provider->receipts->sum('total_amount') + $provider->service_receipts->sum('total_amount') - $provider->returns_to_provider->sum('total_amount') + $provider->transactions->sum('amount')}}
                            </i></span>										
                            @elseif (($provider->receipts->sum('total_amount') + $provider->service_receipts->sum('total_amount') - $provider->returns_to_provider->sum('total_amount') + $provider->transactions->sum('amount')) != 0)
                            @if ($provider->receipts->sum('total_amount') + $provider->service_receipts->sum('total_amount') - $provider->returns_to_provider->sum('total_amount') + $provider->transactions->sum('amount') > 0)
                            <span class="text-success"><i class="fas fa-dollar-sign" aria-hidden="true">
                                {{($provider->receipts->sum('total_amount') + $provider->service_receipts->sum('total_amount') - $provider->returns_to_provider->sum('total_amount') + $provider->transactions->sum('amount'))}}
                            </i></span>
                            @else
                            <span class="text-danger"><i class="fas fa-dollar-sign" aria-hidden="true">
                                {{($provider->receipts->sum('total_amount') + $provider->service_receipts->sum('total_amount') - $provider->returns_to_provider->sum('total_amount') + $provider->transactions->sum('amount'))}}
                            </i></span>
                            @endif
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- <> -->
<div class="row">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills nav-pills-primary nav-pills-icons">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#nav_receipts">{{ __('inventory.receipts') }}</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav_transactions">{{ __('inventory.transactions') }}</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav_to_provider_orders">{{ __('inventory.to_provider_orders') }}</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#returns_to_provider">{{ __('inventory.returns_to_provider') }}</a></li>
                </ul>
                <div class="tab-content" id="nav-tabContent">
                    <!-- <receipts> -->
                    <div class="tab-pane fade show active" id="nav_receipts" role="tabpanel" aria-labelledby="nav_receipts-tab">                            
                        <table class="table">
                            <thead>
                                <th>{{ __('inventory.document') }}</th>
                                <th>{{ __('inventory.provider_doc') }}</th>
                                <th>{{ __('inventory.provider_sale_doc_date_create') }}</th>
                                <th>{{ __('inventory.total') }}</th>
                                <th>{{ __('inventory.currency') }}</th>
                                <th>{{ __('inventory.finalized_at') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($receipts as $receipt)
                                    <tr>
                                        <td><a href="{{ route('receipts.show', $receipt) }}">{{ __('inventory.receipt') }} №{{ $receipt->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($receipt->created_at)) }}</a></td>
                                        <td>
                                            @if($receipt->provider_doc_number && $receipt->provider_doc_date)
                                            {{ __('inventory.provider_doc') }} №{{ $receipt->provider_doc_number }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($receipt->provider_doc_date)) }}
                                            @endif
                                        </td>
                                        <td>{{ $receipt->provider_doc_date }}</td>
                                        <td>{{ $receipt->total_amount }}</td>
                                        <td>{{ $receipt->currency }}</td>
                                        <td>
                                            @if (!$receipt->finalized_at)
                                            <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else
                                            <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- <nav_transactions> -->
                    <div class="tab-pane fade" id="nav_transactions" role="tabpanel" aria-labelledby="nav_transactions-tab">
                        <table class="table">
                            <thead>
                                <th>{{ __('inventory.document') }}</th>
                                <th>{{ __('inventory.title') }}</th>
                                <th>{{ __('inventory.method') }}</th>
                                <th>{{ __('inventory.total') }}</th>
                                <th>{{ __('inventory.currency') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
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

                                        @if($transaction->receipt_id)
                                        <td><a href="/receipts/{{$transaction->receipt_id}}">{{ $transaction->title }}</a></td>
                                        @elseif($transaction->sale_id)
                                        <td><a href="/sales/{{$transaction->sale_id}}">{{ $transaction->title }}</a></td>
                                        @endif

                                        
                                        <td><a href="{{ route('methods.show', $transaction->method) }}">{{ $transaction->method->name }}</a></td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ $transaction->currency }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- <nav_to_provider_orders> -->
                    <div class="tab-pane fade" id="nav_to_provider_orders" role="tabpanel" aria-labelledby="nav_to_provider_orders-tab">
                        <table class="table">
                            <thead>
                                <th>{{ __('inventory.document') }}</th>
                                <th>{{ __('inventory.products') }}</th>
                                <th>{{ __('inventory.total') }}</th>
                                <th>{{ __('inventory.currency') }}</th>
                                <th>{{ __('inventory.finalized_at') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($to_provider_orders as $to_provider_order)
                                    <tr>
                                        <td><a href="{{ route('to_provider_orders.show', $to_provider_order) }}">{{ __('inventory.to_provider_order') }} №{{ $to_provider_order->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($to_provider_order->created_at)) }}</a></td>
                                        <td>{{ $to_provider_order->products->count() }}</td>
                                        <td>{{ $to_provider_order->total_amount }}</td>
                                        <td>{{ $to_provider_order->currency }}</td>
                                        <td>{{ $to_provider_order->finalized_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- <returns_to_provider> -->
                    <div class="tab-pane fade" id="returns_to_provider" role="tabpanel" aria-labelledby="returns_to_provider-tab">
                        <table class="table">
                            <thead>
                                <th>{{ __('inventory.document') }}</th>
                                <th>{{ __('inventory.products') }}</th>
                                <th>{{ __('inventory.total') }}</th>
                                <th>{{ __('inventory.currency') }}</th>
                                <th>{{ __('inventory.finalized_at') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($provider->returns_to_provider as $item)
                                    <tr>
                                        <td><a href="{{ route('returns_to_provider.show', $item) }}">{{ __('inventory.return_to_provider') }} №{{ $item->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($item->created_at)) }}</a></td>
                                        <td>{{ $item->products->count() }}</td>
                                        <td>{{ $item->total_amount }}</td>
                                        <td>{{ $item->currency }}</td>
                                        <td>{{ $item->finalized_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
<!-- <> -->
@endsection
