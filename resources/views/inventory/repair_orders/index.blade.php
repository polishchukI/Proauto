@extends('inventory.layouts.app', ['page' => __('inventory.repair_orders'), 'pageSlug' => 'repair_orders', 'section' => 'documents', 'search' => 'repair_orders'])

@section('content')
    @include('inventory.alerts.success')
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory.repair_orders') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('repair_orders.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
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
                                <th>{{ __('inventory.client') }}</th>
                                <th>{{ __('inventory.total') }}</th>
                                <th><i class="fas fa-money-bill-wave"></i></th>
                                <th><i class="fas fa-print"></i></th>
                                <th>{{ __('inventory.delete') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($repair_orders as $repair_order)
                                    <tr>
                                        <td>
                                            @if (!$repair_order->finalized_at)
                                                <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else
                                                <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif
                                        </td>
                                        <td>{{ $repair_order->user->name }}</td>
                                        <td>
                                            <a href="{{ route('repair_orders.show', ['repair_order' => $repair_order]) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <b>{{ __('inventory.repair_order') }} №{{ $repair_order->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($repair_order->created_at)) }}</b>
                                            </a>                                            
                                        </td>
                                        <td><a href="{{ route('clients.show', $repair_order->client) }}">{{ $repair_order->client->name }}</td>
                                        <td>{{ $repair_order->transactions->sum('amount') }} /{{ $repair_order->currency }}/</td>
                                        <td>
                                        @if ($repair_order->finalized_at)
                                            @if(($repair_order->total_amount - $repair_order->transactions->sum('amount'))==0)
                                                <span class="text-success"><i class="fas fa-dollar-sign"></i></span>
                                            @else
                                            <a href="{{ route('repair_orders.pay', $repair_order) }}" class="btn btn-simple bnt-sm btn-pay" data-toggle="tooltip" data-placement="bottom" title="{{ $repair_order->total_amount - $repair_order->transactions->sum('amount') }}" target="_blank">
                                                <span class="text-danger"><i class="fas fa-dollar-sign"></i></span>
                                            </a>
                                            @endif
                                        @else
                                            <span>{{$repair_order->total_amount - $repair_order->transactions->sum('amount')}}</span>
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('repair_orders.print', $repair_order) }}" class="btn btn-sm btn-simple btn-print" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.print') }}" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('repair_orders.destroy', $repair_order) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this repair_order? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
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
                        {{ $repair_orders->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
