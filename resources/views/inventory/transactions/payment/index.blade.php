@extends('inventory.layouts.app', ['page' => 'Payments', 'pageSlug' => 'payments', 'section' => 'transactions', 'search' => 'payments'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Payments</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('transactions.create', ['type' => 'payment']) }}" class="btn btn-sm btn-simple">New Payment</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('inventory.alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">Date</th>
                                <th scope="col"{{ __('inventory.provider') }}/th>
                                <th scope="col">Title</th>
                                <th scope="col">Method</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Reference</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td> {{ date('d-m-y', strtotime($transaction->created_at)) }}</td>
                                        <td><a href="{{ route('providers.show', $transaction->provider) }}">{{ $transaction->provider->name }}</a></td>
                                        <td> {{ $transaction->title }}</td>
                                        <td><a href="{{ route('methods.show', $transaction->method) }}">{{ $transaction->method->name }}</a></td>
                                        <td>{{ format_money($transaction->amount) }}</td>
                                        <td>{{ $transaction->reference }}</td>
                                        <td></td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('transactions.destroy', $transaction) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this payment? There will be no record left.') ? this.parentElement.submit() : ''">
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
                        {{ $transactions->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
