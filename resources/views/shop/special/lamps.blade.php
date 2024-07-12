@extends('shop.template')

@section('title', "Каталог автомобильных ламп")

@section('description', "Каталог автомобильных ламп")

@section('content')
<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				<!--breadcrumbs-->
				@include('shop.layouts.breadcrumbs')
				<!--breadcrumbs-end-->
				<h1 class="block-header__title" style="text-transform:uppercase; text-align: center">Каталог автомобильных ламп - выберите необходимую</h1>
			</div>
		</div>
		<div class="block">
			<div class="container">
				{{-- <link href="/css/lamps.css" rel="stylesheet" media="screen"> --}}
				<!--desktop-->
				<div class="card mb-4 d-none d-lg-block">
					<div class="car-promo car-promo1">
						<ul class="cp-list">
							<li class="cp-item cp-it1"><div class="cp-title"><span>Ближний, дальний свет</span></div>
								<div class="cp-pic-group"><img alt="S1" src="/images/lamps/s1.png"><img alt="S2" src="/images/lamps/s2.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302421']) }}" class="bs-r2"><span class="cpl-pic"></span><span class="cpl-title">R2</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64203']) }}" class="bs-h4"><span class="cpl-pic"></span><span class="cpl-title">H4(P45T)</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302011']) }}" class="bs-h1"><span class="cpl-pic"></span><span class="cpl-title">H1</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302041']) }}" class="bs-h4-2"><span class="cpl-pic"></span><span class="cpl-title">H4</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302071']) }}" class="bs-h7"><span class="cpl-pic"></span><span class="cpl-title">H7</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302082']) }}" class="bs-h9"><span class="cpl-pic"></span><span class="cpl-title">H9</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64176']) }}" class="bs-h15"><span class="cpl-pic"></span><span class="cpl-title">H15</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302152']) }}" class="bs-hb3"><span class="cpl-pic"></span><span class="cpl-title">HB3</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '9006']) }}" class="ds-hb4"><span class="cpl-pic"></span><span class="cpl-title">HB4</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302905']) }}" class="ds-d1s"><span class="cpl-pic"></span><span class="cpl-title">D1S</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302904']) }}" class="ds-d2s"><span class="cpl-pic"></span><span class="cpl-title">D2S</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '42403XVC1']) }}" class="ds-d3s"><span class="cpl-pic"></span><span class="cpl-title">D3S</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '42306VIC1']) }}" class="ds-d3r"><span class="cpl-pic"></span><span class="cpl-title">D3R</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '66440']) }}" class="ds-d4s"><span class="cpl-pic"></span><span class="cpl-title">D4S</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '66450']) }}" class="ds-d4r"><span class="cpl-pic"></span><span class="cpl-title">D4R</span></a></li>
								</ul>
							</li>
							<li class="cp-item cp-it3"><div class="cp-title"><span>Освещение «бардачка»</span></div>
								<div class="cp-pic-group"><img alt="S3" src="/images/lamps/s3.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '6413']) }}" class="ob-c5w"><span class="cpl-pic"></span><span class="cpl-title">C5W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987301022']) }}" class="ob-r5w"><span class="cpl-pic"></span><span class="cpl-title">R5W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302217']) }}" class="ob-w3w"><span class="cpl-pic"></span><span class="cpl-title">W3W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="ob-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
								</ul>
							</li>
							<li class="cp-item cp-it4"><div class="cp-title"><span>Лампы приборной панели</span></div>
								<div class="cp-pic-group"><img alt="S4" src="/images/lamps/s4.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302220']) }}" class="lpp-bax"><span class="cpl-pic"></span><span class="cpl-title">BAX</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '12516CP']) }}" class="lpp-t5"><span class="cpl-pic"></span><span class="cpl-title">T5</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302217']) }}" class="lpp-w3w"><span class="cpl-pic"></span><span class="cpl-title">W3W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="lpp-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
								</ul>
							</li>
							<li class="cp-item cp-it5"><div class="cp-title"><span>Боковые укзаатели повророта</span></div>
								<div class="cp-pic-group"><img alt="S5" src="/images/lamps/s5.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '68191']) }}" class="bup-h21w"><span class="cpl-pic"></span><span class="cpl-title">H21W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302217']) }}" class="bup-w3w"><span class="cpl-pic"></span><span class="cpl-title">W3W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="bup-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '12396NAB2']) }}" class="bup-wy5w"><span class="cpl-pic"></span><span class="cpl-title">WY5W</span></a></li>
								</ul>
							</li>
							<li class="cp-item cp-it6"><div class="cp-title"><span>Противотуманные фары</span></div>
								<div class="cp-pic-group"><img alt="S6" src="/images/lamps/s6.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302011']) }}" class="ptf-h1"><span class="cpl-pic"></span><span class="cpl-title">H1</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64175']) }}" class="ptf-h2"><span class="cpl-pic"></span><span class="cpl-title">H2</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64151']) }}" class="ptf-h3"><span class="cpl-pic"></span><span class="cpl-title">H3</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302071']) }}" class="ptf-h7"><span class="cpl-pic"></span><span class="cpl-title">H7</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64212']) }}" class="ptf-h8"><span class="cpl-pic"></span><span class="cpl-title">H8</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64211']) }}" class="ptf-h11"><span class="cpl-pic"></span><span class="cpl-title">H11</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302152']) }}" class="ptf-hb3"><span class="cpl-pic"></span><span class="cpl-title">HB3</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '9006']) }}" class="ptf-hb4"><span class="cpl-pic"></span><span class="cpl-title">HB4</span></a></li>
								</ul>
							</li>
							<li class="cp-item cp-it7"><div class="cp-title"><span>Указатели поворота - «аварийка»</span></div>
								<div class="cp-pic-group"><img alt="S7" src="/images/lamps/s7.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64136']) }}" class="upa-h21w"><span class="cpl-pic"></span><span class="cpl-title">H21W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7506']) }}" class="upa-p21w"><span class="cpl-pic"></span><span class="cpl-title">P21W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7507']) }}" class="upa-py21w"><span class="cpl-pic"></span><span class="cpl-title">PY21W</span></a></li>
								</ul>
							</li>
							<li class="cp-item cp-it8"><div class="cp-title"><span>Передние габаритные огни</span></div>
								<div class="cp-pic-group"><img alt="S8" src="/images/lamps/s8.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '12023CP']) }}" class="pgo-h5w"><span class="cpl-pic"></span><span class="cpl-title">H5W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987301035']) }}" class="pgo-h6w"><span class="cpl-pic"></span><span class="cpl-title">H6W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987301022']) }}" class="pgo-r5w"><span class="cpl-pic"></span><span class="cpl-title">R5W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302207']) }}" class="pgo-t4w"><span class="cpl-pic"></span><span class="cpl-title">T4W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="pgo-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
								</ul>
							</li>
						</ul>
					</div>
					<br>
					<br>
					<div class="car-promo car-promo2">
						<ul class="cp-list">
							<li class="cp-item cp-it1"><div class="cp-title"><span>Стоп-сигнал (центральный)</span></div>
								<div class="cp-pic-group"><img alt="S9" src="/images/lamps/s9.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302217']) }}" class="ssc-w3w"><span class="cpl-pic"></span><span class="cpl-title">W3W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="ssc-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302205']) }}" class="ssc-w16w"><span class="cpl-pic"></span><span class="cpl-title">W16W</span></a></li>
								</ul>
							</li>
							<li class="cp-item cp-it2"><div class="cp-title"><span>Внутреннее освещение</span></div>
								<div class="cp-pic-group"><img alt="S10" src="/images/lamps/s10.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '6413']) }}" class="vo-c5w"><span class="cpl-pic"></span><span class="cpl-title">C5W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '1987302011']) }}" class="vo-fest10w"><span class="cpl-pic"></span><span class="cpl-title">FEST10W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '1987302011']) }}" class="vo-h5w"><span class="cpl-pic"></span><span class="cpl-title">H5W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="vo-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
								</ul>
							</li>
							<li class="cp-item cp-it3"><div class="cp-title"><span>Задние габаритные огни</span></div>
								<div class="cp-pic-group"><img alt="S11" src="/images/lamps/s11.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987301035']) }}" class="zgo-h6w"><span class="cpl-pic"></span><span class="cpl-title">H6W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987301022']) }}" class="zgo-r5w"><span class="cpl-pic"></span><span class="cpl-title">R5W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302203']) }}" class="zgo-r10w"><span class="cpl-pic"></span><span class="cpl-title">R10W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302207']) }}" class="zgo-t4w"><span class="cpl-pic"></span><span class="cpl-title">T4W</span></a></li>
								</ul>
							</li>
							<li class="cp-item cp-it4"><div class="cp-title"><span>Задние противотуманные огни</span></div>
								<div class="cp-pic-group"><img alt="S12" src="/images/lamps/s12.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64138']) }}" class="zpo-h21w"><span class="cpl-pic"></span><span class="cpl-title">H21W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302201']) }}" class="zpo-p21w"><span class="cpl-pic"></span><span class="cpl-title">P21W</span></a></li>
								</ul>
							</li>
							<li class="cp-item cp-it5"><div class="cp-title"><span>Стоп-сигналы</span></div>
								<div class="cp-pic-group"><img alt="S13" src="/images/lamps/s13.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302201']) }}" class="ss-p21w"><span class="cpl-pic"></span><span class="cpl-title">P21W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7225']) }}" class="ss-p214w"><span class="cpl-pic"></span><span class="cpl-title">P21/4W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7528']) }}" class="ss-p215w"><span class="cpl-pic"></span><span class="cpl-title">P21/5W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7505']) }}" class="ss-w21w"><span class="cpl-pic"></span><span class="cpl-title">W21W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7515']) }}" class="ss-w215w"><span class="cpl-pic"></span><span class="cpl-title">W215W</span></a></li>
								</ul>
							</li>
							<li class="cp-item cp-it6"><div class="cp-title"><span>Подсветка заднего номера</span></div>
								<div class="cp-pic-group"><img alt="S14" src="/images/lamps/s14.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '6413']) }}" class="pzn-c5w"><span class="cpl-pic"></span><span class="cpl-title">C5W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987301022']) }}" class="pzn-r5w"><span class="cpl-pic"></span><span class="cpl-title">R5W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302203']) }}" class="pzn-r10w"><span class="cpl-pic"></span><span class="cpl-title">R10W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="pzn-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
								</ul>
							</li>
							<li class="cp-item cp-it7"><div class="cp-title"><span>Подсветка багажника</span></div>
								<div class="cp-pic-group"><img alt="S15" src="/images/lamps/s15.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '6413']) }}" class="pb-c5w"><span class="cpl-pic"></span><span class="cpl-title">C5W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '48242673']) }}" class="pb-fest10w"><span class="cpl-pic"></span><span class="cpl-title">FEST10W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987301022']) }}" class="pb-r5w"><span class="cpl-pic"></span><span class="cpl-title">R5W</span></a></li>
								</ul>
							</li>
							<li class="cp-item cp-it8"><div class="cp-title"><span>Фонарь заднего хода</span></div>
								<div class="cp-pic-group"><img alt="S16" src="/images/lamps/s16.png"></div>
								<ul class="cp-lamps">
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '68191']) }}" class="fzh-h21w"><span class="cpl-pic"></span><span class="cpl-title">H21W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7506']) }}" class="fzh-p21w"><span class="cpl-pic"></span><span class="cpl-title">P21W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '921']) }}" class="fzh-w16w"><span class="cpl-pic"></span><span class="cpl-title">W16W</span></a></li>
									<li class="cpl-item"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7505']) }}" class="fzh-w21w"><span class="cpl-pic"></span><span class="cpl-title">W21W</span></a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="alert alert-success" role="alert">
						<h4 class="alert-heading">Будьте внимательны!</h4>
						<p>При выборе ламп, будьте внимательны. Прверяйте лампы по применимости к Вашему автомобилю.</p><hr>
						<p class="mb-0">Если Вы не уверены в своем выборе, обратитесь к нашим специалистам.</p>
					</div>
				</div>
				<!--desktop / end-->
				<!--mobile-->
				<div class="car-lamp-container d-block d-sm-none">
					<img alt="S1" src="/images/lamps/car-front-2.png" class="img-fluid">
					<div class="panel panel-default">
						<div class="panel-heading">Ближний, дальний свет</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302421']) }}" class="bs-r2"><span class="cpl-pic"></span><span class="cpl-title">R2</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64203']) }}" class="bs-h4"><span class="cpl-pic"></span><span class="cpl-title">H4(P45T)</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302011']) }}" class="bs-h1"><span class="cpl-pic"></span><span class="cpl-title">H1</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302041']) }}" class="bs-h4-2"><span class="cpl-pic"></span><span class="cpl-title">H4</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302071']) }}" class="bs-h7"><span class="cpl-pic"></span><span class="cpl-title">H7</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302082']) }}" class="bs-h9"><span class="cpl-pic"></span><span class="cpl-title">H9</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64176']) }}" class="bs-h15"><span class="cpl-pic"></span><span class="cpl-title">H15</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302152']) }}" class="bs-hb3"><span class="cpl-pic"></span><span class="cpl-title">HB3</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '9006']) }}" class="ds-hb4"><span class="cpl-pic"></span><span class="cpl-title">HB4</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302905']) }}" class="ds-d1s"><span class="cpl-pic"></span><span class="cpl-title">D1S</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302904']) }}" class="ds-d2s"><span class="cpl-pic"></span><span class="cpl-title">D2S</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '42403XVC1']) }}" class="ds-d3s"><span class="cpl-pic"></span><span class="cpl-title">D3S</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '42306VIC1']) }}" class="ds-d3r"><span class="cpl-pic"></span><span class="cpl-title">D3R</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '66440XNB']) }}" class="ds-d4s"><span class="cpl-pic"></span><span class="cpl-title">D4S</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '66450']) }}" class="ds-d4r"><span class="cpl-pic"></span><span class="cpl-title">D4R</span></a></li>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Освещение «бардачка»</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '6413']) }}" class="ob-c5w"><span class="cpl-pic"></span><span class="cpl-title">C5W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987301022']) }}" class="ob-r5w"><span class="cpl-pic"></span><span class="cpl-title">R5W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302217']) }}" class="ob-w3w"><span class="cpl-pic"></span><span class="cpl-title">W3W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="ob-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Лампы приборной панели</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'narva','number' => '17036']) }}" class="lpp-bax"><span class="cpl-pic"></span><span class="cpl-title">BAX</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'search','number' => '12516CP']) }}" class="lpp-t5"><span class="cpl-pic"></span><span class="cpl-title">T5</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302217']) }}" class="lpp-w3w"><span class="cpl-pic"></span><span class="cpl-title">W3W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="lpp-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Боковые укзаатели повророта</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'narva','number' => '68191']) }}" class="bup-h21w"><span class="cpl-pic"></span><span class="cpl-title">H21W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302217']) }}" class="bup-w3w"><span class="cpl-pic"></span><span class="cpl-title">W3W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="bup-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '12396NAB2']) }}" class="bup-wy5w"><span class="cpl-pic"></span><span class="cpl-title">WY5W</span></a></li>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Противотуманные фары</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302011']) }}" class="ptf-h1"><span class="cpl-pic"></span><span class="cpl-title">H1</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64175']) }}" class="ptf-h2"><span class="cpl-pic"></span><span class="cpl-title">H2</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64151']) }}" class="ptf-h3"><span class="cpl-pic"></span><span class="cpl-title">H3</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302071']) }}" class="ptf-h7"><span class="cpl-pic"></span><span class="cpl-title">H7</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64212']) }}" class="ptf-h8"><span class="cpl-pic"></span><span class="cpl-title">H8</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64211']) }}" class="ptf-h11"><span class="cpl-pic"></span><span class="cpl-title">H11</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302152']) }}" class="ptf-hb3"><span class="cpl-pic"></span><span class="cpl-title">HB3</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '9006']) }}" class="ptf-hb4"><span class="cpl-pic"></span><span class="cpl-title">HB4</span></a></li>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Указатели поворота - «аварийка»</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'narva','number' => '68191']) }}" class="upa-h21w"><span class="cpl-pic"></span><span class="cpl-title">H21W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7506']) }}" class="upa-p21w"><span class="cpl-pic"></span><span class="cpl-title">P21W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7507']) }}" class="upa-py21w"><span class="cpl-pic"></span><span class="cpl-title">PY21W</span></a></li>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Передние габаритные огни</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '12023CP']) }}" class="pgo-h5w"><span class="cpl-pic"></span><span class="cpl-title">H5W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987301035']) }}" class="pgo-h6w"><span class="cpl-pic"></span><span class="cpl-title">H6W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987301022']) }}" class="pgo-r5w"><span class="cpl-pic"></span><span class="cpl-title">R5W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302207']) }}" class="pgo-t4w"><span class="cpl-pic"></span><span class="cpl-title">T4W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="pgo-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
						</ul>
					</div>
					<img alt="S1" src="/images/lamps/car-back-2.png" class="img-fluid">
					<div class="panel panel-default">
						<div class="panel-heading">Стоп-сигнал (центральный)</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302217']) }}" class="ssc-w3w"><span class="cpl-pic"></span><span class="cpl-title">W3W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="ssc-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302205']) }}" class="ssc-w16w"><span class="cpl-pic"></span><span class="cpl-title">W16W</span></a></li>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Внутреннее освещение</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '6413']) }}" class="vo-c5w"><span class="cpl-pic"></span><span class="cpl-title">C5W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '48242673']) }}" class="vo-fest10w"><span class="cpl-pic"></span><span class="cpl-title">FEST10W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '12023CP']) }}" class="vo-h5w"><span class="cpl-pic"></span><span class="cpl-title">H5W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="vo-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Задние габаритные огни</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987301035']) }}" class="zgo-h6w"><span class="cpl-pic"></span><span class="cpl-title">H6W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987301022']) }}" class="zgo-r5w"><span class="cpl-pic"></span><span class="cpl-title">R5W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302203']) }}" class="zgo-r10w"><span class="cpl-pic"></span><span class="cpl-title">R10W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302207']) }}" class="zgo-t4w"><span class="cpl-pic"></span><span class="cpl-title">T4W</span></a></li>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Задние противотуманные огни</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '64138']) }}" class="zpo-h21w"><span class="cpl-pic"></span><span class="cpl-title">H21W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302201']) }}" class="zpo-p21w"><span class="cpl-pic"></span><span class="cpl-title">P21W</span></a></li>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Стоп-сигналы</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302201']) }}" class="ss-p21w"><span class="cpl-pic"></span><span class="cpl-title">P21W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7225']) }}" class="ss-p214w"><span class="cpl-pic"></span><span class="cpl-title">P21/4W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7528']) }}" class="ss-p215w"><span class="cpl-pic"></span><span class="cpl-title">P21/5W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7505']) }}" class="ss-w21w"><span class="cpl-pic"></span><span class="cpl-title">W21W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7515']) }}" class="ss-w215w"><span class="cpl-pic"></span><span class="cpl-title">W215W</span></a></li>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Подсветка заднего номера</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '6413']) }}" class="pzn-c5w"><span class="cpl-pic"></span><span class="cpl-title">C5W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '5007']) }}" class="pzn-r5w"><span class="cpl-pic"></span><span class="cpl-title">R5W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302203']) }}" class="pzn-r10w"><span class="cpl-pic"></span><span class="cpl-title">R10W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'bosch','number' => '1987302206']) }}" class="pzn-w5w"><span class="cpl-pic"></span><span class="cpl-title">W5W</span></a></li>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Подсветка багажника</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '1987302011']) }}" class="pb-c5w"><span class="cpl-pic"></span><span class="cpl-title">C5W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'philips','number' => '1987302011']) }}" class="pb-fest10w"><span class="cpl-pic"></span><span class="cpl-title">FEST10W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '1987302011']) }}" class="pb-r5w"><span class="cpl-pic"></span><span class="cpl-title">R5W</span></a></li>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Фонарь заднего хода</div>
						<ul class="cp-lamps">
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '68191']) }}" class="fzh-h21w"><span class="cpl-pic"></span><span class="cpl-title">H21W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7506']) }}" class="fzh-p21w"><span class="cpl-pic"></span><span class="cpl-title">P21W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '921']) }}" class="fzh-w16w"><span class="cpl-pic"></span><span class="cpl-title">W16W</span></a></li>
							<li class="cpl-item col-xs-3"><a target="_blank" href="{{ route('product.page', ['brand' => 'osram','number' => '7505']) }}" class="fzh-w21w"><span class="cpl-pic"></span><span class="cpl-title">W21W</span></a></li>
						</ul>
					</div>
					<div class="alert alert-success" role="alert">
						<h4 class="alert-heading">Будьте внимательны!</h4>
						<p>При выборе ламп, будьте внимательны. Прверяйте лампы по применимости к Вашему автомобилю.</p><hr>
						<p class="mb-0">Если Вы не уверены в своем выборе, обратитесь к нашим специалистам.</p>
					</div>
				</div>
				<!--mobile / end-->
			</div>
		</div>
	</div>
	<!--div class="block-space block-space--layout--before-footer"></div-->
</div>
@stop