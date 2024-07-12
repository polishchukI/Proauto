<div class="block">
	<div class="categories-list categories-list--layout--columns-5-full">
		<ul class="categories-list__body">
		@foreach($cataloggroups as $item)
			<li class="categories-list__item">
				<a href="{{$item["url"]}}" class="categories-list__item-link" name="{{$item["group"]}}">
					<div class="image image--type--category">
						<div class="image__body">
							<img class="image__tag" src="{{$item["image_url"]}}" alt="Выберите группу {{$item["group_name"]}}">
						</div>
					</div>
					<div class="categories-list__item-name">{{$item["group_name"]}}</div>
				</a>
			</li>			
			@endforeach
		</ul>
	</div>
</div>