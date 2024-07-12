<form id="form-online_client_order_product_create_store" method="POST" action="{{ route('online_client_orders.product.create.store') }}" style="width:100%;">
	<div class="addproduct modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">{{ __('modal.online_client_order_product_create') }}</h6>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				@csrf
				<div class="form-group">
					<div class="form-group{{ $errors->has('article') ? ' has-danger' : '' }}">
						<label class="form-control-label text-success" for="input-article">{{ __('modal.article') }}</label>
						<input type="text" name="article" id="input-article" class="form-control form-control-alternative{{ $errors->has('article') ? ' is-invalid' : '' }}" value="{{ $product_to_create->article }}">
						@include('inventory.alerts.feedback', ['field' => 'article'])
					</div>		
					<div class="form-group{{ $errors->has('brand') ? ' has-danger' : '' }}">
						<label class="form-control-label text-success" for="input-brand">{{ __('modal.brand') }}</label>
						<input type="text" name="brand" id="input-brand" class="form-control form-control-alternative{{ $errors->has('brand') ? ' is-invalid' : '' }}"  value="{{ $product_to_create->brand }}">
						@include('inventory.alerts.feedback', ['field' => 'brand'])
					</div>
				</div>
				<div class="form-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
					<label class="form-control-label text-success" for="input-product_name">{{ __('modal.product_name') }}</label>
					<input type="text" name="product_name" id="input-product_name" class="form-control form-control-alternative{{ $errors->has('product_name') ? ' is-invalid' : '' }}" value="{{ $product_to_create->name }}">
					@include('inventory.alerts.feedback', ['field' => 'product_name'])
				</div>

				<div class="form-group">
					<div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
						<label class="form-control-label text-success" for="input-category">{{ __('modal.product_category') }}</label>
						<select name="category" id="input-category" class="form-select form-control-alternative{{ $errors->has('category') ? ' is-invalid' : '' }}">
							<option value="">{{ __('modal.not_specified') }}</option>
							@foreach ($categories as $category)
							<option value="{{$category['id']}}">{{$category['id']}} - {{$category['name']}}</option>
							@endforeach
						</select>
						@include('inventory.alerts.feedback', ['field' => 'category'])
					</div>
				</div>
				<div class="form-group">
					<div class="form-group{{ $errors->has('group') ? ' has-danger' : '' }}">
						<label class="form-control-label text-success" for="input-group">{{ __('modal.product_group') }}</label>
						<select name="group" id="input-group" class="form-select form-control-alternative{{ $errors->has('group') ? ' is-invalid' : '' }}">
							<option value="">{{ __('modal.not_specified') }}</option>
							@foreach ($groups as $group)
							<option value="{{$group['id']}}">{{$group['id']}} - {{$group['name']}}</option>
							@endforeach
						</select>
						@include('inventory.alerts.feedback', ['field' => 'group'])
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="online_client_order_product_create_button" type="button" class="btn btn-sm btn-simple">{{ __('modal.create') }}</button>
			</div>
		</div>
	</div>
</form>