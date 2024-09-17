@extends('inventory.layouts.app', ['page' => __('inventory.returns_to_provider'), 'pageSlug' => 'returns_to_provider', 'section' => 'documents', 'search' => 'returns_to_provider'])

@section('content')
@include('inventory.alerts.success')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">{{ $returns_to_provider->links() }}</div>
                        <div class="col-4 text-right">{{-- <a href="{{ route('returns_to_provider.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a> --}}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead>
                                <th><i class="fas fa-flag-checkered"></i></th>
                                <th>{{ __('inventory.user') }}</th>
                                <th>{{ __('inventory.document') }}</th>
                                <th>{{ __('inventory.provider') }}</th>
                                <th>{{ __('inventory.total') }}</th>
                                <th><i class="fas fa-money-bill-wave"></i></th>
                                <th><i class="fas fa-print"></i></th>                                
                                <th>{{ __('inventory.delete') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($returns_to_provider as $return_to_provider)
                                    <tr>
                                        <td>
                                            @if (!$return_to_provider->finalized_at)
                                                <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else
                                                <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif
                                        </td>
                                        <td>{{ $return_to_provider->user->name }}</td>
                                        <td>
                                            <a href="{{ route('returns_to_provider.show', ['return_to_provider' => $return_to_provider]) }}" data-toggle="tooltip" data-placement="bottom" title="View">
                                                {{ __('inventory.return_to_provider') }} №{{ $return_to_provider->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($return_to_provider->created_at)) }}
                                            </a>                                            
                                        </td>
                                        <td><a href="{{ route('providers.show', $return_to_provider->provider) }}">{{ $return_to_provider->provider->name }}</td>
                                        <td>{{ $return_to_provider->total_amount }} /{{ $return_to_provider->currency }}/</td>
                                        <!-- <payments> -->
                                        <td>
                                        @if ($return_to_provider->finalized_at)
                                            @if(($return_to_provider->total_amount - $return_to_provider->transactions->sum('amount')) == 0)
                                                <span class="text-success"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
                                            @else
                                            <a href="{{ route('returns_to_provider.pay', $return_to_provider) }}" data-toggle="tooltip" class="btn btn-simple bnt-sm btn-pay" data-placement="bottom" title="{{$return_to_provider->total_amount + $return_to_provider->transactions->sum('amount')}}" target="_blank">
                                                <span class="text-danger"><i class="fas fa-dollar-sign" aria-hidden="true"></i></span>
                                            </a>
                                            @endif
                                            @else
                                                <span>{{-- $receipt->total_amount + $receipt->transactions->sum('amount') --}}</span>
                                            @endif
                                        </td>
                                        <!-- <payments> -->
                                        <td>
                                            <a href="{{ route('returns_to_provider.print', $return_to_provider) }}" class="btn btn-sm btn-simple btn-print" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.print') }}" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('returns_to_provider.destroy', ['return_to_provider' => $return_to_provider]) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-simple btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this return_to_provider? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
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
                        {{ $returns_to_provider->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
