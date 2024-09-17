@if($edit == "true")
<form id="warehouse_write_off-form-product-update" method="POST" action="{{ route('warehouse_write_offs.product.update') }}" style="width:100%;">
@else
<form id="warehouse_write_off-form-product-add" method="POST" action="{{ route('warehouse_write_offs.add.product.store') }}" style="width:100%;">
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
				<input type="hidden" name="warehouse_write_off_id" value="{{ $product["warehouse_write_off_id"] }}">
				<input type="hidden" name="product_id" value="{{ $product["product_id"] }}">
			</div>
			<div class="form-group">
				<label for="quantity" class="col-form-label">{{ __('modal.quantity') }}:</label>
				<input type="number" class="form-control" id="quantity" name="quantity" value="{{$product['quantity'] ?? 1}}">
			</div>
		</div>
		<div class="modal-footer">
		@if($edit == "true")
			<button id="warehouse_write_off-product-update" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.update') }}</button>
			<button id="warehouse_write_off-product-delete" type="button" class="btn btn-sm btn-simple btn-delete"><i class="fas fa-times"></i> {{ __('modal.delete') }}</button>
		@else
		<button id="warehouse_write_off-product-add" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
		@endif	
		</div>
	</div>
</div>
</form>