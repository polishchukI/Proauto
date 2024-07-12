@extends('inventory.layouts.app', ['page' => __('inventory.brands'), 'pageSlug' => 'brands', 'section' => 'inventory', 'search' => 'brands'])

@section('content')
@include('inventory.alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h4 class="card-title">{{ __('inventory.brands') }}</h4>
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
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <th scope="col-4">{{ __('inventory.brand') }}</th>
                                <th scope="col-2">{{ __('inventory.active') }}</th>
                                <th scope="col-2">{{ __('inventory.manufacturer') }}</th>
                                <th scope="col-2">{{ __('inventory.supplier') }}</th>
                                <th scope="col-2"></th>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
										<td>{{ $brand->brand }}</td>
										<td>
                                            @if ($brand->isactive == False)
                                            <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else
                                            <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif
                                        </td>
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
@push('js')
<script src="{{ asset('assets') }}/js/datatables.js" defer></script>
@endpush