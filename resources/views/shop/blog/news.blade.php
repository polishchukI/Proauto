<div class="block block-posts-carousel block-posts-carousel--layout--grid" data-layout="grid">
	<div class="container">
		<div class="section-header">
			<div class="section-header__body">
				<h2 class="section-header__title">Latest News</h2>
				<div class="section-header__spring"></div>
				<div class="section-header__arrows">
					<div class="arrow section-header__arrow section-header__arrow--prev arrow--prev">
						<button class="arrow__button" type="button">
							<i class="fas fa-angle-left"></i>
						</button>
					</div>
					<div class="arrow section-header__arrow section-header__arrow--next arrow--next">
						<button class="arrow__button" type="button">
							<i class="fas fa-angle-right"></i>
						</button>
					</div>
				</div>
				<div class="section-header__divider"></div>
			</div>
		</div>
		<div class="block-posts-carousel__carousel">
			<div class="owl-carousel">
				@foreach( $posts as $item )
				<div class="block-posts-carousel__item">
					<div class="post-card">
						<div class="post-card__image">
							<a href="{{ route('blogpost', $item["slug"]) }}">
								<img data-src="{{$item["image"]}}" class="lazyload" alt="{{ $item["title"] }}">
							</a>
						</div>
						<div class="post-card__content">
							<div class="post-card__category"><a href="{{ route('blogbycategory', $item["category_uri"]) }}">{{$item["category"]}}</a></div>
							<div class="post-card__title"><h2><a href="{{ route('blogpost', $item["slug"]) }}">{{ $item["title"] }}</a></h2></div>
							<div class="post-card__date">By {{ $item["author"] }} on {{ $item["created_at"] }}</div>
							<div class="post-card__more"><a href="{{ route('blogpost', $item["slug"]) }}" class="btn btn-secondary btn-sm">Подробнее...</a></div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>