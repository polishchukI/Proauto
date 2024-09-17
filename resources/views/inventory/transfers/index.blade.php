@extends('inventory.layouts.app', ['page' => __('inventory.transfers'), 'pageSlug' => 'transfers', 'section' => 'transactions', 'search' => 'transfers'])

@section('content')
@include('inventory.alerts.success')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        {{ $transfers->links() }}
                    </div>
                    <div class="col-2">
                        <form method="get" action="/transfers" autocomplete="off">
                            <input type="text" name="search" placeholder="{{ __('inventory.search') }}" value="{{ request('search') }}" class="form-control-sm" />
                                <button class="btn btn-simple btn-sm btn-selector" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="col-2 text-right">
                            <a href="{{ route('transfers.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class=" text-primary">
                            <th><i class="fas fa-flag-checkered"></i></th>
                            <th>{{ __('inventory.user') }}</th>
                            <th>{{ __('inventory.date') }}</th>
                            <th>{{ __('inventory.title') }}</th>
                            <th>{{ __('inventory.sender_method') }}</th>
                            <th>{{ __('inventory.receiver_method') }}</th>
                            <th>{{ __('inventory.reference_doc') }}</th>
                            <th>{{ __('inventory.amount_sent') }}</th>
                            <th>{{ __('inventory.amount_recieved') }}</th>
                            <th><i class="fas fa-print"></i></th>
                            <th>{{ __('inventory.delete') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($transfers as $transfer)
                                <tr>
                                    <td>{{ date('d-m-y', strtotime($transfer->created_at)) }}</td>
                                    <td style="max-width:150px">{{ $transfer->title }}</td>
                                    <td><a href="{{ route('methods.show', $transfer->sender_method) }}">{{ $transfer->sender_method->name }}</a></td>
                                    <td><a href="{{ route('methods.show', $transfer->receiver_method) }}">{{ $transfer->receiver_method->name }}</a></td>
                                    <td>{{ $transfer->reference }}</td>
                                    <td>${{ $transfer->sended_amount }}</td>
                                    <td>${{ $transfer->received_amount }}</td>
                                    <td>
                                        <a href="{{ route('transfers.print', $sale) }}" class="btn btn-sm btn-simple btn-print" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.print') }}" target="_blank">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('transfers.destroy', $transfer) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-simple btn-sm btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this transfer? There will be no record left.') ? this.parentElement.submit() : ''">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $transfers->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
