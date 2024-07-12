<div class="block-split__item block-split__item-content col-auto">
	<div class="block">
		<div class="products-view">
			<div class="products-view__options view-options view-options--offcanvas--mobile">
				<div class="view-options__body">
					<div class="products-view__pagination-legend">Showing {{count($Numbers)}} of {{$total}} products</div>
				</div>
			</div>
			<div class="products-view__list products-list products-list--grid--3" data-layout="grid" data-with-features="false">
				<div class="products-list__head">
					<div class="products-list__column products-list__column--image">Image</div>
					<div class="products-list__column products-list__column--meta">SKU</div>
					<div class="products-list__column products-list__column--product">Product</div>
					<div class="products-list__column products-list__column--rating">Rating</div>
					<div class="products-list__column products-list__column--price">Price</div>
				</div>
				<div class="products-list__content">
					@foreach($Numbers as $item)
					<div class="products-list__item">
						<div class="product-card">
							<div class="product-card__image">
								<div class="image image--type--product">
									<a href="{{$item['search_url']}}" class="image__body"><img class="image__tag" src="{{$item['img_src']}}" alt="{{$item['name']}}"></a>
								</div>
							</div>
							<div class="product-card__info">
								<div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> {{$item['article']}}</div>
								<div class="product-card__name">
									<div>
										<div class="product-card__badges"></div>
										<a href="{{$item['search_url']}}">{{$item['name']}}</a>
									</div>
								</div>
								@if(isset($Number["RATING"]))
								<div class="product-card__rating">
									<div class="rating product-card__rating-stars">
										<div class="rating__body">
										@for($i=1; $i<=$Number["RATING"]; $i++)
											<div class="rating__star rating__star--active"></div>
										@endfor
										@for($i=1; $i<=$Number["RATING_LEFT"]; $i++)
											<div class="rating__star"></div>
										@endfor
										</div>
									</div>
									@if($Number["REVIEWSCOUNT"]>0)
									<div class="product-card__rating-label">{{$Number["RATING"]}} on {{$Number["REVIEWSCOUNT"]}} reviews</div>
									@endif
								</div>
								@endif
								<div class="product-card__features">
									<ul>
								@if(isset($Number["properties"]))
									@foreach ($Number["properties"] as $PName=>$PValue)
										<li><span>{{ $PName }}</span>:<span>{{$PValue}}</span></li>
									@endforeach
								@endif
									</ul>
								</div>
							</div>
							<div class="product-card__footer">
								<div class="product-card__prices">
									<div class="product-card__price product-card__price--current">$19.00</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<div class="products-view__pagination">
				<nav aria-label="Page navigation example"><ul class="pagination">{{$Numbers->links()}}</ul></nav>
				<div class="products-view__pagination-legend">Showing {{count($Numbers)}} of {{$total}} products</div>
			</div>
		</div>
	</div>
</div>