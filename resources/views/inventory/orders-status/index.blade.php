@extends('inventory.layouts.app', ['page' => 'List of Order Statuses', 'pageSlug' => 'order_statuses', 'section' => 'documents', 'search' => 'order_statuses'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Order Statuses</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('order_statuses.create') }}" class="btn btn-sm btn-simple"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('inventory.alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">Order Status</th>
                                <th scope="col">Status Color</th>
                                <th scope="col">Order Description</th>
                                <th scope="col">Edit</th>
                                <th scope="col">delete</th>
                            </thead>
                            <tbody>
                                @foreach ($ordersstatuses as $item)
                                    <tr>
										<td>{{ $item->name }}</td>
                                        <td style="background-color:{{ $item->status_color }}"> </td>
										<td>{{ $item->description }}</td>
                                        <td>
                                            <a href="{{ route('order_statuses.edit', $item) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('order_statuses.destroy', $item) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to remove this brand? The records that contain it will continue to exist.') ? this.parentElement.submit() : ''">
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
                        {{ $ordersstatuses->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
