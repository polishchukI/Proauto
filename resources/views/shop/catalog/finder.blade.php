<div class="block-finder block">
	<div class="decor block-finder__decor decor--type--bottom">
		<div class="decor__body">
			<div class="decor__start"></div>
			<div class="decor__end"></div>
			<div class="decor__center"></div>
		</div>
	</div>
	<div class="block-finder__image lazyload" data-bgset="/images/finder-1903x500.jpg"></div>
	<div class="block-finder__body container container-xl">
		<div class="block-finder__title"><H1>{{ __('shop.findpartsforyourvehicle') }}</H1></div>
		<div class="block-finder__subtitle">{{ __('shop.hundredsofbrands') }}</div>
		<form class="block-finder__form" method="POST" action="/finder/gotocatalog">
		@csrf
			<div class="block-finder__form-control block-finder__form-control--select">
				<select name="group" aria-label="Vehicle group" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
					<option value="none">Select group</option>
					@foreach($groups as $group)
					<option value="{{$group['group']}}">{{$group['group_name']}}</option>
					@endforeach
				</select>
			</div>
			<div class="block-finder__form-control block-finder__form-control--select">
				<select name="manufacturer" aria-label="Vehicle Brand" disabled="" data-select2-id="#manufacturers" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
					<option value="none">Select Brand</option>
				</select>
			</div>
			<div class="block-finder__form-control block-finder__form-control--select">
				<select name="model" aria-label="Vehicle Model" disabled="" data-select2-id="#models" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
					<option value="none" >Select Model</option>
				</select>
			</div>
			<div class="block-finder__form-control block-finder__form-control--select">
				<select name="modification" aria-label="Vehicle Engine" disabled="" data-select2-id="#types" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
					<option value="none">Select Engine</option>
				</select>
			</div>
			<button class="block-finder__form-control block-finder__form-control--button" type="submit">Search</button>
		</form>
	</div>
</div>
