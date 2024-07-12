@extends('inventory.layouts.app', ['page' => __('inventory.new_provider'), 'pageSlug' => 'provider', 'section' => 'providers', 'search' => 'providers'])
@section('content')

<div class="row">
    <div class="col-xl-12 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0"> {{ __('inventory.new_provider') }}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('providers.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('providers.store') }}" autocomplete="off">
                @csrf
                <h6 class="heading-small text-muted mb-4">{{ __('inventory.provider_information') }}</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('inventory.provider_name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required autofocus>
                                    @include('inventory.alerts.feedback', ['field' => 'name'])
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="form-control-label" for="input-hasprice">{{ __('inventory.provider_hasprice') }}</label>
                                <select name="hasprice" id="input-hasprice" class="form-control form-control-alternative{{ $errors->has('hasprice') ? ' is-invalid' : '' }}" required>
                                    @foreach (['None', 'Price', 'Webservice'] as $hasprice)
                                            <option value="{{$hasprice}}">{{$hasprice}}</option>
                                    @endforeach
                                </select>
                                @include('inventory.alerts.feedback', ['field' => 'hasprice'])
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="provider_code" class="control-label">{{ __('inventory.provider_provider_code') }}</label>
                                    <input class="form-control" required="required" name="provider_code" placeholder="{{ __('inventory.price_any_name') }}" type="text" value="{{ old('provider_code') }}">
                                    @include('inventory.alerts.feedback', ['field' => 'provider_code'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label class="form-control-label" for="input-spares_provider">{{ __('inventory.provider_spares_provider') }}</label>
                                <select name="spares_provider" id="input-spares_provider" class="form-control form-control-alternative{{ $errors->has('spares_provider') ? ' is-invalid' : '' }}" required>
                                    @foreach (['0'=>'Нет', '1'=>'Да'] as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label class="form-control-label" for="input-services_provider">{{ __('inventory.provider_services_provider') }}</label>
                                <select name="services_provider" id="input-services_provider" class="form-control form-control-alternative{{ $errors->has('services_provider') ? ' is-invalid' : '' }}" required>
                                    @foreach (['0'=>'Нет', '1'=>'Да'] as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('inventory.email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}">
                                    @include('inventory.alerts.feedback', ['field' => 'email'])
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone">{{ __('inventory.phone') }}</label>
                                    <input type="phone" name="phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}">
                                    @include('inventory.alerts.feedback', ['field' => 'phone'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('inventory.description') }}</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"value="{{ old('description') }}">
                                    @include('inventory.alerts.feedback', ['field' => 'description'])
                                </div>
                            </div>
                            <div class="col-lg-3 mt-4 text-center">
                                <button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.continue') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
