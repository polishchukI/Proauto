@extends('shop.template')

@section('content')
<!-- site__body -->
<div class="site__body">
	<div class="block-space block-space--layout--after-header"></div>
	<div class="block-banners block">
		<div class="container">
			<h1>Услуги</h1>
			<div class="block-banners__list">
				<a href="{{ route('serviceprices') }}#diagnostics" class="block-banners__item block-banners__item--style--one">
					<span class="block-banners__item-image"><img src="/images/services/services1.jpg" alt=""></span>
					<span class="block-banners__item-image block-banners__item-image--blur"><img src="/images/services/services1.jpg" alt=""></span>
					<span class="block-banners__item-title">Диагностика</span>
					<span class="block-banners__item-details">
						<ul>
							<li>диагностика перед покупкой</li>
							<li>диагностика ходовой</li>
							<li>диагностика двигателя</li>
							<li>диагностика КПП</li>
							<li>компьютерная диагностика</li>
							<li>диагностика кондиционера</li>
							<li>диагностика жидкостей</li>
						</ul>
					</span>
					<span class="block-banners__item-button btn btn-primary btn-sm">Цены </span>
				</a>
				<a href="{{ route('serviceprices') }}#service" class="block-banners__item block-banners__item--style--one">
					<span class="block-banners__item-image"><img src="/images/services/services2.jpg" alt=""></span>
					<span class="block-banners__item-image block-banners__item-image--blur"><img src="images/services/services2.jpg" alt=""></span>
					<span class="block-banners__item-title">Сервисные работы</span>
					<span class="block-banners__item-details">
						<ul>
							<li>замена масел</li>
							<li>замена фильтров</li>
							<li>замена ГРМ</li>
							<li>замена свечей</li>
							<li>обслуживание КПП</li>
							<li>обслуживание тормозов</li>
							<li>замена эксплуатационных жидкостей</li>
						</ul>
					</span>
					<span class="block-banners__item-button btn btn-primary btn-sm">Цены </span>
				</a>
			</div>
		</div>
	</div>
	<div class="block-banners block">
		<div class="container">
			<div class="block-banners__list">
				<a href="{{ route('serviceprices') }}#suspension" class="block-banners__item block-banners__item--style--one">
					<span class="block-banners__item-image"><img src="/images/services/services3.jpg" alt=""></span>
					<span class="block-banners__item-image block-banners__item-image--blur"><img src="/images/services/services3.jpg" alt=""></span>
					<span class="block-banners__item-title">Ходовая часть</span>
					<span class="block-banners__item-details">
						<ul>
							<li>замена амортизаторов</li>
							<li>замена пружин</li>
							<li>замена рычагов</li>
							<li>замена ресор</li>
							<li>замена ступиц</li>
							<li>замена пильников</li>
							<li>замена полуосей</li>
							<li>замена шарових опор</li>
							<li>замена подушек двигателя и КПП</li>
							<li>слесарные работи</li>
						</ul>
					</span>
					<span class="block-banners__item-button btn btn-primary btn-sm">Цены </span>
				</a>
				<a href="{{ route('serviceprices') }}#engine" class="block-banners__item block-banners__item--style--one">
					<span class="block-banners__item-image"><img src="/images/services/services4.jpg" alt=""></span>
					<span class="block-banners__item-image block-banners__item-image--blur"><img src="/images/services/services4.jpg" alt=""></span>
					<span class="block-banners__item-title">Двигатель и трансмиссия</span>
					<span class="block-banners__item-details">
						<ul>
							<li>диагностика двигателя</li>
							<li>ремонт двигателя</li>
							<li>диагностика АКПП</li>
							<li>замена масла АКПП</li>
							<li>чистка-промивка АКПП</li>
							<li>замена сцепления</li>
							<li>диагностика МКПП</li>
							<li>замена масла МКПП</li>
							<li>чистка-промивка МКПП</li>
						</ul>
					</span>
					<span class="block-banners__item-button btn btn-primary btn-sm">Цены </span>
				</a>
			</div>
		</div>
	</div>
	<div class="block-banners block">
		<div class="container">
			<div class="block-banners__list">
				<a href="{{ route('serviceprices') }}#brakes" class="block-banners__item block-banners__item--style--one">
					<span class="block-banners__item-image"><img src="/images/services/services5.jpg" alt=""></span>
					<span class="block-banners__item-image block-banners__item-image--blur"><img src="/images/services/services5.jpg" alt=""></span>
					<span class="block-banners__item-title">Тормоза и рулевое</span>
					<span class="block-banners__item-details">
						<ul>
							<li>диагностика тормозной системы</li>
							<li>замена тормозной жидкости</li>
							<li>ремонт тормозной системы</li>
							<li>прокачивание тормозов</li>
							<li>замена рулевой рейки</li>
							<li>ремонт рулевой рейки</li>
							<li>замена гидроусилителя</li>
							<li>замена жидкости гидроусилителя</li>
							<li>інші послуги по ремонту рулевой системы</li>
							<li>інші послуги по ремонту гальм</li>
						</ul>
					</span>
					<span class="block-banners__item-button btn btn-primary btn-sm">Цены </span>
				</a>
				<a href="{{ route('serviceprices') }}#fuel" class="block-banners__item block-banners__item--style--one">
					<span class="block-banners__item-image"><img src="/images/services/services6.jpg" alt=""></span>
					<span class="block-banners__item-image block-banners__item-image--blur"><img src="/images/services/services6.jpg" alt=""></span>
					<span class="block-banners__item-title">Навесное оборудование</span>
					<span class="block-banners__item-details">
						<ul>
							<li>ремонт стартера</li>
							<li>замена стартера</li>
							<li>ремонт генератора</li>
							<li>замена генератора</li>
							<li>ремонт компрессора кондиционера</li>
							<li>замена роликов</li>
							<li>замена ремней</li>
							<li>замена турбины</li>
						</ul>
					</span>
					<span class="block-banners__item-button btn btn-primary btn-sm">Цены </span>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- site__body / end -->
@stop