@extends('inventory.layouts.app', ['page' => __('inventory.new_brand_rename'), 'pageSlug' => 'brand_renames-create', 'section' => 'brand_renames', 'search' => 'brand_renames'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{__('inventory.new_brand_rename')}}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('brand_renames.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('brand_renames.store') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('inventory.name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" autofocus require>
                                    @include('inventory.alerts.feedback', ['field' => 'name'])
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group{{ $errors->has('rename_from') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-rename_from">{{ __('inventory.brand_rename_from') }}</label>
                                    <input type="text" name="rename_from" id="input-rename_from" class="form-control form-control-alternative{{ $errors->has('rename_from') ? ' is-invalid' : '' }}" autofocus require>
                                    @include('inventory.alerts.feedback', ['field' => 'rename_from'])
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group{{ $errors->has('rename_to') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-rename_to">{{ __('inventory.brand_rename_to') }}</label>
                                    <input type="text" name="rename_to" id="input-rename_to" class="form-control form-control-alternative{{ $errors->has('rename_to') ? ' is-invalid' : '' }}" autofocus require>
                                    @include('inventory.alerts.feedback', ['field' => 'rename_to'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-comment">{{ __('inventory.comment') }}</label>
                                    <input type="text" name="comment" id="input-comment" class="form-control form-control-alternative{{ $errors->has('comment') ? ' is-invalid' : '' }}">
                                    @include('inventory.alerts.feedback', ['field' => 'comment'])
                                    </div>
                            </div>
                            <div class="col-3">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-sm btn-simple btn-success mt-4">{{__('inventory.save')}}</button>
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
