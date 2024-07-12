@extends('shop.template')

@section('content')
<div class="site__body">
	<div class="block-space block-space--layout--spaceship-ledge-height"></div>
	<div class="block">
		<div class="container">
			<div class="not-found">
				<div class="not-found__404">Oops! Error 404</div>
				<div class="not-found__content">
					<h1 class="not-found__title">Страница не найдена</h1>
					<p class="not-found__text">Не возможно отобразить запрошенную вами страницу.
					<br>Попробуйте воспользоваться поиском.</p>
					<p class="not-found__text">Или вернитесь на главную страницу.</p>
					<a class="btn btn-secondary btn-sm" href="{{ route('home') }}">Переход на Главную</a>
				</div>
			</div>
		</div>
	</div>
</div>
@stop