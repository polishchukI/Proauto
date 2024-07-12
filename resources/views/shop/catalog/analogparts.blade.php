@extends('shop.template')

@section('content')

<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				@include('shop.layouts.breadcrumbs')
				<h1 class="block-header__title">{{ __('catalog.analogpartstitle') }} <span style="text-transform:uppercase">{!!request()->brand!!} - {!!request()->number!!}</span></h1>
			</div>
		</div>
		<div class="block-split block-split--has-sidebar">
			<div class="container">
				<div id="filteredblock" class="block-split__row row no-gutters">
					@include('catalog.filteredblock')
				</div>
			</div>
		</div>
	</div>
</div>
@stop