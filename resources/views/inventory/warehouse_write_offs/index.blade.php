@extends('inventory.layouts.app', ['page' => __('inventory.warehouse_write_offs'), 'pageSlug' => 'warehouse_write_offs', 'section' => 'documents', 'search' => 'warehouse_write_offs'])

@section('content')
    @include('inventory.alerts.success')
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                                {{ $warehouse_write_offs->links() }}
                        </div>
                        <div class="col-2">
                            <form method="get" action="/warehouse_write_offs" autocomplete="off">
                                <input type="text" name="search" placeholder="{{ __('inventory.search') }}" value="{{ request('search') }}" class="form-control-sm" />
                                <button class="btn btn-simple btn-sm btn-selector" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="col-2 text-right">
                            <a href="{{ route('warehouse_write_offs.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead>
                                <th><i class="fas fa-flag-checkered"></i></th>
                                <th>{{ __('inventory.user') }}</th>
                                <th>{{ __('inventory.document') }}</th>
                                <th>{{ __('inventory.warehouse') }}</th>
                                <th>{{ __('inventory.total') }}</th>
                                <th><i class="fas fa-print"></i></th>
                                <th>{{ __('inventory.delete') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($warehouse_write_offs as $warehouse_write_off)
                                    <tr>
                                        <td>
                                            @if (!$warehouse_write_off->finalized_at)
                                                <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else
                                                <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif
                                        </td>
                                        <td>{{ $warehouse_write_off->user->name }}</td>
                                        <td>
                                            <a href="{{ route('warehouse_write_offs.show', ['warehouse_write_off' => $warehouse_write_off]) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <b>{{ __('inventory.warehouse_write_off') }} №{{ $warehouse_write_off->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($warehouse_write_off->created_at)) }}</b>
                                            </a>                                            
                                        </td>
                                        <td><a href="{{ route('warehouses.show', $warehouse_write_off->warehouse) }}">{{ $warehouse_write_off->warehouse->name }}</td>
                                        <td>
                                            <span>{{ $warehouse_write_off->total_amount }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('warehouse_write_offs.print', $warehouse_write_off) }}" class="btn btn-sm btn-simple btn-print" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.print') }}" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('warehouse_write_offs.destroy', $warehouse_write_off) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this warehouse_write_off? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
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
                    <div class="row">
                        <div class="col-12">
                                {{ $warehouse_write_offs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
