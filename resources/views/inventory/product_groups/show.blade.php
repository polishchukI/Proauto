@extends('inventory.layouts.app', ['page' => 'Product product_group Information', 'pageSlug' => 'product_groups', 'section' => 'inventory', 'search' => 'product_groups'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Category Information</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Parent</th>
                            <th>Level</th>
                            <th>Text</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $product_group->id }}</td>
                                <td>{{ $product_group->name }}</td>
                                <td>{{ $product_group->products->count() }}</td>
                                <td>{{ $product_group->products->sum('stock') }}</td>
                                <td>{{ $product_group->products->sum('stock_defective') }}</td>
                                <td>${{ round($product_group->products->avg('price'), 2) }}</td>
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
                    <h4 class="card-title">products: {{ $product_group->products->count() }}</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
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
                            @foreach ($product_group->products as $product)
                                <tr>
                                    <td><a href="{{ route('products.show', $product) }}">{{ $product->full_name }}</a></td>
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
            </div>
        </div>
    </div>
@endsection