<div class="addproduct modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h6 class="modal-title">{{ __('modal.product_info') }}: {{ $ResultArray["full_name"] }}</h6>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<div class="modal-body">
			<ul class="nav nav-pills nav-pills-primary nav-pills-icons">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Info"><i class="tim-icons icon-istanbul"></i> {{ __('modal.product_info') }}</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Price"><i class="tim-icons icon-settings"></i> {{ __('modal.product_prices') }}</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Cross"><i class="tim-icons icon-settings"></i> {{ __('modal.product_crosses') }}</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Applicability"><i class="tim-icons icon-settings"></i> {{ __('modal.product_applicability') }}</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Properties"><i class="tim-icons icon-settings"></i> {{ __('modal.product_properties') }}</a></li>
			</ul>
			<div class="tab-content tab-space" style="height:360px;position:relative;">
				<div class="tab-pane active" id="Info" style="max-height:100%;overflow:auto;">
					<div class="container">
						<div class="row">
							<div class="col-6">
								<div class="row"><div class="col-6">{{ __('modal.product_name') }}</div><div class="col-6">{{ $ResultArray["name"] }}</div></div>
								<div class="row"><div class="col-6">{{ __('modal.article') }}</div><div class="col-6">{{ $ResultArray["article"] }}</div></div>
								<div class="row"><div class="col-6">{{ __('modal.brand') }}</div><div class="col-6">{{ $ResultArray["brand"] }}</div></div>
							</div>
							<div class="col-6">
								<div class="text-center">
									<img src="{{ $ResultArray["image"] }}" class="rounded" alt="{{ $ResultArray["full_name"] }}">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="Price" style="max-height:100%;overflow:auto;">
				@if(count($ResultArray["prices"])>0)
					<div class="table-responsive ps">
						<table class="table">
							<thead>
								<th>{{ __('modal.provider') }}</th>
								<th>{{ __('modal.price_date') }}</th>
								<th>{{ __('modal.available') }}</th>
								<th>{{ __('modal.provider_days') }}</th>
								<th>{{ __('modal.income_price') }}</th>
								<th>{{ __('modal.price') }}</th>
							</thead>
							<tbody>
								@foreach ($ResultArray["prices"] as $price)
								<tr>
									<td>{{ $price['provider'] }}</td>
									<td>{{ $price['date'] }}</td>
									<td>{{ $price['available'] }}</td>
									<td>{{ $price['day'] }}</td>
									<td>{{ $price['src'] }}</td>
									<td>{{ $price['price'] }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@else
					<div class="product__features-title">{{ __('modal.nocrosses') }}</div>
					@endif
				</div>
				<div class="tab-pane" id="Cross" style="max-height:100%;overflow:auto;">
					@if(!empty($ResultArray["crosses"]))
					<div class="table-responsive ps">
						<table class="table">
							<thead>
								<th class="col-3">{{ __('modal.brand') }}</th>
								<th class="col-3">{{ __('modal.article') }}</th>
								<th class="col-3">{{ __('modal.product_name') }}</th>
								<th class="col-3 d-none d-sm-block">{{ __('modal.product_type') }}</th>
							</thead>
							<tbody>
							@foreach($ResultArray["crosses"] as $item)
								<tr>
									<td class="col-3">{{$item["brand"]}}</td>
									<td class="col-3">{{$item["article"]}}</td>
									<td class="col-3">{{$item["name"]}}</td>
									<td class="col-3 d-none d-sm-block">{{$item["type"] ?? "-----"}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@else
					<div class="product__features-title">{{ __('modal.nocrosses') }}</div>
					@endif
				</div>
				<div class="tab-pane" id="Applicability" style="max-height:100%;overflow:auto;">
					Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas.
					<br>
					<br>Dramatically maintain clicks-and-mortar solutions without functional solutions.
				</div>
				<div class="tab-pane" id="Properties" style="max-height:100%;overflow:auto;">
				<ul>
				@foreach ($ResultArray["properties"] as $property)
					<li>{{$property["name"]}}: <span>{{$property["VALUE"]}}</span></li>
				@endforeach	
				</ul>
				</div>
			</div>
		</div>
		<!-- <div class="modal-footer"><button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{ __('modal.close') }}</button></div> -->
	</div>
</div>