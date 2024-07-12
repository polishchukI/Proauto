@extends('shop.template')

@section('content')
<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				@include('shop.layouts.breadcrumbs')
				<h1 class="block-header__title">Каталог запчастей - выберите марку автомобиля</h1>
			</div>
		</div>
		<div class="block-split">
			<div class="container">
				<div class="block-split__row row no-gutters">
					<div class="block-split__item block-split__item-content col-auto">
					@include('shop.catalog.groups')
					<div class="block-space block-space--layout--divider-nl"></div>
					@include('shop.block.featured')
					<div class="block-space block-space--layout--divider-nl"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop	