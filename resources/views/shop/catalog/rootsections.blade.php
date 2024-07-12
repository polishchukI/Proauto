<div class="container">
	<div class="block-split__item block-split__item-content col-auto"></div>
	<div class="block">
		<div class="categories-list categories-list--layout--columns-6-full">
			<ul class="categories-list__body">
				@foreach ($ResultArray["ROOT_SECTIONS"] as $root_section)
				<li class="categories-list__item">
					<a href="{{$root_section["LINK"]}}">
					<img src="/images/sections/200/{{$root_section["SID"]}}.png" alt="{{ $root_section["name"] }}">
					<div class="categories-list__item-name">{{ $root_section["name"] }}</div>
					</a>
				</li>
				<li class="categories-list__divider"></li>
				@endforeach
			</ul>
		</div>
	</div>
</div>