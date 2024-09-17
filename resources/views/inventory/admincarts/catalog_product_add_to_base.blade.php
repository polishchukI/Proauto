@if($from_search == "true")
<form id="admincart-form-product_add_tobase_from_search" method="POST" action="{{ route('admincarts.product.add.tobase.store') }}" style="width:100%;">
@else
<form id="admincart-form-product_create_store" method="POST" action="{{ route('admincarts.product.create.store') }}" style="width:100%;">
@endif
<div class="addproduct modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			@if($from_search == "true")
			<h6 class="modal-title">{{ __('modal.create_from_search') }}</h6>
			@else
			<h6 class="modal-title">{{ __('modal.create_manual') }}</h6>
			@endif
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<div class="modal-body">
			@csrf
			<input type="hidden" id="admincart_id" name="admincart_id" value="{{ $admincart_id }}">				
			<div class="row">
				<div class="col-6">
					@if(isset($brand))
					<div class="form-group{{ $errors->has('brand') ? ' has-danger' : '' }}">
						<label class="form-control-label text-success" for="input-brand">{{ __('modal.brand') }}</label>
						<input type="text" name="brand" id="input-brand" class="form-control form-control-alternative{{ $errors->has('brand') ? ' is-invalid' : '' }}" value="{{ $brand }}">
						@include('inventory.alerts.feedback', ['field' => 'brand'])
					</div>
					@else
					<div class="form-group{{ $errors->has('brand') ? ' has-danger' : '' }}">
						<label class="form-control-label text-success" for="input-brand">{{ __('modal.product_brand') }}</label>
						<select name="brand" id="input-brand" class="form-select form-control-alternative{{ $errors->has('brand') ? ' is-invalid' : '' }}">
							@foreach ($brands as $brand)
							<option value="{{$brand['brand']}}">{{$brand['brand']}}</option>
							@endforeach
						</select>
						@include('inventory.alerts.feedback', ['field' => 'brand'])
					</div>
					@endif
				</div>
				<div class="col-6">
					<div class="form-group{{ $errors->has('article') ? ' has-danger' : '' }}">
						<label class="form-control-label text-success" for="input-article">{{ __('modal.article') }}</label>
						<input type="text" name="article" id="input-article" class="form-control form-control-alternative{{ $errors->has('article') ? ' is-invalid' : '' }}"
						@if(isset($article))
						value="{{ $article }}"
						@else
						placeholder="{{ __('modal.article') }}"
						@endif>
						@include('inventory.alerts.feedback', ['field' => 'article'])
					</div>
				</div>
			</div>
			<div class="form-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
				<label class="form-control-label text-success" for="input-product_name">{{ __('modal.product_name') }}</label>
				<input type="text" name="product_name" id="input-product_name" class="form-control form-control-alternative{{ $errors->has('product_name') ? ' is-invalid' : '' }}"
					@if(isset($product_name))
					value="{{ $product_name }}"
					@else
					placeholder="{{ __('modal.product_name') }}" 
					@endif>
				@include('inventory.alerts.feedback', ['field' => 'product_name'])
			</div>
			<!-- <comment> -->
			<div class="form-group{{ $errors->has('product_description') ? ' has-danger' : '' }}">
				<label class="form-control-label text-success" for="input-product_description">{{ __('modal.product_description') }}</label>
				<input type="text" name="product_description" id="input-product_description" class="form-control form-control-alternative{{ $errors->has('product_description') ? ' is-invalid' : '' }}"
					@if(isset($product_description))
					value="{{ $product_description }}"
					@else
					placeholder="{{ __('modal.product_description') }}" 
					@endif>
				@include('inventory.alerts.feedback', ['field' => 'product_description'])
			</div>
			<!-- <comment> -->
			<div class="row">
				<div class="col-6">
					<div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
						<label class="form-control-label text-success" for="input-category">{{ __('modal.product_category') }}</label>
						<select name="category" id="input-category" class="form-select form-control-alternative{{ $errors->has('category') ? ' is-invalid' : '' }}">
							@foreach ($categories as $category)
							<option value="{{$category['id']}}">{{$category['id']}} - {{$category['name']}}</option>
							@endforeach
						</select>
						@include('inventory.alerts.feedback', ['field' => 'category'])
					</div>
				</div>
				<div class="col-6">
					<div class="form-group{{ $errors->has('group') ? ' has-danger' : '' }}">
						<label class="form-control-label text-success" for="input-group">{{ __('modal.product_group') }}</label>
						<select name="group" id="input-group" class="form-select form-control-alternative{{ $errors->has('group') ? ' is-invalid' : '' }}">
							@foreach ($groups as $group)
							<option value="{{$group['id']}}">{{$group['id']}} - {{$group['name']}}</option>
							@endforeach
						</select>
						@include('inventory.alerts.feedback', ['field' => 'group'])
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="quantity" class="col-form-label">{{ __('modal.quantity') }}:</label>
						<input type="number" class="form-control" id="quantity" name="quantity" value="1">
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="price" class="col-form-label">{{ __('modal.price') }}:</label>
						<input type="number" class="form-control" id="price" name="price">
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
		@if($from_search == "true")
			<button id="admincart-product-create-from-search" type="button" class="btn btn-simple btn-selector btn-sm">{{ __('modal.create') }}</button>
			<button id="admincart-product-create-from-search-add" type="button" class="btn btn-sm btn-success btn-simple">{{ __('modal.create_and_to_cart') }}</button>
		@else
			<button id="admincart-product-create-manual" type="button" class="btn btn-simple btn-selector btn-sm">{{ __('modal.create') }}</button>
			<button id="admincart-product-create-manual-add" type="button" class="btn btn-sm btn-success btn-simple">{{ __('modal.create_and_to_cart') }}</button>
		@endif	
		</div>
	</div>
</div>
</form>