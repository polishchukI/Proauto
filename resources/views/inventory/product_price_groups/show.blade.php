@extends('inventory.layouts.app', ['page' => __('inventory.product_price_group'), 'pageSlug' => 'categories', 'section' => 'inventory', 'search' => 'categories'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('inventory.product_price_group_information')}}</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>{{__('inventory.name')}}</th>
                            <th>{{__('inventory.surcharge')}}</th>
                            <th>{{__('inventory.surcharge_coefficient')}}</th>
                            <th>Stocks Faulty</th>
                            <th>Average Price</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $product_price_group->id }}</td>
                                <td>{{ $product_price_group->name }}</td>
                                <td>{{ $product_price_group->surcharge }}</td>
                                <td>{{ $product_price_group->surcharge_coefficient }}</td>
                                <td>{{-- $product_price_group->surcharge_coefficient --}}</td>
                                <td>{{-- $product_price_group->surcharge_coefficient --}}</td>
                                
                                <td class="td-actions">
                                    <a href="{{ route('product_price_groups.edit', $product_price_group) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td class="td-actions">
                                    <form action="{{ route('product_price_groups.destroy', $product_price_group) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-simple btn-sm btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this price_group? All products belonging to it will be deleted and the records that contain it will not be accurate.') ? this.parentElement.submit() : ''">
                                        <i class="fas fa-times" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="row">
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
    </div>--}}
@endsection