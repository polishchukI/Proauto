@extends('inventory.layouts.app', ['page' => __('inventory.edit_brand'), 'pageSlug' => 'brands', 'section' => 'inventory', 'search' => 'brands'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-xl-12 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{ __('inventory.edit_brand') }}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('brands.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('brands.update', $brand) }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <h6 class="heading-small text-muted mb-4">{{ __('inventory.brand_information') }}</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-4">                                    
                                <div class="form-group{{ $errors->has('brand') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-brand">{{ __('inventory.brand_name') }}</label>
                                    <input type="text" name="brand" id="input-brand" class="form-control form-control-alternative" placeholder="{{ __('inventory.brand_name') }}" value="{{ old('brand', $brand->brand) }}" required>
                                    @include('inventory.alerts.feedback', ['field' => 'brand'])
                                </div>
                            </div>
                            <div class="col-4">                                    
                                <div class="form-group{{ $errors->has('brand_group') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-brand_group">{{ __('inventory.brand_group') }}</label>
                                    <input type="text" name="brand_group" id="input-brand_group" class="form-control form-control-alternative" placeholder="{{ __('inventory.brand_group') }}" value="{{ old('brand_group', $brand->brand_group) }}">
                                    @include('inventory.alerts.feedback', ['field' => 'brand_group'])
                                </div>
                            </div>
                            <div class="col-2">                                    
                                <div class="form-group{{ $errors->has('off_site') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-off_site">{{ __('inventory.brand_site') }}</label>
                                    <input type="text" name="off_site" id="input-off_site" class="form-control form-control-alternative" placeholder="{{ __('inventory.brand_site') }}" value="{{ old('off_site', $brand->off_site) }}">
                                    @include('inventory.alerts.feedback', ['field' => 'off_site'])
                                </div>
                            </div>
                            <div class="col-2 text-center mt-4">
                                <button type="submit" class="btn btn-success btn-simple btn-sm">{{__('inventory.save')}}</button>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-2">                                    
                                <div class="form-group{{ $errors->has('ismanufacturer') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-ismanufacturer">{{ __('inventory.ismanufacturer') }}</label>
                                    <select name="ismanufacturer" id="input-ismanufacturer" class="form-control form-control-alternative{{ $errors->has('ismanufacturer') ? ' is-invalid' : '' }}" required>
                                        @foreach (['False'=>'No', 'True'=>'Yes'] as $key=>$value)
                                        @if($key == old('ismanufacturer') or $key == $brand->ismanufacturer)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">                                    
                                <div class="form-group{{ $errors->has('catalog_url') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-catalog_url">{{ __('inventory.catalog_uri') }}</label>
                                    <input type="text" name="catalog_url" id="input-catalog_url" class="form-control form-control-alternative" placeholder="{{ __('inventory.catalog_uri') }}" value="{{ old('catalog_url', $brand->catalog_url) }}">
                                    @include('inventory.alerts.feedback', ['field' => 'catalog_url'])
                                </div>
                            </div>
                            <div class="col-2">                                    
                                <div class="form-group{{ $errors->has('isshowable') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-isshowable">{{ __('inventory.isshowable') }}</label>
                                    <select name="isshowable" id="input-isshowable" class="form-control form-control-alternative{{ $errors->has('isshowable') ? ' is-invalid' : '' }}" required>
                                        @foreach (['False'=>'Not', 'True'=>'Active'] as $key=>$value)
                                        @if($key == old('isshowable') or $key == $brand->isshowable)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">                                    
                                <div class="form-group{{ $errors->has('isactive') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-isactive">{{ __('inventory.active') }}</label>
                                    <select name="isactive" id="input-isactive" class="form-control form-control-alternative{{ $errors->has('isactive') ? ' is-invalid' : '' }}" required>
                                        @foreach (['False'=>'Not', 'True'=>'Active'] as $key=>$value)
                                        @if($key == old('isactive') or $key == $brand->isactive)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">                                    
                                <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-country">{{ __('inventory.country_of_origin') }}</label>
                                    <input type="text" name="country" id="input-country" class="form-control form-control-alternative" placeholder="{{ __('inventory.country_of_origin') }}" value="{{ old('country', $brand->country) }}">
                                    @include('inventory.alerts.feedback', ['field' => 'country'])
                                </div>
                            </div>
                            <div class="col-2">                                    
                                <div class="form-group{{ $errors->has('iso') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-iso">ISO</label>
                                    <input type="text" name="iso" id="input-iso" class="form-control form-control-alternative" placeholder="ISO" value="{{ old('iso', $brand->iso) }}">
                                    @include('inventory.alerts.feedback', ['field' => 'iso'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">                                    
                                <div class="form-group{{ $errors->has('isprovider') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-isprovider">{{ __('inventory.aftermarket') }}</label>
                                    <select name="isprovider" id="input-isprovider" class="form-control form-control-alternative{{ $errors->has('isprovider') ? ' is-invalid' : '' }}" required>
                                        @foreach (['False'=>'No', 'True'=>'Yes'] as $key=>$value)
                                        @if($key == old('isprovider') or $key == $brand->isprovider)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">                                    
                                <div class="form-group{{ $errors->has('isaxle') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-isaxle">{{ __('inventory.isaxle') }}</label>
                                    <select name="isaxle" id="input-isaxle" class="form-control form-control-alternative{{ $errors->has('isaxle') ? ' is-invalid' : '' }}" required>
                                        @foreach (['False'=>'No', 'True'=>'Yes'] as $key=>$value)
                                        @if($key == old('isaxle') or $key == $brand->isaxle)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">                                    
                                <div class="form-group{{ $errors->has('iscommercialvehicle') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-iscommercialvehicle">{{ __('inventory.iscvmanufacturer') }}</label>
                                    <select name="iscommercialvehicle" id="input-iscommercialvehicle" class="form-control form-control-alternative{{ $errors->has('iscommercialvehicle') ? ' is-invalid' : '' }}" required>
                                        @foreach (['False'=>'No', 'True'=>'Yes'] as $key=>$value)
                                        @if($key == old('iscommercialvehicle') or $key == $brand->iscommercialvehicle)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">                                    
                                <div class="form-group{{ $errors->has('isengine') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-isengine">{{ __('inventory.isengine') }}</label>
                                    <select name="isengine" id="input-isengine" class="form-control form-control-alternative{{ $errors->has('isengine') ? ' is-invalid' : '' }}" required>
                                        @foreach (['False'=>'No', 'True'=>'Yes'] as $key=>$value)
                                        @if($key == old('isengine') or $key == $brand->isengine)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">                                    
                                <div class="form-group{{ $errors->has('ismotorbike') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-ismotorbike">{{ __('inventory.ismotorbike') }}</label>
                                    <select name="ismotorbike" id="input-ismotorbike" class="form-control form-control-alternative{{ $errors->has('ismotorbike') ? ' is-invalid' : '' }}" required>
                                        @foreach (['False'=>'No', 'True'=>'Yes'] as $key=>$value)
                                        @if($key == old('ismotorbike') or $key == $brand->ismotorbike)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">                                    
                                <div class="form-group{{ $errors->has('ispassengercar') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-ispassengercar">{{ __('inventory.ispassangercar') }}</label>
                                    <select name="ispassengercar" id="input-ispassengercar" class="form-control form-control-alternative{{ $errors->has('ispassengercar') ? ' is-invalid' : '' }}" required>
                                        @foreach (['False'=>'No', 'True'=>'Yes'] as $key=>$value)
                                        @if($key == old('ispassengercar') or $key == $brand->ispassengercar)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group{{ $errors->has('brand_text') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-brand_text">{{ __('inventory.brand_text') }}</label>
                                    <textarea name="brand_text" id="input-brand_text" class="form-control form-control-alternative" placeholder="{{ __('inventory.brand_text') }}">{{ old('brand_text', $brand->brand_text) }}</textarea>
                                    @include('inventory.alerts.feedback', ['field' => 'brand_text'])
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
@push('js')
<script src="{{ asset('/assets/js/ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'brand_text', {
    filebrowserUploadUrl: "{{route('brands.ckeditor.upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});
</script>
@endpush