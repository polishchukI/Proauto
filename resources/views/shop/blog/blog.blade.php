@extends('shop.template')

@section('content')
<!-- site__body -->
<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				<!--breadcrumbs-->
				@include('shop.layouts.breadcrumbs')
				<!--breadcrumbs-end-->
				<h1 class="block-header__title">{{ __('blog.blog') }}</h1>
			</div>
		</div>
	</div>
	<div class="block blog-view blog-view--layout--list">
		<div class="container">
			<div class="blog-view__body">
				<div class="blog-view__item blog-view__item-sidebar">
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
				<div class="blog-view__item blog-view__item-posts">
					<div class="block posts-view">
						<div class="posts-view__list posts-list posts-list--layout--list">
							<div class="posts-list__body">
								<!--item-->
								@foreach( $posts as $post )
								<div class="posts-list__item">
									<div class="post-card post-card--layout--list">
										<div class="post-card__image"><a href="{{ route('blogpost', $post->slug) }}"><img src="{{$post->image}}" alt="{{ $post->title }}"></a></div>
										<div class="post-card__content">
											<div class="post-card__category">
												<a href="{{ route('blogbycategory', $post->category->slug) }}">{{$post->category->title}}</a>
											</div>
											<div class="post-card__title"><h2><a href="{{ route('blogpost', $post->slug) }}">{{ $post->title }}</a></h2></div>
											<div class="post-card__date">By {{ $post->author->name }} on {{ $post->created_at }}</div>
											<div class="post-card__excerpt">
												<div class="typography">{!! Str::limit($post->description, 200) !!}</div>
											</div>
											<div class="post-card__more"><a href="{{ route('blogpost', $post->slug) }}">Подробнее...</a></div>
										</div>
									</div>
								</div>
								@endforeach
								<!--item-->
							</div>
						</div>
						<!--Pagination-->						
						<div class="posts-view__pagination">
							<ul class="pagination">{{$posts->links()}}</ul>
						</div>
						<!--Pagination-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- site__body / end -->
@stop