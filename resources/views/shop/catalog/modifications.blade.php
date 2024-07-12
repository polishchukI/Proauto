@extends('shop.template')

@section('title', "Выберите модификацию {$ResultArray["ubrand"]} {$ResultArray["model"]}")

@section('description', "Выберите description {$ResultArray["ubrand"]} {$ResultArray["model"]}")

@section('content')

<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				@include('shop.layouts.breadcrumbs')
				<h1 class="block-header__title">Выберите модификацию {{$ResultArray["ubrand"]}} {{$ResultArray["model"]}} {{-- $ResultArray["year"] --}}</h1>
			</div>
		</div>
		<div class="block-split">
			<div class="container">
				<table class="table">
					@if($ResultArray['group'] == "passenger")
					<thead>
						<tr>
							<th>Бренд - Модель - Модификация</th>
							<th>ConstructionInterval</th>
							<th>Код двигателя</th>
							<th>Мощность кВт(лс)</th>
							<th>Тип двигателя</th>
							<th>Тип топлива</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($ResultArray['modifications'] as $item)
						<tr>
							<td><a class="dblock" href="{{$item["url"]}}"><b>{{$ResultArray["ubrand"]}} - {{$ResultArray["model"]}} <span style="text-transform:lowercase">{{$item['fueltype']??"-"}}</span> {{$item["capacity"] ?? "-"}} </b></a></td>
							<td>{{ $item["constructioninterval"] }}</td>
							<td class="hidden-xs">{{$item["enginecode"]??"-"}}</td>
							<td>{{$item["power"]}}</td>
							<td class="hidden-xs">{{$item["numberofcylinders"]??"-"}}</td>
							<td>{{$item['fueltype']??"-"}}</td>
						</tr>
						@endforeach
					</tbody>
					@elseif($ResultArray['group'] == "commercial")
					{{-- "modification_id" => 8087
							"ConstructionInterval" => "04.2005 - "
							"modification" => "MAN TGL 7.180, 8.180 FC, FLC, FRC, FLRC"
							"Power" => "132 kW"
							"Capacity_Technical" => "4580 ccm"
							"Suspension" => "2 / Пневматическая рессора"
							"Wheelbase" => "1-2/5200 mm"
							"Tonnage" => "7.49 t"
							"PlatformType" => "Грузовик c бортовой платформой/шасси"
							"EngineType" => "Дизель"
							"AxleConfiguration" => "4x2"
							"EngineCode" => "D 0834 LFL 41, D 0834 LFL 51, D 0834 LFL 54, D 0834 LFL 64, D 0834 LFL 61, D 0834 LFL 67, D 0834 LFL 75"
					--}}
					<thead>
						<tr>
							<th>Бренд - Модель - Модификация</th>
							<th>ConstructionInterval</th>
							<th>Capacity_Technical</th>
							<th>Мощность кВт(лс)</th>
							<th>PlatformType</th>
							<th>AxleConfiguration</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($ResultArray['modifications'] as $item)
						<tr>
							<td><a class="dblock" href="{{-- $item["url"] --}}"><b>{{$item["Modification"]}}</b></a></td>
							<td>{{ $item["ConstructionInterval"] }}</td>
							<td class="hidden-xs">{{ $item["Capacity_Technical"]??"-" }}</td>
							<td>{{$item["Power"]}}</td>
							<td class="hidden-xs">{{ $item["PlatformType"]??"-" }}</td>
							<td>{{ $item['AxleConfiguration']??"-" }}</td>
						</tr>
						@endforeach
					</tbody>
					@elseif($ResultArray['group'] == "motorbike")
					{{--
						101459 => array:2 [▼
					"description" => "Multistrada 1200"
					"constructioninterval" => "01.2013
					 --}}
					<thead>
						<tr>
							<th>Бренд - Модель - Модификация</th>
							<th>ConstructionInterval</th>
							<th>Capacity_Technical</th>
							<th>Мощность кВт(лс)</th>
							<th>PlatformType</th>
							<th>AxleConfiguration</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($ResultArray['modifications'] as $item)
						<tr>
							<td><a class="dblock" href="{{-- $item["url"] --}}"><b>{{$ResultArray["ubrand"]}} - {{$item["description"]}} </b></a></td>
							<td>{{ $item["constructioninterval"] }}</td>
						</tr>
						@endforeach
					</tbody>
					@endif
				</table>
			</div>
			<div class="block-space block-space--layout--divider-nl"></div>
			@include('shop.blog.news')
			<div class="block-space block-space--layout--divider-nl"></div>
		</div>
	</div>
</div>
@stop