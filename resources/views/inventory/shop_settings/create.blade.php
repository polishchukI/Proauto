@extends('inventory.layouts.app', ['page' => 'New Shop Setting', 'pageSlug' => 'shop_settings', 'section' => 'settings', 'search' => 'shop_settings'])

@section('content')
    
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New Shop Setting</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('shop_settings.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('shop_settings.store') }}" autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Setting information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">name</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @include('inventory.alerts.feedback', ['field' => 'name'])
                                </div>
                                <div class="form-group{{ $errors->has('value') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-value">Value</label>
                                    <input type="text" name="value" id="input-value" class="form-control form-control-alternative{{ $errors->has('value') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('value') }}" required>
                                    @include('inventory.alerts.feedback', ['field' => 'value'])
                                </div>
                                <div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-comment">{{ __('comment') }}</label>
                                    <input type="text" name="comment" id="input-comment" class="form-control form-control-alternative{{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="{{ __('comment') }}" comment="{{ old('comment', $shop_setting->comment) }}" required>
                                    @include('inventory.alerts.feedback', ['field' => 'comment'])
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
