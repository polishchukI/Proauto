@extends('inventory.layouts.app', ['page' => 'Sales', 'pageSlug' => 'revenues', 'section' => 'stats'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h4 class="card-title">Product stocks by Quantity</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Article</th>
                            <th>Brand</th>
                            <th>Name</th>
                            <th>quantity</th>
                            <th>Revenue</th>
                        </thead>
                        <tbody>
                            @foreach($revenues as $product)
                                <tr>
                                    <td><a href="{{ route('products.show', $product['id']) }}">{{ $product['article'] }}</a></td>
                                    <td>{{ $product['brand'] }}</td>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['quantity'] }}</td>
                                    <td>{{ $product['revenue'] }}</td>
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