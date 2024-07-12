<div class="header__navbar-departments">
	<div class="departments">
		<button class="departments__button" type="button">
			<span class="departments__button-icon">
				<svg width="16px" height="12px">
					<path d="M0,7L0,5L16,5L16,7L0,7ZM0,0L16,0L16,2L0,2L0,0ZM12,12L0,12L0,10L12,10L12,12Z"/>
				</svg>
			</span>
			<span class="departments__button-title">Shop By Category</span>
			<!--top menu st@tus-->
			<span class="departments__button-arrow">
				<svg width="9px" height="6px">
					<path d="M0.2,0.4c0.4-0.4,1-0.5,1.4-0.1l2.9,3l2.9-3c0.4-0.4,1.1-0.4,1.4,0.1c0.3,0.4,0.3,0.9-0.1,1.3L4.5,6L0.3,1.6C-0.1,1.3-0.1,0.7,0.2,0.4z"/>
				</svg>
			</span>
		</button>
		<div class="departments__menu">
			<div class="departments__arrow"></div>
			<div class="departments__body">
				<ul class="departments__list">
					<li class="departments__list-padding" role="presentation"></li>
					<li class="departments__item"><a href="{{ route('specific.tyres') }}" class="departments__item-link">Tyres</a></li>
					<li class="departments__item"><a href="{{ route('specific.rims') }}" class="departments__item-link">Rims</a></li>
					<li class="departments__item"><a href="{{ route('specific.lamps') }}" class="departments__item-link">Lamps</a></li>
					<li class="departments__item"><a href="{{ route('brandspage') }}" class="departments__item-link">Brands</a></li>
					<li class="departments__list-padding" role="presentation"></li>
				</ul>
				<div class="departments__menu-container"></div>
			</div>
		</div>
	</div>
</div>