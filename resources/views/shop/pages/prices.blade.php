@extends('shop.template')

@section('content')
<!-- site__body -->
<div class="site__body">
	<div class="block-space block-space--layout--after-header"></div>
	<div class="block-banners block">
		<div class="container">
			<div align="center">
				<h1>Цены на услуги</h1>
				<p class="text-primary"><br>На этой странице вы сможете ознакомиться с ценами на наши услуги.</p>
			</div>
            <h6><a name="diagnostics">Диагностика авто</a></h6>
			<div class="cell-sm-6 height-fill">
				<table class="table table-striped">
					<thead>
						<tr><th>Услуга</th><th>Цена</th></tr>
					</thead>
					<tbody>
						<tr><td>Полная диагностика автомобиля</td><td>от 300</td></tr>
						<tr class="alt"><td>Диагностика ходовой</td><td>100</td></tr>
						<tr><td>Компьютерная диагностика (считывание ошибок)</td><td>150</td></tr>
						<tr class="alt"><td>Проверка компрессии в цилиндрах</td><td>от 100</td></tr>
						<tr><td>Диагностика системы охлаждения</td><td>50</td></tr>
						<tr class="alt"><td>Диагностика вихлопной системы</td><td>50</td></tr>
						<tr><td>Диагностика трансмиссии</td><td>от 50</td></tr>
						<tr class="alt"><td>Диагностика электросистем автомобиля</td><td>150</td></tr>
						<tr><td>Диагностика системы обогрева салона автомобиля</td><td>100</td></tr>
						<tr class="alt"><td> Компьютерная диагностика с поиском неисправностей</td><td>от 200</td></tr>
						<tr><td>Диагностика стану жидкостей</td><td>100</td></tr>
						<!--tr class="alt"><td>Диагностика кузова толщиномером ЛКП</td><td>150</td></tr-->
					</tbody>
				</table>
			</div>
			<h6><a name="service">Сервсное обслуживание</a></h6>
			<div class="cell-sm-6 height-fill">
				<div class="datagrid">
					<table class="table table-striped">
						<thead>
							<tr><th>Услуга</th><th>Цена</th></tr>
						</thead>
						<tbody>
							<tr><td>Один час работи</td><td>150</td></tr>
							<tr class="alt"><td>Замена масла в двигателе</td><td>100</td></tr>
							<tr><td>Замена масляного фильтра</td><td>от 20</td></tr>
							<tr class="alt"><td>Замена топливного фильтра</td><td>от 80</td></tr>
							<tr><td>Замена воздушного фильтра двигателя</td><td>от 20</td></tr>
							<tr class="alt"><td>Замена воздушного фильтра салона</td><td>от 20</td></tr>
							<tr><td>Замена антифриза</td><td>от 80</td></tr>
							<tr class="alt"><td>Замена приводного ремня</td><td>от 60</td></tr>
							<tr><td>Замена комплекта ГРМ с помпой</td><td>от 500</td></tr>
							<tr class="alt"><td>Замена роликов привода</td><td>от 80</td></tr>
							<tr><td>Замена водяной помпи</td><td>от 100</td></tr>
							<tr class="alt"><td>Замена термостата</td><td>от 120</td></tr>
							<tr><td>Снять-поставить колесо</td><td>20</td></tr>
							<tr class="alt"><td>Замена масла в редукторе</td><td>от 100</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<h6><a name="electric">Автоэлектрика</a></h6>
			<div class="cell-sm-6 height-fill">
				<div class="datagrid">
					<table class="table table-striped">
						<thead>
							<tr><th>Услуга</th><th>Цена</th></tr>
						</thead>
						<tbody>
							<tr><td>Один час работи</td><td>150</td></tr>
							<tr class="alt"><td>Компьютерная диагностика</td><td>150</td></tr>
							<tr><td>Адаптация двигателя</td><td>250</td></tr>
							<tr class="alt"><td>Адаптация АКПП</td><td>100</td></tr>
							<tr><td>Замена свечей зажигания</td><td>250</td></tr>
							<tr class="alt"><td>Ремонт бензонасосов</td><td>от 50</td></tr>
							<tr><td>Регенерация сажевого фильтра</td><td>450</td></tr>
							<tr class="alt"><td>Установка ксенона</td><td>от 350</td></tr>
							<tr><td>Ремонт электропроводки</td><td>от 400</td></tr>
							<tr class="alt"><td>Замена катушки зажигания</td><td>от 80</td></tr>
							<tr><td>Замена лампочек</td><td>от 20</td></tr>
							<tr class="alt"><td>Установка системы парктроник</td><td>от 700</td></tr>
							<tr><td>Снятие-установка аккумулятора</td><td>от 30</td></tr>
							<tr class="alt"><td>Установка сигнализацииї</td><td>от 500</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<h6><a name="suspension">Ремонт ходовой</a></h6>
			<div class="cell-sm-6 height-fill">
				<div class="datagrid">
					<table class="table table-striped">
						<thead>
							<tr><th>Услуга</th><th>Цена</th></tr>
						</thead>
						<tbody>
							<tr><td>Один час работи</td><td>150</td></tr>
							<tr class="alt"><td>Диагностика ходовой части </td><td>100</td></tr>
							<tr><td>Замена переднего амортизатора</td><td>от 150</td></tr>
							<tr class="alt"><td>Замена заднего амортизатора</td><td>от 100</td></tr>
							<tr><td>Замена шаровой опоры</td><td>от 100</td></tr>
							<tr class="alt"><td>Замена втулки стабилизатора</td><td>от 100</td></tr>
							<tr><td>Замена стойки стабилизатора</td><td>от 80</td></tr>
							<tr class="alt"><td>Замена пружин подвески (пары)</td><td>от 200</td></tr>
							<tr><td>Замена опори переднего амортизатора</td><td>от 80</td></tr>
							<tr class="alt"><td>Замена подшипника ступицы</td><td>от 200</td></tr>
							<tr><td>Замена рулевой тяги</td><td>от 100</td></tr>
							<tr class="alt"><td>Замена сайлентблока</td><td>от 80</td></tr>
							<tr><td>Замена втулок</td><td>от 60</td></tr>
							<tr class="alt"><td>Замена сайлентблока задней балки</td><td>от 250</td></tr>
							<tr><td>Замена балки передней подвески</td><td>500</td></tr>
							<tr class="alt"><td>Замена подрамника</td><td>от 300</td></tr>
							<tr><td>Замена балки задней подвески</td><td>от 400</td></tr>
							<tr class="alt"><td>Замена верхнего рычага подвески</td><td>от 100</td></tr>
							<tr><td>Замена верхнего рычага задней подвески</td><td>от 60</td></tr>
							<tr class="alt"><td>Замена продольного рычага подвески</td><td>от 250</td></tr>
							<tr><td>Замена втулки рычага подвески</td><td>60</td></tr>
							<tr class="alt"><td>Замена ступицы колеса</td><td>от 200</td></tr>
							<tr><td>Замена передней полуоси</td><td>от 240</td></tr>
							<tr class="alt"><td>Замена тяги стабилизатора</td><td>90</td></tr>
							<tr><td>Замена подушки двигателя</td><td>от 150</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<h6><a name="engine">Ремонт двигателя</a></h6>
			<div class="cell-sm-6 height-fill">
				<div class="datagrid">
					<table class="table table-striped">
						<thead>
							<tr><th>Услуга</th><th>Цена</th></tr>
						</thead>
						<tbody>
							<tr><td>Один час работи</td><td>200</td></tr>
							<tr class="alt"><td>Диагностика двигателя </td><td>100</td></tr>
							<tr><td>Расширенная диагностика двигателя</td><td>от 200</td></tr>
							<tr class="alt"><td>Замена двигателя легкового автомобиля</td><td>от 1800</td></tr>
							<tr><td>Замена двигателя внедорожника</td><td>от 2800</td></tr>
							<tr class="alt"><td>Замена головки блока двигателя</td><td>от 1400</td></tr>
							<tr><td>Замена коленчатого вала</td><td>от 1000</td></tr>
							<tr class="alt"><td>Замена прокладки головки блока</td><td>от 1000</td></tr>
							<tr><td>Замена впускного/выпускного коллектора</td><td>от 300</td></tr>
							<tr class="alt"><td>Замена помпы системы охлаждения</td><td>от 370</td></tr>
							<tr><td>Замена поддона</td><td>от 150</td></tr>
							<tr class="alt"><td>Замена термостата</td><td>от 150</td></tr>
							<tr><td>Замена патрубков системы охлаждения</td><td>от 70</td></tr>
							<tr class="alt"><td>Замена радиатора системы охлаждения</td><td>от 350</td></tr>
							<tr><td>Замена радиатора системы кондиционирования</td><td>300</td></tr>
							<tr class="alt"><td>Замена трубок системы кондиционирования</td><td>от 150</td></tr>
							<tr><td>Замена теплообменника кондиционира</td><td>от 600</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<h6><a name="transmission">АКПП, МКПП, сцепление</a></h6>
			<div class="cell-sm-6 height-fill">
				<div class="datagrid">
					<table class="table table-striped">
						<thead>
							<tr><th>Услуга</th><th>Цена</th></tr>
						</thead>
						<tbody>
							<tr><td>Один час работи</td><td>150</td></tr>
							<tr class="alt"><td>Замена масла МКПП</td><td>от 150</td></tr>
							<tr><td>Замена масла АКПП</td><td>от 250</td></tr>
							<tr class="alt"><td>Диагностика МКПП</td><td>100</td></tr>
							<tr><td>Диагностика АКПП</td><td>200</td></tr>
							<tr class="alt"><td>Снятие-установка МКПП</td><td>400</td></tr>
							<tr><td>Снятие-установка АКПП</td><td>1200</td></tr>
							<tr class="alt"><td>Замена комплекта сцепления</td><td>от 450</td></tr>
							<tr><td>Замена двухмасового маховика</td><td>от 550</td></tr>
							<tr class="alt"><td>Замена главного цилиндра сцепления</td><td>от 130</td></tr>
							<tr><td>Замена рабочего цилиндра сцепления</td><td>от 130</td></tr>
							<tr class="alt"><td>Регулировка троса сцепления</td><td>от 35</td></tr>
							<tr><td>Замена троса сцепления</td><td>от 250</td></tr>
							<tr class="alt"><td>Долив гидравлического масла сцепления</td><td>от 50</td></tr>
							<tr><td>Снятие-установка карданного вала</td><td>от 150</td></tr>
							<tr class="alt"><td>Замена крестовины карданного вала</td><td>от 200</td></tr>
							<tr><td>Замена еластичной муфты карданного вала</td><td>от 200</td></tr>
							<tr class="alt"><td>Прокачка гидропривода сцепления</td><td>от 100</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<h6><a name="fuel">Топливная система, навесное</a></h6>
			<div class="cell-sm-6 height-fill">
				<div class="datagrid">
					<table class="table table-striped">
						<thead>
							<tr><th>Услуга</th><th>Цена</th></tr>
						</thead>
						<tbody>
							<tr><td>Один час работи</td><td>150</td></tr>
							<tr class="alt"><td>Демонтаж-монтаж форсунок</td><td>от 500</td></tr>
							<tr><td>Диагностика форсунок</td><td>от 200</td></tr>
							<tr class="alt"><td>Демонтаж-монтаж бака</td><td>от 700</td></tr>
							<tr><td>Замена ТНВД (топливный насос)</td><td>800</td></tr>
							<tr class="alt"><td>Демонтаж-монтаж стартера</td><td>от 400</td></tr>
							<tr><td>Чистка бака</td><td>от 300</td></tr>
							<tr class="alt"><td>Регулировка троса сцепления</td><td>от 35</td></tr>
							<tr class="alt"><td>Ремонт стартера</td><td>250</td></tr>
							<tr><td>Демонтаж-монтаж генератора</td><td>от 400</td></tr>
							<tr class="alt"><td>Ремонт генератора</td><td>от 600</td></tr>
							<tr><td>Демонтаж-монтаж турбины</td><td>от 300</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<h6><a name="brakes">Тормозная система</a></h6>
			<div class="cell-sm-6 height-fill">
				<div class="datagrid">
					<table class="table table-striped">
						<thead>
							<tr><th>Услуга</th><th>Цена</th></tr>
						</thead>
						<tbody>
							<tr><td>Один час работи</td><td>150</td></tr>
							<tr class="alt"><td>Диагностика тормозной системы</td><td>100</td></tr>
							<tr><td>Замена тормозных трубок та шланг</td><td>от 90</td></tr>
							<tr class="alt"><td>Замена передних тормозных колодок</td><td>120</td></tr>
							<tr><td>Замена задних тормозных колодок</td><td>120</td></tr>
							<tr class="alt"><td>Замена тормозного масла</td><td>от 80</td></tr>
							<tr><td>Замена тормозных дисков</td><td>от 200</td></tr>
							<tr class="alt"><td>Замена барабанных колодок</td><td>от 180</td></tr>
							<tr><td>Замена тормозного троса</td><td>от 170</td></tr>
							<tr class="alt"><td>Замена главного тормозного цилиндра</td><td>от 150</td></tr>
							<tr><td>Замена робочого тормозного цилиндра</td><td>от 50</td></tr>
							<tr class="alt"><td>Замена вакуумного усилителя тормозов</td><td>от 190</td></tr>
							<tr><td>Замена одного суппорта колеса</td><td>от 120</td></tr>
							<tr class="alt"><td>Прокачка тормозной системы</td><td>от 120</td></tr>
							<tr><td>Замена тормозной жидкости</td><td>120</td></tr>
							<tr class="alt"><td>Замена главного тормозного цилиндра</td><td>от 150</td></tr>
							<tr><td>Замена рабочего тормозного цилиндра</td><td>от 50</td></tr>
							<tr class="alt"><td>Замена вакуумного усилителя тормознов</td><td>от 190</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<h6><a name="steering">Рулевое управление</a></h6>
			<div class="cell-sm-6 height-fill">
				<div class="datagrid">
					<table class="table table-striped">
						<thead>
							<tr><th>Услуга</th><th>Цена</th></tr>
						</thead>
						<tbody>
							<tr><td>Один час работи</td><td>150</td></tr>
							<tr class="alt"><td>Диагностика рулевого управления</td><td>от 50</td></tr>
							<tr><td>Замена рулевой рейки</td><td>от 240</td></tr>
							<tr class="alt"><td>Замена насоса ГУР</td><td>от 240</td></tr>
							<tr><td>Замена масла ГУР</td><td>от 50</td></tr>
							<tr class="alt"><td>Замена рулевой тяги</td><td>от 100</td></tr>
							<tr><td>Замена пыльника рулевой тяги</td><td>от 40</td></tr>
							<tr class="alt"><td>Замена наконечника рулевой тяги</td><td>от 80</td></tr>
							<tr><td>Замена шланга высокого давления рулевого</td><td>от 150</td></tr>
							<tr class="alt"><td>Замена шланга низкого давления рулевого</td><td>от 100</td></tr>
							<tr><td>Замена пыльника рулевой тяги</td><td>от 40</td></tr>
							<tr class="alt"><td>Замена рулевого механизма</td><td>500</td></tr>
							<tr><td>Ремонт рулевой рейки</td><td>от 2000</td></tr>
							<tr class="alt"><td>Ремонт насоса ГУР</td><td>от 1000</td></tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- site__body / end -->
@stop