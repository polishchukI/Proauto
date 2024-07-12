@if($edit == "true")
<form method="POST" id="client-form-phone-update" action="{{ route('clients.phone.update') }}" style="width:100%;">
@else
<form method="POST" id="client-form-phone-store" action="{{ route('clients.add.phone.store') }}" style="width:100%;">
@endif
	<div class="addphone modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				@if($edit == "true")
				<h6 class="m-0 font-weight-bold">{{ __('modal.edit_phone') }}</h6>
				@else
				<h6 class="m-0 font-weight-bold">{{ __('modal.add_phone') }}</h6>
				@endif
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				@csrf
				<input type="hidden" name="client_id" value="{{ $client_id }}">
				@if($edit == "true")
				<input type="hidden" name="phone_id" value="{{ $phone['id'] }}">
				@else
				@endif
				<div class="form-group{{ $errors->has('phone') ? 'has-error' : ''}}">
					<label for="phone" class="col-form-label">{{ __('modal.phone') }}:</label>
					<input type="text" class="form-control" id="phone" name="phone" @if($edit == "true") value="{{$phone['phone']}}" @endif required>
				</div>
				<div class="form-check mt-3 {{ $errors->has('telegram') ? 'has-error' : ''}}">
					<label class="form-check-label text-success" for="telegram">
						<input class="form-check-input" type="checkbox" value="1" @if($edit == "true" && $phone["telegram"] == 1) checked @endif id="telegram" name="telegram">
						<span class="form-check-sign"></span>
						Telegram
					</label>
				</div>
				<div class="form-check mt-3 {{ $errors->has('viber') ? 'has-error' : ''}}">
					<label class="form-check-label text-success" for="viber">
						<input class="form-check-input" type="checkbox" value="1" @if($edit == "true" && $phone["viber"] == 1) checked @endif id="viber" name="viber">
						<span class="form-check-sign"></span>
						Viber
					</label>
				</div>
				<div class="form-check mt-3 {{ $errors->has('whatsapp') ? 'has-error' : ''}}">
					<label class="form-check-label text-success" for="whatsapp">
						<input class="form-check-input" type="checkbox" value="1" @if($edit == "true" && $phone["whatsapp"] == 1) checked @endif id="whatsapp" name="whatsapp">
						<span class="form-check-sign"></span>
						Whatsapp
					</label>
				</div>
				<div class="form-check mt-3 {{ $errors->has('default') ? 'has-error' : ''}}">
					<label class="form-check-label text-success" for="default">
						<input class="form-check-input" type="checkbox" value="1" @if($edit == "true" && $phone["default"] == 1) checked @endif id="default" name="default">
						<span class="form-check-sign"></span>
						Default
					</label>
				</div>
				<div class="form-group{{ $errors->has('comment') ? 'has-error' : ''}}">
					<label for="comment" class="col-form-label">{{ __('modal.comment') }}:</label>
					<input type="text" class="form-control" id="comment" name="comment" @if($edit == "true") value="{{$phone['comment']}}" @endif>
				</div>
			</div>
			<div class="modal-footer">
			@if($edit == "true")
				<button id="client-phone-update" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.update') }}</button>
				<button id="client-phone-delete" type="button" class="btn btn-sm btn-simple btn-delete"><i class="fas fa-times"></i> {{ __('modal.delete') }}</button>
			@else
				<button id="client-phone-store" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
			@endif	
			</div>
		</div>
	</div>
</form>