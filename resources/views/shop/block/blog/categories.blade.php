<div class="card widget widget-categories">
	<div class="widget__header"><h4>{{ __('blog.categories') }}</h4></div>
	<ul class="widget-categories__list widget-categories__list--root" data-collapse="" data-collapse-opened-class="widget-categories__item--open">
		@foreach($categories as $category)
		<li class="widget-categories__item" data-collapse-item="">
			<a href="{{ route('blogbycategory', $category->slug) }}" class="widget-categories__link">{{$category->title}}</a>
		</li>
		@endforeach
	</ul>
</div>