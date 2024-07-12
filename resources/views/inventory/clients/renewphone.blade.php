<form method="POST" action="{{ route('clients.phones.renew') }}" style="width:100%;">
	<div class="renew modal-dialog" role="document">
		<div class="modal-content">
			<div class="card-header">
				<h6 class="modal-title">{{ __('modal.renew') }}</h6>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="card-body">
				@csrf
				<div class="form-group">
					<label for="oldprefix" class="col-form-label">{{ __('modal.oldprefix') }}:</label>
					<input type="text" class="form-control" id="oldprefix" name="oldprefix" placeholder="{{ __('modal.oldprefix') }}">
				</div>
				<div class="form-group">
					<label for="newprefix" class="col-form-label">{{ __('modal.newprefix') }}:</label>
					<input type="text" class="form-control" id="newprefix" name="newprefix" placeholder="{{ __('modal.newprefix') }}">
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">{{ __('modal.update') }}</button>
			</div>
		</div>
	</div>
</form>