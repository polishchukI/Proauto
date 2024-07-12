@extends('inventory.layouts.app', ['page' => __('inventory.new_warehouse'), 'pageSlug' => 'warehouses', 'section' => 'inventory', 'search' => 'warehouses'])

@section('content')
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('inventory.new_warehouse') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('warehouses.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('warehouses.store') }}" autocomplete="off">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">{{ __('inventory.warehouse_info') }}</h6>
                        <div class="row">
                            <div class="col-3">                                    
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('inventory.warehouse') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="{{ __('inventory.warehouse') }}" required>
                                    @include('inventory.alerts.feedback', ['field' => 'name'])
                                </div>
                            </div>
                            <div class="col-3">                                    
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('inventory.description') }}</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative" placeholder="{{ __('inventory.description') }}">
                                    @include('inventory.alerts.feedback', ['field' => 'description'])
                                </div>
                            </div>
                            <div class="col-1">                                    
                                <div class="form-group{{ $errors->has('active') ? 'has-error' : ''}}">
                                    <div class="custom-control custom-switch mt-4">
                                        <input type="checkbox" class="custom-control-input" id="active" name="active">
                                        <label class="custom-control-label text-success" for="active">{{ __('inventory.active') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">                                    
                                <div class="form-group{{ $errors->has('address') ? 'has-error' : ''}}">
                                    <div class="custom-control custom-switch mt-4">
                                        <input type="checkbox" class="custom-control-input" id="address" name="address">
                                        <label class="custom-control-label text-success" for="address">{{ __('inventory.address_wh') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
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