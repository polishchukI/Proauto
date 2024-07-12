@extends('inventory.layouts.app', ['page' => __('inventory.new_product'), 'pageSlug' => 'products', 'section' => 'inventory', 'search' => 'products'])

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0">{{ __('inventory.new_product') }}</h3>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('products.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form method="post" action="{{ route('products.store') }}" autocomplete="off">
					@csrf
					<h6 class="heading-small text-muted mb-4">{{ __('inventory.product_information') }}</h6>
					<div class="pl-lg-4">
						<div class="row">
							<div class="col-9">
								<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-name">{{ __('inventory.name') }}</label>
									<input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.name') }}" value="{{ old('name') }}" >
									@include('inventory.alerts.feedback', ['field' => 'name'])
								</div>
							</div>
							<div class="col-3">                                    
								<div class="form-group{{ $errors->has('article') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-article">{{ __('inventory.article') }}</label>
									<input type="text" name="article" id="input-article" class="form-control form-control-alternative" placeholder="{{ __('inventory.article') }}" value="{{ old('article') }}" required>
									@include('inventory.alerts.feedback', ['field' => 'article'])
								</div>
							</div>                            
						</div>
						<div class="row">
							<div class="col-3">                                    
								<div class="form-group{{ $errors->has('product_category_id') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-category">{{ __('inventory.product_category') }}</label>
									<select name="product_category_id" id="input-category" class="form-select form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
										@foreach ($categories as $category)
											<option value="{{$category['id']}}">{{$category['name']}}</option>
										@endforeach
									</select>
									@include('inventory.alerts.feedback', ['field' => 'product_category_id'])
								</div>
							</div>
							<div class="col-3">
								<label class="form-control-label" for="input-group">{{ __('inventory.group') }}</label>
								<select name="product_group_id" id="input-group" class="form-select form-control-alternative{{ $errors->has('product_group_id') ? ' is-invalid' : '' }}" required>
									@foreach ($groups as $group)
											<option value="{{$group['id']}}">{{$group['name']}} ({{$group['id']}})</option>
									@endforeach
								</select>
								@include('inventory.alerts.feedback', ['field' => 'product_group_id'])
							</div>
							<div class="col-3">
								<label class="form-control-label" for="input-product_price_group">{{ __('inventory.product_price_group') }}</label>
								<select name="product_price_group_id" id="input-product_price_group" class="form-select form-control-alternative{{ $errors->has('product_price_group_id') ? ' is-invalid' : '' }}">
											<option value="">{{ __('inventory.no_price_group') }}</option>
									@foreach ($product_price_groups as $group)
											<option value="{{$group['id']}}">{{$group['name']}} ({{$group['id']}})</option>
									@endforeach
								</select>
								@include('inventory.alerts.feedback', ['field' => 'product_price_group_id'])
							</div>
							<div class="col-2">
								<div class="form-group{{ $errors->has('brand') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-brand">{{ __('inventory.brand') }}</label>
									<select name="brand" id="input-brand" class="form-select form-control-alternative{{ $errors->has('brand') ? ' is-invalid' : '' }}" required>
										<option value="">{{ __('inventory.not_specified') }}</option>
										@foreach ($brands as $brand)
											<option value="{{$brand['brand']}}">{{$brand['brand']}}</option>
										@endforeach
									</select>
									@include('inventory.alerts.feedback', ['field' => 'brand'])
								</div>
							</div>
							<div class="col-1 mt-4">
								<button type="button" class="btn btn-sm btn-selector btn-simple" data-toggle="modal" data-target="#createNewBrand"><i class="fas fa-plus"></i></button>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-description">{{ __('inventory.description') }}</label>
									<input type="text" name="description" id="input-description" class="form-control form-control-alternative" placeholder="{{ __('inventory.description') }}" value="{{ old('description') }}" >
									@include('inventory.alerts.feedback', ['field' => 'description'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('weight') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-weight">{{ __('inventory.weight') }}</label>
									<input type="text" name="weight" id="input-weight" class="form-control form-control-alternative" placeholder="{{ __('inventory.weight') }}" value="{{ old('weight') }}" >
									@include('inventory.alerts.feedback', ['field' => 'weight'])
								</div>
							</div>
							<div class="col-3">
								<div class="text-center">
									<button type="submit" class="btn btn-success btn-simple btn-sm mt-4">{{ __('inventory.save') }}</button>
								</div>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- modal -->
<form id="form-product_create_new_brand_store" method="POST" action="{{ route('products.create.new.brand.store') }}" style="width:100%;">
	<div class="modal modal-black fade" id="createNewBrand" tabindex="-1" role="dialog" aria-labelledby="createNewBrand" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="createNewBrandLabel">{{ __('modal.new_brand') }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<i class="fas fa-times"></i>
					</button>
				</div>
				<div class="modal-body">
				@csrf
					<div class="form-group{{ $errors->has('brand') ? ' has-danger' : '' }}">
						<label class="form-control-label text-success" for="input-brand">{{ __('modal.brand') }}</label>
						<input type="text" name="brand" id="input-brand" class="form-control form-control-alternative{{ $errors->has('brand') ? ' is-invalid' : '' }}" placeholder="{{ __('modal.brand') }}" autofocus>
						@include('inventory.alerts.feedback', ['field' => 'brand'])
					</div>
					<div class="form-group{{ $errors->has('ismanufacturer') ? ' has-danger' : '' }}">
						<label class="form-control-label text-success" for="input-ismanufacturer">{{ __('modal.manufacturer') }}</label>
						<select name="ismanufacturer" id="input-ismanufacturer" class="form-control form-control-alternative{{ $errors->has('ismanufacturer') ? ' is-invalid' : '' }}" required>
							@foreach (['False'=>'No', 'True'=>'Yes'] as $key=>$value)
							<option value="{{$key}}">{{$value}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group{{ $errors->has('isprovider') ? ' has-danger' : '' }}">
						<label class="form-control-label text-success" for="input-isprovider">{{ __('modal.provider') }}</label>
						<select name="isprovider" id="input-isprovider" class="form-control form-control-alternative{{ $errors->has('isprovider') ? ' is-invalid' : '' }}" required>
							@foreach (['False'=>'No', 'True'=>'Yes'] as $key=>$value)
							<option value="{{$key}}">{{$value}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group{{ $errors->has('isactive') ? ' has-danger' : '' }}">
						<label class="form-control-label text-success" for="input-isactive">{{ __('modal.active') }}</label>
						<select name="isactive" id="input-isactive" class="form-control form-control-alternative{{ $errors->has('isactive') ? ' is-invalid' : '' }}" required>
							@foreach (['False'=>'Not', 'True'=>'Active'] as $key=>$value)
							<option value="{{$key}}">{{$value}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button id="products-create-new-brand-store" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.create') }}</button>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection