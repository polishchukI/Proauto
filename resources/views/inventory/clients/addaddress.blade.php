@if($edit == "true")
<form method="POST" id="client-form-address-update" action="{{ route('clients.address.update') }}" style="width:100%;">
@else
<form method="POST" id="client-form-address-store" action="{{ route('clients.add.address.store') }}" style="width:100%;">
@endif
	<div class="address modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				@if($edit == "true")
				<h6 class="modal-title">{{ __('modal.editaddress') }}</h6>
				@else
				<h6 class="modal-title">{{ __('modal.addaddress') }}</h6>
				@endif
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				@csrf
				<input type="hidden" name="client_id" value="{{$client_id}}">
				@if($edit == "true")
				<input type="hidden" name="address_id" value="{{$address['id']}}">
				@else
				@endif
				<div class="row">
					<div class="col-6 form-group">
						<label for="zipcode" class="col-form-label">{{ __('modal.zipcode') }}:</label>
						@if($edit == "true")
						<input type="text" class="form-control" id="zipcode" name="zipcode" value="{{$address['zipcode']}}">
						@else
						<input type="text" class="form-control" id="zipcode" name="zipcode">
						@endif
					</div>
					<div class="col-6 form-group">
						<label for="country" class="col-form-label">{{ __('modal.country') }}:</label>
						@if($edit == "true")
						<input type="text" class="form-control" id="country" name="country" value="{{$address['country']}}">
						@else
						<input type="text" class="form-control" id="country" name="country">
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-6 form-group">
						<label for="state" class="col-form-label">{{ __('modal.state') }}:</label>
						@if($edit == "true")
						<input type="text" class="form-control" id="state" name="state" value="{{$address['state']}}">
						@else
						<input type="text" class="form-control" id="state" name="state">
						@endif
					</div>
					<div class="col-6 form-group">
						<label for="city" class="col-form-label">{{ __('modal.city') }}:</label>
						@if($edit == "true")
						<input type="text" class="form-control" id="city" name="city" value="{{$address['city']}}">
						@else
						<input type="text" class="form-control" id="city" name="city">
						@endif
					</div>
				</div>
				<div class="form-group">
					<label for="settlement" class="col-form-label">{{ __('modal.settlement') }}:</label>
					@if($edit == "true")
					<input type="text" class="form-control" id="settlement" name="settlement" value="{{$address['settlement']}}">
					@else
					<input type="text" class="form-control" id="settlement" name="settlement">
					@endif
				</div>
				<div class="form-group">
					<label for="street" class="col-form-label">{{ __('modal.street') }}:</label>
					@if($edit == "true")
					<input type="text" class="form-control" id="street" name="street" value="{{$address['street']}}">
					@else
					<input type="text" class="form-control" id="street" name="street">
					@endif
				</div>
				<div class="row">
					<div class="col-4 form-group">
						<label for="address" class="col-form-label">{{ __('modal.address') }}:</label>
						@if($edit == "true")
						<input type="text" class="form-control" id="address" name="address" value="{{$address['address']}}">
						@else
						<input type="text" class="form-control" id="address" name="address">
						@endif
					</div>
					<div class="col-4 form-group">
						<label for="housing" class="col-form-label">{{ __('modal.housing') }}:</label>
						@if($edit == "true")
						<input type="text" class="form-control" id="housing" name="housing" value="{{$address['housing']}}">
						@else
						<input type="text" class="form-control" id="housing" name="housing">
						@endif
					</div>
					<div class="col-4 form-group">
						<label for="apartment" class="col-form-label">{{ __('modal.apartment') }}:</label>
						@if($edit == "true")
						<input type="text" class="form-control" id="apartment" name="apartment" value="{{$address['apartment']}}">
						@else
						<input type="text" class="form-control" id="apartment" name="apartment">
						@endif
					</div>
				</div>
				<div class="form-group">
					<label for="comment" class="col-form-label">{{ __('modal.comment') }}:</label>
					@if($edit == "true")
					<input type="text" class="form-control" id="comment" name="comment" value="{{$address['comment']}}">
					@else
					<input type="text" class="form-control" id="comment" name="comment">
					@endif					
				</div>
				<div class="form-group">
				@if($edit == "true")
					<span class="default">default</span><input type="checkbox" name="default" value="1" @if($address['default'] == 1) checked @endif >
				@else
					<span class="default">default</span><input type="checkbox" name="default" value="1">
				@endif		
				</div>
			</div>
			<div class="modal-footer">
			@if($edit == "true")
				<button id="client-address-update" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.update') }}</button>
				<button id="client-address-delete" type="button" class="btn btn-sm btn-simple btn-delete"><i class="fas fa-times"></i> {{ __('modal.delete') }}</button>
			@else
				<button id="client-address-store" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
			@endif				
			</div>
		</div>
	</div>
</form>