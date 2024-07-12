@extends('inventory.layouts.app', ['page' => __('inventory.warehouse_info'), 'pageSlug' => 'warehouses', 'section' => 'inventory', 'search' => 'warehouses'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('inventory.warehouse_info')}}</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>№</th>
                            <th>{{__('inventory.warehouse')}}</th>
                            <th>{{__('inventory.description')}}</th>
                            <th>{{__('inventory.edit')}}</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $warehouse->id }}</td>
                                <td>{{ $warehouse->name }}</td>
                                <td>{{ $warehouse->description }}</td>
                                <td>
                                    <a href="{{ route('warehouses.edit', $warehouse) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
