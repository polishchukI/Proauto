<div class="pricesview modal-dialog modal-dialog-centered">
	<div class="modal-content">
		<button type="button" class="pricesview__close">
			<svg width="12" height="12">
				<path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6 c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4 C11.2,9.8,11.2,10.4,10.8,10.8z"></path>
			</svg>
		</button>
		<div class="pricesview__body">
			<div class="pricesview__product">
				<div class="pricesview__product-name"></div>
				<div class="pricesview__product-meta">
					<table>
						<tbody>
							<tr>
								<th>{{ __('shop_modal.article') }}</th>
								<td>{{$ResultArray["article"]}}</td>
							</tr>
							<tr>
								<th>{{ __('shop_modal.brand') }}</th>
								<td>{{$ResultArray["brand"]}}</td>
							</tr>
							<tr>
								<th>{{ __('shop_modal.country') }}</th>
								<td>Japan</td>
							</tr>
							<!--tr>
								<th>{{ __('shop_modal.article') }}</th>
								<td>{{$ResultArray["article"]}}</td>
							</tr-->
						</tbody>
					</table>
				</div>
				<div class="pricesview__product-description">
					<div class="product__features">
						<div class="product__features-title">{{ __('shop_modal.pricesfor') }} - {{$ResultArray["brand"]}} - {{$ResultArray["article"]}}</div>
						<table class="pricesview__product-description table">
							<thead>
								<tr>
									<th class="col-2">{{ __('shop_modal.available') }}</th>
									<th class="col-2">{{ __('shop_modal.day') }}</th>
									<th class="col-2 d-none d-sm-block">{{ __('shop_modal.percentgive') }}</th>
									<th class="col-2">{{ __('shop_modal.price') }}</th>
									<th class="col-2 d-none d-sm-block">{{ __('shop_modal.quantity') }}</th>
									<th class="col-2"></th>
								</tr>
							</thead>
							<tbody>
								@foreach($ResultArray["prices"] as $item)
								<tr>
									<td class="col-2">
										<i class="fa fa-boxes"></i><span>{{$item["available"]}}</span></span>
									</td>
									<td class="col-2">
										<i class="fa fa-truck"></i><span>{{$item["day"]}}</span>
									</td>
									<td class="col-2 d-none d-sm-block">
										<span>{{$item["options"]["percentgive"]}} %</span>
									</td>
									<td class="col-2">
										<span>{{Session::get('currency_symbol')}} {{$item["price_formated"]}}</span>
									</td>
									<td class="col-2 d-none d-sm-block">
										<div class="input-number mb-2">
											<input class="form-control input-number__input" type="number" min="1" value="1" max="{{$item["available"]}}">
											<div class="input-number__add"></div>
											<div class="input-number__sub"></div>
										</div>
									</td>
									<td class="col-2">
										<button class="MP_addtocart-full" type="button" OnClick="addtocart(this,'{{$item["uid"]}}')">
											<i class="fas fa-shopping-cart"></i>
										</button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!---->
	</div>
</div>