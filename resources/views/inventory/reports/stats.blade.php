@extends('inventory.layouts.app', ['page' => 'Sales', 'pageSlug' => 'sales', 'section' => 'transactions'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h4 class="card-title">Statistics by Quantity (TOP 15)</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Article</th>
                            <th>Brand</th>
                            <th>Name</th>
                            <th>quantity</th>
                            <th>Annual Sales</th>
                            <th>Average Price</th>
                            <th>Annual Income</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($soldproductsbystock as $soldproduct)
                                <tr>
                                    <td><a href="{{ route('products.show', $soldproduct->product) }}">{{ $soldproduct->product->article }}</a></td>
                                    <td>{{ $soldproduct->product->brand }}</td>
                                    <td>{{ $soldproduct->product->fullname }}</td>
                                    <td>{{ $soldproduct->product->quantity }}</td>
                                    <td>{{ $soldproduct->total_quantity }}</td>
                                    <td>{{ round($soldproduct->avg_price) }}</td>
                                    <td>{{ $soldproduct->incomes }}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('products.show', $soldproduct->product) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                            <i class="fa fa-eye"></i>
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
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h4 class="card-title">Statistics by Income (TOP 15)</h4>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>Article</th>
                                <th>Brand</th>
                                <th>Name</th>
                                <th>Sold</th>
                                <th>Income</th>
                            </thead>
                            <tbody>
                                @foreach ($soldproductsbyincomes as $soldproduct)
                                    <tr>
                                        <td><a href="{{ route('products.show', $soldproduct->product) }}">{{ $soldproduct->product->article }}</a></td>
                                        <td>{{ $soldproduct->product->brand }}</td>
                                        <td>{{ $soldproduct->product->fullname }}</td>
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
	</div>
	<div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h4 class="card-title">Statistics by Average Price (TOP 15)</h4>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>Article</th>
                                <th>Brand</th>
                                <th>Name</th>
                                <th>Sold</th>
                                <th>Avg Price</th>
                            </thead>
                            <tbody>
                                @foreach ($soldproductsbyavgprice as $soldproduct)
                                    <tr>
                                        <td><a href="{{ route('products.show', $soldproduct->product) }}">{{ $soldproduct->product->article }}</a></td>
                                        <td>{{ $soldproduct->product->brand }}</td>
                                        <td>{{ $soldproduct->product->fullname }}</td>
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
</div>
@endsection