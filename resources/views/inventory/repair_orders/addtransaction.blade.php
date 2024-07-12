@extends('inventory.layouts.app', ['page' => __('inventory.new_transaction'), 'pageSlug' => 'sales', 'section' => 'inventory', 'search' => 'sales'])
@section('content')
<div class="row">
    <div class="col-xl-12 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{__('inventory.new_transaction')}}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('sales.transaction.store', $sale) }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                    <input type="hidden" name="client_id" value="{{ $sale->client_id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <h6 class="heading-small text-muted mb-4">{{__('inventory.transaction_information')}}</h6>
                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-method">{{__('inventory.transaction_information')}}</label>
                            <select name="type" id="input-method" class="form-select form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
                                @if(isset($receipt->id))
                                <option value="income" selected>Оплата от покупателя</option>
                                @else
                                @foreach (['income' => 'Оплата от покупателя', 'expense' => 'Возврат оплаты покупателю'] as $type => $title)
                                    @if($type == old('type'))
                                        <option value="{{$type}}" selected>{{ $title }}</option>
                                    @else
                                        <option value="{{$type}}">{{ $title }}</option>
                                    @endif
                                @endforeach
                                @endif
                            </select>
                            @include('inventory.alerts.feedback', ['field' => 'payment_method_id'])
                        </div>
                        <div class="form-group{{ $errors->has('payment_method_id') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-method">{{ __('inventory.method') }}</label>
                            <select name="payment_method_id" id="input-method" class="form-select form-control-alternative{{ $errors->has('payment_method_id') ? ' is-invalid' : '' }}" required>
                                @foreach ($payment_methods as $payment_method)
                                    @if($payment_method['id'] == old('payment_method_id'))
                                        <option value="{{$payment_method['id']}}" selected>{{$payment_method['name']}}</option>
                                    @else
                                        <option value="{{$payment_method['id']}}">{{$payment_method['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @include('inventory.alerts.feedback', ['field' => 'payment_method_id'])
                        </div>
                        <div class="form-group{{ $errors->has('reference') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-reference">{{__('inventory.reference_doc')}}</label>
                            @if($sale->id)
                                <input type="text" name="reference" id="input-reference" class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.reference_doc')}}" value="Receipt № {{ $sale->id }}">
                            @else
                                <input type="text" name="reference" id="input-reference" class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.reference_doc')}}" value="{{ old('reference') }}">
                            @endif
                            @include('inventory.alerts.feedback', ['field' => 'reference'])
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount">{{__('inventory.total_amount')}}</label>
                                    @if($sale->id)
                                    <input type="number" step=".01" name="amount" id="input-amount" class="form-control form-control-alternative" placeholder="{{__('inventory.reference_doc')}}" value="{{ $sale->total_amount }}" required>
                                    @else
                                    <input type="number" step=".01" name="amount" id="input-amount" class="form-control form-control-alternative" placeholder="{{__('inventory.reference_doc')}}" value="{{ old('amount') }}" required>
                                    @endif
                                    @include('inventory.alerts.feedback', ['field' => 'amount'])
                                </div>
                            </div>
                            <div class="col-3 mt-4">
                                <button type="submit" class="btn btn-success btn-simple btn-sm">{{__('inventory.save')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection