<form id="return_to_provider-form-single-product-add" method="POST" action="{{ route('returns_to_provider.add.single.product.store') }}" style="width:100%;">
	<div class="addproduct modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">{{ __('modal.add_single_product') }}</h6>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				@csrf
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<input type="hidden" name="return_to_provider_id" value="{{ $return_to_provider_id }}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="form-group{{ $errors->has('product') ? ' has-danger' : '' }}">
							<label class="form-control-label" for="input-product">{{ __('modal.products') }}</label>
							<select name="product" id="input-product" class="form-select form-control-alternative{{ $errors->has('product') ? ' is-invalid' : '' }}">
								<option value="">{{ __('modal.not_specified') }}</option>
								@foreach ($products as $product)
								<option value="{{$product['product_id']}}">{{$product['full_name']}}</option>
								@endforeach
							</select>
							@include('inventory.alerts.feedback', ['field' => 'product'])
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
				<button id="return_to_provider-single-product-add" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
				<button type="button" class="btn btn-sm btn-simple btn-selector" data-dismiss="modal">{{ __('modal.close') }}</button>
			</div>
		</div>
	</div>
</form>