@extends('shop.template')

@section('content')

<div class="site__body">

	@include('shop.catalog.finder')
	<div class="block-space block-space--layout--divider-nl"></div>
	@include('shop.block.features')
	<div class="block-space block-space--layout--divider-nl"></div>
	@include('shop.block.featured')
	<div class="block-space block-space--layout--divider-nl"></div>
	@include('shop.blog.news')
	<div class="block-space block-space--layout--divider-nl"></div>
	@include('shop.block.arrivals')
	<div class="block-space block-space--layout--divider-nl"></div>
	@include('shop.block.seo')
	<div class="block-space block-space--layout--divider-nl d-xl-block d-none"></div>
	@include('shop.block.columns')
	
	@include('shop.metrics.schema')

</div>

@stop