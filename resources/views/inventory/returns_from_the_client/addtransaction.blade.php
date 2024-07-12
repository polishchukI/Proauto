@extends('inventory.layouts.app', ['page' => 'New Expence', 'pageSlug' => 'returns_to_provider', 'section' => 'inventory', 'search' => 'returns_to_provider'])
@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New Transaction</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('returns_to_provider.show', $return_to_provider) }}" class="btn btn-sm btn-simple">Volver a la venta</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('returns_to_provider.transaction.store', $return_to_provider) }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="return_to_provider_id" value="{{ $return_to_provider->id }}">
                            <input type="hidden" name="provider_id" value="{{ $return_to_provider->provider_id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <h6 class="heading-small text-muted mb-4">Transaction Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-method">Transaction Type</label>
									<select name="type" id="input-method" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
										@if(isset($return_to_provider->id))
										<option value="income" selected>Возврат оплаты от поставщика</option>
										@else
                                        @foreach (['income' => 'Возврат оплаты от поставщика', 'expense' => 'Оплата поставщику'] as $type => $title)
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
                                    <label class="form-control-label" for="input-amount">Amount</label>
									@if($return_to_provider->id)
									<input type="number" step=".01" name="amount" id="input-amount" class="form-control form-control-alternative" placeholder="Amount" value="{{ $return_to_provider->total_amount }}" required>
                                    @else
                                    <input type="number" step=".01" name="amount" id="input-amount" class="form-control form-control-alternative" placeholder="Amount" value="{{ old('amount') }}" required>
									@endif
                                    @include('inventory.alerts.feedback', ['field' => 'amount'])

                                </div>

                                <div class="form-group{{ $errors->has('reference') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-reference">Reference</label>
									@if($return_to_provider->id)
                                    <input type="text" name="reference" id="input-reference" class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}" placeholder="Reference" value="Возврат оплаты от поставщика № {{ $return_to_provider->id }}">
									@else
                                    <input type="text" name="reference" id="input-reference" class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}" placeholder="Reference" value="{{ old('reference') }}">
								    @endif
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