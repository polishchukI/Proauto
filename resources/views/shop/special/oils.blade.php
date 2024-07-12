@extends('shop.template')

@section('content')
<!-- site__body -->
<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				<!--breadcrumbs-->
				@include('shop.layouts.breadcrumbs')
				<!--breadcrumbs-end-->
				<h1 class="block-header__title">Oils</h1>
			</div>
			<div class="block-split">
				<div class="container">
					<div class="block-split__row row no-gutters">
						<div class="block-split__item block-split__item-content col-auto">
							<div class="block">
								<div class="products-view">
									<div class="products-view__options view-options view-options--offcanvas--always">
										<div class="view-options__body">
											<div class="view-options__layout layout-switcher">
												<div class="layout-switcher__list">
													<button type="button" class="layout-switcher__button" data-layout="grid" data-with-features="false">
														<svg width="16" height="16"><path d="M15.2,16H9.8C9.4,16,9,15.6,9,15.2V9.8C9,9.4,9.4,9,9.8,9h5.4C15.6,9,16,9.4,16,9.8v5.4C16,15.6,15.6,16,15.2,16z M15.2,7H9.8C9.4,7,9,6.6,9,6.2V0.8C9,0.4,9.4,0,9.8,0h5.4C15.6,0,16,0.4,16,0.8v5.4C16,6.6,15.6,7,15.2,7z M6.2,16H0.8C0.4,16,0,15.6,0,15.2V9.8C0,9.4,0.4,9,0.8,9h5.4C6.6,9,7,9.4,7,9.8v5.4C7,15.6,6.6,16,6.2,16z M6.2,7H0.8C0.4,7,0,6.6,0,6.2V0.8C0,0.4,0.4,0,0.8,0h5.4C6.6,0,7,0.4,7,0.8v5.4C7,6.6,6.6,7,6.2,7z"></path></svg>
													</button>
													<button type="button" class="layout-switcher__button layout-switcher__button--active" data-layout="grid" data-with-features="true" disabled="disabled">
														<svg width="16" height="16"><path d="M16,0.8v14.4c0,0.4-0.4,0.8-0.8,0.8H9.8C9.4,16,9,15.6,9,15.2V0.8C9,0.4,9.4,0,9.8,0l5.4,0C15.6,0,16,0.4,16,0.8z M7,0.8v14.4C7,15.6,6.6,16,6.2,16H0.8C0.4,16,0,15.6,0,15.2L0,0.8C0,0.4,0.4,0,0.8,0l5.4,0C6.6,0,7,0.4,7,0.8z"></path></svg></button>
													<button type="button" class="layout-switcher__button" data-layout="list" data-with-features="false">
														<svg width="16" height="16"><path d="M15.2,16H0.8C0.4,16,0,15.6,0,15.2V9.8C0,9.4,0.4,9,0.8,9h14.4C15.6,9,16,9.4,16,9.8v5.4C16,15.6,15.6,16,15.2,16z M15.2,7H0.8C0.4,7,0,6.6,0,6.2V0.8C0,0.4,0.4,0,0.8,0h14.4C15.6,0,16,0.4,16,0.8v5.4C16,6.6,15.6,7,15.2,7z"></path></svg>
													</button>
													<button type="button" class="layout-switcher__button" data-layout="table" data-with-features="false">
														<svg width="16" height="16"><path d="M15.2,16H0.8C0.4,16,0,15.6,0,15.2v-2.4C0,12.4,0.4,12,0.8,12h14.4c0.4,0,0.8,0.4,0.8,0.8v2.4C16,15.6,15.6,16,15.2,16zM15.2,10H0.8C0.4,10,0,9.6,0,9.2V6.8C0,6.4,0.4,6,0.8,6h14.4C15.6,6,16,6.4,16,6.8v2.4C16,9.6,15.6,10,15.2,10z M15.2,4H0.8C0.4,4,0,3.6,0,3.2V0.8C0,0.4,0.4,0,0.8,0h14.4C15.6,0,16,0.4,16,0.8v2.4C16,3.6,15.6,4,15.2,4z"></path></svg>
													</button>
												</div>
											</div>
											<div class="view-options__legend">
												<nav aria-label="Page navigation example"><ul class="pagination">{{$Numbers->links()}}</ul></nav>
												<div class="products-view__pagination-legend">Showing {{count($Numbers)}} of {{$total}} products</div>
											</div>
											<div class="view-options__spring"></div>
										</div>
									</div>									
									<div class="products-view__options view-options view-options--offcanvas--always">
										<form method="POST" action="{{ route('special.oils') }}">
											@csrf
											<div class="view-options__body">
												<div class="view-options__select">
													<label for="view-option-oil_type">{{ __('catalog.oil_type') }}</label>
													<select id="view-option-oil_type" class="form-control form-control-sm" name="oil_type" onchange="javascript:this.form.submit();" >
													@foreach($ResultArray["oil_type"] as $value=>$name)
														<option value="{{$value}}" @if(request('oil_type')==$value) selected @endif>{{$name}}</option>  
													@endforeach
													</select>
												</div>
												<div class="view-options__select">
													<label for="view-option-oil_brand">{{ __('catalog.oil_brand') }}</label>
													<select id="view-option-oil_brand" class="form-control form-control-sm" name="oil_brand" onchange="javascript:this.form.submit();" >
													@foreach($ResultArray["oil_brand"] as $value=>$name)
														<option value="{{$value}}" @if(request('oil_brand')==$value) selected @endif>{{$name}}</option>
													@endforeach

													</select>
												</div>
												<div class="view-options__select">
													<label for="view-option-oil_viscosity">{{ __('catalog.oil_viscosity') }}</label>
													<select id="view-option-oil_viscosity" class="form-control form-control-sm" name="oil_viscosity" onchange="javascript:this.form.submit();" >
													@foreach($ResultArray["oil_viscosity"] as $value=>$name)
														<option value="{{$value}}" @if(request('oil_viscosity')==$value) selected @endif>{{$name}}</option>  
													@endforeach
													</select>
												</div>
												<div class="view-options__select">
													<label for="view-option-oil_acea">{{ __('catalog.oil_acea') }}</label>
													<select id="view-option-oil_acea" class="form-control form-control-sm" name="oil_acea" onchange="javascript:this.form.submit();" >
													@foreach($ResultArray["oil_acea"] as $value=>$name)
														<option value="{{$value}}" @if(request('oil_acea')==$value) selected @endif>{{$name}}</option>  
													@endforeach
													</select>
												</div>
												<div class="view-options__select">
													<label for="view-option-oil_api">{{ __('catalog.oil_api') }}</label>
													<select id="view-option-oil_api" class="form-control form-control-sm" name="oil_api" onchange="javascript:this.form.submit();" >
													@foreach($ResultArray["oil_api"] as $value=>$name)
														<option value="{{$value}}" @if(request('oil_api')==$value) selected @endif>{{$name}}</option>  
													@endforeach
													</select>
												</div>
												<div class="view-options__select">
													<label for="view-option-oil_oem">{{ __('catalog.oil_oem') }}</label>
													<select id="view-option-oil_oem" class="form-control form-control-sm" name="oil_oem" onchange="javascript:this.form.submit();" >
													@foreach($ResultArray["oil_oem"] as $value=>$name)
														<option value="{{$value}}" @if(request('oil_oem')==$value) selected @endif>{{$name}}</option>  
													@endforeach
													</select>
												</div>
												<div class="view-options__select">
													<label for="view-option-oil_basis">{{ __('catalog.oil_basis') }}</label>
													<select id="view-option-oil_basis" class="form-control form-control-sm" name="oil_basis" onchange="javascript:this.form.submit();" >
													@foreach($ResultArray["oil_basis"] as $value=>$name)
														<option value="{{$value}}" @if(request('oil_basis')==$value) selected @endif>{{$name}}</option>  
													@endforeach
													</select>
												</div>
											</div>
										</form>
										<div class="view-options__body view-options__body--filters">
											<div class="view-options__label">Active Filters</div>
											<div class="applied-filters">
												<ul class="applied-filters__list">
													@if(request('oil_basis'))
													<li class="applied-filters__item">
														<a href="#" class="applied-filters__button applied-filters__button--filter">{{ request('oil_basis') }}<svg width="9" height="9"><path d="M9,8.5L8.5,9l-4-4l-4,4L0,8.5l4-4l-4-4L0.5,0l4,4l4-4L9,0.5l-4,4L9,8.5z"></path></svg></a>
													</li>
													@endif
													@if(request('oil_oem'))
													<li class="applied-filters__item">
														<a href="#" class="applied-filters__button applied-filters__button--filter">{{ request('oil_oem') }}<svg width="9" height="9"><path d="M9,8.5L8.5,9l-4-4l-4,4L0,8.5l4-4l-4-4L0.5,0l4,4l4-4L9,0.5l-4,4L9,8.5z"></path></svg></a>
													</li>
													@endif
													@if(request('oil_acea'))
													<li class="applied-filters__item">
														<a href="#" class="applied-filters__button applied-filters__button--filter">{{ request('oil_acea') }}<svg width="9" height="9"><path d="M9,8.5L8.5,9l-4-4l-4,4L0,8.5l4-4l-4-4L0.5,0l4,4l4-4L9,0.5l-4,4L9,8.5z"></path></svg></a>
													</li>
													@endif
													@if(request('oil_viscosity'))
													<li class="applied-filters__item">
														<a href="#" class="applied-filters__button applied-filters__button--filter">{{ request('oil_viscosity') }}<svg width="9" height="9"><path d="M9,8.5L8.5,9l-4-4l-4,4L0,8.5l4-4l-4-4L0.5,0l4,4l4-4L9,0.5l-4,4L9,8.5z"></path></svg></a>
													</li>
													@endif
													@if(request('oil_brand'))
													<li class="applied-filters__item">
														<a href="#" class="applied-filters__button applied-filters__button--filter">{{ request('oil_brand') }}<svg width="9" height="9"><path d="M9,8.5L8.5,9l-4-4l-4,4L0,8.5l4-4l-4-4L0.5,0l4,4l4-4L9,0.5l-4,4L9,8.5z"></path></svg></a>
													</li>
													@endif
													@if(request('oil_type'))
													<li class="applied-filters__item">
														<a href="#" class="applied-filters__button applied-filters__button--filter">{{ request('oil_type') }}<svg width="9" height="9"><path d="M9,8.5L8.5,9l-4-4l-4,4L0,8.5l4-4l-4-4L0.5,0l4,4l4-4L9,0.5l-4,4L9,8.5z"></path></svg></a>
													</li>
													@endif
													@if(request('oil_api'))
													<li class="applied-filters__item">
														<a href="#" class="applied-filters__button applied-filters__button--filter">{{ request('oil_api') }}<svg width="9" height="9"><path d="M9,8.5L8.5,9l-4-4l-4,4L0,8.5l4-4l-4-4L0.5,0l4,4l4-4L9,0.5l-4,4L9,8.5z"></path></svg></a>
													</li>
													@endif
													<li class="applied-filters__item"><button type="button" class="applied-filters__button applied-filters__button--clear">Clear All</button></li>
												</ul>
											</div>
										</div>
									</div>
									
									<div class="products-view__list products-list products-list--grid--6" data-layout="grid" data-with-features="true">
										<div class="products-list__head">
											<div class="products-list__column products-list__column--image">Image</div>
											<div class="products-list__column products-list__column--meta">SKU</div>
											<div class="products-list__column products-list__column--product">Product</div>
											<div class="products-list__column products-list__column--rating">Rating</div>
											<div class="products-list__column products-list__column--price">Price</div>
										</div>
										<div class="products-list__content">
											<div class="products-list__item">
												<div class="product-card">
													<div class="product-card__actions-list">
														<button class="product-card__action product-card__action--quickview" type="button" aria-label="Quick view"><svg width="16" height="16"><path d="M14,15h-4v-2h3v-3h2v4C15,14.6,14.6,15,14,15z M13,3h-3V1h4c0.6,0,1,0.4,1,1v4h-2V3z M6,3H3v3H1V2c0-0.6,0.4-1,1-1h4V3zM3,13h3v2H2c-0.6,0-1-0.4-1-1v-4h2V13z"></path></svg></button>
														<button class="product-card__action product-card__action--wishlist" type="button" aria-label="Add to wish list"><svg width="16" height="16"><path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z"></path></svg></button>
														<button class="product-card__action product-card__action--compare" type="button" aria-label="Add to compare"><svg width="16" height="16"><path d="M9,15H7c-0.6,0-1-0.4-1-1V2c0-0.6,0.4-1,1-1h2c0.6,0,1,0.4,1,1v12C10,14.6,9.6,15,9,15z"></path><path d="M1,9h2c0.6,0,1,0.4,1,1v4c0,0.6-0.4,1-1,1H1c-0.6,0-1-0.4-1-1v-4C0,9.4,0.4,9,1,9z"></path>
														<path d="M15,5h-2c-0.6,0-1,0.4-1,1v8c0,0.6,0.4,1,1,1h2c0.6,0,1-0.4,1-1V6C16,5.4,15.6,5,15,5z"></path></svg></button>
													</div>
													<div class="product-card__image">
														<div class="image image--type--product">
															<a href="product-full.html" class="image__body"><img class="image__tag" src="images/products/product-13-245x245.jpg" alt=""></a>
														</div>
														<div class="status-badge status-badge--style--success product-card__fit status-badge--has-icon status-badge--has-text">
															<div class="status-badge__body">
																<div class="status-badge__icon"><svg width="13" height="13"><path d="M12,4.4L5.5,11L1,6.5l1.4-1.4l3.1,3.1L10.6,3L12,4.4z"></path></svg></div>
																<div class="status-badge__text">Part Fit for 2011 Ford Focus S</div>
																<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="" data-original-title="Part Fit for 2011 Ford Focus S"></div>
															</div>
														</div>
													</div>
													<div class="product-card__info">
														<div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 985-00884-S</div>
														<div class="product-card__name">
															<div><a href="product-full.html">Fantastic 12-Stroke Engine With A Power of 1991 hp</a></div>
														</div>
														<div class="product-card__rating">
															<div class="rating product-card__rating-stars">
																<div class="rating__body">
																	<div class="rating__star rating__star--active"></div>
																	<div class="rating__star rating__star--active"></div>
																	<div class="rating__star rating__star--active"></div>
																	<div class="rating__star"></div>
																	<div class="rating__star"></div>
																</div>
															</div>
															<div class="product-card__rating-label">3 on 17 reviews</div>
														</div>
														<div class="product-card__features">
															<ul>
																<li>Speed: 750 RPM</li>
																<li>Power Source: Cordless-Electric</li>
																<li>Battery Cell Type: Lithium</li>
																<li>Voltage: 20 Volts</li>
																<li>Battery Capacity: 2 Ah</li>
															</ul>
														</div>
													</div>
													<div class="product-card__footer">
														<div class="product-card__prices">
															<div class="product-card__price product-card__price--current">$2579.00</div>
														</div>
														<button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
															<svg width="20" height="20"><circle cx="7" cy="17" r="2"></circle><circle cx="15" cy="17" r="2"></circle><path d="M20,4.4V5l-1.8,6.3c-0.1,0.4-0.5,0.7-1,0.7H6.7c-0.4,0-0.8-0.3-1-0.7L3.3,3.9C3.1,3.3,2.6,3,2.1,3H0.4C0.2,3,0,2.8,0,2.6 V1.4C0,1.2,0.2,1,0.4,1h2.5c1,0,1.8,0.6,2.1,1.6L5.1,3l2.3,6.8c0,0.1,0.2,0.2,0.3,0.2h8.6c0.1,0,0.3-0.1,0.3-0.2l1.3-4.4 C17.9,5.2,17.7,5,17.5,5H9.4C9.2,5,9,4.8,9,4.6V3.4C9,3.2,9.2,3,9.4,3h9.2C19.4,3,20,3.6,20,4.4z"></path></svg>
														</button>
														<button class="product-card__addtocart-full" type="button">Add to cart</button>
														<button class="product-card__wishlist" type="button">
															<svg width="16" height="16"><path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7 l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z"></path></svg>
															<span>Add to wishlist</span>
														</button>
														<button class="product-card__compare" type="button"><svg width="16" height="16"><path d="M9,15H7c-0.6,0-1-0.4-1-1V2c0-0.6,0.4-1,1-1h2c0.6,0,1,0.4,1,1v12C10,14.6,9.6,15,9,15z"></path><path d="M1,9h2c0.6,0,1,0.4,1,1v4c0,0.6-0.4,1-1,1H1c-0.6,0-1-0.4-1-1v-4C0,9.4,0.4,9,1,9z"></path><path d="M15,5h-2c-0.6,0-1,0.4-1,1v8c0,0.6,0.4,1,1,1h2c0.6,0,1-0.4,1-1V6C16,5.4,15.6,5,15,5z"></path></svg> <span>Add to compare</span></button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="products-view__pagination">
										<nav aria-label="Page navigation example"><ul class="pagination">{{$Numbers->links()}}</ul></nav>
										<div class="products-view__pagination-legend">Showing {{count($Numbers)}} of {{$total}} products</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="block-space block-space--layout--before-footer"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- site__body / end -->
@stop