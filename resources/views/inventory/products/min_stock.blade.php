@if($edit == "true")
<form method="POST" id="product-min_stock-form-update" action="{{ route('products.min_stock.update') }}" style="width:100%;">
@else
<form method="POST" id="product-min_stock-form-add" action="{{ route('products.add.min_stock.store') }}" style="width:100%;">
@endif
	<div class="addmin_stock modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			@if($edit == "true")
				<h6 class="modal-title">{{ __('modal.edit_min_stock') }}</h6>
			@else
				<h6 class="modal-title">{{ __('modal.add_min_stock') }}</h6>
			@endif				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				@csrf
				<input type="hidden" name="product_id" value="{{$product_id}}">
				@if($edit == "true")
				<input type="hidden" name="min_stock_id" value="{{$min_stock_id}}">
				@endif
				<div class="form-group{{ $errors->has('warehouse_id') ? ' has-danger' : '' }}">
					<label class="form-label text-success" for="input-warehouse">{{ __('modal.warehouse') }}:</label>
					<select name="warehouse_id" id="input-warehouse" class="form-select form-control-alternative{{ $errors->has('warehouse') ? ' is-invalid' : '' }}">
						<option value="">{{ __('modal.not_specified') }}</option>
						@foreach ($warehouses as $warehouse)
							@if($edit == "true")
							<option value="{{$warehouse['id']}}" @if($warehouse['id'] == $warehouse_id)) selected @endif>{{$warehouse['name']}}</option>
							@endif
							<option value="{{$warehouse['id']}}">{{$warehouse['name']}}</option>
						@endforeach
					</select>
					@include('inventory.alerts.feedback', ['field' => 'warehouse_id'])
				</div>
				<div class="form-group{{ $errors->has('quantity') ? 'has-error' : ''}}">
					<label for="quantity" class="form-label text-success">{{ __('modal.quantity') }}:</label>
					<input type="number" class="form-control" id="quantity" name="quantity" @if($edit == "true") value="{{ $quantity }}" @endif>
					@include('inventory.alerts.feedback', ['field' => 'quantity'])
				</div>
			</div>
			<div class="modal-footer">
				@if($edit == "true")
				<button id="product-min_stock-update" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.update') }}</button>
				<button id="product-min_stock-delete" type="button" class="btn btn-sm btn-simple btn-delete"><i class="fas fa-times"></i> {{ __('modal.delete') }}</button>
				@else
				<button id="product-min_stock-add" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
				@endif	
			</div>
		</div>
	</div>
</form>