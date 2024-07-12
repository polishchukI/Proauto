@extends('inventory.layouts.app', ['page' => __('inventory.inventory_report'), 'pageSlug' => 'istats', 'section' => 'inventory', 'search' => ''])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('inventory.statistics_by_quantity') }}</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>{{ __('inventory.article') }}</th>
                            <th>{{ __('inventory.brand') }}</th>
                            <th>{{ __('inventory.name') }}</th>
                            <th>{{ __('inventory.stock') }}</th>
                            <th>{{ __('inventory.annual_sales') }}</th>
                            <th>{{ __('inventory.average_price') }}</th>
                            <th>{{ __('inventory.annual_income') }}</th>
                        </thead>
                        <tbody>
                            @foreach($soldproductsbystock as $soldproduct)
                                <tr>
                                    <td>{{ $soldproduct->product->article }}</td>
                                    <td>{{ $soldproduct->product->brand }}</td>
                                    <td><a href="{{ route('products.show', $soldproduct->product) }}">{{ $soldproduct->product->name }}</a></td>
                                    <td>{{ $soldproduct->product->stocks()->sum('quantity') ?? 0}}</td>
                                    <td>{{ $soldproduct->total_qty }}</td>
                                    <td>{{ round($soldproduct->avg_price) }}</td>
                                    <td>{{ $soldproduct->incomes }}</td>
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
                    <h4 class="card-title">{{ __('inventory.statistics_by_income') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>{{ __('inventory.article') }}</th>
                                <th>{{ __('inventory.brand') }}</th>
                                <th>{{ __('inventory.name') }}</th>
                                <th>{{ __('inventory.sold') }}</th>
                                <th>{{ __('inventory.income') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($soldproductsbyincomes as $soldproduct)
                                    <tr>
                                    <td>{{ $soldproduct->product->article }}</td>
                                        <td>{{ $soldproduct->product->brand }}</td>
                                        <td><a href="{{ route('products.show', $soldproduct->product) }}">{{ $soldproduct->product->name }}</a></td>
                                        <td>{{ $soldproduct->total_quantity }}</td>
                                        <td>{{ $soldproduct->incomes }}</td>
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
                    <h4 class="card-title">{{ __('inventory.statistics_by_average_price') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>{{ __('inventory.article') }}</th>
                                <th>{{ __('inventory.brand') }}</th>
                                <th>{{ __('inventory.name') }}</th>
                                <th>{{ __('inventory.sold') }}</th>
                                <th>{{ __('inventory.average_price') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($soldproductsbyavgprice as $soldproduct)
                                    <tr>
                                        <td>{{ $soldproduct->product->article }}</td>
                                        <td>{{ $soldproduct->product->brand }}</td>
                                        <td><a href="{{ route('products.show', $soldproduct->product) }}">{{ $soldproduct->product->name }}</a></td>
                                        <td>{{ $soldproduct->total_quantity }}</td>
                                        <td>{{ round($soldproduct->avg_price) }}</td>
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