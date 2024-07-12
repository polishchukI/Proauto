@extends('inventory.layouts.app', ['page' => 'Transactions', 'pageSlug' => 'transactions', 'section' => 'transactions', 'search' => ''])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Transactions</h4>
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="btn btn-sm btn-simple" data-toggle="modal" data-target="#transactionModal">New Transaction</button>
                            <button type="button" class="btn btn-sm btn-simple" data-toggle="modal" data-target="#transactionsExportModal">Export</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('inventory.alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th>Date</th>
                                <th>Type</th>
                                <th>Contragent</th>
                                <th>Title</th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Reference</th>
                                <th>Transfer</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ date('d-m-y', strtotime($transaction->created_at)) }}</td>
                                        <td style="text-transform: uppercase;">
											<a href="{{ route('transactions.show', $transaction) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="Show Transaction">
												{{ $transaction->type }} {{ $transaction->id }}
											</a>
										</td>
                                        <td>
                                            @if ($transaction->client)
                                                <a href="{{ route('clients.show', $transaction->client) }}">{{ $transaction->client->name }}</a>
                                            @elseif ($transaction->provider)
                                                <a href="{{ route('providers.show', $transaction->provider) }}">{{ $transaction->provider->name }}</a>
                                            @else
                                                Does not apply
                                            @endif
                                        </td>
										<td style="max-width:150px">{{ $transaction->title }}</td>
                                        <td><a href="{{ route('methods.show', $transaction->method) }}">{{ $transaction->method->name }}</a></td>
                                        <td>{{ format_money($transaction->amount) }}</td>
                                        <td>{{ $transaction->reference }}</td>
                                        <td>
                                            @if ($transaction->transfer)
                                                <a href="{{ route('transfer.show', $transaction->transfer) }}">ID {{ $transaction->transfer->id }}</a>
                                            @else
                                                Does not apply
                                            @endif
                                        </td>
                                        <td class="td-actions text-right">
                                            @if ($transaction->sale_id)
                                                <a href="{{ route('sales.show', $transaction->sale) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            @elseif ($transaction->transfer_id)
                                                <a href="{{ route('transfer.show', $transaction->transfer) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            @else
                                                <!--a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a-->
                                                <form action="{{ route('transactions.destroy', $transaction) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to delete this transaction?') ? this.parentElement.submit() : ''">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
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
    <div class="modal fade" id="transactionsExportModal" tabindex="-1" role="dialog" aria-labelledby="transactionsExportModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<i class="fas fa-times"></i>
					</button>
                </div>
                <div class="modal-body">
					<div class="row">
                        <div class="col-6">
                            <div class="form-group{{ $errors->has('date_from') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-date_from">date_from</label>
                                <input type="date" name="date_from" id="input-date_from" class="form-control form-control-alternative{{ $errors->has('date_from') ? ' is-invalid' : '' }}" placeholder="date_from">
                                @include('inventory.alerts.feedback', ['field' => 'date_from'])
                            </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group{{ $errors->has('date_to') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-date_to">date_to</label>
                                    <input type="date" name="date_to" id="input-date_to" class="form-control form-control-alternative{{ $errors->has('date_to') ? ' is-invalid' : '' }}" placeholder="date_to">
                                    @include('inventory.alerts.feedback', ['field' => 'date_to'])
                                </div>
                            </div>
                        </div>
					<div class="row">
						<div class="col-6">
							<input type="hidden" name="user_id" value="{{ Auth::id() }}">
						</div>
						<div class="col-6">
							<button type="button" class="btn btn-sm btn-primary" OnClick="kpi_stats_show()">KPI stats show</button>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Transaction</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<i class="fas fa-times"></i>
					</button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('transactions.create', ['type' => 'payment']) }}" class="btn btn-sm btn-simple">Payment</a>
                        <a href="{{ route('transactions.create', ['type' => 'income']) }}" class="btn btn-sm btn-simple">Income</a>
                        <a href="{{ route('transactions.create', ['type' => 'expense']) }}" class="btn btn-sm btn-simple">Expense</a>
                        <a href="{{ route('transfer.create') }}" class="btn btn-sm btn-simple">Transfer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
