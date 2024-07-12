@if($edit == "true")
<form id="client_order-form-product-update" method="POST" action="{{ route('client_orders.product.update') }}" style="width:100%;">
@else
<form id="client_order-form-product-add" method="POST" action="{{ route('client_orders.add.product.store') }}" style="width:100%;">
@endif
<div class="addproduct modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			@if($edit == "true")
			<h6 class="modal-title">{{ __('modal.edit_product') }}: {{ $product["full_name"] }}</h6>
			@else
			<h6 class="modal-title">{{ __('modal.add_product') }}: {{ $product["full_name"] }}</h6>
			@endif
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<div class="modal-body">
			@csrf
			<div class="form-group">
				<input type="hidden" name="client_order_id" value="{{ $product["client_order_id"] }}">
				<input type="hidden" name="product_id" value="{{ $product["product_id"] }}">
			</div>
			<div class="form-group">
				<label for="quantity" class="col-form-label">{{ __('modal.quantity') }}:</label>
				<input type="number" class="form-control" id="quantity" name="quantity" value="{{$product['quantity'] ?? 1}}">
			</div>
			<div class="form-group">
				<label for="price" class="col-form-label">{{ __('modal.price') }}:</label>
				@if($edit == "true")
				<input type="number" class="form-control" id="price" name="price" value="{{$product['price']}}">
				@else
				<input type="number" class="form-control" id="price" name="price" value="{{$product['price']}}">
				@endif
			</div>
		</div>
		<div class="modal-footer">
		@if($edit == "true")
			<button id="client_order-product-update" type="button" class="btn btn-sm btn-simple">{{ __('modal.update') }}</button>
			<button id="client_order-product-delete" type="button" class="btn btn-sm btn-simple"><i class="fas fa-times text-danger"></i> {{ __('modal.delete') }}</button>
		@else
		<button id="client_order-product-add" type="button" class="btn btn-sm btn-simple">{{ __('modal.add') }}</button>
		@endif	
		</div>
	</div>
</div>
</form>