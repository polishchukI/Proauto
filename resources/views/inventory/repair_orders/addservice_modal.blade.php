@if($edit == "true")
<form id="repair_order-form-service-update" method="POST" action="{{ route('repair_orders.service.update') }}" style="width:100%;">
@else
<form id="repair_order-form-service-add" method="POST" action="{{ route('repair_orders.add.service.store') }}" style="width:100%;">
@endif
<div class="addservice modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			@if($edit == "true")
			<h6 class="modal-title">{{ __('modal.edit_service') }}: {{ $service["name"] }}</h6>
			@else
			<h6 class="modal-title">{{ __('modal.add_service') }}: {{ $service["name"] }}</h6>
			@endif
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<div class="modal-body">
			@csrf
			<div class="form-group">
				<input type="hidden" name="repair_order_id" value="{{ $service["repair_order_id"] }}">
				<input type="hidden" name="service_id" value="{{ $service["service_id"] }}">
			</div>
			<div class="form-group{{ $errors->has('employee') ? ' has-danger' : '' }}">
				<label class="form-control-label" for="input-employee">{{ __('modal.employee') }}</label>
				<select name="employee" id="input-employee">
					<option value="">{{ __('modal.not_specified') }}</option>
					@foreach ($employees as $employee)
						@if($edit == "true" && $employee['id'] == $service["employee_id"])
						<option value="{{ $employee['id'] }}" selected>{{ $employee['fullname'] }}</option>
						@else
						<option value="{{ $employee['id'] }}">{{ $employee['fullname'] }}</option>
						@endif
					@endforeach
				</select>
				@include('inventory.alerts.feedback', ['field' => 'employee'])
			</div>
			<div class="form-group">
				<label for="price" class="col-form-label">{{ __('modal.price') }}:</label>
				@if($edit == "true")
				<input type="number" class="form-control" id="price" name="price" value="{{$service['price']}}">
				@else
				<input type="number" class="form-control" id="price" name="price" value="{{$service['price']}}">
				@endif
			</div>
		</div>
		<div class="modal-footer">
		@if($edit == "true")
			<button id="repair_order-service-update" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.update') }}</button>
			<button id="repair_order-service-delete" type="button" class="btn btn-sm btn-simple btn-delete"><i class="fas fa-times"></i> {{ __('modal.delete') }}</button>
		@else
		<button id="repair_order-service-add" type="button" class="btn btn-sm btn-simple">{{ __('modal.add') }}</button>
		@endif	
		</div>
	</div>
</div>
</form>