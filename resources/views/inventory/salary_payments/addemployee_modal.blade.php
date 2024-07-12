@if($edit == "true")
<form id="salary_payment-form-employee-update" method="POST" action="{{ route('salary_payments.employee.update') }}" style="width:100%;">
@else
<form id="salary_payment-form-employee-add" method="POST" action="{{ route('salary_payments.add.employee.store') }}" style="width:100%;">
@endif
<div class="addemployee modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			@if($edit == "true")
			<h6 class="modal-title">{{ __('modal.edit_employee') }}: {{ $employee["lastname"] }} {{ $employee["firstname"] }} {{ $employee["secondname"] }}</h6>
			@else
			<h6 class="modal-title">{{ __('modal.add_employee') }}: {{ $employee["lastname"] }} {{ $employee["firstname"] }} {{ $employee["secondname"] }}</h6>
			@endif
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<div class="modal-body">
			@csrf
			<div class="form-group">
				<input type="hidden" name="salary_payment_id" value="{{ $employee["salary_payment_id"] }}">
				<input type="hidden" name="employee_id" value="{{ $employee["employee_id"] }}">
			</div>
			<div class="form-group">
				<label for="salary" class="col-form-label">{{ __('modal.salary') }}:</label>
				<input type="number" class="form-control" id="salary" name="salary" value="{{$employee['salary'] ?? 1}}">
			</div>
		</div>
		<div class="modal-footer">
		@if($edit == "true")
			<button id="salary_payment-employee-update" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.update') }}</button>
			<button id="salary_payment-employee-delete" type="button" class="btn btn-sm btn-simple btn-delete"><i class="fas fa-times text-danger"></i> {{ __('modal.delete') }}</button>
		@else
		<button id="salary_payment-employee-add" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
		@endif	
		</div>
	</div>
</div>
</form>