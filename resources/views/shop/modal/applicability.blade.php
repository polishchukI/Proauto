<div class="applicability modal-dialog modal-dialog-centered">
	<div class="modal-content">
		<button type="button" class="applicability__close">
			<svg width="12" height="12">
				<path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6 c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4 C11.2,9.8,11.2,10.4,10.8,10.8z"></path>
			</svg>
		</button>
		<div class="applicability__body">
			<div class="applicability__product">
				<div class="applicability__product-name">{{ __('shop_modal.applicabilityfor') }} - {{$ResultArray["brand"]}} - {{$ResultArray["article"]}}</div>
				<div class="applicability__product-meta">
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
				<div class="applicability__product-description">
					<div class="product__features">
						@if(count($ResultArray["applicability"])>0)
						<div class="product__features-title">{{ __('shop_modal.applicability') }}</div>
						<div class="accordion" id="accordionBrands">
							@if(array_key_exists("app_brands",$ResultArray))
							@foreach ($ResultArray["app_brands"] as $brand)
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
											<li class="widget-categories__item">
												<a target="_blank" href="{{$arSec2["URL"]}}" class="widget-categories__link">{{$arSec2["MOD_CDS_TEXT"]}} - {{$arSec2["TYP_CDS_TEXT"]}} ({{$arSec2["TYP_CCM"]}}ccm) {{$arSec2["TYP_KW_FROM"]}}kW/{{$arSec2["TYP_HP_FROM"]}}HP ({{$arSec2["START"]}} - {{$arSec2["END"]}})</a>
											</li>
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
			</div>
		</div>
		<!---->
	</div>
</div>