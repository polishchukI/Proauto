@extends('shop.template')

@section('content')

<div class="site__body">
	<div class="block-header block-header--has-breadcrumb">
		<div class="container">
			<div class="block-header__body">
				@include('shop.layouts.breadcrumbs')
			</div>
		</div>
	</div>
	<div class="block-split">
		<div class="container">
			<div class="block-split__row row no-gutters">
				<div class="block-split__item block-split__item-content col-auto">
					<div class="product product--layout--full">
						<div class="product__body">
							<div class="product__card product__card--one"></div>
							<div class="product__card product__card--two"></div>
							<div class="product-gallery product-gallery--layout--product-full product__gallery" data-layout="product-full">
								<div class="product-gallery__featured">
									<button type="button" class="product-gallery__zoom">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M15,18c-2,0-3.8-0.6-5.2-1.7c-1,1.3-2.1,2.8-3.5,4.6c-2.2,2.8-3.4,1.9-3.4,1.9s-0.6-0.3-1.1-0.7 c-0.4-0.4-0.7-1-0.7-1s-0.9-1.2,1.9-3.3c1.8-1.4,3.3-2.5,4.6-3.5C6.6,12.8,6,11,6,9c0-5,4-9,9-9s9,4,9,9S20,18,15,18z M15,2 c-3.9,0-7,3.1-7,7s3.1,7,7,7s7-3.1,7-7S18.9,2,15,2z M16,13h-2v-3h-3V8h3V5h2v3h3v2h-3V13z"></path></svg>
									</button>
									<div class="owl-carousel owl-loaded owl-drag">
										<div class="owl-stage-outer">
											<div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0.9s ease 0s; width: 1280px;">
												@if(isset($MainPartArray["images"]))
													@foreach ($MainPartArray["images"] as $img)
													<div class="owl-item" style="width: 320px;">
														<a href="{{$img}}" target="_blank"><img src="{{$img}}" alt=""> </a>
													</div>
													@endforeach
												@endif
											</div>
										</div>
									</div>
								</div>
								<div class="product-gallery__thumbnails">
									<div class="owl-carousel owl-loaded owl-drag">
										<div class="owl-stage-outer">
											<div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 263px;">
												@if(isset($MainPartArray["images"]))
													@foreach ($MainPartArray["images"] as $img)
													<div class="owl-item active" style="width: 57.6px; margin-right: 8px;">
														<a href="{{$img}}" class="product-gallery__thumbnails-item" target="_blank"><img src="{{$img}}" alt=""> </a>
													</div>
													@endforeach
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="product__header">
								<h1 class="product__title">{{$MainPartArray["name"]}}</h1>
								@if(isset($MainPartArray["rating"]))
								<div class="product__subtitle">
									<div class="product__rating">
										<div class="product__rating-stars">
											<div class="rating">
												<div class="rating__body">
													@for($i=1; $i<=$MainPartArray["rating"]; $i++)
														<div class="rating__star rating__star--active"></div>
													@endfor
													@for($i=1; $i<=$MainPartArray["rating_left"]; $i++)
														<div class="rating__star"></div>
													@endfor
												</div>
											</div>
										</div>
										@if($MainPartArray["reviewscount"]>0)
										<div class="product-card__rating-label">{{$MainPartArray["rating"]}} {{ __('shop.reviews_on') }} {{$MainPartArray["reviewscount"]}} {{ __('shop.reviews') }}</div>
										@endif
									</div>
								</div>
								@endif
							</div>
							<div class="product__main">
								@if(count($MainPartArray["properties"])>0 || isset($MainPartArray["kind"]))
								<div class="product__features">
									<div class="product__features-title">{{ __('shop.product_properties') }}</div>
									<ul>
									@if(isset($MainPartArray["kind"]))
										@if ($MainPartArray["kind"] == "supplier" || $MainPartArray["kind"] == "")<li class="artkind_analog">{{ __('shop.artkind_analog') }}</li>@endif
										@if ($MainPartArray["kind"] == "manufacturer")<li class="artkind_original">{{ __('shop.artkind_original') }}</li>@endif
									@endif
									@foreach ($MainPartArray["properties"] as $Property)										
										<li>{{$Property["name"]}}: <span>{{$Property["value"]}}</span></li>
									@endforeach
									</ul>
								</div>
								@endif
							</div>
							<div class="product__info">
								<div class="product__info-card">
									@if($MainPartArray["prices_count"]>0)
									@foreach ($MainPartArray["prices"] as $PriceArray)
									<div class="product__info-body">
										@foreach ($PriceArray["options"] as $key => $value)
										@if($value>0)
											<div class="product__badge tag-badge tag-badge--{{strtolower($key)}}">{{$key}}</div>
										@endif
										@endforeach										
										<div class="product__prices-stock">
											<div class="product__prices">
												<div class="product__price product__price--current">{{ Session::get('currency_symbol') }} <span>{{ $PriceArray["price_formated"] }}</span></div>
											</div>
											@if(array_key_exists('code',$PriceArray) && $PriceArray["code"]=="MY")
											<div class="status-badge status-badge--style--success product__stock status-badge--has-text">
												<div class="status-badge__body">
													<div class="status-badge__text">{{ __('shop.in_stock') }}</div>
													<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="" data-original-title="{{ __('shop.in_stock') }}"></div>
												</div>
											</div>
											@endif
										</div>
										<div class="product__meta">
											<table>
												<tbody>
													<tr><img class="ProductBrand" src="{{ $MainPartArray["logo_src"] }}" alt="{{ $MainPartArray["brand"] }}"></tr>
													<tr><th>{{ __('shop.article') }}</th><td><a href="{{$MainPartArray["search_url"]}}">{{$MainPartArray["article"]}}</a></td></tr>
													<tr><th>{{ __('shop.brand') }}</th><td><strong>{{$MainPartArray["brand"]}}</strong></td></tr>
													<tr><th>{{ __('shop.name') }}</th><td>{{$MainPartArray["name"]}}</td></tr>
													<tr><th>{{ __('shop.country') }}</th><td><img src="{{$MainPartArray["flag_media"]}}" width="24" height="24" alt="{{$MainPartArray["country"]}}"> {{$MainPartArray["country"]}}</td></tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="product__actions">
										<div class="product__actions-item product__actions-item--quantity">
											<div class="input-number">
												<input class="input-number__input form-control form-control-lg" type="number" min="1" value="1" max="{{$PriceArray["available"]}}">
												<div class="input-number__add"></div>
												<div class="input-number__sub"></div>
											</div>
										</div>
										<div class="product__actions-item product__actions-item--addtocart">
											<button class="btn btn-primary btn-lg btn-block">{{ __('shop.add_to_cart') }}</button>
										</div>
										<div class="product__actions-divider"></div>
									</div>
									@break
									@endforeach
									@else
									<div class="product__info-body">
										<div class="product__prices-stock">
											<div class="product__prices">
												<div class="product__price product__price--current">{{ __('shop.no_price') }}</div>
											</div>
										</div>
										<div class="product__meta">
											<table>
												<tbody>
													<tr><img src="{{$MainPartArray["logo_src"]}}" width="auto" height="32" alt="{{$MainPartArray["logo_src"]}}"></tr>
													<tr><th>{{ __('shop.article') }}</th><td><a href="{{$MainPartArray["search_url"]}}">{{$MainPartArray["article"]}}</a></td></tr>
													<tr><th>{{ __('shop.brand') }}</th><td><strong>{{$MainPartArray["brand"]}}</strong></td></tr>
													<tr><th>{{ __('shop.name') }}</th><td>{{$MainPartArray["name"]}}</td></tr>
													<tr><th>{{ __('shop.country') }}</th><td><img src="{{$MainPartArray["flag_media"]}}" width="24" height="24" alt="{{$MainPartArray["country"]}}"> {{$MainPartArray["country"]}}</td></tr>
												</tbody>
											</table>
										</div>
										<div class="row">
											<div class="col-12" style="top:20px">
												<div class="alert alert-danger mb-3">
													<svg class="CmAvalOnPage CmColorFi" viewBox="0 0 24 24">
														<path d="M16.677 17.868l-.343.195v-1.717l.343-.195v1.717zm2.823-3.325l-.342.195v1.717l.342-.195v-1.717zm3.5-7.602v11.507l-9.75 5.552-12.25-6.978v-11.507l9.767-5.515 12.233 6.941zm-13.846-3.733l9.022 5.178 1.7-.917-9.113-5.17-1.609.909zm2.846 9.68l-9-5.218v8.19l9 5.126v-8.098zm3.021-2.809l-8.819-5.217-2.044 1.167 8.86 5.138 2.003-1.088zm5.979-.943l-2 1.078v2.786l-3 1.688v-2.856l-2 1.078v8.362l7-3.985v-8.151zm-4.907 7.348l-.349.199v1.713l.349-.195v-1.717zm1.405-.8l-.344.196v1.717l.344-.196v-1.717zm.574-.327l-.343.195v1.717l.343-.195v-1.717zm.584-.333l-.35.199v1.717l.35-.199v-1.717z"></path>
													</svg>
													<span>{{ __('shop.not_available') }}</span>
												</div>
											</div>
										</div>
									</div>
									@endif
									<div class="product__tags-and-share-links">
										<div class="product__tags tags tags--sm">
											<div class="tags__list">
												<a>{{ $MainPartArray["article"] }}</a>
												<a>{{ $MainPartArray["brand"] }}</a>
												<a>{{ $MainPartArray["name"] }}</a>
												<a>{{ $MainPartArray["country"] ?? WorldWide }}</a>
											</div>
										</div>
										<div class="product__share-links share-links">
											<script async src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
											<script async src="//yastatic.net/share2/share.js"></script>
											<div class="ya-share2" data-services="facebook,twitter,viber,whatsapp,telegram" data-counter=""></div>
										</div>
									</div>
								</div>
							</div>
							<div class="product__tabs product-tabs product-tabs--layout--full">
								<ul class="product-tabs__list">
									<li class="product-tabs__item product-tabs__item--active"><a href="#product-tab-description">{{ __('shop.tab_description') }}</a></li>
									@if(count($MainPartArray["properties"])>0)
									<li class="product-tabs__item"><a href="#product-tab-specification">{{ __('shop.tab_specification') }}</a></li>
									@endif
									@if(array_key_exists("applicability_brand",$MainPartArray))
									<li class="product-tabs__item"><a href="#product-tab-applicability">{{ __('shop.tab_applicability') }}</a></li>
									@endif
									<li class="product-tabs__item"><a href="#product-tab-reviews">{{ __('shop.tab_reviews') }}<span class="product-tabs__item-counter">{{ $MainPartArray["reviewscount"] ?? 0 }}</span></a></li>
									@if($MainPartArray["prices_count"]>0)
									<li class="product-tabs__item"><a href="#product-tab-prices">{{ __('shop.tab_prices') }}<span class="product-tabs__item-counter">{{ count($MainPartArray["prices"]) ?? 0 }}</span></a></li>
									@endif
									@if(array_key_exists("analogs",$MainPartArray))
									<li class="product-tabs__item"><a href="#product-tab-analogs">{{ __('shop.tab_analogs') }}</a></li>
									@endif
									@if(count($MainPartArray["oemnumbers"])>0)
									<li class="product-tabs__item"><a href="#product-tab-oemnumbers">{{ __('shop.tab_oemnumbers') }}</a></li>
									@endif
								</ul>
								<div class="product-tabs__content max_height">
									{{-- <div class="product-tabs__pane product-tabs__pane--active" id="product-tab-brand-description">
										<div class="row">
											<div class="col-12">
											@if($MainPartArray["brand_description"] != "null")																						
												<div class="typography">											
													{!! $MainPartArray["brand_description"] !!}
												</div>
												@else
												<div class="form-group">
													<span><b>{{ __('shop.no_brand_description') }}</b></span>
												</div>									
												@endif
											</div>
										</div>
									</div> --}}
									<!-- initial -->
									<div class="product-tabs__pane product-tabs__pane--active" id="product-tab-description">
										<div class="typography"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum, diam non iaculis finibus, ipsum arcu sollicitudin dolor, ut cursus sapien sem sed purus. Donec vitae fringilla tortor, sed fermentum nunc. Suspendisse sodales turpis dolor, at rutrum dolor tristique id. Quisque pellentesque ullamcorper felis, eget gravida mi elementum a. Maecenas consectetur volutpat ante, sit amet molestie urna luctus in. Nulla eget dolor semper urna malesuada dictum. Duis eleifend pellentesque dui et finibus. Pellentesque dapibus dignissim augue. Etiam odio est, sodales ac aliquam id, iaculis eget lacus. Aenean porta, ante vitae suscipit pulvinar, purus dui interdum tellus, sed dapibus mi mauris vitae tellus.</p><h4>Etiam lacus lacus mollis in mattis</h4><p>Praesent mattis eget augue ac elementum. Maecenas vel ante ut enim mollis accumsan. Vestibulum vel eros at mi suscipit feugiat. Sed tortor purus, vulputate et eros a, rhoncus laoreet orci. Proin sapien neque, commodo at porta in, vehicula eu elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur porta vulputate augue, at sollicitudin nisl molestie eget.</p><p>Nunc sollicitudin, nunc id accumsan semper, libero nunc aliquet nulla, nec pretium ipsum risus ac neque. Morbi eu facilisis purus. Quisque mi tortor, cursus in nulla ut, laoreet commodo quam. Pellentesque et ornare sapien. In ac est tempus urna tincidunt finibus. Integer erat ipsum, tristique ac lobortis sit amet, dapibus sit amet purus. Nam sed lorem nisi. Vestibulum ultrices tincidunt turpis, sit amet fringilla odio scelerisque non.</p></div>
									</div>
									<!-- specification -->
									@if(count($MainPartArray["properties"])>0)
									<div class="product-tabs__pane" id="product-tab-specification">
										<div class="scroll_block">
											<div class="spec">											
												<div class="spec__section">
													@foreach ($MainPartArray["properties"] as $Property)
													<div class="spec__row"><div class="spec__name">{{ $Property["name"] }}</div><div class="spec__value">{{ $Property["value"] }}</div></div>
													@endforeach
													<div class="spec__disclaimer">{{ __('shop.tab_specification_disclaimer') }}</div>
												</div>
											</div>
										</div>
									</div>
									@endif
									<!-- initial_end -->
									<div class="product-tabs__pane" id="product-tab-applicability">
										<ul class="widget-categories__list widget-categories__list--root" data-collapse="" data-collapse-opened-class="widget-categories__item--open">
											@if(array_key_exists("applicability_brand",$MainPartArray))
											@foreach ($MainPartArray["applicability_brand"] as $brand)
											<li class="widget-categories__item" data-collapse-item="">{{$brand["mfa_brand"]}}
												<button class="widget-categories__expander" type="button" data-collapse-trigger=""></button>
												<div class="widget-categories__container" data-collapse-content="" style="">
													@if(array_key_exists($brand["mfa_brand"],$MainPartArray["applicability"]))
														@if(is_array($MainPartArray["applicability"][$brand["mfa_brand"]]))
															<ul class="widget-categories__list widget-categories__list--child">
															@foreach($MainPartArray["applicability"][$brand["mfa_brand"]] as $arSec2)
																<li class="widget-categories__item"><a target="_blank" href="{{$arSec2["url"]}}" class="widget-categories__link">{{$arSec2["MOD_CDS_TEXT"]}} - {{$arSec2["TYP_CDS_TEXT"]}} ({{$arSec2["TYP_CCM"]}}ccm) {{$arSec2["TYP_KW_FROM"]}}kW/{{$arSec2["TYP_HP_FROM"]}}HP ({{$arSec2["START"]}} - {{$arSec2["END"]}})</a></li>
															@endforeach
															</ul>
														@endif
													@endif
												</div>
											</li>
											@endforeach
											@endif
										</ul>
									</div>
									<div class="product-tabs__pane" id="product-tab-reviews">
									<div>
										<div class="reviews-view">
											<div class="block block-reviews">
												<div class="container">
													<div class="block-reviews__list">
														<div class="owl-carousel owl-loaded owl-drag">
															<div class="owl-stage-outer">
																<div class="owl-stage" style="transform: translate3d(-2740px, 0px, 0px); transition: all 0s ease 0s; width: 9590px;">
																	@foreach ($MainPartArray["reviews"] as $review)
																	<div class="owl-item" style="width: 1350px; margin-right: 20px;">
																		<div class="block-reviews__item">
																			<div class="block-reviews__item-avatar">
																				<img src="{{$review['avatar']}}" alt="{{$review['firstname']}} {{$review['lastname']}}">
																			</div>
																			<div class="block-reviews__item-content">
																				<div class="block-reviews__item-text">{{$review['review']}}</div>
																				<div class="block-reviews__item-meta">
																					<div class="block-reviews__item-rating">
																						<div class="rating">
																							<div class="rating__body">
																							@for($i=1; $i<=$review['rating']; $i++)
																							<div class="rating__star rating__star--active"></div>
																							@endfor
																							@for($i=1; $i<=$review['rating_left']; $i++)
																							<div class="rating__star"></div>
																							@endfor
																							</div>
																						</div>
																					</div>
																					<div class="block-reviews__item-author">{{$review['firstname']}} {{$review['lastname']}}, {{date('d.m.Y', strtotime($review['date']))}}</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	@endforeach
																</div>
															</div>
															<div class="owl-dots"></div>
														</div>
													</div>
												</div>
											</div>
											@auth('clients')
											<form class="reviews-view__form" method="POST" action="{{ route('catalog.rateproduct') }}">
												@csrf
												<h3 class="reviews-view__header">{{ __('shop.write_a_review') }}</h3>
												<div class="row">
													<div class="col-12">
														<div class="form-row">
															<div class="form-group col-md-4">
																<label for="review-stars">{{ __('shop.review_stars') }}</label>
																<select id="review-stars" name="review-stars" class="form-control">
																	<option value="5">5 {{ __('shop.stars_rating') }}</option>
																	<option value="4">4 {{ __('shop.stars_rating') }}</option>
																	<option value="3">3 {{ __('shop.stars_rating') }}</option>
																	<option value="2">2 {{ __('shop.stars_rating') }}</option>
																	<option value="1">1 {{ __('shop.stars_rating') }}</option>
																</select>
															</div>
															<div class="form-group col-md-4">
																<label for="review-author">{{ __('shop.your_name') }}</label>
																<input type="text" class="form-control" id="review-author" name="review-author" value="{{ Auth::guard('clients')->user()->firstname }}">
															</div>
															<div class="form-group col-md-4">
																<label for="review-email">{{ __('shop.your_email') }}</label>
																<input type="text" class="form-control" id="review-email" name="review-email" value="{{ Auth::guard('clients')->user()->email }}">
															</div>
														</div>
														<div class="form-group">
															<label for="review-text">{{ __('shop.your_review') }}</label>
															<textarea class="form-control" id="review-text" name="review-text" rows="6"></textarea>
														</div>
														<input type="hidden" id="pkey" name="pkey" value="{{$MainPartArray["pkey"]}}">
														<input type="hidden" id="article" name="article" value="{{$MainPartArray["article"]}}">
														<input type="hidden" id="akey" name="akey" value="{{$MainPartArray["akey"]}}">
														<input type="hidden" id="brand" name="brand" value="{{$MainPartArray["brand"]}}">
														<input type="hidden" id="bkey" name="bkey" value="{{$MainPartArray["bkey"]}}">
														<input type="hidden" id="name" name="name" value="{{$MainPartArray["name"]}}">
														<div class="form-group mb-0 mt-4"><button type="submit" class="btn btn-primary">{{ __('shop.post_your_review') }}</button></div>
													</div>
												</div>
											</form>
											@else
											<div class="row">
												<div class="col-12">
													<div class="form-group">
														<span><b>{{ __('shop.only_registered') }}</b></span>
													</div>
												</div>
											</div>
											@endauth
										</div>
									</div>
									</div>
									<div class="product-tabs__pane" id="product-tab-prices">
										<div class="scroll_block">
											<table class="analogs-table">
												<thead>
													<tr>
														<th class="analogs-table__column analogs-table__column">{{ __('shop.provider') }}</th>
														<th class="analogs-table__column analogs-table__column">{{ __('shop.day') }}</th>
														<th class="analogs-table__column analogs-table__column">{{ __('shop.stock') }}</th>
														<th class="analogs-table__column analogs-table__column">{{ __('shop.price') }}</th>
														<th class="analogs-table__column analogs-table__column">{{ __('shop.quantity') }}</th>
														<th class="analogs-table__column analogs-table__column">{{ __('shop.order') }}</th>
													</tr>
												</thead>
												<tbody>
												@if($MainPartArray["prices_count"]>0)
												@foreach ($MainPartArray["prices"] as $PriceArray)
												<tr>
													<td class="analogs-table__column analogs-table__column">
														@if(!empty($PriceArray["stock"]))
														<div class="analogs-table__product-name">{{$PriceArray["stock"]}}</div>
														@else
														<div class="analogs-table__product-name">{{$PriceArray["provider_code"]}}</div>
														@endif
													</td>
													<td class="analogs-table__column analogs-table__column">
														@if ($PriceArray["day"] == 0)
														<div class="status-badge status-badge--style--success status-badge--has-icon status-badge--has-text">
															<div class="status-badge__body">
																<div class="status-badge__icon"><svg width="13" height="13"><path d="M12,4.4L5.5,11L1,6.5l1.4-1.4l3.1,3.1L10.6,3L12,4.4z"></path></svg></div>
																<div class="status-badge__text">{{ __('shop.in_stock') }}</div>
																<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="" data-original-title="{{ __('shop.in_stock') }}"></div>
															</div>
														</div>
														@else
														<div class="status-badge status-badge--style--warning status-badge--has-icon status-badge--has-text">
															<div class="status-badge__body">
																<div class="status-badge__icon"><svg width="13" height="13"><path d="M12,4.4L5.5,11L1,6.5l1.4-1.4l3.1,3.1L10.6,3L12,4.4z"></path></svg></div>
																<div class="status-badge__text">{{ $PriceArray["day"] }}</div>
																<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="" data-original-title="{{ $PriceArray["day"] }}"></div>
															</div>
														</div>
														@endif
													</td>
													<td class="analogs-table__column analogs-table__column">
														<span>{{ $PriceArray["available"] }}</span>
													</td>
													<td class="analogs-table__column analogs-table__column"> {{ Session::get('currency_symbol') }} {{$PriceArray["price_formated"]}}</td>
													<td class="analogs-table__column analogs-table__column">
														<div class="input-number">
															<input class="form-control input-number__input" type="number" min="1" value="1" max="{{$PriceArray["available"]}}">
															<div class="input-number__add"></div>
															<div class="input-number__sub"></div>
														</div>
													</td>
													<td class="analogs-table__column analogs-table__column">
														<button OnClick="addtocart(this,'{{$PriceArray["uid"]}}')" class="MP_addtocart-full" type="button">
															<i class="fab fa-opencart"></i>
														</button>
													</td>													
												</tr>
												@endforeach
												@endif
												</tbody>
											</table>
										</div>
									</div>
									@if(array_key_exists("analogs",$MainPartArray))
									<div class="product-tabs__pane" id="product-tab-analogs">
										<div class="scroll_block">
											<table class="analogs-table">
												<thead>
													<tr>
														<th class="analogs-table__column analogs-table__column--name">{{ __('shop.name') }}</th>
														<th class="analogs-table__column analogs-table__column--rating">{{ __('shop.rating') }}</th>
														<th class="analogs-table__column analogs-table__column--vendor">{{ __('shop.brand') }}</th>
														<th class="analogs-table__column analogs-table__column--price">{{ __('shop.price') }}</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($MainPartArray["analogs"] as $analog)
													<tr>
														<td class="analogs-table__column analogs-table__column--name">
															{{ $analog["name"] ?? "" }}<br>
															<div class="analogs-table__sku" data-title="SKU"><a href="{{ route('product.page', ['brand' => $analog["brand"], 'number' => $analog["akey"]]) }}" class="analogs-table__product-sku">{{$analog["article"]}}</a></div>
														</td>
														<td class="analogs-table__column analogs-table__column--rating">
															<div class="analogs-table__rating">
																<div class="analogs-table__rating-stars">
																	<div class="rating">
																		<div class="rating__body">
																			@for($i=1; $i<=$analog['rating']; $i++)
																			<div class="rating__star rating__star--active"></div>
																			@endfor
																			@for($i=1; $i<=$analog['rating_left']; $i++)
																			<div class="rating__star"></div>
																			@endfor
																		</div>
																	</div>
																</div>
																<div class="analogs-table__rating-label">{{ $analog['reviewscount'] }} {{ __('shop.reviews') }}</div>
															</div>
														</td>
														<td class="analogs-table__column analogs-table__column--vendor" data-title="Vendor">{{ $analog["brand"] }}<div class="analogs-table__country">(Germany)</div></td>
														<td class="analogs-table__column analogs-table__column--price">{{ Session::get('currency_symbol') }} {{ number_format($analog["min_price"], 2) }}</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
									@endif
									@if(count($MainPartArray["oemnumbers"])>0)
									<div class="product-tabs__pane" id="product-tab-oemnumbers">
										<div class="scroll_block">
											<table class="analogs-table">
												<thead>
													<tr>
														<th class="analogs-table__column analogs-table__column--name">{{ __('shop.name') }}</th>
														<th class="analogs-table__column analogs-table__column--rating">{{ __('shop.rating') }}</th>
														<th class="analogs-table__column analogs-table__column--vendor">{{ __('shop.brand') }}</th>
														<th class="analogs-table__column analogs-table__column--price">{{ __('shop.price') }}</th>												
													</tr>
												</thead>

												<tbody>
												@foreach ($MainPartArray["oemnumbers"] as $item)
												<tr>
													<td class="analogs-table__column analogs-table__column--name">
														{{ $item["name"] ?? "" }}<br>
														<div class="analogs-table__sku" data-title="SKU"><a href="{{ route('product.page', ['brand' => $item["brand"], 'number' => $item["article"]]) }}" class="analogs-table__product-sku">{{$item["article"]}}</a></div>
													</td>
													<td class="analogs-table__column analogs-table__column--rating">
														<div class="analogs-table__rating">
															<div class="analogs-table__rating-stars">
																<div class="rating">
																	<div class="rating__body">
																		@for($i=1; $i<=$item['rating']; $i++)
																		<div class="rating__star rating__star--active"></div>
																		@endfor
																		@for($i=1; $i<=$item['rating_left']; $i++)
																		<div class="rating__star"></div>
																		@endfor
																	</div>
																</div>
															</div>
															<div class="analogs-table__rating-label">{{ $item['reviewscount'] }} {{ __('shop.reviews') }}</div>
														</div>
													</td>
													<td class="analogs-table__column analogs-table__column--vendor" data-title="Vendor">{{ $item["brand"] }}<div class="analogs-table__country">(Germany)</div></td>
													<td class="analogs-table__column analogs-table__column--price">{{ Session::get('currency_symbol') }} {{ number_format($item["min_price"], 2) }}</td>
												</tr>
												@endforeach
												</tbody>
											</table>
										</div>
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="block-space block-space--layout--divider-nl"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
