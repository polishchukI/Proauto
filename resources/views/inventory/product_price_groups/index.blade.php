@extends('inventory.layouts.app', ['page' => __('inventory.product_price_groups'), 'pageSlug' => 'product_price_groups', 'section' => 'inventory', 'search' => 'product_price_groups'])

@section('content')
@include('inventory.alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory.product_price_groups') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('product_price_groups.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">


                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">{{ __('inventory.name') }}</th>
                                <th scope="col">{{ __('inventory.surcharge') }}</th>
                                <th scope="col">{{ __('inventory.surcharge_coefficient') }}</th>
                                <th scope="col">{{ __('inventory.comment') }}</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </thead>
                            <tbody>
                                @foreach ($product_price_groups as $price_group)
                                    <tr>
                                        <td>{{ $price_group->name }}</td>
                                        <td>{{ $price_group->surcharge }}</td>
                                        <td>{{ $price_group->surcharge_coefficient }}</td>
                                        <td>{{ $price_group->comment }}</td>
										<td class="td-actions">
                                            <a href="{{ route('product_price_groups.edit', $price_group) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
											</td>
										<td class="td-actions">
                                            <form action="{{ route('product_price_groups.destroy', $price_group) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-simple btn-sm btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this price_group? All products belonging to it will be deleted and the records that contain it will not be accurate.') ? this.parentElement.submit() : ''">
                                                    <i class="fas fa-times" aria-hidden="true"></i>
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
                        {{ $product_price_groups->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
