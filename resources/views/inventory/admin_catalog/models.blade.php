@extends('inventory.layouts.app', ['page' => 'Catalog', 'pageSlug' => 'models', 'section' => 'catalog', 'search' => 'models'])

@section('content')
<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
				<h1 class="block-header__title" style="text-transform:uppercase">Каталог моделей {{$ResultArray["ubrand"]}}</h1>
				<div class="autopic">
					<img class="autopicimg" src="{{$ResultArray["brand_logo_src"]}}" alt="{{$ResultArray["ubrand"]}}">
				</div>
			</div>
		</div>
		<div class="block-split">
			<div class="container">
				<div class="block-split__row row no-gutters">
					<div class="block-split__item block-split__item-content col-auto">
						<div class="block">
							<div class="categories-list categories-list--layout--columns-4-full">
								<ul class="categories-list__body">
								@if($ResultArray["models_count"]>0)
									@foreach($ResultArray["models"] as $CurModel=>$arModels)
										<li class="categories-list__item">
											<a href="#Modal_{{trim($CurModel)}}"  data-toggle="modal" data-whatever="{{trim($CurModel)}}">
												<img src="{{$ResultArray["model_picture"][trim($CurModel)]}}" alt="{{trim($CurModel)}}">
												<div class="categories-list__item-name">{{trim($CurModel)}}</div>
											</a>
										</li>
										<!--modal-->
										<div class="modal fade" id="Modal_{{trim($CurModel)}}" tabindex="-1" role="dialog" aria-labelledby="{{trim($CurModel)}}" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="Modal_{{trim($CurModel)}}">Select model {{trim($CurModel)}}</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<div class="container-fluid">
														@foreach($arModels as $arModel)
															<div class="row">
																<a href="{{$arModel["model_url"]}}">{{$arModel["model_name"]}} ( {{$arModel["date_from"]}} - {{$arModel["date_to"]}} )</a>
															</div>
															@endforeach
														</div>
													</div>
												</div>
											</div>
										</div>
										<!--modal-->
									@endforeach
								@endif
								</ul>
							</div>
						</div>
						<div class="block-space block-space--layout--divider-nl"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop