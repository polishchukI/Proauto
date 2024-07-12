@extends('shop.template')

@section('content')

<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
					@include('shop.layouts.breadcrumbs')
				<h1 class="block-header__title">Подразделы запчастей {{$ResultArray["ubrand"]}} {{$ResultArray["model"]}} {{$ResultArray["constructioninterval"]}}</h1>
			</div>
		</div>
		<div class="block block-split block-split--has-sidebar">
			<div class="container">
				<div class="block-split__row row no-gutters">
					<!--sidebar block-->
					@include('shop.block.sidebar')
					<!--sidebar block-->
					<div class="block-split__item block-split__item-content col-auto">
						<div class="block">
						@if($ResultArray["sections_count"]>0)
							<div class="filter_small_img">
								<img alt="{{$ResultArray["ubrand"]}} {{$ResultArray["section_name"]}} at amazing prices" max-width="300" src="{{$ResultArray["rsection_picture"]}}" height="250">
								<div class="title">Please select the category of car parts you are interested in.</div>
								<ul class="simple_links">
									@foreach($ResultArray["sections"] as $arSec)
		
									<li>
										<a href="{{$ResultArray["csec_link"]."/".$arSec["node_id"]}}" >
											<span class="link">
												<img alt="{{$arSec["description"]}}" src="/images/sections/100/{{$arSec["node_id"]}}.png">
												<span>{{$arSec["description"]}}</span>
											</span>
										</a>
									</li>
			
									@endforeach
								</ul>
							</div>
						@endif
						</div>
						@if(!empty($ResultArray["seo"]))
						<div class="block" style = "padding-top: 2rem;">
							<div class="document__content card">
								<h2 class="card-title">{!!$ResultArray["sec_seo_header"]!!}</h2>
								{!!$ResultArray["section_seo"]!!}
								{!!$ResultArray["sec_seo_types"]!!}
								{!!$ResultArray["seo_service_life"]!!}
								{!!$ResultArray["sec_seo_failures"]!!}
								{!!$ResultArray["sec_seo_causes_failure"]!!}
								{!!$ResultArray["sec_seo_replacement"]!!}
								{!!$ResultArray["sec_seo_buy"]!!}
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
