<div class="modal-dialog askprice" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">{{ __('shop_modal.askprice') }} {{$ResultArray["brand"]}} - {{$ResultArray["article"]}}</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="container-fluid">
				<form method="POST" action="{{ route('askprice.send') }}" style="width:100%;">
					@csrf
					<div class="form-group">
						<input type="hidden" name="check_product" value="{{$ResultArray["brand"]}} - {{$ResultArray["article"]}}">
					</div>
					<div class="form-group">
						<label for="form-name">{{ __('shop.search_part_contact') }}</label>
						@guest('clients')<input type="text" id="name" name="name" class="form-control" placeholder="{{ __('shop.search_part_contact') }}">@endguest
						@auth('clients')<input type="text" id="name" name="name" class="form-control" value="{{ Auth::guard('clients')->user()->firstname }}">@endauth
					</div>
					<div class="form-group">
						<label for="email" class="col-form-label">{{ __('shop.email') }}</label>
						@guest('clients')<input type="email" class="form-control" id="email" name="email" placeholder="{{ __('shop.email') }}">@endguest
						@auth('clients')<input type="email" class="form-control" id="email" name="email" value="{{ Auth::guard('clients')->user()->email }}">@endauth
					</div>
					<div class="form-group">
						<label for="phone" class="col-form-label">{{ __('shop_modal.phone') }}</label>
						<input type="text" class="form-control" id="phone" name="phone">
					</div>
					<div class="form-group">
						<label for="message" class="col-form-label">{{ __('shop_modal.message') }}</label>
						<textarea class="form-control" id="message" name="message"></textarea>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">{{ __('shop_modal.send') }}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>