@extends('inventory.layouts.app', ['page' => __('inventory.error_404'), 'pageSlug' => '', 'section' => '', 'search' => ''])

@section('content')


<div class="row">
    <div class="card" style="height:800PX;position:relative;">
        <div class="card-header">
            <h4 class="card-title">{{ __('inventory.error_404') }}</h4>
        </div>
        <div class="card-body">
			<div class="block">
				<div class="container">
					<div class="not-found">
						<div class="not-found__404">Oops! Error 404</div>
						<div class="not-found__content">
							<h1 class="not-found__title">Страница не найдена</h1>
							<p class="not-found__text">Не возможно отобразить запрошенную вами страницу.
							<br>Попробуйте воспользоваться поиском.</p>
							<p class="not-found__text">Или вернитесь на главную страницу.</p>
							<a class="btn btn-secondary btn-sm" href="/">Переход на Главную</a>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
@stop