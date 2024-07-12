@extends('inventory.layouts.app', ['page' => 'List of crosses', 'pageSlug' => 'product_crosses_manager', 'section' => 'inventory', 'search' => 'product_crosses_manager'])

@section('content')
<div class="row">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">crosses</h4>
                </div>
                <div class="col-4 text-right">
                    <a href="{{ route('product.crosses.manager.create') }}" class="btn btn-sm btn-simple">New Cross</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('inventory.alerts.success')
            <div class="">
                <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                        <th scope="col">Article</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </thead>
                    <tbody>
                        @foreach ($product_crosses as $cross)
                            <tr>
                                <td>{{ $cross->article }}</td>
                                <td>{{ $cross->brand }}</td>
                                <td>{{ $cross->code }}</td>
                                <td>{{ $cross->name }}</td>
                                <td>
                                    @if ($cross->main_by_group == 0)
                                    <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                    @else
                                    <span class="text-success"><i class="far fa-check-square"></i></span>
                                    @endif                                        
                                </td>
                                <td>
                                    @if ($cross->main_by_brand == 0)
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
        </div>
        <div class="card-footer py-4">
			<nav class="d-flex justify-content-end" aria-label="...">
				{{ $product_crosses->links() }}
			</nav>
		</div>
	</div>
</div>
@endsection
