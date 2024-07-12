<div class="widget widget-filters widget-filters--offcanvas--mobile" data-collapse="" data-collapse-opened-class="filter--opened">
<form method="POST" action="{{ route('special.tyres') }}" style="width:100%;">
@csrf
	<div class="widget__header widget-filters__header">
		<h4>{{ __('catalog.filters') }}</h4>
	</div>
	<div class="widget-filters__list">
		<div class="widget-filters__item">
			<div class="filter filter--opened" data-collapse-item="">
				<button type="button" class="filter__title" data-collapse-trigger="">{{ __('catalog.price') }}
					<span class="filter__arrow">
						<svg width="12px" height="7px">
							<path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"></path>
						</svg>
					</span>
				</button>
				<div class="filter__body" data-collapse-content="">
					<div class="filter__container">
						<div class="filter-price" data-min="500" data-max="1500" data-from="590" data-to="1000">
							<div class="filter-price__slider noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr">
								<div class="noUi-base">
									<div class="noUi-connects">
										<div class="noUi-connect" style="transform: translate(9%) scale(0.41, 1);"></div>
									</div>
									<div class="noUi-origin" style="transform: translate(-910%); z-index: 5;">
										<div class="noUi-handle noUi-handle-lower" data-handle="0" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="500.0" aria-valuemax="1000.0" aria-valuenow="590.0" aria-valuetext="590.00">
											<div class="noUi-touch-area"></div>
										</div>
									</div>
									<div class="noUi-origin" style="transform: translate(-500%); z-index: 6;">
										<div class="noUi-handle noUi-handle-upper" data-handle="1" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="590.0" aria-valuemax="1500.0" aria-valuenow="1000.0" aria-valuetext="1000.00">
											<div class="noUi-touch-area"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="filter-price__title-button">
								<div class="filter-price__title">{{Session::get('currency_symbol')}}<span class="filter-price__min-value">590.00</span> – {{Session::get('currency_symbol')}}<span class="filter-price__max-value">1000.00</span></div>
								<button type="button" class="btn btn-xs btn-secondary filter-price__button">Filter</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--width-->
		<div class="widget-filters__item">
			<div class="filter filter--opened" data-collapse-item="">
				<button type="button" class="filter__title" data-collapse-trigger="">{{ __('catalog.width') }}
					<span class="filter__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="12px" height="7px">
						<path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"></path></svg></span>
				</button>
				<div class="filter__body" data-collapse-content="">
					<div class="filter__container">
						<div class="filter-list">
							<div class="filter-list__list">
								@foreach ($ResultArray["all_width"] as $bkey=>$width)
									<label class="filter-list__item">
										<span class="input-check filter-list__input">
											<span class="input-check__body">
												<input class="input-check__input" onchange="javascript:this.form.submit();" name="width[]" value="{{$width}}" id="{{$width}}" type="checkbox" @if(request('width')) checked @endif>
												<span class="input-check__box"></span>
												<span class="input-check__icon">
													<svg xmlns="http://www.w3.org/2000/svg" width="9px" height="7px">
														<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
													</svg>
												</span>
											</span>
										</span>
										<span class="filter-list__title">{{$width}}</span>
										@if(isset($ResultArray["ab_min_price_f"][$bkey]) && $ResultArray["ab_min_price_f"][$bkey]>0)
										<span class="filter-list__counter">{{Session::get('currency_symbol')}} {{$ResultArray["ab_min_price_f"][$bkey]}}</span>
										@endif
									</label>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--height-->
		<div class="widget-filters__item">
			<div class="filter filter--opened" data-collapse-item="">
				<button type="button" class="filter__title" data-collapse-trigger="">{{ __('catalog.height') }}
					<span class="filter__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="12px" height="7px">
						<path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"></path></svg></span>
				</button>
				<div class="filter__body" data-collapse-content="">
					<div class="filter__container">
						<div class="filter-list">
							<div class="filter-list__list">
								@foreach ($ResultArray["all_height"] as $bkey=>$height)
									<label class="filter-list__item">
										<span class="input-check filter-list__input">
											<span class="input-check__body">
												<input class="input-check__input" onchange="javascript:this.form.submit();" name="height[]" value="{{$height}}" id="{{$height}}" type="checkbox" @if(request('height')) checked @endif>
												<span class="input-check__box"></span>
												<span class="input-check__icon">
													<svg xmlns="http://www.w3.org/2000/svg" width="9px" height="7px">
														<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
													</svg>
												</span>
											</span>
										</span>
										<span class="filter-list__title">{{$height}}</span>
										@if(isset($ResultArray["ab_min_price_f"][$bkey]) && $ResultArray["ab_min_price_f"][$bkey]>0)
										<span class="filter-list__counter">{{Session::get('currency_symbol')}} {{$ResultArray["ab_min_price_f"][$bkey]}}</span>
										@endif
									</label>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--size testing-->
		<div class="widget-filters__item">
			<div class="filter filter--opened" data-collapse-item="">
				<button type="button" class="filter__title" data-collapse-trigger="">{{ __('catalog.size') }}
					<span class="filter__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="12px" height="7px">
						<path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"></path></svg></span>
				</button>
				<div class="filter__body" data-collapse-content="">
					<div class="filter__container">
						<div class="filter-list">
							<div class="filter-list__list">
								@foreach ($ResultArray["all_size"] as $bkey=>$size)
									<label class="filter-list__item">
										<span class="input-check filter-list__input">
											<span class="input-check__body">
												<input class="input-check__input" onchange="javascript:this.form.submit();" name="size[]" value="{{$size}}" id="{{$size}}" type="checkbox" @if(request('size')) checked @endif>
												<span class="input-check__box"></span>
												<span class="input-check__icon">
													<svg xmlns="http://www.w3.org/2000/svg" size="9px" height="7px">
														<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
													</svg>
												</span>
											</span>
										</span>
										<span class="filter-list__title">{{$size}}</span>
										@if(isset($ResultArray["ab_min_price_f"][$bkey]) && $ResultArray["ab_min_price_f"][$bkey]>0)
										<span class="filter-list__counter">{{Session::get('currency_symbol')}} {{$ResultArray["ab_min_price_f"][$bkey]}}</span>
										@endif
									</label>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--brand-->
		<div class="widget-filters__item">
			<div class="filter filter--opened" data-collapse-item="">
				<button type="button" class="filter__title" data-collapse-trigger="">{{ __('catalog.brand') }}
					<span class="filter__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="12px" height="7px">
						<path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"></path></svg></span>
				</button>
				<div class="filter__body" data-collapse-content="">
					<div class="filter__container">
						<div class="filter-list">
							<div class="filter-list__list">
							<!--firstbrand-->
								@foreach ($ResultArray["all_brands"] as $bkey=>$brand)
									<label class="filter-list__item">
										<span class="input-check filter-list__input">
											<span class="input-check__body">
												<input class="input-check__input" onchange="javascript:this.form.submit();" name="brand[]" value="{{$brand}}" id="{{$brand}}" type="checkbox" @if(request('brand')) checked @endif>
												<span class="input-check__box"></span>
												<span class="input-check__icon">
													<svg xmlns="http://www.w3.org/2000/svg" width="9px" height="7px">
														<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
													</svg>
												</span>
											</span>
										</span>
										<span class="filter-list__title">{{$brand}}</span>
										@if(isset($ResultArray["ab_min_price_f"][$bkey]) && $ResultArray["ab_min_price_f"][$bkey]>0)
										<span class="filter-list__counter">{{Session::get('currency_symbol')}} {{$ResultArray["ab_min_price_f"][$bkey]}}</span>
										@endif
									</label>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--season testing-->
		<div class="widget-filters__item">
			<div class="filter filter--opened" data-collapse-item="">
				<button type="button" class="filter__title" data-collapse-trigger="">{{ __('catalog.season') }}
					<span class="filter__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="12px" height="7px">
						<path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"></path></svg></span>
				</button>
				<div class="filter__body" data-collapse-content="">
					<div class="filter__container">
						<div class="filter-list">
							<div class="filter-list__list">
								@foreach ($ResultArray["all_seasons"] as $bkey=>$season)
									<label class="filter-list__item">
										<span class="input-check filter-list__input">
											<span class="input-check__body">
												<input class="input-check__input" onchange="javascript:this.form.submit();" name="season[]" value="{{$season}}" id="{{$season}}" type="checkbox" @if(request('season')) checked @endif>
												<span class="input-check__box"></span>
												<span class="input-check__icon">
													<svg xmlns="http://www.w3.org/2000/svg" season="9px" height="7px">
														<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
													</svg>
												</span>
											</span>
										</span>
										<span class="filter-list__title">{{$season}}</span>
										@if(isset($ResultArray["ab_min_price_f"][$bkey]) && $ResultArray["ab_min_price_f"][$bkey]>0)
										<span class="filter-list__counter">{{Session::get('currency_symbol')}} {{$ResultArray["ab_min_price_f"][$bkey]}}</span>
										@endif
									</label>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--rating-->
		<div class="widget-filters__item">
			<div class="filter filter--opened" data-collapse-item="">
				<button type="button" class="filter__title" data-collapse-trigger="">{{ __('catalog.rating') }}
					<span class="filter__arrow">
						<svg width="12px" height="7px">
							<path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"></path>
						</svg>
					</span>
				</button>
				<div class="filter__body" data-collapse-content="" style="">
					<div class="filter__container">
						<div class="filter-rating">
							<ul class="filter-rating__list">
								<li class="filter-rating__item">
									<label class="filter-rating__item-label">
										<span class="input-check filter-rating__item-input">
											<span class="input-check__body">
												<input class="input-check__input" type="checkbox">
												<span class="input-check__box"></span>
												<span class="input-check__icon">
													<svg width="9px" height="7px">
														<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
													</svg>
												</span>
											</span>
										</span>
										<span class="filter-rating__item-stars">
											<div class="rating">
												<div class="rating__body">
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
												</div>
											</div>
										</span>
										<span class="filter-rating__item-title sr-only">5 stars </span>
										<span class="filter-rating__item-counter">42</span>
									</label>
								</li>
								<li class="filter-rating__item">
									<label class="filter-rating__item-label">
										<span class="input-check filter-rating__item-input">
											<span class="input-check__body">
												<input class="input-check__input" type="checkbox">
												<span class="input-check__box"></span>
												<span class="input-check__icon">
													<svg width="9px" height="7px">
														<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
													</svg>
												</span>
											</span>
										</span>
										<span class="filter-rating__item-stars">
											<div class="rating">
												<div class="rating__body">
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star"></div>
												</div>
											</div>
										</span>
										<span class="filter-rating__item-title sr-only">4 stars </span>
										<span class="filter-rating__item-counter">24</span>
									</label>
								</li>
								<li class="filter-rating__item">
									<label class="filter-rating__item-label">
										<span class="input-check filter-rating__item-input">
											<span class="input-check__body">
												<input class="input-check__input" type="checkbox">
												<span class="input-check__box"></span>
												<span class="input-check__icon">
													<svg width="9px" height="7px">
														<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
													</svg>
												</span>
											</span>
										</span>
										<span class="filter-rating__item-stars">
											<div class="rating">
												<div class="rating__body">
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star"></div>
													<div class="rating__star"></div>
												</div>
											</div>
										</span>
										<span class="filter-rating__item-title sr-only">3 stars </span>
										<span class="filter-rating__item-counter">19</span>
									</label>
								</li>
								<li class="filter-rating__item">
									<label class="filter-rating__item-label">
										<span class="input-check filter-rating__item-input">
											<span class="input-check__body">
												<input class="input-check__input" type="checkbox">
												<span class="input-check__box"></span>
												<span class="input-check__icon">
													<svg width="9px" height="7px">
														<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
													</svg>
												</span>
											</span>
										</span>
										<span class="filter-rating__item-stars">
											<div class="rating">
												<div class="rating__body">
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star"></div>
													<div class="rating__star"></div>
													<div class="rating__star"></div>
												</div>
											</div>
										</span>
										<span class="filter-rating__item-title sr-only">2 stars </span>
										<span class="filter-rating__item-counter">3</span>
									</label>
								</li>
								<li class="filter-rating__item">
									<label class="filter-rating__item-label">
										<span class="input-check filter-rating__item-input">
											<span class="input-check__body">
												<input class="input-check__input" type="checkbox">
												<span class="input-check__box"></span>
												<span class="input-check__icon">
													<svg width="9px" height="7px">
														<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
													</svg>
												</span>
											</span>
										</span>
										<span class="filter-rating__item-stars">
											<div class="rating">
												<div class="rating__body">
													<div class="rating__star rating__star--active"></div>
													<div class="rating__star"></div>
													<div class="rating__star"></div>
													<div class="rating__star"></div>
													<div class="rating__star"></div>
												</div>
											</div>
										</span>
										<span class="filter-rating__item-title sr-only">1 star </span>
										<span class="filter-rating__item-counter">12</span>
									</label>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!---->
	</div>
		</form>
</div>