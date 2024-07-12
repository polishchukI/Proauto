<div class="card widget widget-posts">
	<div class="widget__header"><h4>{{ __('blog.latestposts') }}</h4></div>
	<ul class="widget-posts__list">
		<li class="widget-posts__item">
			<div class="widget-posts__image">
				<a href="{{ route('blogpost', $latestpost->slug) }}">
					<img style="width:100%;height:100%;object-fit:cover;max-height:70px;max-width:70px;" src="{{$latestpost->image}}" alt="{{$latestpost->title}}">
				</a>
			</div>
			<div class="widget-posts__info">
				<div class="widget-posts__name"><a href="{{ route('blogpost', $latestpost->slug) }}">{{$latestpost->title}}</a></div>
				<div class="widget-posts__date">{{$latestpost->created_at}}</div>
			</div>
		</li>
	</ul>
</div>