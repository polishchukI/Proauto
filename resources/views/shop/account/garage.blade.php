@extends('shop.template')

@section('content')
<div class="site__body">
	<div class="block-space block-space--layout--after-header"></div>
		<div class="block">
			<div class="container container-xl">
				<div class="row">
					@include('shop.block.profileNav')
					<div class="col-12 col-lg-9 mt-4 mt-lg-0">
						<div class="card">
							<div class="card-header">
								<h5>{{ __('account.garage') }}</h5>
							</div>
							<div class="card-divider"></div>
						<div class="card-body card-body--padding--2">
							<div class="vehicles-list vehicles-list--layout--account">
								<div class="vehicles-list__body">
								@foreach($garage as $item)
									<div class="vehicles-list__item">
										<div class="vehicles-list__item-info">
											<div class="vehicles-list__item-name">{{$item["name"]}}</div>
											<div class="vehicles-list__item-details">{{$item["details"]}}</div>
											<div class="vehicles-list__item-details" style="text-transform: uppercase;">VIN: {{$item["vin"]}}</div>
											<div class="vehicles-list__item-links"><a href="{{$item["url"]}}" target="_blank">{{ __('account.showparts') }}</a></div>
										</div>
										<button type="button" onclick="deletegarage('{{$item["vin"]}}')" class="vehicles-list__item-remove">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
												<path d="M2,4V2h3V1h6v1h3v2H2z M13,13c0,1.1-0.9,2-2,2H5c-1.1,0-2-0.9-2-2V5h10V13z"/>
											</svg>
										</button>
									</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="card-divider"></div>
						<div class="card-header"><h5>{{ __('account.addavehicle') }}</h5></div>
						<div class="card-divider"></div>
						<!---->
						<div class="card-body card-body--padding--2">
							<div class="vehicle-form vehicle-form--layout--account">
								<div class="vehicle-form__item vehicle-form__item--select">
									<select name="group" aria-label="{{ __('account.vehicleyear') }}" data-select2-id="#groups" tabindex="-1" class="form-control form-control-select2" aria-hidden="true">
										<option value="none">{{ __('account.selectgroup') }}</option>
										@foreach($groups as $group)
										<option value="{{$group['group']}}">{{$group['group_name']}}</option>
										@endforeach
									</select>
								</div>
								<div class="vehicle-form__item vehicle-form__item--select">
									<select name="manufacturer" aria-label="{{ __('account.vehiclebrand') }}" data-select2-id="#manufacturers" class="form-control form-control-select2" disabled="disabled">
										<option value="none">{{ __('account.selectbrand') }}</option>	
									</select>
								</div>
								<div class="vehicle-form__item vehicle-form__item--select">
									<select name="model" class="form-control form-control-select2" aria-label="{{ __('account.vehiclemodel') }}" disabled="disabled">
										<option value="none">{{ __('account.selectmodel') }}</option>

									</select>
								</div>
								<div class="vehicle-form__item vehicle-form__item--select">
									<select name="modification" aria-label="Vehicle Engine" class="form-control form-control-select2" aria-label="{{ __('account.vehicleengine') }}" disabled="disabled">
										<option value="none">{{ __('account.selectengine') }}</option>

									</select>
								</div>
								<div class="vehicle-form__divider">{{ __('account.and') }}</div>
								<div class="vehicle-form__item">
									<input type="text" name="vin" class="form-control vin" placeholder="{{ __('account.entervin') }}" aria-label="{{ __('account.vinnumber') }}">
								</div>
							</div>
							<div class="mt-4 pt-3">
								<button OnClick="addtogarage()" class="btn btn-sm btn-primary">{{ __('account.addavehicle') }}</button>
							</div>
						</div>
						<!---->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop