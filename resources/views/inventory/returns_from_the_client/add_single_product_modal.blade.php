<form id="return_from_the_client-form-single-product-add" method="POST" action="{{ route('returns_from_the_client.add.single.product.store') }}" style="width:100%;">
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
							<input type="hidden" name="return_from_the_client_id" value="{{ $return_from_the_client_id }}">
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
					<div class="col-12">
						<div class="form-group">
							<label for="quantity" class="col-form-label">{{ __('modal.quantity') }}:</label>
							<input type="number" class="form-control" id="quantity" name="quantity" value="1">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">			
				<button id="return_from_the_client-single-product-add" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
				<button type="button" class="btn btn-sm btn-simple btn-delete" data-dismiss="modal">{{ __('modal.close') }}</button>
			</div>
		</div>
	</div>
</form>