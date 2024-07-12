@extends('inventory.layouts.app', ['page' => __('inventory.warehouses'), 'pageSlug' => 'warehouses', 'section' => 'inventory', 'search' => 'warehouses'])

@section('content')
@include('inventory.alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{__('inventory.warehouses')}}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('warehouses.create') }}" class="btn btn-sm btn-simple"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th class="text-center">#</th>
                                <th>{{__('inventory.warehouse')}}</th>
                                <th>{{__('inventory.description')}}</th>
                                <th>{{__('inventory.active')}}</th>
                                <th>{{__('inventory.address_wh')}}</th>
                                <th>{{__('inventory.show')}}</th>
                                <th>{{__('inventory.edit')}}</th>
                                <th>{{__('inventory.delete')}}</th>
                            </thead>
                            <tbody>
                                @foreach ($warehouses as $warehouse)
                                    <tr>
										<td class="text-center">{{ $loop->iteration }}</td>
										<td>{{ $warehouse->name }}</td>
										<td>{{ $warehouse->description }}</td>
										<td>
                                        @if ($warehouse->active == 1)
                                            <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @else
                                            <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                        @endif
                                        </td>                                       
										<td>
                                        @if ($warehouse->address == 1)
                                            <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @else
                                            <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                        @endif
                                        </td>                                       
                                        <td>
                                            <a href="{{ route('warehouses.show', $warehouse) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>                                       
                                        <td>
                                            <a href="{{ route('warehouses.edit', $warehouse) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>                                       
                                        <td>
                                            <form action="{{ route('warehouses.destroy', $warehouse) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to remove this warehouse? The records that contain it will continue to exist.') ? this.parentElement.submit() : ''">
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
                    <nav class="d-flex justify-content-end">
                        {{ $warehouses->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
