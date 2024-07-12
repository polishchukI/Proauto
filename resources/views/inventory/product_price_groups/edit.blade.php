@extends('inventory.layouts.app', ['page' => __('inventory.edit_product_price_group'), 'pageSlug' => 'product_price_groups', 'section' => 'inventory', 'search' => 'product_price_groups'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{__('inventory.edit_product_price_group')}}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('product_price_groups.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('product_price_groups.update', $product_price_group) }}" autocomplete="off">
                            @csrf
                            @method('put')
                            {{--<h6 class="heading-small text-muted mb-4">{{__('inventory.product_price_group_information')}}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Name</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name', $product_price_group->name) }}" required autofocus>
                                    @include('inventory.alerts.feedback', ['field' => 'name'])
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.save') }}</button>
                                </div>
                            </div>--}}
                            <h6 class="heading-small text-muted mb-4">{{__('inventory.product_price_group_information')}}</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{__('inventory.name')}}</label>
                                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name', $product_price_group->name) }}" required autofocus>
                                            @include('inventory.alerts.feedback', ['field' => 'name'])
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group{{ $errors->has('surcharge') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-surcharge">{{__('inventory.surcharge')}}</label>
                                            <input type="number" name="surcharge" id="input-surcharge" class="form-control form-control-alternative{{ $errors->has('surcharge') ? ' is-invalid' : '' }}" default="0" placeholder="{{__('inventory.surcharge')}}" value="{{ old('surcharge', $product_price_group->surcharge) }}" required>
                                            @include('inventory.alerts.feedback', ['field' => 'surcharge'])
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group{{ $errors->has('surcharge_coefficient') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-surcharge_coefficient">{{__('inventory.surcharge_coefficient')}}</label>
                                            <input type="number" name="surcharge_coefficient" id="input-surcharge_coefficient" class="form-control form-control-alternative{{ $errors->has('surcharge_coefficient') ? ' is-invalid' : '' }}" default="0" placeholder="{{__('inventory.surcharge_coefficient')}}" value="{{ old('surcharge_coefficient', $product_price_group->surcharge_coefficient) }}" required>
                                            @include('inventory.alerts.feedback', ['field' => 'surcharge_coefficient'])
                                        </div>
                                    </div>
                                </div>
                                <div class="row">									
                                    <div class="col-10">
                                        <div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-comment">{{__('inventory.comment')}}</label>
                                            <input type="text" name="comment" id="input-comment" class="form-control form-control-alternative{{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.comment')}}" value="{{ old('comment', $product_price_group->comment) }}" required>
                                            @include('inventory.alerts.feedback', ['field' => 'comment'])
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-sm btn-simple btn-success mt-4">{{__('inventory.save')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
