@extends('inventory.layouts.app', ['page' => __('inventory.product_category_information'), 'pageSlug' => 'product_categories', 'section' => 'inventory', 'search' => 'product_categories'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">{{__('inventory.product_category_information')}}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('product_categories.index') }}" class="btn btn-simple btn-sm btn-back"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
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
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->products->count() }}</td>
                                <td>{{ $category->products->sum('stock') }}</td>
                                <td>{{ $category->products->sum('stock_defective') }}</td>
                                <td>{{ round($category->products->avg('price'), 2) }}</td>
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
                            <th>Name</th>
                            <th>Stock</th>
                            <th>Defective Stock</th>
                            <th>Base price</th>
                            <th>Average Price</th>
                            <th>Total sales</th>
                            <th>Income Produced</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->stock_defective }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->solds->avg('price') }}</td>
                                    <td>{{ $product->solds->sum('quantity') }}</td>
                                    <td>{{ $product->solds->sum('total_amount') }}</td>
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