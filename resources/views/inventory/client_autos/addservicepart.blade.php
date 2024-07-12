@if($edit == "true")
<form method="POST" id="auto-servicepart-form-update" action="{{ route('client_autos.servicepart.update') }}" style="width:100%;">
@else
<form method="POST" id="auto-servicepart-form-add" action="{{ route('client_autos.servicepart.store') }}" style="width:100%;">
@endif
	<div class="addservicepart modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">{{ __('modal.addservicepart') }}</h6>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				@csrf
				<input type="hidden" name="client_auto_id" value="{{$client_auto_id}}">
				<input type="hidden" name="item_id" @if($edit == "true") value="{{$item_id}}" @endif>
				<div class="row">
					<div class="col-12">
						<div class="form-group{{ $errors->has('product') ? ' has-danger' : '' }}">
							<label class="form-control-label text-success" for="input-product">{{ __('modal.products') }}</label>
							<select name="product" id="input-product" class="form-select form-control-alternative{{ $errors->has('product') ? ' is-invalid' : '' }}">
								<option value="">{{ __('modal.not_specified') }}</option>
								@foreach ($products as $product)
								@if($edit == "true" && ($product['product_id'] == old($servicepart['product_id']) or $product['product_id'] == $servicepart['product_id']))
								<option selected value="{{$product['product_id']}}">{{$product['full_name']}}</option>
								@else
								<option value="{{$product['product_id']}}">{{$product['full_name']}}</option>
								@endif
								@endforeach
							</select>
							@include('inventory.alerts.feedback', ['field' => 'product'])
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label for="quantity" class="col-form-label text-success">{{ __('modal.quantity') }}:</label>					
							<input type="number" class="form-control" id="quantity" name="quantity" min="1" max="1000" @if($edit == "true") value="{{$servicepart['quantity']}}" @else value="1" @endif>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label for="comment" class="col-form-label text-success">{{ __('modal.comment') }}:</label>					
							<input type="text" class="form-control" id="comment" name="comment" @if($edit == "true") value="{{$servicepart['comment']}}" @endif>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				@if($edit == "true")
					<button id="auto-servicepart-update" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.update') }}</button>
					<button id="auto-servicepart-delete" type="button" class="btn btn-sm btn-simple btn-delete"><i class="fas fa-times"></i> {{ __('modal.delete') }}</button>
				@else
					<button id="auto-servicepart-add" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
				@endif	
				</button>
			</div>
		</div>
	</div>
</form>