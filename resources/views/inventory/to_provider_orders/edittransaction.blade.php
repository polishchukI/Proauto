@extends('inventory.layouts.app', ['page' => 'Edit Income', 'pageSlug' => 'to_provider_orders', 'section' => 'transactions', 'search' => 'to_provider_orders'])

@section('content')
    
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit Transaction</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('to_provider_orders.show', $to_provider_order) }}" class="btn btn-sm btn-simple">Volver a la venta</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('to_provider_orders.transaction.update', ['to_provider_order' => $to_provider_order, 'transaction' => $transaction]) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <input type="hidden" name="to_provider_order_id" value="{{ $to_provider_order->id }}">
                            <input type="hidden" name="provider_id" value="{{ $to_provider_order->provider_id }}">
                            <input type="hidden" name="user_id" value="{{ $to_provider_order->user_id }}">

                            <h6 class="heading-small text-muted mb-4">Transaction Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-method">Transaction Type</label>
                                    <select name="type" id="input-method" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
                                        @foreach (['income' => 'Payment Received', 'expense' => 'Returned Paid'] as $type => $title)
                                            @if($type == old('type') or $type == $transaction->type)
                                                <option value="{{$type}}" selected>{{ $title }}</option>
                                            @else
                                                <option value="{{$type}}">{{ $title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('inventory.alerts.feedback', ['field' => 'payment_method_id'])
                                </div>
                                <div class="form-group{{ $errors->has('payment_method_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-method">{{ __('inventory.method') }}</label>
                                    <select name="payment_method_id" id="input-method" class="form-select form-control-alternative{{ $errors->has('payment_method_id') ? ' is-invalid' : '' }}" required>
                                        @foreach ($payment_methods as $payment_method)
                                            @if($payment_method['id'] == old('payment_method_id') or $payment_method['id'] == $transaction->payment_method_id)
                                                <option value="{{$payment_method['id']}}" selected>{{$payment_method['name']}}</option>
                                            @else
                                                <option value="{{$payment_method['id']}}">{{$payment_method['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('inventory.alerts.feedback', ['field' => 'payment_method_id'])
                                </div>

                                <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount">Amount</label>
                                    <input type="number" step=".01" name="amount" id="input-amount" class="form-control form-control-alternative" placeholder="Amount" value="{{ old('amount', abs($transaction->amount) ) }}" min="0" required>
                                    @include('inventory.alerts.feedback', ['field' => 'amount'])

                                </div>

                                <div class="form-group{{ $errors->has('reference') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-reference">Reference</label>
                                    <input type="text" name="reference" id="input-reference" class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}" placeholder="Reference" value="{{ old('reference', $transaction->reference) }}">
                                    @include('inventory.alerts.feedback', ['field' => 'reference'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection