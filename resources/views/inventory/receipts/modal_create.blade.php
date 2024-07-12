<form method="post" action="{{ route('receipts.store') }}" autocomplete="off">
	<div class="receiptCreateModal modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header text-primary">{{ __('inventory.new_receipt') }}</div>
			<div class="modal-body">
				@csrf
				<div class="row">
					<input type="hidden" name="user_id" value="{{ Auth::id() }}">
					@if(isset($to_provider_order))
					<input type="hidden" name="provider_id" value="{{ $to_provider_order->provider_id }}">
					<input type="hidden" name="reference_type" value="to_provider_order">
					<input type="hidden" name="reference_id" value="{{ $to_provider_order->id }}">
					<input type="hidden" name="warehouse_id" value="{{ $to_provider_order->warehouse_id }}">
					<input type="hidden" name="currency" value="{{ $to_provider_order->currency }}">
					@endif
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group{{ $errors->has('provider_doc_number') ? ' has-danger' : '' }}">
							<label class="form-control-label" for="input-provider_doc_number">{{ __('inventory.provider_doc') }}</label>
							<input type="text" name="provider_doc_number" id="input-provider_doc_number" class="form-control form-control-alternative{{ $errors->has('provider_doc_number') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.provider_doc') }}" autofocus>
							@include('inventory.alerts.feedback', ['field' => 'provider_doc_number'])
						</div>						
					</div>
					<div class="col-md-6">
						<div class="form-group{{ $errors->has('provider_doc_date') ? ' has-danger' : '' }}">
							<label class="form-control-label" for="input-provider_doc_date">{{ __('inventory.provider_sale_doc_date_create') }}</label>
							<input type="date" name="provider_doc_date" id="input-provider_doc_date" class="form-control form-control-alternative{{ $errors->has('provider_doc_date') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" autofocus>
							@include('inventory.alerts.feedback', ['field' => 'provider_doc_date'])
						</div>						
					</div>
				</div>
				@if(!isset($to_provider_order))
				<div class="row">
					<div class="col-md-4">
						<div class="form-group{{ $errors->has('provider_id') ? ' has-danger' : '' }}">
							<label class="form-control-label" for="input-provider">{{ __('inventory.provider') }}</label>
							<select name="provider_id" id="input-provider" class="form-select form-control-alternative{{ $errors->has('provider') ? ' is-invalid' : '' }}">
								<option value="">{{ __('modal.not_specified') }}</option>
								@foreach ($providers as $provider)
								<option value="{{$provider['id']}}">{{$provider['name']}}</option>
								@endforeach
							</select>
							@include('inventory.alerts.feedback', ['field' => 'provider_id'])
						</div>
					</div>
					<div class="col-md-4">
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
					</div>
					<div class="col-md-4">
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
					</div>
				</div>
				@endif
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="form-control-label" for="input-setup_prices">{{ __('inventory.setup_prices_create') }}</label>
							<select name="setup_prices" id="input-setup_prices" class="form-control form-control-alternative{{ $errors->has('setup_prices') ? ' is-invalid' : '' }}" required>
								@foreach (['0'=>'No', '1'=>'Yes'] as $key=>$value)
									<option value="{{$key}}">{{$value}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="form-control-label" for="input-surcharge">{{ __('inventory.surcharge') }}</label>
							<select name="surcharge" id="input-surcharge" class="form-control form-control-alternative{{ $errors->has('surcharge') ? ' is-invalid' : '' }}" required>
								@foreach (['0'=>'0%', '5'=>'5%','10'=>'10%', '15'=>'15%','20'=>'20%', '25'=>'25%','30'=>'30%','35'=>'35%','40'=>'40%','45'=>'45%','50'=>'50%'] as $key=>$value)
									<option value="{{$key}}">{{$value}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="form-control-label" for="input-surcharge_coefficient">{{ __('inventory.surcharge_coefficient') }}</label>
							<select name="surcharge_coefficient" id="input-surcharge_coefficient" class="form-control form-control-alternative{{ $errors->has('surcharge_coefficient') ? ' is-invalid' : '' }}" required>
								@foreach (['1'=>'1', '5'=>'5','10'=>'10', '50'=>'50'] as $key=>$value)
									<option value="{{$key}}">{{$value}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-10">
						<div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
							<label class="form-control-label" for="input-comment">{{ __('inventory.comment') }}</label>
							<input type="text" name="comment" id="input-comment" class="form-control form-control-alternative{{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.provider_doc') }}" autofocus>
							@include('inventory.alerts.feedback', ['field' => 'comment'])
						</div>						
					</div>
					<div class="col-2">
						<div class="form-group">
							<label class="form-control-label" for="input-is_gratuitous">{{ __('inventory.is_gratuitous') }}</label>
							<select name="is_gratuitous" id="input-is_gratuitous" class="form-control form-control-alternative{{ $errors->has('is_gratuitous') ? ' is-invalid' : '' }}" required>
								@foreach (['0'=>'No', '1'=>'Yes'] as $key=>$value)
									<option value="{{$key}}">{{$value}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>			
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.create') }}</button>
			</div>
		</div>
	</div>
</form>