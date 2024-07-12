@extends('inventory.layouts.app', ['page' => __('inventory.user_profile'), 'pageSlug' => 'profile', 'section' => 'users', 'search' => 'users'])

@section('content')
@include('inventory.alerts.success')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('inventory.edit_user_profile') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label>{{ __('inventory.user_name') }}</label>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', auth()->user()->name) }}">
                                    @include('inventory.alerts.feedback', ['field' => 'name'])
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label>{{ __('inventory.user_email') }}</label>
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', auth()->user()->email) }}">
                                    @include('inventory.alerts.feedback', ['field' => 'email'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group{{ $errors->has('twitter') ? ' has-danger' : '' }}">
                                    <label>{{ __('inventory.user_twitter') }}</label>
                                    <input type="twitter" name="twitter" class="form-control{{ $errors->has('twitter') ? ' is-invalid' : '' }}" value="{{ old('twitter', auth()->user()->twitter) }}">
                                    @include('inventory.alerts.feedback', ['field' => 'twitter'])
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group{{ $errors->has('google') ? ' has-danger' : '' }}">
                                    <label>{{ __('inventory.user_google') }}</label>
                                    <input type="google" name="google" class="form-control{{ $errors->has('google') ? ' is-invalid' : '' }}" value="{{ old('google', auth()->user()->google) }}">
                                    @include('inventory.alerts.feedback', ['field' => 'google'])
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group{{ $errors->has('facebook') ? ' has-danger' : '' }}">
                                    <label>{{ __('inventory.user_facebook') }}</label>
                                    <input type="facebook" name="facebook" class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}" value="{{ old('facebook', auth()->user()->facebook) }}">
                                    @include('inventory.alerts.feedback', ['field' => 'facebook'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group{{ $errors->has('default_warehouse_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-default_warehouse_id">{{ __('inventory.user_default_warehouse') }}</label>
                                    <select name="default_warehouse_id" id="input-warehouse" class="form-select form-control-alternative{{ $errors->has('default_warehouse_id') ? ' is-invalid' : '' }}">
                                        <option value="0">{{ __('modal.not_specified') }}</option>
                                        @foreach ($warehouses as $warehouse)
                                        @if($warehouse['id'] == auth()->user()->default_warehouse_id)
                                        <option value="{{ $warehouse['id'] }}" selected>{{ $warehouse->name }}</option>
                                        @else
                                        <option value="{{ $warehouse['id'] }}">{{ $warehouse['name'] }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @include('inventory.alerts.feedback', ['field' => 'default_warehouse_id'])
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group{{ $errors->has('default_currency') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-default_currency">{{ __('inventory.user_default_currency') }}</label>
                                    <select name="default_currency" id="input-default_currency" class="form-select form-control-alternative{{ $errors->has('default_currency') ? ' is-invalid' : '' }}">
                                        <option value="">{{ __('inventory.not_specified') }}</option>
                                        @foreach ($currencies as $currency)
                                        @if($currency['code'] == auth()->user()->default_currency)
                                        <option value="{{$currency['code']}}" selected>{{$currency['name']}}</option>
                                        @else
                                        <option value="{{$currency['code']}}">{{$currency['name']}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @include('inventory.alerts.feedback', ['field' => 'default_currency'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group{{ $errors->has('unfinalize') ? ' has-danger' : '' }}">
                                    <select name="unfinalize" id="input-unfinalize" class="form-select form-control-alternative{{ $errors->has('unfinalize') ? ' is-invalid' : '' }}" required>
                                        @foreach (['off'=>__('inventory.unfinalize_off'), 'on'=>__('inventory.unfinalize_on')] as $key=>$value)
                                        @if($key == old('unfinalize') or $key == auth()->user()->unfinalize)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-simple btn-sm btn-success">{{ __('inventory.save') }}</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('inventory.change_user_password') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')
                        @include('inventory.alerts.success', ['key' => 'password_status'])
                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>{{ __('inventory.current_user_password') }}</label>
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" value="" required>
                            @include('inventory.alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>{{ __('inventory.new_user_password') }}</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="" required>
                            @include('inventory.alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('inventory.confirm_new_user_password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" value="" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-simple btn-sm btn-success">{{ __('inventory.change_password') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                @if(auth()->user()->avatar)
                                <img class="avatar" src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->email }}">
                                @else
                                <img class="avatar" src="/images/admin/avatar_placeholder.jpg" alt="{{ __('inventory.no_avatar') }}">
                                @endif
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </a>
                            <p class="description"></p>
                        </div>
                    </p>
                    <div class="card-description"></div>
                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook" onclick="window.location.href='{{ auth()->user()->facebook }}';">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter" onclick="window.location.href='{{ auth()->user()->twitter }}';">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google" onclick="window.location.href='{{ auth()->user()->google }}';">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection