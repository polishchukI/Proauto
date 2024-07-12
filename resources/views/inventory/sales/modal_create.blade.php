<form method="post" action="{{ route('sales.store') }}" autocomplete="off">
	<div class="receiptCreateModal modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-primary">{{ __('inventory.new_sale') }}</div>
			<div class="modal-body">
				@csrf
				<div class="form-group">
					<input type="hidden" name="user_id" value="{{ Auth::id() }}">
					@if(isset($client_order))
					<input type="hidden" name="client_id" value="{{ $client_order->client_id }}">
					<input type="hidden" name="reference_type" value="client_order">
					<input type="hidden" name="reference_id" value="{{ $client_order->id }}">
					<input type="hidden" name="warehouse_id" value="{{ $client_order->warehouse_id }}">
					<input type="hidden" name="currency" value="{{ $client_order->currency }}">
					@endif
				</div>				
				@if(!isset($client_order))
				<div class="form-group{{ $errors->has('client_id') ? ' has-danger' : '' }}">
					<label class="form-control-label" for="input-client">{{ __('inventory.client') }}</label>
					<select name="client_id" id="input-client" class="form-select form-control-alternative{{ $errors->has('client') ? ' is-invalid' : '' }}">
						<option value="">{{ __('modal.not_specified') }}</option>
						@foreach ($clients as $client)
						<option value="{{$client['id']}}">{{$client['name']}}</option>
						@endforeach
					</select>
					@include('inventory.alerts.feedback', ['field' => 'client_id'])
				</div>
				<div class="form-group{{ $errors->has('warehouse_id') ? ' has-danger' : '' }}">
					<label class="form-control-label" for="input-warehouse">{{ __('inventory.warehouse') }}</label>
					<select name="warehouse_id" id="input-warehouse" class="form-select form-control-alternative{{ $errors->has('warehouse') ? ' is-invalid' : '' }}">
						<option value="">{{ __('modal.not_specified') }}</option>
						@foreach ($warehouses as $warehouse)
						<option value="{{$warehouse['id']}}">{{$warehouse['name']}}</option>
						@endforeach
					</select>
					@include('inventory.alerts.feedback', ['field' => 'warehouse_id'])
				</div>
				<div class="form-group{{ $errors->has('currency') ? ' has-danger' : '' }}">
					<label class="form-control-label" for="input-currency">{{ __('inventory.currency') }}</label>
					<select name="currency" id="input-currency" class="form-select form-control-alternative{{ $errors->has('currency') ? ' is-invalid' : '' }}">
						<option value="">{{ __('modal.not_specified') }}</option>
						@foreach ($currencies as $currency)
						<option value="{{$currency['code']}}">{{$currency['name']}}</option>
						@endforeach
					</select>
					@include('inventory.alerts.feedback', ['field' => 'currency'])
				</div>
				@endif
			</div>			
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-simple btn-success">Create</button>
			</div>
		</div>
	</div>
</form>