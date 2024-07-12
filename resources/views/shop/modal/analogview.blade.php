<div class="analogview modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">{{ __('shop_modal.analogsfor') }} - {{$ResultArray["brand"]}} - {{$ResultArray["article"]}}</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="container-fluid">
				@if(count($ResultArray["analogs"])>0)
					<div class="product__features-title">{{ __('shop_modal.analogs') }}</div>
					<table class="analogview__product-description table">
						<thead>
							<tr>
								<th class="col-3">{{ __('shop_modal.brand') }}</th>
								<th class="col-3">{{ __('shop_modal.article') }}</th>
								<th class="col-3">{{ __('shop_modal.name') }}</th>
								<th class="col-3 d-none d-sm-block">{{ __('shop_modal.type') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($ResultArray["analogs"] as $item)
							<tr>
								<td class="col-3">{{$item["brand"]}}</td>
								<td class="col-3"><a href="{{$item["link"]}}">{{$item["article"]}}</a></td>
								<td class="col-3">{{$item["name"]}}</td>
								<td class="col-3 d-none d-sm-block">{{$item["type"]}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@else
					<div class="product__features-title">{{ __('shop_modal.noanalogs') }}</div>
					@endif
			</div>
		</div>
	</div>
</div>