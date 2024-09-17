@extends('inventory.layouts.app', ['page' => __('inventory.client_order_corrections'), 'pageSlug' => 'client_order_corrections', 'section' => 'documents', 'search' => 'client_order_corrections'])

@section('content')
    @include('inventory.alerts.success')
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                                {{ $client_order_corrections->links() }}
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('client_order_corrections.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
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
                                @foreach ($client_order_corrections as $client_order_correction)
                                    <tr>
                                        <td>
                                            @if (!$client_order_correction->finalized_at)
                                                <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else
                                                <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif
                                        </td>
                                        <td>{{ $client_order_correction->user->name }}</td>
                                        <td>
                                            <a href="{{ route('client_order_corrections.show', ['client_order_correction' => $client_order_correction]) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <b>{{ __('inventory.client_order_correction') }} №{{ $client_order_correction->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($client_order_correction->created_at)) }}</b>
                                            </a>                                            
                                        </td>
                                        <td><a href="{{ route('clients.show', $client_order_correction->client) }}">{{ $client_order_correction->client->name }}</td>
                                        <td>{{-- $client_order_correction->transactions->sum('amount') --}} /{{ $client_order_correction->currency }}/</td>
                                        <td>
                                        {{-- @if ($client_order_correction->finalized_at)
                                            @if(($client_order_correction->total_amount - $client_order_correction->transactions->sum('amount'))==0)
                                                <span class="text-success"><i class="fas fa-dollar-sign"></i></span>
                                            @else
                                            <a href="{{ route('client_order_corrections.pay', $client_order_correction) }}" class="btn btn-simple bnt-sm btn-pay" data-toggle="tooltip" data-placement="bottom" title="{{ $client_order_correction->total_amount - $client_order_correction->transactions->sum('amount') }}" target="_blank">
                                                <span class="text-danger"><i class="fas fa-dollar-sign"></i></span>
                                            </a>
                                            @endif
                                        @else
                                            <span>{{$client_order_correction->total_amount - $client_order_correction->transactions->sum('amount')}}</span>
                                        @endif --}}
                                        </td>
                                        <td>
                                            <a href="{{ route('client_order_corrections.print', $client_order_correction) }}" class="btn btn-sm btn-simple btn-print" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.print') }}" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('client_order_corrections.destroy', $client_order_correction) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this client_order_correction? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
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
                                {{ $client_order_corrections->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
