<div class="card widget-tags widget">
	<div class="widget__header"><h4>{{ __('blog.tagscloud') }}</h4></div>
	<div class="widget-tags__body tags">
		<div class="tags__list">
		@foreach($tags as $tag)
			<a href="{{ route('blogbytag', $tag->slug) }}">{{$tag->name}}</a>
		@endforeach
		</div>
	</div>
</div>