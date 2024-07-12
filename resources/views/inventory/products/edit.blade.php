@extends('inventory.layouts.app', ['page' => __('inventory.edit_product'), 'pageSlug' => 'products', 'section' => 'inventory', 'search' => 'products'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form method="post" action="{{ route('products.update', $product) }}" autocomplete="off">
					@csrf
					@method('put')
						<!-- <image> -->
						<div class="row">
							<div class="col-9">
								<div class="row">
									<div class="col-9">
										<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-name">{{ __('inventory.name') }}</label>
											<input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.name') }}" value="{{ old('name', $product->name) }}" required autofocus>
											@include('inventory.alerts.feedback', ['field' => 'name'])
										</div>
									</div>
									<div class="col-3">                                    
										<div class="form-group{{ $errors->has('article') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-article">{{ __('inventory.article') }}</label>
											<input type="text" name="article" id="input-article" class="form-control form-control-alternative{{ $errors->has('article') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.article') }}" value="{{ old('article', $product->article) }}" required autofocus>
											@include('inventory.alerts.feedback', ['field' => 'article'])
										</div>
									</div>		
								</div>
								<div class="row">
									<div class="col-9">
										<div class="form-group{{ $errors->has('full_name') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-full_name">{{ __('inventory.full_name') }}</label>
											<input type="text" name="full_name" id="input-full_name" class="form-control form-control-alternative{{ $errors->has('full_name') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.full_name') }}" value="{{ old('full_name', $product->full_name) }}" required autofocus>
											@include('inventory.alerts.feedback', ['field' => 'full_name'])
										</div>
									</div>
									<div class="col-3">                                    
                                    <div class="form-group{{ $errors->has('article') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-article">{{ __('inventory.id') }}</label>
                                        <input type="text" name="article" id="input-article" class="form-control form-control-alternative{{ $errors->has('article') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.article') }}" value="{{ $product->id }}" disabled>
                                    </div>
                                </div>			
								</div>
								@if($product->product_category_id !== 1)
									@if($product->product_category_id == 2)
										@include('inventory.products.bulbs')
									@endif
									@if($product->product_category_id == 3)
										@include('inventory.products.batteries')
									@endif
									@if($product->product_category_id == 4)
										@include('inventory.products.batteries')
									@endif
									@if($product->product_category_id == 5)
										@include('inventory.products.batteries')
									@endif
									@if($product->product_category_id == 6)
										@include('inventory.products.batteries')
									@endif
									@if($product->product_category_id == 7)
										@include('inventory.products.batteries')
									@endif
									@if($product->product_category_id == 8)
										@include('inventory.products.alternator')
									@endif
									@if($product->product_category_id == 9)
										@include('inventory.products.starter')
									@endif
								@endif
								<div class="row">
									<div class="col-3">
										<label class="form-control-label" for="input-name">{{ __('inventory.product_category') }}</label>
										<select name="product_category_id" id="input-category" class="form-select form-control-alternative{{ $errors->has('product_category_id') ? ' is-invalid' : '' }}" required>
											@foreach ($categories as $category)
											@if($category['id'] == old($product->product_category_id) or $category['id'] == $product->product_category_id)
													<option value="{{$category['id']}}" selected>{{$category['name']}}</option>
												@else
													<option value="{{$category['id']}}">{{$category['name']}}</option>
												@endif
											@endforeach
										</select>
										@include('inventory.alerts.feedback', ['field' => 'product_category_id'])
									</div>
									<div class="col-3">
										<label class="form-control-label" for="input-name">{{ __('inventory.group') }}</label>
										<select name="product_group_id" id="input-group" class="form-select form-control-alternative{{ $errors->has('product_group_id') ? ' is-invalid' : '' }}" required>
											@foreach ($groups as $group)
											@if($group['id'] == old($product->product_group_id) or $group['id'] == $product->product_group_id)
													<option value="{{$group['id']}}" selected>{{$group['name']}} ({{$group['id']}})</option>
												@else
													<option value="{{$group['id']}}">{{$group['name']}} ({{$group['id']}})</option>
												@endif
											@endforeach
										</select>
										@include('inventory.alerts.feedback', ['field' => 'product_group_id'])
									</div>
									<div class="col-3">
										<label class="form-control-label" for="input-product_price_group">{{ __('inventory.product_price_group') }}</label>
										<select name="product_price_group_id" id="input-product_price_group" class="form-select form-control-alternative{{ $errors->has('product_price_group_id') ? ' is-invalid' : '' }}">
											<option value="">{{ __('inventory.no_price_group') }}</option>
											@foreach ($product_price_groups as $group)
												@if($group['id'] == old($product->product_price_group_id) or $group['id'] == $product->product_price_group_id)
													<option value="{{$group['id']}}" selected>{{$group['name']}} ({{$group['id']}})</option>
												@else
													<option value="{{$group['id']}}">{{$group['name']}} ({{$group['id']}})</option>
												@endif
											@endforeach
										</select>
										@include('inventory.alerts.feedback', ['field' => 'product_price_group_id'])
									</div>
									<div class="col-3">
										<label class="form-control-label" for="input-brand">{{ __('inventory.brand') }}</label>
										<select name="brand" id="input-brand" class="form-select form-control-alternative{{ $errors->has('brand') ? ' is-invalid' : '' }}" required>
											<option value="">{{ __('inventory.not_specified') }}</option>
											@foreach ($brands as $brand)
												@if($brand->bkey == old($product->bkey) or $brand->bkey == $product->bkey)
													<option value="{{$brand->brand}}" selected>{{$brand->brand}}</option>
												@else
													<option value="{{$brand->brand}}">{{$brand->brand}}</option>
												@endif
											@endforeach
										</select>
										@include('inventory.alerts.feedback', ['field' => 'brand'])
									</div>	
								</div>
								<div class="row">
									<div class="col-9">
										<div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-description">{{ __('inventory.description') }}</label>
											<input type="text" name="description" id="input-description" class="form-control form-control-alternative" placeholder="{{ __('inventory.description') }}" value="{{ old('description', $product->description) }}" >
											@include('inventory.alerts.feedback', ['field' => 'description'])
										</div>
									</div>
									<div class="col-3">
										<div class="form-group{{ $errors->has('weight') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-weight">{{ __('inventory.weight') }}</label>
											<input type="text" name="weight" id="input-weight" class="form-control form-control-alternative" placeholder="{{ __('inventory.weight') }}" value="{{ old('weight', $product->weight) }}" >
											@include('inventory.alerts.feedback', ['field' => 'weight'])
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 text-center">
										<table class="table">
											<thead>
												<tr>
													<th scope="col">{{ __('inventory.stock') }}</th>
													<th scope="col">{{ __('inventory.base_price') }}</th>
													<th scope="col">{{ __('inventory.retail_price') }}</th>
													<th scope="col">{{ __('inventory.total_sales') }}</th>
													<th scope="col">{{ __('inventory.income_produced') }}</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>{{ number_format($product->stocks()->sum('quantity') ?? 0, 2)}}</td>
													<td>{{ number_format($product->price_in ?? 0, 2)}}</td>
													<td>{{ number_format($product->price_out ?? 0, 2)}}</td>
													<td>{{ number_format($product->solds->sum('quantity') ?? 0, 2)}}</td>
													<td>{{ number_format($product->solds->sum('total_amount') ?? 0, 2)}}</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-3">
								<div class="row">
									<div class="col-12 text-center">
										<a href="{{ route('products.index') }}" class="btn btn-simple btn-sm btn-back"><i class="fas fa-arrow-left"></i></a>
									</div>
								</div>
								<div class="row">
									<div class="col-12 text-center">
										<div class="fileinput fileinput-new text-center" data-provides="fileinput">
											<div class="fileinput-new thumbnail">
												<img src="/images/admin/image_placeholder.jpg" alt="...">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail" style=""></div>
											<div>
												<span class="btn btn-selector btn-simple btn-sm btn-file">
													<span class="fileinput-new">{{ __('inventory.select_image') }}</span>
													<span class="fileinput-exists">{{ __('inventory.change_image') }}</span>
													<input type="hidden"><input type="file" name="...">
												</span>
												<a href="#" class="btn btn-delete btn-simple btn-sm fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i>{{ __('inventory.remove_image') }}</a>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 text-center">
										<button type="submit" class="btn btn-sm btn-simple btn-success mt-4">{{__('inventory.save')}}</button>
									</div>
								</div>
							</div>
						</div>
						
					</form>
				</div>
				</div>
			@if($product)
			<div class="row">
				<div class="col-12">
					<div class="card" style="height:560px;position:relative;">
						<div class="card-body" style="max-height:100%;overflow:auto;">
							<ul class="nav nav-pills nav-pills-primary nav-pills-icons">
								<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#nav-provider_prices">{{ __('inventory.provider_prices') }}</a></li>
								<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-crosses">{{ __('inventory.crosses') }}</a></li>
								<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-min_stocks">{{ __('inventory.min_stocks') }}</a></li>
							</ul>
							<div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="nav-provider_prices" role="tabpanel" aria-labelledby="nav-provider_prices-tab">
									<div class="card-header d-flex flex-row align-items-center justify-content-between">
										<h4 class="card-title">{{ __('inventory.provider_prices') }}</h4>
									</div>
									<table class="table">
										<thead>
											<th>{{ __('inventory.provider') }}</th>
											<th>{{ __('inventory.stock') }}</th>
											<th>{{ __('inventory.available') }}</th>
											<th>{{ __('inventory.provider_days') }}</th>
											<th>{{ __('inventory.income_price') }}</th>
											<th>{{ __('inventory.price') }}</th>
										</thead>
										<tbody>
											@foreach ($product->provider_prices as $price)
												<tr>
													<td>{{ $price->provider }}</td>
													<td>{{ $price->stock }}</td>
													<td>{{ $price->available }}</td>
													<td>{{ $price->day }}</td>
													<td>{{ $price->src }}</td>
													<td>{{ $price->price }}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>

								<div class="tab-pane fade" id="nav-crosses" role="tabpanel" aria-labelledby="nav-crosses-tab">
									<div class="card-header d-flex flex-row align-items-center justify-content-between">
										<h4 class="card-title">{{ __('inventory.crosses') }}</h4>
										<div class="col-4 text-right">
											<button type="button" class="btn btn-sm btn-simple btn-selector" OnClick="product_addcross('{{ $product->id }}')"><i class="fas fa-plus"></i></button>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive" id="crossesTable">
											<table class="table">
												<thead>
													<tr>
														<th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
														<th scope="col" style="width: 15%;">{{ __('inventory.brand') }}</th>
														<th scope="col" style="width: 40%;">{{ __('inventory.name') }}</th>
														<th scope="col" style="width: 15%;">{{ __('modal.main_by_group') }}</th>
														<th scope="col" style="width: 15%;">{{ __('modal.main_by_brand') }}</th>
													</tr>
												</thead>
												<tbody>
												@foreach($crosses as $cross)
													<tr id="selected_cross-{{ $cross->id }}" class="pointer" OnClick="product_editcross('{{$cross['id']}}','{{$cross['uid']}}')">
														<td>{{ $cross->article }}</td>
														<td>{{ $cross->brand }}</td>
														<td>{{ $cross->name }}</td>
														<td>
															@if ($cross->main_by_group == 1)<span class="text-success"><i class="far fa-check-square"></i></span>@endif                                        
														</td>
														<td>
															@if ($cross->main_by_brand == 1)<span class="text-success"><i class="far fa-check-square"></i></span>@endif                                        
														</td>
													</tr>
												@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- <min_stocks> -->
								<div class="tab-pane fade" id="nav-min_stocks" role="tabpanel" aria-labelledby="nav-min_stocks-tab">
									<div class="card-header d-flex flex-row align-items-center justify-content-between">
										<h4 class="card-title">{{ __('inventory.min_stocks') }}</h4>
										<div class="col-4 text-right">
											<button type="button" class="btn btn-sm btn-simple btn-selector" OnClick="product_add_min_stock('{{$product->id}}')"><i class="fas fa-plus"></i></button>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive" id="minStocksTable">
											<table class="table">
												<thead>
													<tr>
														<th>{{ __('inventory.date') }}</th>
														<th>{{ __('inventory.warehouse') }}</th>
														<th>{{ __('inventory.min_stock') }}</th>
													</tr>
												</thead>
												<tbody>
												@foreach($product->minimal_stocks as $min_stock)
													<tr id="selected_min_stock-{{ $min_stock->id }}" class="pointer" OnClick="product_edit_min_stock('{{$product->id}}','{{$min_stock->id}}')">
														<td scope="row" class="date">@if($min_stock->updated_at) {{ $min_stock->updated_at }} @else {{ $min_stock->created_at }} @endif</td>
														<td scope="row" class="warehouse">{{ $min_stock->warehouse->name }}</td>
														<td scope="row" class="quantity">{{ $min_stock->quantity }}</td>
													</tr>
												@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endif
</div>
@endsection