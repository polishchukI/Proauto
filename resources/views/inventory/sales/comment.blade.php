<form id="sale-form-comment-update" method="POST" action="{{ route('sales.comment.update') }}" style="width:100%;">
	<div class="addcomment modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">{{ __('modal.comment') }}</h6>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				@csrf
				<div class="form-group">
					<input type="hidden" name="sale_id" value="{{ $sale_id }}">
				</div>
				<div class="form-group">
					<label for="comment" class="col-form-label text-success">{{ __('modal.comment') }}:</label>
					<input type="text" class="form-control" id="comment" name="comment" value="{{ $comment }}">
				</div>
			</div>
			<div class="modal-footer">
				<button id="sale-comment-update" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.update') }}</button>
				<button id="sale-comment-delete" type="button" class="btn btn-sm btn-simple btn-delete"><i class="fas fa-times"></i> {{ __('modal.delete') }}</button>
			</div>
		</div>
	</div>
</form>