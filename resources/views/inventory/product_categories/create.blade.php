@extends('inventory.layouts.app', ['page' => __('inventory.new_product_category'), 'pageSlug' => 'product_categories', 'section' => 'inventory', 'search' => 'product_categories'])

@section('content')
<div class="row">
    <div class="col-xl-12 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{__('inventory.new_product_category')}}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('product_categories.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('product_categories.store') }}" autocomplete="off">
                    @csrf

                    <h6 class="heading-small text-muted mb-4">{{__('inventory.product_category_information')}}</h6>
                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{__('inventory.product_category_name')}}</label>
                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.product_category_name')}}" value="{{ old('name') }}" required autofocus>
                            @include('inventory.alerts.feedback', ['field' => 'name'])
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-simple btn-sm mt-4">{{__('inventory.save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
