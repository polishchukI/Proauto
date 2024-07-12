@extends('inventory.layouts.app', ['page' => __('inventory.returns_from_the_client'), 'pageSlug' => 'returns_from_the_client', 'section' => 'documents', 'search' => 'returns_from_the_client'])

@section('content')
@include('inventory.alerts.success')
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory.returns_from_the_client') }}</h4>
                        </div>
                        <div class="col-4 text-right"></div>
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
                                @foreach ($returns_from_the_client as $return_from_the_client)
                                    <tr>
                                        <td>
                                            @if (!$return_from_the_client->finalized_at)
                                                <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else
                                                <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif
                                        </td>
                                        <td>{{ $return_from_the_client->user->name }}</td>
                                        <td>
                                            <a href="{{ route('returns_from_the_client.show', ['return_from_the_client' => $return_from_the_client]) }}" data-toggle="tooltip" data-placement="bottom" title="View">
                                                {{ __('inventory.return_from_the_client') }} №{{ $return_from_the_client->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($return_from_the_client->created_at)) }}
                                            </a>                                            
                                        </td>
                                        <td><a href="{{ route('clients.show', $return_from_the_client->client) }}">{{ $return_from_the_client->client->name }}</td>
                                        <td>{{ $return_from_the_client->total_amount }} /{{ $return_from_the_client->currency }}/</td>
                                        <!-- <payments> -->
                                        <td>
                                            @if ($return_from_the_client->finalized_at)
                                            @if(($return_from_the_client->total_amount + $return_from_the_client->transactions->sum('amount'))==0)
                                            <span class="text-success"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
                                            @else
                                            <a href="{{ route('return_from_the_clients.pay', $return_from_the_client) }}" data-toggle="tooltip" class="btn btn-simple bnt-sm btn-pay" data-placement="bottom" title="{{$return_from_the_client->total_amount + $return_from_the_client->transactions->sum('amount')}}" target="_blank">
                                                <span class="text-danger"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
                                            </a>
                                            @endif
                                            @else
                                            <span>{{-- $return_from_the_client->total_amount + $return_from_the_client->transactions->sum('amount') --}}</span>
                                            @endif
                                        </td>
                                        <!-- <payments> -->
                                        <td>
                                            <a href="{{ route('returns_from_the_client.print', $return_from_the_client) }}" class="btn btn-sm btn-simple btn-print" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.print') }}" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('returns_from_the_client.destroy', ['return_from_the_client' => $return_from_the_client]) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this return_from_the_client? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
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
                        {{ $returns_from_the_client->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
