@extends('inventory.layouts.app', ['page' => __('inventory.new_transfer'), 'pageSlug' => 'transfers', 'section' => 'transactions', 'search' => 'transfers'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{ __('inventory.new_transfer') }}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('transfers.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('transfer.store') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <h6 class="heading-small text-muted mb-4">{{ __('inventory.transfer_information') }}</h6>
                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-title">{{ __('inventory.title') }}</label>
                            <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" required autofocus>
                            @include('inventory.alerts.feedback', ['field' => 'title'])
                        </div>
                        <div class="form-group{{ $errors->has('sender_method_id') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-method">{{ __('inventory.sender_method') }}</label>
                            <select name="sender_method_id" id="input-method" class="form-select form-control-alternative{{ $errors->has('sender_method_id') ? ' is-invalid' : '' }}" required>
                                @foreach ($methods as $payment_method)
                                    @if($payment_method['id'] == old('sender_method_id'))
                                        <option value="{{$payment_method['id']}}" selected>{{$payment_method['name']}}</option>
                                    @else
                                        <option value="{{$payment_method['id']}}">{{$payment_method['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @include('inventory.alerts.feedback', ['field' => 'sender_method_id'])
                        </div>
                        <div class="form-group{{ $errors->has('receiver_method_id') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-method">{{ __('inventory.receiver_method') }}</label>
                            <select name="receiver_method_id" id="input-method" class="form-select form-control-alternative{{ $errors->has('receiver_method_id') ? ' is-invalid' : '' }}" required>
                                @foreach ($methods as $payment_method)
                                    @if($payment_method['id'] == old('receiver_method_id'))
                                        <option value="{{$payment_method['id']}}" selected>{{$payment_method['name']}}</option>
                                    @else
                                        <option value="{{$payment_method['id']}}">{{$payment_method['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @include('inventory.alerts.feedback', ['field' => 'receiver_method_id'])
                        </div>
                        <div class="form-group{{ $errors->has('sended_amount') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-sended_amount">{{ __('inventory.amount_sent') }}</label>
                            <input type="number" step=".01" name="sended_amount" id="input-sended_amount" class="form-control form-control-alternative" value="{{ old('sended_amount') }}" min="0" required>
                            @include('inventory.alerts.feedback', ['field' => 'amount'])
                        </div>
                        <div class="form-group{{ $errors->has('received_amount') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-received_amount">{{ __('inventory.amount_recieved') }}</label>
                            <input type="number" step=".01" name="received_amount" id="input-received_amount" class="form-control form-control-alternative" value="{{ old('received_amount') }}" min="0" required>
                            @include('inventory.alerts.feedback', ['field' => 'received_amount'])
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group{{ $errors->has('reference') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-reference">{{ __('inventory.reference_doc') }}</label>
                                    <input type="text" name="reference" id="input-reference" class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}" value="{{ old('reference') }}">
                                    @include('inventory.alerts.feedback', ['field' => 'reference'])
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.save') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection