@extends('inventory.layouts.app', ['page' => __('inventory.edit_client_auto'), 'pageSlug' => 'client_autos', 'section' => 'inventory', 'search' => 'client_autos'])

@section('content')
<div class="row">
	<div class="col-xl-12 order-xl-1">
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col-8">
						<h4 class="mb-0">{{ __('inventory.edit_client_auto') }}</h4>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('client_autos.index') }}" class="btn btn-sm btn-simple btn-back" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ __('inventory.clients_list') }}"><i class="fas fa-arrow-left"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form method="post" action="{{ route('client_autos.update', $client_auto) }}" autocomplete="off">
					@csrf
					@method('put')
					<!------------------>
					<h6 class="heading-small text-muted mb-4">{{ __('inventory.client_auto_information') }}</h6>
					<div class="pl-lg-4">
						<div class="row">
							<div class="col-3">
								<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-name">{{ __('inventory.name') }}</label>
									<input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.name') }}" value="{{ old('name', $client_auto->name) }}" required readonly>
									@include('inventory.alerts.feedback', ['field' => 'name'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('vin') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-vin">{{ __('inventory.vin') }}</label>
									<input type="text" name="vin" id="input-vin" class="form-control form-control-alternative{{ $errors->has('vin') ? ' is-invalid' : '' }}" placeholder="VIN" value="{{ old('vin', $client_auto->vin) }}" required readonly>
									@include('inventory.alerts.feedback', ['field' => 'vin'])
								</div>
							</div>
							<div class="col-6">
								<div class="row">
									<div class="col-10">
										<div class="form-group{{ $errors->has('client_id') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-client">{{ __('inventory.client') }}</label>
											<select name="client_id" id="input-client" class="form-select form-control-alternative{{ $errors->has('client') ? ' is-invalid' : '' }}">
												<option value="">{{ __('modal.not_specified') }}</option>
												@foreach ($clients as $client)
												@if($client_auto['client_id'] == $client['id'])
												<option value="{{$client['id']}}" selected>{{$client['name']}}</option>
												@else
												<option value="{{$client['id']}}">{{$client['name']}}</option>
												@endif
												@endforeach
											</select>
											@include('inventory.alerts.feedback', ['field' => 'client_id'])
										</div>
									</div>
									<div class="col-2 text-left mt-4">
										<a href="{{ route('clients.show',['client' => $client_auto->client]) }}" class="btn btn-sm btn-simple btn-back" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ __('inventory.go_to_client') }}"><i class="fas fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-3">
								<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-name">{{ __('inventory.name') }}</label>
									<input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.name') }}" value="{{ old('name', $client_auto->name) }}" required readonly>
									@include('inventory.alerts.feedback', ['field' => 'name'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('plate') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-plate">{{ __('inventory.plate') }}</label>
									<input type="text" name="plate" id="input-plate" class="form-control form-control-alternative{{ $errors->has('plate') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.plate') }}" value="{{ old('plate', $client_auto->plate) }}" >
									@include('inventory.alerts.feedback', ['field' => 'plate'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('color') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-color">{{ __('inventory.vehiclecolor') }}</label>
									<select name="color" id="input-color" class="form-select form-control-alternative{{ $errors->has('color') ? ' is-invalid' : '' }}">
										<option value="">{{ __('modal.not_specified') }}</option>
										@foreach ($colors as $color)
										@if($client_auto['color'] == $color['name'])
										<option value="{{$color['name']}}" selected>{{$color['name']}}</option>
										@else
										<option value="{{$color['name']}}">{{$color['name']}}</option>
										@endif
										@endforeach
									</select>
									@include('inventory.alerts.feedback', ['field' => 'color'])
								</div>
							</div>
							<div class="col-3 text-left mt-4">
								<button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.save') }}</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--service parts-->
@if($client_auto)
<div class="row">
	<div class="col-xl-12 order-xl-1">
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col-10">
						<h4 class="mb-0">{{ __('inventory.client_auto_service_parts') }}</h4>
					</div>
					<div class="col-1 text-right">
						<a href="{{ route('client_autos.show',['client_auto' => $client_auto]) }}" class="btn btn-sm btn-simple btn-selector" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ __('inventory.go_to_order') }}"><i class="fas fa-file-download"></i></a>
					</div>
					<div class="col-1 text-right">
						<button type="button" class="btn btn-sm btn-simple btn-success" OnClick="servicepart_add('{{$client_auto->id}}')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ __('inventory.add_servicepart') }}"><i class="fas fa-plus"></i></button>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive" id="servicepartsTable">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>{{ __('inventory.article') }}</th>
								<th>{{ __('inventory.brand') }}</th>
								<th>{{ __('inventory.name') }}</th>
								<th>{{ __('inventory.quantity') }}</th>
								<th>{{ __('inventory.stock') }}</th>
								<th>{{ __('inventory.price') }}</th>
								<th>{{ __('inventory.comment') }}</th>
							</tr>
						</thead>					
						<tbody>								
							@foreach($client_auto->serviceparts as $item)
							<tr id="selected_servicepart-{{ $item->id }}" class="pointer" OnClick="servicepart_edit('{{$client_auto->id}}','{{$item->id}}')">
								<td scope="row" class="article">{{ $item->product->article }}</td>
								<td scope="row" class="brand">{{ $item->product->brand }}</td>
                                <td scope="row" class="name">{{ $item->product->name }}</td>
								<td scope="row" class="quantity">{{ $item->quantity ?? 0}}</td>
								<td scope="row" class="stock">{{ $item->stock ?? 0}}</td>
								<td scope="row" class="price">{{ $item->price ?? 0}}</td>
								<td scope="row" class="comment">{{ $item->comment }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
@endsection