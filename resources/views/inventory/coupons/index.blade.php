@extends('inventory.layouts.app', ['page' => 'List of Coupons', 'pageSlug' => 'coupons', 'section' => 'shop_settings', 'search' => 'coupons'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Coupons</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('coupons.create') }}" class="btn btn-simple btn-sm">New Coupon</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('inventory.alerts.success')
                    <div class="">
						<table class="table tablesorter" id="dataTable" width="100%" cellspacing="0">
                            <thead class=" text-primary">
                                <th scope="col">№</th>
                                <th scope="col">Code</th>
                                <th scope="col">Type</th>
                                <th scope="col">Value</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
										<td>{{ $coupon->code }}</td>
										<td>{{ $coupon->type }}</td>
                                        <td>{{ $coupon->value }}</td>
										<td class="td-actions text-right">
                                            <a href="{{ route('coupons.edit', $coupon) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
										</td>
										<td class="td-actions text-right">											
                                            <form action="{{ route('coupons.destroy', $coupon) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this coupon? Records of payments made to him will not be deleted.') ? this.parentElement.submit() : ''">
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
                        {{ $coupons->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection