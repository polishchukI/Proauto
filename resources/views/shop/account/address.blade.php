@extends('shop.template')

@section('content')
<div class="site__body">
	<div class="block-space block-space--layout--after-header"></div>
		<div class="block">
			<div class="container container-xl">
				<div class="row">
					@include('shop.block.profileNav')
					<div class="col-12 col-lg-9 mt-4 mt-lg-0">
					@if (!isset($edit))
						<form method="POST" action="{{ route ('account.addresses.store') }}">
					@else
						<form method="POST" action="{{ route ('account.addresses.update', $address["id"]) }}">
					@endif
					@csrf
						<div class="card">
							<div class="card-header"><h5>{{ __('account.editaddress') }}</h5></div>
							<div class="card-divider"></div>
							<div class="card-body card-body--padding--2">
								<div class="row no-gutters">
									<div class="col-12 col-lg-12 col-xl-12">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="address-country">{{ __('account.country') }}</label>
												<select id="address-country" name="country" class="form-control">
													<option value="">{{ __('account.countryselect') }}</option>
													<option value="Россия">Россия</option>
													<option value="Украина">Украина</option>
													<option value="Беларусь">Беларусь</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label for="address-street">{{ __('account.street') }}</label>
												@if(isset($address["street"]))
												<input type="text" class="form-control" id="address-street" name="street" value="{{$address["street"]}}" placeholder="House number and street name">
												@else
												<input type="text" class="form-control" id="address-street" name="street" value="" placeholder="House number and street name">
												@endif
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="address-state">{{ __('account.state') }}</label>
												@if(isset($address["state"]))
												<input type="text" class="form-control" id="address-state" name="state" value="{{$address["state"]}}" placeholder="Texas">
												@else
												<input type="text" class="form-control" id="address-state" name="state" value="" placeholder="Texas">
												@endif
											</div>
											<div class="form-group col-md-6">
												<label for="address-address">{{ __('account.address') }}</label>
												@if(isset($address["address"]))
												<input type="text" class="form-control" id="address-address" name="address" value="{{$address["address"]}}" placeholder="Apartment, suite, unit etc.">
												@else
												<input type="text" class="form-control" id="address-address" name="address" value="" placeholder="Apartment, suite, unit etc.">
												@endif
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="address-city">{{ __('account.city') }}</label>
												@if(isset($address["city"]))
												<input type="text" class="form-control" id="address-city" name="city" value="{{$address["city"]}}" placeholder="Houston">
												@else
												<input type="text" class="form-control" id="address-city" name="city" value="" placeholder="Houston">
												@endif
											</div>
											<div class="form-group col-md-6">
												<label for="address-apartment">{{ __('account.apartment') }}</label>
												@if(isset($address["apartment"]))
												<input type="text" class="form-control" id="address-apartment" name="apartment" value="{{$address["apartment"]}}" placeholder="Apartment, suite, unit etc.">
												@else
												<input type="text" class="form-control" id="address-apartment" name="apartment" value="" placeholder="Apartment, suite, unit etc.">
												@endif
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="address-postcode">{{ __('account.zipcode') }}</label>
												@if(isset($address["zipcode"]))
												<input type="text" class="form-control" id="address-postcode" name="postcode" value="{{$address["zipcode"]}}" placeholder="19720">
												@else
												<input type="text" class="form-control" id="address-postcode" name="postcode" value="" value="" placeholder="19720">
												@endif
											</div>
											<div class="form-group col-md-6"></div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-4">
												<div class="form-check">
													<span class="input-check form-check-input">
														<span class="input-check__body">
															<input class="input-check__input" type="checkbox" name="default" id="default" value="on" @if(isset($address["default"]) && $address["default"] == 1) checked @endif>
															<span class="input-check__box"></span>
															<span class="input-check__icon">
																<svg width="9px" height="7px">
																	<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
																</svg>
															</span>
														</span>
													</span>
													<label class="form-check-label" for="default-address">{{ __('account.setdefault') }}</label>
												</div>
											</div>
											<div class="form-group col-md-4">
												<div class="form-check">
													<span class="input-check form-check-input">
														<span class="input-check__body">
															<input class="input-check__input" type="checkbox" name="shipping" id="shipping" value="on" @if(isset($address["shipping"]) && $address["shipping"] == 1) checked @endif>
															<span class="input-check__box"></span>
															<span class="input-check__icon">
																<svg width="9px" height="7px">
																	<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
																</svg>
															</span>
														</span>
													</span>
													<label class="form-check-label" for="shipping-address">{{ __('account.setshipping') }}</label>
												</div>
											</div>
											<div class="form-group col-md-4">
												<div class="form-check">
													<span class="input-check form-check-input">
														<span class="input-check__body">
															<input class="input-check__input" type="checkbox" name="billing" id="billing" value="on" @if(isset($address["billing"]) && $address["billing"] == 1) checked @endif>
															<span class="input-check__box"></span>
															<span class="input-check__icon">
																<svg width="9px" height="7px">
																	<path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"></path>
																</svg>
															</span>
														</span>
													</span>
													<label class="form-check-label" for="billing-address">{{ __('account.setbilling') }}</label>
												</div>
											</div>
										</div>
										<div class="form-group mb-0 pt-3 mt-3">
											<button class="btn btn-primary" type="submit">{{ __('account.save') }}</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop