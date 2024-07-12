<div class="block-split__item block-split__item-sidebar col-auto">
	<div class="sidebar sidebar--offcanvas--mobile">
		<div class="sidebar__backdrop"></div>
		<div class="sidebar__body">
			<div class="sidebar__header">
				<div class="sidebar__title">Фильтры</div>
				<button class="sidebar__close" type="button">
					<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12">
						<path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4C11.2,9.8,11.2,10.4,10.8,10.8z"></path></svg>
				</button>
			</div>
			<div class="sidebar__content">
				<!---->
				<div class="widget widget-filters widget-filters--offcanvas--mobile" data-collapse="" data-collapse-opened-class="filter--opened">
					<div class="widget__header widget-filters__header">
						<h4>Фильтры</h4>
					</div>
					<div class="widget-filters__list">
						<!--size-->
						<div class="widget-filters__item">
							<div class="filter filter--opened" data-collapse-item="">
								<button type="button" class="filter__title" data-collapse-trigger="">Size
									<span class="filter__arrow">
										<svg width="12px" height="7px">
											<path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"></path>
										</svg>
									</span>
								</button>
								<div class="filter__body" data-collapse-content="" style="">
									<div class="filter__container">
										<div class="filter-list">
											<div class="filter-list__list">
												<div class="filter filter--opened" data-collapse-item="">
													<div class="form-group">
														<select class="form-control" name="rim_size" onchange="SendRimsValue({rim_size:jQuery(this).val()})">
															@foreach ($ResultArray["rim_size"] as $key=>$value)
															<option  @isset($ResultArray['rim_size']) selected @endisset value="{{$key}}">{{$value}}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--size-->
						<!--Holes-->
						<div class="widget-filters__item">
							<div class="filter filter--opened" data-collapse-item="">
								<button type="button" class="filter__title" data-collapse-trigger="">Holes
									<span class="filter__arrow">
										<svg width="12px" height="7px">
											<path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"></path>
										</svg>
									</span>
								</button>
								<div class="filter__body" data-collapse-content="" style="">
									<div class="filter__container">
										<div class="filter-list">
											<div class="filter-list__list">
												<div class="filter filter--opened" data-collapse-item="">
													<div class="form-group">
														<select class="form-control" name="rim_hole_number" onchange="SendRimsValue({rim_hole_number:jQuery(this).val()})">
															@foreach ($ResultArray["rim_hole_number"] as $key=>$value)
															<option  @isset($ResultArray['rim_hole_number']) selected @endisset value="{{$key}}">{{$value}}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--Holes-->
						<!--PCD-->
						<div class="widget-filters__item">
							<div class="filter filter--opened" data-collapse-item="">
								<button type="button" class="filter__title" data-collapse-trigger="">PCD
									<span class="filter__arrow">
										<svg width="12px" height="7px">
											<path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"></path>
										</svg>
									</span>
								</button>
								<div class="filter__body" data-collapse-content="" style="">
									<div class="filter__container">
										<div class="filter-list">
											<div class="filter-list__list">
												<div class="filter filter--opened" data-collapse-item="">
													<div class="form-group">
														<select class="form-control" name="bolt_hole_circle" onchange="SendRimsValue({bolt_hole_circle:jQuery(this).val()})">
															@foreach ($ResultArray["bolt_hole_circle"] as $key=>$value)
															<option  @isset($ResultArray['bolt_hole_circle']) selected @endisset value="{{$key}}">{{$value}}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--PCD-->
						<!--width-->
						<div class="widget-filters__item">
							<div class="filter filter--opened" data-collapse-item="">
								<button type="button" class="filter__title" data-collapse-trigger="">width
									<span class="filter__arrow">
										<svg width="12px" height="7px">
											<path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"></path>
										</svg>
									</span>
								</button>
								<div class="filter__body" data-collapse-content="" style="">
									<div class="filter__container">
										<div class="filter-list">
											<div class="filter-list__list">
												<div class="filter filter--opened" data-collapse-item="">
													<div class="form-group">
														<select class="form-control" name="width" onchange="SendRimsValue({width:jQuery(this).val()})">
															@foreach ($ResultArray["width"] as $key=>$value)
															<option  @isset($ResultArray['width']) selected @endisset value="{{$key}}">{{$value}}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--width-->
						<!--firstbrand-->
						<div class="widget-filters__item">
							<div class="filter filter--opened" data-collapse-item="">
								<button type="button" class="filter__title" data-collapse-trigger="">Brand 
									<span class="filter__arrow">
										<svg width="12px" height="7px">
											<path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"></path>
										</svg>
									</span>
								</button>
								<div class="filter__body" data-collapse-content="">
									<div class="filter__container">
										<div class="filter-list">
											<div class="filter-list__list">
											@foreach ($ResultArray["all_brands"] as $bkey=>$brand)
												<label class="filter-list__item">
													<span class="input-check filter-list__input">
														<span class="input-check__body">
															<input class="input-check__input" OnClick="SetPropFilter('Brand','{{$bkey}}')" value="{{$brand}}" type="checkbox" @isset($ResultArray['filtered_brands'][$bkey]) checked @endisset>
															<span class="input-check__box"></span>
															<span class="input-check__icon">
																<svg xmlns="http://www.w3.org/2000/svg" width="9px" height="7px">
																	<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
																</svg>
															</span>
														</span>
													</span>
													<span class="filter-list__title">{{$brand}}</span>
												</label>
											@endforeach
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--firstbrand-->
						<!---->
						<div class="widget-filters__item">
							<div class="filter filter--opened" data-collapse-item="">
								<button type="button" class="filter__title" data-collapse-trigger="">Rating
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
					<!--button reset visibility-->
					<div class="widget-filters__actions d-flex">
						<button onclick="SetPropFilter('Action','Reset')" class="btn btn-secondary btn-sm">Reset</button>
					</div>
				</div>
				<!---->
				@include('shop.block.randomproductswidget')
				<!---->
			</div>
		</div>
	</div>
</div>
<!--sidebar block-->