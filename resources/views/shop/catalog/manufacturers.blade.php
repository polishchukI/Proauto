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
						<div class="block block-brands block-brands--layout--columns-8-full">
							<div class="container">
								<div class="section-header">
									<div class="section-header__body">
										<h2 class="section-header__title">Группы производителей</h2>
										<div class="section-header__spring"></div>
										<div class="section-header__divider"></div>
									</div>
								</div>
								<ul class="block-brands__list">
								@foreach($manufacturers as $item)
								<li class="block-brands__item">
									<a href="{{$item["url"]}}" class="block-brands__item-link" name="{{$item["manufacturer_name"]}}">
										<img src="{{$item["image_url"]}}" alt="Выберите производителя {{$item["manufacturer_name"]}}">
										<span class="block-brands__item-name">{{$item["manufacturer_name"]}}</span>
									</a>
								</li>
								<li class="block-brands__divider" role="presentation"></li>
								@endforeach
								</ul>
							</div>
						</div>
					<div class="block-space block-space--layout--divider-nl"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop