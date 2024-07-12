@extends('inventory.layouts.app', ['page' => 'New Service', 'pageSlug' => 'services', 'section' => 'services', 'search' => 'services'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New service</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('services.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('services.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">service Information</h6>
                            <div class="pl-lg-4">
								<div class="row">
                 
                                    <div class="col-4">                                    
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">service</label>
                                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="service" value="{{ old('name') }}" required>
                                            @include('inventory.alerts.feedback', ['field' => 'name'])
                                        </div>
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