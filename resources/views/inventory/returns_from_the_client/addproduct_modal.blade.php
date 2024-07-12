<form id="returns_from_the_client-form-product-update" method="POST" action="{{ route('returns_from_the_client.product.update') }}" style="width:100%;">
<div class="addproduct modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h6 class="modal-title">{{ __('modal.edit_product') }}: {{ $product["full_name"] }}</h6>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<div class="modal-body">
			@csrf
			<div class="form-group">
				<input type="hidden" name="return_from_the_client_id" value="{{ $product["return_from_the_client_id"] }}">
				<input type="hidden" name="product_id" value="{{ $product["product_id"] }}">
			</div>
			<div class="form-group">
				<label for="quantity" class="col-form-label">{{ __('modal.quantity') }}:</label>
				<input type="number" class="form-control" id="quantity" name="quantity" value="{{$product['quantity'] ?? 1}}">
			</div>
			<div class="form-group">
				<label for="price" class="col-form-label">{{ __('modal.price') }}:</label>
				<input type="number" class="form-control" id="price" name="price" value="{{$product['price']}}">
			</div>
		</div>
		<div class="modal-footer">
			<button id="returns_from_the_client-product-update" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.update') }}</button>
			<button id="returns_from_the_client-product-delete" type="button" class="btn btn-sm btn-simple btn-delete"><i class="fas fa-times"></i> {{ __('modal.delete') }}</button>
		</div>
	</div>
</div>
</form>