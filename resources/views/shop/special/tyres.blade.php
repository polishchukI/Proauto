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
				<h1 class="block-header__title">Transmission</h1>
			</div>
		</div>
	</div>
	<div class="block-split block-split--has-sidebar">
		<div class="container">
			<div class="block-split__row row no-gutters">
				<!--sidebar block-->
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
								@include('shop.filters.tyresfilter')
								<!---->
								@include('shop.block.randomproductswidget')
								<!---->
								@include('shop.block.lastestpost')
								<!---->
							</div>
						</div>
					</div>
				</div>
				<!--sidebar block-->
				<div class="block-split__item block-split__item-content col-auto">
					<div class="block">
						<div class="products-view">
							<!--products-list-->
							@include('shop.block.productsview')
							<!--products-list-->
						</div>
					</div>
				</div>
			</div>
			<div class="block-space block-space--layout--before-footer"></div>
		</div>
	</div>
</div>
<!-- site__body / end -->
@stop