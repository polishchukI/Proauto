@extends('inventory.layouts.app', ['page' => __('inventory.brands'), 'pageSlug' => 'brands', 'section' => 'inventory', 'search' => 'brands'])

@section('content')
@include('inventory.alerts.success')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        {{ $brands->links() }}
                    </div>
                    <div class="col-2">
                        <form method="get" action="/brands" autocomplete="off">
                            <input type="text" name="search" placeholder="{{ __('inventory.search') }}" value="{{ request('search') }}" class="form-control-sm" />
                            <button class="btn btn-simple btn-sm btn-selector" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="col-1 text-right">
                        <a href="{{ route('brands.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="col-1 text-right">
                        <a href="{{ route('brands.bkeys') }}" class="btn btn-simple btn-selector btn-sm">{{ __('inventory.BKEYs') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table" width="100%" cellspacing="0">
                        <thead>
                            <th><i class="fas fa-flag-checkered"></i></th>
                            <th scope="col-4">{{ __('inventory.brand') }}</th>
                            <th scope="col-2">{{ __('inventory.off_site') }}</th>
                            <th scope="col-2">{{ __('inventory.catalog_url') }}</th>
                            <th scope="col-2">{{ __('inventory.manufacturer') }}</th>
                            <th scope="col-2">{{ __('inventory.supplier') }}</th>
                            <th scope="col"><i class="fas fa-edit"></i></th>
                            <th scope="col"><i class="fas fa-times"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>
                                        @if ($brand->isactive == False)
                                        <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                        @else
                                        <span class="text-success"><i class="far fa-check-square"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $brand->brand }}</td>
                                    <td>@if($brand->off_site)<a href="{{ $brand->off_site }}" rel="nofollow" target="_blank">{{ $brand->off_site }}</a>@endif</td>
                                    <td>@if($brand->catalog_url)<a href="{{ $brand->catalog_url }}" rel="nofollow" target="_blank">{{ $brand->catalog_url }}</a>@endif</td>                                   

                                    <td>
                                    @if ($brand->ismanufacturer == False)
                                        <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                        @else
                                        <span class="text-success"><i class="far fa-check-square"></i></span>
                                        @endif
                                    </td>
                                    <td>
                                    @if ($brand->issupplier == False)
                                        <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                        @else
                                        <span class="text-success"><i class="far fa-check-square"></i></span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('brands.edit', $brand) }}" class="btn btn-simple btn-selector btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('brands.destroy', $brand) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-simple btn-delete btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to remove this brand? The records that contain it will continue to exist.') ? this.parentElement.submit() : ''">
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