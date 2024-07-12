@extends('inventory.layouts.app', ['page' => __('inventory.new_transaction'), 'pageSlug' => 'salary_payments', 'section' => 'inventory', 'search' => 'salary_payments'])

@section('content')    
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">New Transaction</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('salary_payments.show', $salary_payment) }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('salary_payments.payment.store', $salary_payment) }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="salary_payment_id" value="{{ $salary_payment->id }}">
                    <input type="hidden" name="provider_id" value="{{ $salary_payment->provider_id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                    <h6 class="heading-small text-muted mb-4">{{__('inventory.transaction_information')}}</h6>
                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-method">{{__('inventory.transaction_type')}}</label>
                            <select name="type" id="input-method" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
                                @if(isset($salary_payment->id))
                                <option value="expense" selected>{{__('inventory.expense_of_money_on_salary')}}</option>
                                @else
                                @foreach (['income' => __('inventory.expense_of_money_on_salary'), 'expense' => __('inventory.expense_of_money_on_salary')] as $type => $title)
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

                        <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-amount">{{__('inventory.total_amount')}}</label>
                            @if($salary_payment->id)
                            <input type="number" step=".01" name="amount" id="input-amount" class="form-control form-control-alternative" placeholder="Amount" value="{{ $salary_payment->total_amount }}" required>
                            @else
                            <input type="number" step=".01" name="amount" id="input-amount" class="form-control form-control-alternative" placeholder="Amount" value="{{ old('amount') }}" required>
                            @endif
                            @include('inventory.alerts.feedback', ['field' => 'amount'])

                        </div>
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group{{ $errors->has('reference') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-reference">{{__('inventory.reference_doc')}}</label>
                                    @if($salary_payment->id)
                                    <input type="text" name="reference" id="input-reference" class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}" placeholder="Reference" value="Salary Payment № {{ $salary_payment->id }}">
                                    @else
                                    <input type="text" name="reference" id="input-reference" class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}" placeholder="Reference" value="{{ old('reference') }}">
                                    @endif
                                @include('inventory.alerts.feedback', ['field' => 'reference'])
                                </div>
                            </div>
                            <div class="col-3 mt-4">
                                <button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection