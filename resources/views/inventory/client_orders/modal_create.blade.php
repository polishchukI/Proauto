<form method="post" action="{{ route('client_orders.store') }}" autocomplete="off">
	<div class="receiptCreateModal modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-primary">{{ __('inventory.new_client_order') }}</div>
			<div class="modal-body">
				@csrf
				<div class="form-group">
					<input type="hidden" name="user_id" value="{{ Auth::id() }}">
					@if(isset($admincart))
					<input type="hidden" name="client_id" value="{{ $admincart->client_id }}">
					<input type="hidden" name="reference_type" value="admincart">
					<input type="hidden" name="reference_id" value="{{ $admincart->id }}">
					<input type="hidden" name="warehouse_id" value="{{ $admincart->warehouse_id }}">
					<input type="hidden" name="currency" value="{{ $admincart->currency }}">
					@endif
				</div>				
				@if(!isset($admincart))
				<div class="form-group{{ $errors->has('client_id') ? ' has-danger' : '' }}">
					<label class="form-control-label" for="input-client">{{ __('inventory.client') }}</label>
					<select name="client_id" id="input-client" class="form-control form-control-alternative{{ $errors->has('client') ? ' is-invalid' : '' }}">
						<option value="">{{ __('inventory.not_specified') }}</option>
						@foreach ($clients as $client)
						<option value="{{$client['id']}}">{{$client['name']}}</option>
						@endforeach
					</select>
					@include('inventory.alerts.feedback', ['field' => 'client_id'])
				</div>
				<div class="form-group{{ $errors->has('warehouse_id') ? ' has-danger' : '' }}">
					<label class="form-control-label" for="input-warehouse">{{ __('inventory.warehouse') }}</label>
					<select name="warehouse_id" id="input-warehouse" class="form-control form-control-alternative{{ $errors->has('warehouse') ? ' is-invalid' : '' }}">
					<option value="">{{ __('inventory.not_specified') }}</option>
						@foreach ($warehouses as $warehouse)
						<option value="{{$warehouse['id']}}">{{$warehouse['name']}}</option>
						@endforeach
					</select>
					@include('inventory.alerts.feedback', ['field' => 'warehouse_id'])
				</div>
				<div class="form-group{{ $errors->has('currency') ? ' has-danger' : '' }}">
					<label class="form-control-label" for="input-currency">{{ __('inventory.currency') }}</label>
					<select name="currency" id="input-currency" class="form-control form-control-alternative{{ $errors->has('currency') ? ' is-invalid' : '' }}">
					<option value="">{{ __('inventory.not_specified') }}</option>
						@foreach ($currencies as $currency)
						<option value="{{$currency['code']}}">{{$currency['name']}}</option>
						@endforeach
					</select>
					@include('inventory.alerts.feedback', ['field' => 'currency'])
				</div>
				@endif
			</div>			
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.continue') }}</button>
			</div>
		</div>
	</div>
</form>