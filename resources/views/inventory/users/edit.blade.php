@extends('inventory.layouts.app', ['page' => __('User Management'), 'pageSlug' => 'users', 'section' => 'users', 'search' => 'users'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('inventory.user_management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-simple">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('users.update', $user) }}" autocomplete="off">
                            @csrf
                            @method('put')
                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}" required autofocus>
                                    @include('inventory.alerts.feedback', ['field' => 'name'])
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}" required>
                                    @include('inventory.alerts.feedback', ['field' => 'email'])
                                </div>
                                <div class="form-group{{ $errors->has('default_warehouse_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-default_warehouse_id">Default Warehouse</label>
                                    <select name="default_warehouse_id" id="input-warehouse" class="form-select form-control-alternative{{ $errors->has('default_warehouse_id') ? ' is-invalid' : '' }}">
                                        <option value="">{{ __('modal.not_specified') }}</option>
                                        @foreach ($warehouses as $warehouse)
                                        @if($warehouse['id'] == $user->default_warehouse_id)
                                        <option value="{{ $warehouse['id'] }}" selected>{{$warehouse->name}}</option>
                                        @else
                                        <option value="{{$warehouse['id']}}">{{$warehouse['name']}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @include('inventory.alerts.feedback', ['field' => 'default_warehouse_id'])
                                </div>
                                <div class="form-group{{ $errors->has('default_currency') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-default_currency">Default Currency</label>
                                    <select name="default_currency" id="input-default_currency" class="form-select form-control-alternative{{ $errors->has('default_currency') ? ' is-invalid' : '' }}">
                                        <option value="">{{ __('modal.not_specified') }}</option>
                                        @foreach ($currencies as $currency)
                                        @if($currency['code'] == $user->default_currency)
                                        <option value="{{$currency['code']}}" selected>{{$currency['name']}}</option>
                                        @else
                                        <option value="{{$currency['code']}}">{{$currency['name']}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @include('inventory.alerts.feedback', ['field' => 'default_currency'])
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="">
                                    @include('inventory.alerts.feedback', ['field' => 'password'])
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm Password') }}" value="">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection