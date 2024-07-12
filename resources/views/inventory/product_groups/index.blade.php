@extends('inventory.layouts.app', ['page' => 'List of Categories', 'pageSlug' => 'product_groups', 'section' => 'inventory', 'search' => 'product_groups'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Categories</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('product_groups.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('inventory.alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">Id</th>
                                <th scope="col">Parent</th>
                                <th scope="col">Level</th>
                                <th scope="col">Text</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </thead>
                            <tbody>
                                @foreach ($product_groups as $group)
                                    <tr>
                                        <td>{{ $group->id }}</td>
                                        <td>{{ $group->parent }}</td>
                                        <td>{{ $group->level }}</td>
                                        <td>{{ $group->text }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('product_groups.show', $group) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                <i class="fas fa-search"></i>
                                            </a>
										</td>
										<td class="td-actions text-right">
                                            <a href="{{ route('product_groups.edit', $group) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
											</td>
										<td class="td-actions text-right">
                                            <form action="{{ route('product_groups.destroy', $group) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this group? All products belonging to it will be deleted and the records that contain it will not be accurate.') ? this.parentElement.submit() : ''">
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
                        {{ $product_groups->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
