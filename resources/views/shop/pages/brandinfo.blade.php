@extends('shop.template')

@section('content')
<!-- site__body -->
<div class="site__body">
	<div class="block-header block-header--has-breadcrumb">
		<div class="container">
			<div class="block-header__body">
				<!--breadcrumbs-->
				@include('shop.layouts.breadcrumbs')
				<!--breadcrumbs-end-->
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
									<div class="owl-carousel owl-loaded owl-drag">
										<div class="owl-stage-outer">
											<div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0.9s ease 0s; width: 1280px;">
												<div class="owl-item active" style="width: 320px;">
													<img src="{{$brandInfo["main_image"]}}" alt="{{$brandInfo["brand"]}}">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="product__header">
								<h1 class="product__title">{{$brandInfo["brand"]}}</h1>
								<div class="product__subtitle">
									<div class="product__rating">
										<div class="product__rating-stars">
											<div class="rating">
												<div class="rating__body">
													@for($i=1; $i<=$brandInfo["rating"]; $i++)
														<div class="rating__star rating__star--active"></div>
													@endfor
													@for($i=1; $i<=$brandInfo["rating_left"]; $i++)
														<div class="rating__star"></div>
													@endfor
												</div>
											</div>
										</div>
										<div class="product__rating-label">{{$brandInfo["rating"]}} {{ __('shop.reviews_on') }} {{$brandInfo["reviewscount"]}} {{ __('shop.reviews') }}</div>
									</div>
								</div>
							</div>
							<div class="product__main">
								<div class="product__features"></div>
							</div>
							<div class="product__info">
								<div class="product__info-card">
									<div class="product__info-body">
										<div class="product__meta">
											<table>
												<tbody>
													<tr><img class="ProductBrand" src="{{$brandInfo["logo"]}}" alt="{{$brandInfo["brand"]}}"></tr>
													<tr><th>{{ __('catalog.brand') }}</th><td><strong>{{$brandInfo["brand"]}}</strong></td></tr>
													<tr><th>{{ __('catalog.offsite') }}</th><td><strong><a href="{{$brandInfo["off_site"]}}" class="block-brands__item-link" target="_blank">{{ __('catalog.offsite') }}</a></strong></td></tr>
													<tr><th>{{ __('catalog.catalog') }}</th><td><strong><a href="{{$brandInfo["catalog_url"]}}" class="block-brands__item-link" target="_blank">{{ __('catalog.goto') }}</a></strong></td></tr>
													<tr><th>{{ __('catalog.country') }}</th><td><img src="{{$brandInfo["flag_media"]}}" width="24" height="24" alt="{{$brandInfo["country"]}}"> {{$brandInfo["country"]}}</td></tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="product__tags-and-share-links">
										<div class="product__tags tags tags--sm">
											<div class="tags__list">
												<a>{{ $brandInfo["brand"] }}</a>
												@if(isset($brandInfo["country"]))
												<a>{{$brandInfo["country"]}}</a>
												@else
												<a>WorldWide</a>
												@endif
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
									<li class="product-tabs__item product-tabs__item--active"><a href="#product-tab-brand-description">{{ __('catalog.description') }}</a></li>
									<li class="product-tabs__item"><a href="#product-tab-reviews">{{ __('shop.tab_reviews') }} <span class="product-tabs__item-counter">{{$brandInfo["reviewscount"]}}</span></a></li>
								</ul>
								<div class="product-tabs__content max_height">
									<div class="product-tabs__pane product-tabs__pane--active" id="product-tab-brand-description">
										<div class="scroll_block">
											<div class="typography">
												{!!$brandInfo["brand_text"]!!}
											</div>
										</div>
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
																	@foreach ($brandInfo["reviews"] as $review)
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
											<form class="reviews-view__form" method="POST" action="{{ route('ratebrand') }}">
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
														<input type="hidden" id="brand_id" name="brand_id" value="{{$brandInfo["id"]}}">
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
							</div>
						</div>
					</div>
					<div class="block-space block-space--layout--divider-nl"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- site__body / end -->
@stop
