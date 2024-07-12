
<div class="priceimportresult modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h6 class="modal-title">{{ __('modal.priceimportresult') }}</h6>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<div class="modal-body">
			@foreach($ResponseArray as $info)
			<div class="">{{ $info }}</div>
			@endforeach
		</div>
	</div>
</div>