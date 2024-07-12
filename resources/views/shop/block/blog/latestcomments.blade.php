@if(isset($latestcomment))
<div class="card widget widget-comments">
	<div class="widget__header"><h4>{{ __('blog.latestcomments') }}</h4></div>
	<div class="widget-comments__body">
		<ul class="widget-comments__list">
			<li class="widget-comments__item">
				<div class="widget-comments__author">{{$latestcomment->firstname}} {{$latestcomment->lastname}}</div>
				<div class="widget-comments__content">{{$latestcomment->comment}}</div>
				<div class="widget-comments__meta">
					<div class="widget-comments__date">{{$latestcomment->created_at}}</div>
					<div class="widget-comments__name">On <a href="{{ route('blogpost', $latestcomment->slug)}}" title="{{$latestcomment->posttitle}}">{{$latestcomment->posttitle}}</a></div>
				</div>
			</li>
		</ul>
	</div>
</div>
@endif