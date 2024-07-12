@extends('shop.template')

@section('title', "Выберите модификацию {$ResultArray["UBRAND"]} {$ResultArray["MODEL"]}")

@section('description', "Выберите description {$ResultArray["UBRAND"]} {$ResultArray["MODEL"]}")

@section('content')

<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				@include('shop.layouts.breadcrumbs')
				<h1 class="block-header__title">Выберите модификацию {{$ResultArray["UBRAND"]}} {{$ResultArray["MODEL"]}}</h1>
			</div>
		</div>
		<div class="block-split">
			<div class="container">
				<table class="table">
					<thead>
						<tr>
							<th>Бренд</th>
							<th>Модель - модификация</th>
							<th>Производство</th>
							<th>Код двигателя</th>
							<th>Мощность кВт(лс)</th>
							<th>Объем см.куб</th>
							<th>Тип двигателя</th>
							<th>Тип топлива</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($ResultArray['TYPES'] as $arType)
						<tr>
							<td><b>{{$ResultArray["UBRAND"]}}</b></td>
							<td><a class="dblock" href="{{$arType["URL"]}}"><b>{{$arType["TYP_CDS_TEXT"]}}</b></a></td>
							<td>{{$arType["START"]}} - {{$arType["END"]}}</td>
							<td class="hidden-xs">{{$arType["ENG_CODE"]}}</td>
							<td>{{$arType["TYP_KW_FROM"]}}<span>kW</span>({{$arType["TYP_HP_FROM"]}}<span>HP</span>)</td>
							<td class="hidden-xs">{{$arType["TYP_CCM"]}}<span>ccm</span></td>
							<td class="hidden-xs">{{$arType["TYP_CYLINDERS"]}}</td>
							<td>{{$arType['TYP_FUEL_DES_TEXT']}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="block-space block-space--layout--divider-nl"></div>
			@include('shop.blog.news')
			<div class="block-space block-space--layout--divider-nl"></div>
		</div>
	</div>
</div>
@stop