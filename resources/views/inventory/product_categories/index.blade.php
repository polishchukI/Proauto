@extends('inventory.layouts.app', ['page' => __('inventory.product_categories'), 'pageSlug' => 'product_categories', 'section' => 'inventory', 'search' => 'product_categories'])

@section('content')
@include('inventory.alerts.success')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">{{__('inventory.product_categories')}}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('product_categories.create') }}" class="btn btn-simple btn-sm btn-selector"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                            <th scope="col">{{__('inventory.id')}}</th>
                            <th scope="col">{{__('inventory.product_category_name')}}</th>
                            <th scope="col">{{__('inventory.products')}}</th>
                            <!--th scope="col">Total Stock</th>
                            <th scope="col">Defective Stock</th>
                            <th scope="col">Average Price of Product</th-->
                            <th scope="col">{{__('inventory.show')}}</th>
                            <th scope="col">{{__('inventory.edit')}}</th>
                            <th scope="col">{{__('inventory.delete')}}</th>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ count($category->products) }}</td>
                                    <!-- td>{{ $category->products->sum('stock') }}</td>
                                    <td>{{ $category->products->sum('stock_defective') }}</td>
                                    <td>{{ format_money($category->products->avg('price')) }}</td-->
                                    <td class="td-actions text-right">
                                        <a href="{{ route('product_categories.show', $category) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('product_categories.edit', $category) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="td-actions text-right">
                                        <form action="{{ route('product_categories.destroy', $category) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-simple btn-sm btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this category? All products belonging to it will be deleted and the records that contain it will not be accurate.') ? this.parentElement.submit() : ''">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">
                    {{ $categories->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
