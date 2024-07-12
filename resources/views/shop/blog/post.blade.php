@extends('shop.template')

@section('content')
<!-- site__body -->
<div class="site__body">
	<div class="block post-view">
		<div class="post-view__header post-header post-header--has-image">
			<div class="post-header__image" style="background-image: url('{{$post->image}}');"></div>
			<div class="post-header__body">
				<div class="post-header__categories">
					<ul class="post-header__categories-list">
						<li class="post-header__categories-item"><a href="{{ route('blogbycategory', $post->category->slug) }}" class="post-header__categories-link">{{ $post->category->title}}</a></li>
					</ul>
				</div>
				<h1 class="post-header__title">{{$post->title}}</h1>
				<div class="post-header__meta">
					<ul class="post-header__meta-list">
						<li class="post-header__meta-item">{{ __('blog.author') }} {{$post->author->name}}</li>
						<li class="post-header__meta-item">{{$post->created_at}}</li>
						<li class="post-header__meta-item">{{ __('blog.views') }} {{$post->views}}</li>
					</ul>
				</div>
			</div>
			<div class="decor post-header__decor decor--type--bottom">
				<div class="decor__body">
					<div class="decor__start"></div>
					<div class="decor__end"></div>
					<div class="decor__center"></div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="post-view__body">
				<div class="post-view__item post-view__item-sidebar">
					<!--blogsearch-->
					@include('shop.block.blog.blogsearch')
					<!--blogsearch-end-->
					<!--categories widget-->
					@include('shop.block.blog.categories')
					<!--categories widget-->
					<!--latestposts widget-->
					@include('shop.block.blog.latestposts')
					<!--latestposts widget-->
					<!--comments widget-->
					@include('shop.block.blog.latestcomments')
					<!--comments widget-->
					<!--tagscloud widget-->
					@include('shop.block.blog.tagscloud')
					<!--tagscloud widget-->
				</div>
				<div class="post-view__item post-view__item-post">
					<div class="post-view__card post">
						<div class="post__body typography">
							{!!$post->body!!}
						</div>
						<div class="post__footer">
							<div class="post__tags tags tags--sm">
								<div class="tags__list">
									@foreach ($post->tag as $singleTag)
									<a href="{{ route('blogbytag', $singleTag->slug) }}">{{$singleTag->name}}</a>
									@endforeach
								</div>
							</div>
							<div class="post__share-links share-links">
								<script async src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
								<script async src="//yastatic.net/share2/share.js"></script>
								<div class="ya-share2" data-services="facebook,twitter,viber,whatsapp,telegram" data-counter=""></div>
							</div>
						</div>
						<div class="post__author">
							<div class="post__author-avatar"><img src="{{$post->author->avatar}}" alt="{{$post->author->name}}" width="80" height="80" ></div>
							<div class="post__author-info">
								<div class="post__author-name">{{$post->author->name}}</div>
								<div class="post__author-about">{{$post->author->description}}</div>
							</div>
						</div>
					</div>
					<div class="post-view__card post-navigation">
						<div class="post-navigation__body">
							@if (isset($previous))
							<a class="post-navigation__item post-navigation__item--prev" href="{{ route('blogpost', $previous->slug) }}">
								<div class="post-navigation__item-image">
									<img src="{{$previous->image}}" width="80" height="80" style="object-fit: cover;" alt="{{ $previous->title }}">
								</div>
								<div class="post-navigation__item-info">
									<div class="post-navigation__direction">
										<div class="post-navigation__direction-arrow">
											<svg xmlns="http://www.w3.org/2000/svg" width="7" height="11">
												<path d="M6.7,0.3L6.7,0.3c-0.4-0.4-0.9-0.4-1.3,0L0,5.5l5.4,5.2c0.4,0.4,0.9,0.3,1.3,0l0,0c0.4-0.4,0.4-1,0-1.3l-4-3.9l4-3.9C7.1,1.2,7.1,0.6,6.7,0.3z"></path>
											</svg>
										</div>
										<div class="post-navigation__direction-title">{{ __('blog.previous') }}</div>
									</div>
									<div class="post-navigation__item-title">{{ $previous->title }}</div>
								</div>
							</a>
							@endif
							@if (isset($next))
							<a class="post-navigation__item post-navigation__item--next" href="{{ route('blogpost', $next->slug) }}">
								<div class="post-navigation__item-info">
									<div class="post-navigation__direction">
										<div class="post-navigation__direction-title">{{ __('blog.next') }}</div>
										<div class="post-navigation__direction-arrow">
											<svg xmlns="http://www.w3.org/2000/svg" width="7" height="11">
												<path d="M0.3,10.7L0.3,10.7c0.4,0.4,0.9,0.4,1.3,0L7,5.5L1.6,0.3C1.2-0.1,0.7,0,0.3,0.3l0,0c-0.4,0.4-0.4,1,0,1.3l4,3.9l-4,3.9 C-0.1,9.8-0.1,10.4,0.3,10.7z"></path>
											</svg>
										</div>
									</div>
									<div class="post-navigation__item-title">{{ $next->title }}</div>
								</div>
								<div class="post-navigation__item-image">
									<img src="{{$next->image}}" width="80" height="80" style="object-fit: cover;" alt="{{ $next->title }}">
								</div>
							</a>
							@endif
						</div>
					</div>
					@guest('clients')
					<div class="post-view__card">
						<div class="alert alert-primary alert-lg mb-3 alert-dismissible fade show">{{ __('blog.registered') }}</br>
							<a href="{{ route('account.login') }}">{{ __('blog.login') }}</a>{{ __('blog.wanttoleavecomment') }}
						</div>
					</div>
					@endguest
					<!--comments-->
					<div class="post-view__card">
						<h2 class="post-view__card-title">{{ __('blog.comments') }} ({{count($post->comments)}})</h2>
						<div class="post-view__card-body comments-view">
							<ol class="comments-list comments-list--level--0 comments-view__list">
								@include('shop.block.commentsdisplay', ['comments' => $post->comments, 'post_id' => $post->id])
							</ol>							
						</div>
					</div>					
					@auth('clients')
					<div class="post-view__card">
						<h2 class="post-view__card-title">{{ __('blog.writeacomment') }}</h2>
						<form class="post-view__card-body" method="POST" action="{{ route('blog.addcomment') }}">
							@csrf
							<input name="client_id" type="hidden" value="{{ Auth::guard('clients')->user()->id }}">
							<input type="hidden" name="post_id" value="{{ $post->id }}" />
							<div class="form-group">
								<label for="comment-content">{{ __('blog.comment') }}</label>
								<textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
							</div>
							<div class="form-group mb-0">
								<button type="submit" class="btn btn-primary mt-md-4 mt-2">{{ __('blog.postcomment') }}</button>
							</div>
						</form>
					</div>
					@endauth
					</div>
					<!--comments-->
				</div>
			</div>
		</div>
	</div>
</div>
@stop