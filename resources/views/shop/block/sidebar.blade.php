<div class="block-split__item block-split__item-sidebar col-auto">
	<div class="sidebar sidebar--offcanvas--mobile">
		<div class="sidebar__backdrop"></div>
		<div class="sidebar__body">
			<div class="sidebar__header">
				<div class="sidebar__title">{{ __('catalog.filters') }}</div>
				<button class="sidebar__close" type="button">
					<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12">
						<path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4C11.2,9.8,11.2,10.4,10.8,10.8z"></path></svg>
				</button>
			</div>
			<div class="sidebar__content">
				<!---->
				@if(isset($ResultArray["filtrable"]) && $ResultArray["filtrable"]==true)
				@include('shop.block.productsfilter')
				@endif
				<!---->
				@include('shop.block.randomproductswidget')
				<!---->
				@include('shop.block.lastestpost')
				<!---->
			</div>
		</div>
	</div>
</div>