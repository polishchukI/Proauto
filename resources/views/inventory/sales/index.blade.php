@extends('inventory.layouts.app', ['page' => __('inventory.sales'), 'pageSlug' => 'sales', 'section' => 'documents', 'search' => 'sales'])

@section('content')
    @include('inventory.alerts.success')
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                                {{ $sales->links() }}
                        </div>
                        <div class="col-2">
                            <form method="get" action="/sales" autocomplete="off">
                                <input type="text" name="search" placeholder="{{ __('inventory.search') }}" value="{{ request('search') }}" class="form-control-sm" />
                                <button class="btn btn-simple btn-sm btn-selector" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="col-2 text-right">
                            <a href="{{ route('sales.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
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
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>
                                            @if (!$sale->finalized_at)
                                                <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else
                                                <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif
                                        </td>
                                        <td>{{ $sale->user->name }}</td>
                                        <td>
                                            <a href="{{ route('sales.show', ['sale' => $sale]) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <b>{{ __('inventory.sale') }} №{{ $sale->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($sale->created_at)) }}</b>
                                            </a>                                            
                                        </td>
                                        <td><a href="{{ route('clients.show', $sale->client) }}">{{ $sale->client->name }}</td>
                                        <td>{{ $sale->transactions->sum('amount') }} /{{ $sale->currency }}/</td>
                                        <td>
                                        @if ($sale->finalized_at)
                                            @if(($sale->total_amount - $sale->transactions->sum('amount'))==0)
                                                <span class="text-success"><i class="fas fa-dollar-sign"></i></span>
                                            @else
                                            <a href="{{ route('sales.pay', $sale) }}" class="btn btn-simple bnt-sm btn-pay" data-toggle="tooltip" data-placement="bottom" title="{{ $sale->total_amount - $sale->transactions->sum('amount') }}" target="_blank">
                                                <span class="text-danger"><i class="fas fa-dollar-sign"></i></span>
                                            </a>
                                            @endif
                                        @else
                                            <span>{{$sale->total_amount - $sale->transactions->sum('amount')}}</span>
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('sales.print', $sale) }}" class="btn btn-sm btn-simple btn-print" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.print') }}" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('sales.destroy', $sale) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this sale? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
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
                                {{ $sales->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
