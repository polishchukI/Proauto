@extends('inventory.layouts.app', ['page' => __('inventory.edit_client'), 'pageSlug' => 'clients', 'section' => 'clients', 'search' => 'clients'])

@section('content')
<div class="row">
	<div class="col-xl-12 order-xl-1">
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0">{{ __('inventory.edit_client') }}</h3>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('clients.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form method="post" action="{{ route('clients.update', $client) }}" autocomplete="off">
					@csrf
					@method('put')
					<h6 class="heading-small text-muted mb-4">{{__('inventory.client_information')}}</h6>
					<div class="pl-lg-4">
						<div class="row">
							<div class="col-3">
								<div class="form-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-lastname">{{__('inventory.lastname')}}</label>
									<input type="text" name="lastname" id="input-lastname" class="form-control form-control-alternative{{ $errors->has('lastname') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.lastname')}}" value="{{ $client['lastname'] }}" autofocus>
									@include('inventory.alerts.feedback', ['field' => 'lastname'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('firstname') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-firstname">{{__('inventory.firstname')}}</label>
									<input type="text" name="firstname" id="input-firstname" class="form-control form-control-alternative{{ $errors->has('firstname') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.firstname')}}" value="{{ $client['firstname'] }}" autofocus>
									@include('inventory.alerts.feedback', ['field' => 'firstname'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('secondname') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-secondname">{{__('inventory.secondname')}}</label>
									<input type="text" name="secondname" id="input-secondname" class="form-control form-control-alternative{{ $errors->has('secondname') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.secondname')}}" value="{{ $client['secondname'] }}" autofocus>
									@include('inventory.alerts.feedback', ['field' => 'secondname'])
								</div>
							</div>
							<div class="col-3">
								<div class="form-group{{ $errors->has('birthday') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-birthday">{{__('inventory.birthday')}}</label>
									<input type="date" name="birthday" id="input-birthday" class="form-control form-control-alternative{{ $errors->has('birthday') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.birthday')}}" value="{{ $client['birthday'] }}">
									@include('inventory.alerts.feedback', ['field' => 'birthday'])
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-name">{{__('inventory.name')}}</label>
									<input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.name')}}" value="{{ $client['name'] }}"  autofocus>
									@include('inventory.alerts.feedback', ['field' => 'name'])
								</div>
							</div>
							<div class="col-2">
								<div class="form-group{{ $errors->has('product_discount') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-product_discount">{{__('inventory.product_discount')}}</label>
									<input type="number" name="product_discount" id="input-product_discount" max="10" class="form-control form-control-alternative{{ $errors->has('product_discount') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.product_discount')}}" value="{{ $client['product_discount'] }}">
									@include('inventory.alerts.feedback', ['field' => 'product_discount'])
								</div>
							</div>
							<div class="col-2">
								<div class="form-group{{ $errors->has('service_discount') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-service_discount">{{__('inventory.service_discount')}}</label>
									<input type="number" name="service_discount" id="input-service_discount" max="10"class="form-control form-control-alternative{{ $errors->has('service_discount') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.service_discount')}}" value="{{ $client['service_discount'] }}">
									@include('inventory.alerts.feedback', ['field' => 'service_discount'])
								</div>
							</div>
							<div class="col-2">
								<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-email">{{__('inventory.email')}}</label>
									<input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.email')}}" value="{{ $client['email'] }}">
									@include('inventory.alerts.feedback', ['field' => 'email'])
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-10">
								<div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
									<label class="form-control-label" for="input-comment">{{__('inventory.comment')}}</label>
									<input type="text" name="comment" id="input-comment" class="form-control form-control-alternative{{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.comment')}}" value="{{ $client['comment'] }}">
									@include('inventory.alerts.feedback', ['field' => 'comment'])
								</div>
							</div>
							<div class="col-2">
								<button type="submit" class="btn btn-sm btn-simple btn-success mt-4">{{__('inventory.save')}}</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@if($client)
<div class="row">
	<div class="col-6"><!--phones-->
		<div class="card" style="height:368px;position:relative;">
			<div class="card-header d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold">{{__('inventory.phones')}}</h6>
				<div class="col-4 text-right">
					<button type="button" class="btn btn-sm btn-simple btn-success" OnClick="client_addphone('{{$client->id}}')"><i class="fas fa-phone-square"></i></button>
				</div>
			</div>
			<div class="card-body" style="max-height:100%;overflow:auto;">
				<div class="table-responsive" id="clientPhonesTable">
					<table class="table">
						<thead>
							<tr>
								<th>{{__('inventory.phone')}}</th>
								<th><i class="fab fa-telegram"></i></th>
								<th><i class="fab fa-viber"></i></th>
								<th><i class="fab fa-whatsapp"></i></th>
								<th><i class="far fa-check-square"></i></th>
								<th>{{__('inventory.comment')}}</th>
							</tr>
						</thead>
						<tbody>
						@foreach($client->phones as $phone)
							<tr id="client_selected_phone-{{ $phone->id }}" class="pointer" OnClick="client_editphone('{{$client->id}}','{{$phone->id}}')">
								<td scope="row" class="phone">{{ $phone->phone }}</td>
								<td scope="row" class="telegram">@if($phone->telegram == 1)<i class="far fa-check-square text-success"></i>@endif</td>
								<td scope="row" class="viber">@if($phone->viber == 1)<i class="far fa-check-square text-success"></i>@endif</td>
								<td scope="row" class="whatsapp">@if($phone->whatsapp == 1)<i class="far fa-check-square text-success"></i>@endif</td>
								<td scope="row" class="default">@if($phone->default == 1)<i class="far fa-check-square text-success"></i>@endif</td>
								<td scope="row" class="comment">{{ $phone->comment }}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>				
	<div class="col-6"><!--addresses-->
		<div class="card" style="height:368px;position:relative;">
			<div class="card-header d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold">{{ __('inventory.addresses') }}</h6>
				<div class="col-4 text-right">
					<button type="button" class="btn btn-sm btn-simple btn-success" OnClick="client_addaddress('{{$client->id}}')"><i class="far fa-address-book"></i></button>
				</div>
			</div>
			<div class="card-body" style="max-height:100%;overflow:auto;">
				<div class="table-responsive" id="clientAddressesTable">
					<table class="table">
						<thead>
							<tr>
								<th></th>
								<th>{{ __('inventory.zipcode') }}</th>
								<th>{{ __('inventory.country') }}</th>
								<th>{{ __('inventory.state') }}</th>
								<th>{{ __('inventory.city') }}</th>
								<th>{{ __('inventory.street') }}</th>
								<th>{{ __('inventory.address') }}</th>
								<th>{{ __('inventory.comment') }}</th>
							</tr>
						</thead>
						<tbody>
						@foreach($client->addresses as $address)
							<tr id="client_selected_address-{{ $address->id }}" class="pointer" OnClick="client_editaddress('{{$client->id}}','{{$address->id}}')">
								<td scope="row" class="default">@if($address->default == 1)<i class="far fa-check-square text-success"></i>@endif</td>
								<td scope="row" class="zipcode">{{ $address->zipcode }}</td>
								<td scope="row" class="country">{{ $address->country }}</td>
								<td scope="row" class="state">{{ $address->state }}</td>
								<td scope="row" class="city">{{ $address->city }}</td>
								<td scope="row" class="street">{{ $address->street }}</td>
								<td scope="row" class="address">{{ $address->address }} / {{ $address->apartment }} </td>
								<td scope="row" class="comment">{{ $address->comment }}</td>
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
@if($client)
<div class="row">
	<div class="col-3"><!--autos-->
		<div class="card" style="height:512px;position:relative;">
			<div class="card-header d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold">{{ __('inventory.add_auto') }}</h6>
			</div>
			<div class="card-body" style="max-height:100%;overflow:auto;">
				<div class='row'>
					<div class='col-12'>
						<div class="form-group">
							<div class="vehicle-form__item vehicle-form__item--select">
								<select name="group" aria-label="{{ __('inventory.vehiclegroup') }}" id="#group" tabindex="-1" class="form-select group" aria-hidden="true">
									<option value="none">{{ __('inventory.selectgroup') }}</option>
									@foreach($cataloggroups as $group)
									<option value="{{$group->name}}">{{$group->description}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-12'>
						<div class="form-group">
							<div class="vehicle-form__item vehicle-form__item--select">
								<select name="manufacturer" aria-label="{{ __('inventory.vehiclebrand') }}" id="#manufacturers" class="form-select manufacturers">
									<option value="none">{{ __('inventory.selectbrand') }}</option>	
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-12'>
						<div class="form-group">
							<div class="vehicle-form__item vehicle-form__item--select">
								<select name="model" aria-label="{{ __('inventory.vehiclemodel') }}" id="#model" class="form-select model">
									<option value="none">{{ __('inventory.selectmodel') }}</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-12'>
						<div class="form-group">
							<div class="vehicle-form__item vehicle-form__item--select">
								<select name="modification" aria-label="{{ __('inventory.vehicleengine') }}" id="#modification" class="form-select modification">
									<option value="none">{{ __('inventory.selectengine') }}</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-12'>
						<div class="form-group">
							<div class="vehicle-form__item vehicle-form__item--select">
								<select name="color" aria-label="{{ __('inventory.vehiclecolor') }}" id="#colors" tabindex="-1" class="form-select colors" aria-hidden="true">
									<option value="none">{{ __('inventory.selectcolor') }}</option>
									@foreach($colors as $color)
									<option value="{{$color['name']}}">{{$color['name']}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-6'>
						<div class="form-group">
							<div class="vehicle-form__item">
								<input type="text" name="plate" class="form-control plate" placeholder="{{ __('inventory.plate') }}" aria-label="{{ __('inventory.plate') }}">
							</div>
						</div>
					</div>
					<div class='col-6'>
						<div class="form-group">
							<div class="vehicle-form__item">
								<input type="text" name="year" class="form-control year" placeholder="{{ __('inventory.enteryear') }}" aria-label="{{ __('inventory.year') }}">
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-12'>
						<div class="form-group">
							<div class="vehicle-form__item">
								<input type="text" name="vin" class="form-control vin" placeholder="{{ __('inventory.entervin') }}" aria-label="{{ __('inventory.vinnumber') }}">
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-12'>
						<button type="button" class="btn btn-sm btn-simple btn-success" OnClick="client_addauto('{{$client->id}}')">Add auto</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-9">
		<div class="card" style="height:512px;position:relative;">
			<div class="card-header d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold">{{ __('inventory.autos') }}</h6>
			</div>
			<div class="card-body" style="max-height:100%;overflow:auto;">
				<div class="table-responsive">
					<table class="table" style="width: 100%">
						<thead>
							
							<tr>
								<th>{{ __('inventory.model') }}</br>{{ __('inventory.modification') }}</th>
								<th>{{ __('inventory.auto') }}</th>
								<th style="width: 5%">{{ __('inventory.year') }}</th>
								<th style="width: 5%"></th>
								<th style="width: 5%"></th>
								<th style="width: 5%"></th>
								<th style="width: 5%"></th>
							</tr>
						</thead>
						<tbody>
						@foreach($client->automobiles as $auto)
							<tr>
								<td>{{ $auto->model_id }}</br>{{ $auto->modification_id }}</td>
								<td>
									<b>{{ $auto->name }}</b></br>{{ $auto->vin }}
								</td>
								<td>{{ $auto->year }}</td>
								<td class="td-actions">
									<a href="{{ route('client_autos.show', $auto->id) }}" class="btn btn-simple btn-sm btn-service-parts">
										<i class='fa fa-cogs'></i>
									</a>
								</td>
								<td>
									<form method="post" action="{{ route('admincarts.store') }}">
										@csrf
										<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
										<input type="hidden" name="client_id" value="{{ $client->id }}">
										<input type="hidden" name="client_auto_id" value="{{ $auto->id }}">
										<input type="hidden" name="warehouse_id" value="{{ auth()->user()->default_warehouse_id }}">
										<input type="hidden" name="currency" value="{{ auth()->user()->default_currency }}">
										<button type="submit" class="btn btn-simple btn-sm btn-selector"><i class="fas fa-cart-plus"></i></button>
									</form>
								</td>
								<td class="td-actions">
									<a href="{{ route('client_autos.edit', $auto->id) }}" class="btn btn-sm btn-simple btn-selector" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
										<i class="fas fa-edit"></i>
									</a>
								</td>

								<td class="td-actions">
									<button type="button" class="btn btn-simple btn-sm btn-delete" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" OnClick="client_delete_auto('{{$client->id}}','{{$auto->id}}')">
										<i class="fas fa-times"></i>
									</button>
								</td>
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
@push('js')
<script defer>
document.addEventListener("DOMContentLoaded", () => 
{
	$('[name="group"]').on("change", function(e)
	{
		$.ajax({
			url: '/finder/groups',
			type: 'POST',
			dataType: 'json',
			data: { group: $('[name="group"]').val()},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				$('[name="manufacturer"]').html('');
				var html="";
				html += '<option value="none">Select '+$('[name="group"]').val()+' brand</option>';
				for(var i = 0; i < data.length; i++)
				{
					html += '<option value="'+data[i].id+'">'+data[i].manufacturer+'</option>';
				}
				$('[name="manufacturer"]').append(html)
			},
			error: function(xhr, textStatus, thrownError)
			{
				alert(xhr.status);
				alert(thrownError);
			}
		});
	});
	$('[name="manufacturer"]').on("change", function(e)
	{
		$.ajax({
			url: '/finder/models',
			type: 'POST',
			dataType: 'json',
			data: {group: $('[name="group"]').val(), manufacturer_id: $('[name="manufacturer"]').val()},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				$('[name="model"]').html('');
				var html="";
				html += '<option value="none">Select model</option>';
				for(var i = 0; i < data.length; i++)
				{
					html += '<option value="'+data[i].id+'">'+data[i].model+'</option>';
				}
				$('[name="model"]').append(html)
			},
			error: function(xhr, textStatus, thrownError)
			{
				alert(xhr.status);
				alert(thrownError);
			}
		});
	});
	$('[name="model"]').on("change", function(e)
	{
		$.ajax({
			url: '/finder/modifications',
			type: 'POST',
			dataType: 'json',
			data: {group: $('[name="group"]').val(), manufacturer_id: $('[name="manufacturer"]').val(), model_id: $('[name="model"]').val()},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				$('[name="modification"]').html('');
				var html="";
				html += '<option value="none">Select Engine</option>';
				for(var i = 0; i < data.length; i++)
				{
					html += '<option value="'+data[i].id+'">'+data[i].id+'-'+data[i].modification+'</option>';
				}
				$('[name="modification"]').append(html)
			},
			error: function(xhr, textStatus, thrownError)
			{
				alert(xhr.status);
				alert(thrownError);
			}
		});
	});
});
</script>
@endpush
