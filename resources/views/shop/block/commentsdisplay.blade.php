@foreach($comments as $comment)
<li class="comments-list__item">
	<div class="comment">
		<div class="comment__body">
			<div class="comment__avatar"><img src="{{ $comment->client['avatar']}}" alt="{{ $comment->client['firstname']}}" width="40" height="40"></div>
			<div class="comment__meta">
				<div class="comment__author">{{ $comment->client['firstname']}}</div>
				<div class="comment__date">{{ $comment->client['created_at']}}</div>
			</div>
			<div class="comment__content typography">{{ $comment->comment }}</div>
			@auth('clients')
			<div class="form-group">
				<div class="comment__reply">
					<a href="" id="reply"></a>
					<form method="post" action="{{ route('blog.addcomment') }}">
						@csrf
						<div class="form-group">
							<input type="text" name="comment" class="form-control" />
							<input type="hidden" name="post_id" value="{{ $post_id }}" />
							<input type="hidden" name="parent_id" value="{{ $comment->id }}" />
							<input type="hidden" name="client_id" value="{{ Auth::guard('clients')->user()->id }}" />
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary btn-xs" value="Reply" />
						</div>
					</form>
				</div>
			</div>
			@endauth
		</div>
	</div>
	@if(count($comment->replies)>0)
	<div class="comments-list__children">
		<ol class="comments-list comments-list--level--1">
			@include('shop.block.commentsdisplay', ['comments' => $comment->replies])
		</ol>
	</div>
	@endif
</li>
@endforeach