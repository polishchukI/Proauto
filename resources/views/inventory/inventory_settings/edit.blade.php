@extends('inventory.layouts.app', ['page' => __('Setting Management'), 'pageSlug' => 'inventory_settings', 'section' => 'settings', 'search' => 'inventory_settings'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Setting Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('inventory_settings.index') }}" class="btn btn-sm btn-simple">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('inventory_settings.update', $inventory_setting) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Product information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('option') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-option">{{ __('option') }}</label>
                                    <input type="text" name="option" id="input-option" class="form-control form-control-alternative{{ $errors->has('option') ? ' is-invalid' : '' }}" placeholder="{{ __('option') }}" value="{{ old('option', $inventory_setting->option) }}" required autofocus>
                                    @include('inventory.alerts.feedback', ['field' => 'option'])
                                </div>
                                <div class="form-group{{ $errors->has('value') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-value">{{ __('value') }}</label>
                                    <input type="text" name="value" id="input-value" class="form-control form-control-alternative{{ $errors->has('value') ? ' is-invalid' : '' }}" placeholder="{{ __('value') }}" value="{{ old('value', $inventory_setting->value) }}" required>
                                    @include('inventory.alerts.feedback', ['field' => 'value'])
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
