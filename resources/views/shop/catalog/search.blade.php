@extends('shop.template')

@section('content')

<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				@include('shop.layouts.breadcrumbs')
				<h1 class="block-header__title">{{ __('shop.partsCatalog') }}</h1>
			</div>
		</div>
		<div class="block-split block-split--has-sidebar">
			<div class="container">
				<div class="block-split__row row no-gutters">
					<!--sidebar block-->
					@include('shop.block.sidebar')
					<!--sidebar block-->
					<!--product block-->
					<div class="block-split__item block-split__item-content col-auto">
						<div class="block">
							<div class="products-view">
								<!--products-list-->
								@include('shop.block.productsview')
								<!--products-list-->
							</div>
						</div>
					</div>
					<!--product block end-->
				</div>
			</div>
		</div>
	</div>
</div>
@stop
