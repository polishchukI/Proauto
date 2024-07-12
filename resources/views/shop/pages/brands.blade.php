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
				<h1 class="block-header__title">Brands</h1>
			</div>
		</div>
	</div>
	<div class="block block-brands block-brands--layout--columns-8-full">
		<div class="container">
			<ul class="block-brands__list">
				<!---->
				@foreach ($brands as $item)
				<li class="block-brands__item">
					<a href="{{ route('singlebrand', $item["slug"]) }}" class="block-brands__item-link">
						<img src="{{$item["logo"]}}" alt="{{$item["brand"]}}">
						<span class="block-brands__item-name">{{$item["brand"]}}</span>
					</a>
				</li>
				<li class="block-brands__divider" role="presentation"></li>
				@endforeach
				<!---->
			</ul>
		</div>
	</div>
</div>
<!-- site__body / end -->
@stop