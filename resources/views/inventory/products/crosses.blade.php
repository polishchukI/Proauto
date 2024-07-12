@if($edit == "true")
<form method="POST" id="product-cross-form-update" action="{{ route('products.cross.update') }}" style="width:100%;">
@else
<form method="POST" id="product-cross-form-add" action="{{ route('products.add.cross.store') }}" style="width:100%;">
@endif
	<div class="addcross modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" data-bs-focus="false">
				@if($edit == "true") <h6 class="modal-title">{{ __('modal.editcross') }}</h6> @else <h6 class="modal-title">{{ __('modal.addcross') }}</h6> @endif
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				@csrf
				@if($edit == "true")
				@if(isset($cross["uid"]) && isset($cross["id"]))
				<input type="hidden" name="cross_id" value="{{$cross["id"]}}">
				<input type="hidden" name="uid" value="{{$cross["uid"]}}">
				@endif
				@else
				<input type="hidden" name="product_id" value="{{$product["id"]}}">
				@endif
				<div class="form-group{{ $errors->has('brand') ? 'has-danger' : ''}}">
					<label class="form-label text-success" for="input-brand">{{ __('modal.brand') }}</label>
					<select name="brand" id="input-brand" class="modal-select form-control-alternative{{ $errors->has('brand') ? ' is-invalid' : '' }}" required autofocus>
						@foreach ($brands as $brand)
						@if(isset($cross["bkey"]))
							<option value="{{$brand->brand}}" @if($brand->bkey == $cross['bkey']) selected @endif>{{$brand->brand}}</option>
						@else
							<option value="{{$brand->brand}}">{{$brand->brand}}</option>
						@endif
						@endforeach
					</select>
				</div>
				<div class="form-group{{ $errors->has('article') ? 'has-error' : ''}}">
					<label for="article" class="form-label text-success">{{ __('modal.article') }}:</label>					
					<input class="form-control" id="article" autocomplete="off" name="article" @if($edit == "true") value="{{$cross['article']}}" @endif required>					
				</div>
				<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
					<label for="name" class="form-label text-success">{{ __('modal.product_name') }}:</label>					
					<input class="form-control" id="name" autocomplete="off" name="name" @if($edit == "true") value="{{$cross['name']}}" @endif>
				</div>

				<div class="form-check mt-3 {{ $errors->has('main_by_group') ? 'has-error' : ''}}">
					<label class="form-check-label text-success" for="main_by_group">
						<input class="form-check-input" type="checkbox" value="1" @if($edit == "true" && $cross["main_by_group"] == 1) checked @endif id="main_by_group" name="main_by_group">
						<span class="form-check-sign"></span>
						{{ __('modal.main_by_group') }}
					</label>
				</div>
				
				<div class="form-check mt-3 {{ $errors->has('main_by_brand') ? 'has-error' : ''}}">
					<label class="form-check-label text-success" for="main_by_brand">
						<input class="form-check-input" type="checkbox" value="1" @if($edit == "true" && $cross["main_by_brand"] == 1) checked @endif id="main_by_brand" name="main_by_brand">
						<span class="form-check-sign"></span>
						{{ __('modal.main_by_brand') }}
					</label>
				</div>
			</div>
			<div class="modal-footer">
			@if($edit == "true")
				<button id="product-cross-update" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.update') }}</button>
				<button id="product-cross-delete" type="button" class="btn btn-sm btn-simple btn-delete"><i class="fas fa-times"></i> {{ __('modal.delete') }}</button>
			@else
				<button id="product-cross-add" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
			@endif			
			</div>
		</div>
	</div>
</form>