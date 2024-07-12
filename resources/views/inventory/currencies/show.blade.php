@extends('inventory.layouts.app', ['page' => 'currency Information', 'pageSlug' => 'currencies', 'section' => 'inventory', 'search' => 'currencies'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">currency Information</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>products</th>
                            <th>Stocks</th>
                            <th>Stocks Faulty</th>
                            <th>Average Price</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $currency->id }}</td>
                                <td>{{ $currency->name }}</td>
                                <td>{{ $currency->products->count() }}</td>
                                <td>{{ $currency->products->sum('stock') }}</td>
                                <td>{{ $currency->products->sum('stock_defective') }}</td>
                                <td>${{ round($currency->products->avg('price'), 2) }}</td>
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
                    <h4 class="card-title">products: {{ $products->count() }}</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Stock</th>
                            <th>Defective Stock</th>
                            <th>Base price</th>
                            <th>Average Price</th>
                            <th>Total sales</th>
                            <th>Income Produced</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td><a href="{{ route('products.show', $product) }}">{{ $product->id }}</a></td>
                                    <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->stock_defective }}</td>
                                    <td>{{ format_money($product->price) }}</td>
                                    <td>{{ format_money($product->solds->avg('price')) }}</td>
                                    <td>{{ $product->solds->sum('quantity') }}</td>
                                    <td>{{ format_money($product->solds->sum('total_amount')) }}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end">
                        {{ $products->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection