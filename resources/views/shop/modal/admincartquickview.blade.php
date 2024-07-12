<div class="quickview modal-dialog modal-dialog-centered">
	<div class="modal-content">
		<button type="button" class="quickview__close">
			<svg width="12" height="12">
				<path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6 c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4 C11.2,9.8,11.2,10.4,10.8,10.8z"></path>
			</svg>
		</button>
		<div class="quickview__body">
			<div class="product-gallery product-gallery--layout--quickview quickview__gallery" data-layout="quickview">
				<div class="product-gallery__featured">
					<button type="button" class="product-gallery__zoom">
						<svg width="24" height="24">
							<path d="M15,18c-2,0-3.8-0.6-5.2-1.7c-1,1.3-2.1,2.8-3.5,4.6c-2.2,2.8-3.4,1.9-3.4,1.9s-0.6-0.3-1.1-0.7 c-0.4-0.4-0.7-1-0.7-1s-0.9-1.2,1.9-3.3c1.8-1.4,3.3-2.5,4.6-3.5C6.6,12.8,6,11,6,9c0-5,4-9,9-9s9,4,9,9S20,18,15,18z M15,2 c-3.9,0-7,3.1-7,7s3.1,7,7,7s7-3.1,7-7S18.9,2,15,2z M16,13h-2v-3h-3V8h3V5h2v3h3v2h-3V13z"></path>
						</svg>
					</button>
					<div class="owl-carousel owl-loaded owl-drag">
						<div class="owl-stage-outer">
							<div class="owl-stage" style="transform: translate3d(-320px, 0px, 0px); transition: all 0.3s ease 0s; width: 1280px;">
							@foreach ($ResultArray["images"] as $image)
								<div class="owl-item" style="width: 320px;">
									<a class="image image--type--product" href="{{$image}}" target="_blank" data-width="700" data-height="700">
									<div class="image__body"><img class="image__tag" src="{{$image}}" alt=""></div></a>
								</div>
							@endforeach	
							</div>
						</div>
						<div class="owl-nav disabled">
							<button type="button" role="presentation" class="owl-prev"><span aria-label="{{ __('shop_modal.previous') }}">‹</span></button>
							<button type="button" role="presentation" class="owl-next"><span aria-label="{{ __('shop_modal.next') }}">›</span></button>
						</div>
						<div class="owl-dots disabled"></div>
					</div>
				</div>
				<div class="product-gallery__thumbnails">
					<div class="owl-carousel owl-loaded owl-drag">
						<div class="owl-stage-outer">
							<div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 264px;">
							@foreach ($ResultArray["images"] as $image)
								<div class="owl-item active" style="width: 56px; margin-right: 10px;">
									<div class="product-gallery__thumbnails-item image image--type--product">
										<div class="image__body"><img class="image__tag" src="{{$image}}" alt=""></div>
									</div>
								</div>
							@endforeach	
						</div>
						</div>
						<div class="owl-nav disabled">
							<button type="button" role="presentation" class="owl-prev"><span aria-label="{{ __('shop_modal.previous') }}">‹</span></button>
							<button type="button" role="presentation" class="owl-next"><span aria-label="{{ __('shop_modal.next') }}">›</span></button>
						</div>
						<div class="owl-dots disabled"></div>
					</div>
				</div>
			</div>
			<div class="quickview__product">
				<div class="quickview__product-name">{{$ResultArray["name"]}}</div>
				<div class="quickview__product-meta">
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
						</tbody>
					</table>
				</div>
				<div class="quickview__product-description">
					<div class="product__features">
						<div class="product__features-title">{{ __('shop_modal.properties') }}</div>
						<ul>
						@foreach ($ResultArray["properties"] as $property)
							<li>{{$property["name"]}}: <span>{{$property["VALUE"]}}</span></li>
						@endforeach	
						</ul>
					</div>
				</div>
				<!---->
				<div class="applicability__product-description">
					<div class="product__features">
						@if(count($ResultArray["applicability_brand"])>0)
						<div class="product__features-title">{{ __('shop_modal.applicability') }}</div>
						<div class="accordion" id="accordionBrands">
							@if(array_key_exists("applicability_brand",$ResultArray))
							@foreach ($ResultArray["applicability_brand"] as $brand)
							<div class="card">
								<div class="card-header" id="heading{{$brand["MFA_BRAND"]}}">
									<h6 class="mb-0">
										<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$brand["MFA_BRAND"]}}" aria-expanded="false" aria-controls="collapse{{$brand["MFA_BRAND"]}}">
											{{$brand["MFA_BRAND"]}}
										</button>
									</h6>
								</div>
								<div id="collapse{{$brand["MFA_BRAND"]}}" class="collapse" aria-labelledby="heading{{$brand["MFA_BRAND"]}}" data-parent="#accordionBrands">
									<div class="card-body">
									@if(array_key_exists($brand["MFA_BRAND"],$ResultArray["applicability"]))
									@if(is_array($ResultArray["applicability"][$brand["MFA_BRAND"]]))
										<ul class="widget-categories__list widget-categories__list--child">
										@foreach($ResultArray["applicability"][$brand["MFA_BRAND"]] as $arSec2)
											<li class="widget-categories__item">{{$arSec2["MOD_CDS_TEXT"]}} - {{$arSec2["TYP_CDS_TEXT"]}} ({{$arSec2["TYP_CCM"]}}ccm) {{$arSec2["TYP_KW_FROM"]}}kW/{{$arSec2["TYP_HP_FROM"]}}HP ({{$arSec2["START"]}} - {{$arSec2["END"]}})</li>
										@endforeach
										</ul>
									@endif
									@endif
									</div>
								</div>
							</div>
							@endforeach
							@endif
						</div>
						@else
						<div class="product__features-title">{{ __('shop_modal.noapplicability') }}</div>
						@endif
					</div>
				</div>
				<!---->
				<div class="analogview__product-description">
					<div class="product__features">
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
									<td class="col-3">{{$item["article"]}}</td>
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
				<!---->
				
			</div>
		</div>
	</div>
</div>