@extends('inventory.layouts.app', ['page' => __('inventory.brand_renames'), 'pageSlug' => 'brand_renames', 'section' => 'inventory', 'search' => 'brand_renames'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">{{ __('inventory.brand_renames') }}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('brand_renames.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-primary text-center">
                            <th>#</th>
                            <th>{{ __('inventory.name') }}</th>
                            <th>{{ __('inventory.brand_rename_from') }}</th>
                            <th>{{ __('inventory.brand_rename_to') }}</th>
                            <th>{{ __('inventory.author') }}</th>
                            <th>{{ __('inventory.comment') }}</th>
                            <th>{{ __('inventory.delete') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($brand_renames as $brand_rename)
                                <tr>
                                    <td>
                                        <a href="{{ route('brand_renames.edit', $brand_rename) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                            {{ $brand_rename->id }}<i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>{{ $brand_rename->name }}</td>
                                    <td>{{ $brand_rename->rename_from }}</td>
                                    <td>{{ $brand_rename->rename_to }}</td>
                                    <td>{{ $brand_rename->user->name ?? ""}}</td>
                                    <td>{{ $brand_rename->comment }}</td>
                                    <td class="td-actions text-center">
                                        <form action="{{ route('brand_renames.destroy', ['brand_rename' => $brand_rename]) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-simple btn-sm btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Estás seguro que quieres eliminar a este brand_rename? Los registros de sus compras y Transactions no serán eliminados.') ? this.parentElement.submit() : ''">
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
        </div>
    </div>
</div>
@endsection