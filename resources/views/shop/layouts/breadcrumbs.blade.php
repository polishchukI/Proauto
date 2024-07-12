<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
	<ol class="breadcrumb__list">
		<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{ route('home') }}" class="breadcrumb__item-link">Main</a></li>
		@php $segments = ''; @endphp
		@foreach(Request::segments() as $segment)
		@php $segments .= '/'.$segment; @endphp
		<li class="breadcrumb__item breadcrumb__item--parent">
			<a class="breadcrumb__item-link" href="{{ $segments }}">{{$segment}}</a>
		</li>
		@endforeach
	</ol>
</nav>