@if($edit == "true")
<form id="services_receipt-form-service-update" method="POST" action="{{ route('services_receipts.service.update') }}" style="width:100%;">
@else
<form id="services_receipt-form-service-add" method="POST" action="{{ route('services_receipts.add.service.store') }}" style="width:100%;">
@endif
<div class="addservice modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h6 class="modal-title">{{ __('modal.add_edit_service') }}</h6>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<div class="modal-body">
			@csrf
			<div class="form-group">
				<input type="hidden" name="services_receipt_id" value="{{ $services_receipt->id }}">
			</div>
			<div class="form-group">
				<label class="form-control-label" for="input-name">Service</label>
				<select name="service_id" id="input-service" class="form-select form-control-alternative{{ $errors->has('service_id') ? ' is-invalid' : '' }}" required>
				@foreach ($services as $service)
				@if(isset($service_id) && ($service['id'] == old($service_id) or $service['id'] == $receipt_service['service_id']))
					<option value="{{$service['id']}}" selected>{{$service['name']}}</option>
				@else
					<option value="{{$service['id']}}">{{$service['name']}}</option>
				@endif
				@endforeach
				</select>
				@include('inventory.alerts.feedback', ['field' => 'service_id'])
			</div>
			<div class="form-group">
				<label for="quantity" class="col-form-label">{{ __('modal.quantity') }}:</label>
				<input type="number" class="form-control" id="quantity" name="quantity" value="{{$receipt_service['quantity'] ?? 1}}">
			</div>
			<div class="form-group">
				<label for="price" class="col-form-label">{{ __('modal.price') }}:</label>
				@if($edit == "true")
				<input type="number" class="form-control" id="price" name="price" value="{{$receipt_service['price']}}">
				@else
				<input type="number" class="form-control" id="price" name="price">
				@endif
			</div>
		</div>
		<div class="modal-footer">
		@if($edit == "true")
			<button id="services_receipt-service-update" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.update') }}</button>
			<button id="services_receipt-service-delete" type="button" class="btn btn-sm btn-simple btn-delete"><i class="fas fa-times"></i> {{ __('modal.delete') }}</button>
		@else
			<button id="services_receipt-service-add" type="button" class="btn btn-sm btn-simple btn-selector">{{ __('modal.add') }}</button>
		@endif	
		</div>
	</div>
</div>
</form>