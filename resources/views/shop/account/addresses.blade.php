@extends('shop.template')

@section('title', "Аккаунт посетителя - Адреса")

@section('description', "Аккаунт посетителя - Адреса")

@section('content')
<div class="site__body">
	<div class="block-space block-space--layout--after-header"></div>
	<div class="block">
		<div class="container container-xl">
			<div class="row">
				@include('shop.block.profileNav')
				<div class="col-12 col-lg-9 mt-4 mt-lg-0">
					<div class="addresses-list">
						<a href="{{ route('account.addresses.add') }}" class="addresses-list__item addresses-list__item--new">
							<div class="addresses-list__plus"></div>
							<div class="btn btn-secondary btn-sm">{{ __('account.addnew') }}</div>
						</a>
						<div class="addresses-list__divider"></div>
						@foreach($addresses as $item)						
						<div class="addresses-list__item card address-card">
							@if(0<$item["default"])
							<div class="address-card__badge tag-badge tag-badge--theme">{{ __('account.default') }}</div>
							@endif
							<div class="address-card__body">
								<div class="address-card__name">{{$item["name"]}}</div>
								<div class="address-card__row">
									<div class="address-card__row-title">{{ __('account.country') }}</div>
									<div class="address-card__row-content">{{$item["country"]}}</div>
								</div>
								<div class="address-card__row">
									<div class="address-card__row-title">{{ __('account.zipcode') }}</div>
									<div class="address-card__row-content">{{$item["zipcode"]}}</div>
								</div>
								<div class="address-card__row">
									<div class="address-card__row-title">{{ __('account.city') }}</div>
									<div class="address-card__row-content">{{$item["city"]}}</div>
								</div>
								<div class="address-card__row">
									<div class="address-card__row-title">{{ __('account.address') }}</div>
									<div class="address-card__row-content">{{$item["street"]}}, {{$item["address"]}}</div>
								</div>
								<div class="address-card__footer">
									<a href="{{ url('/account/addresses/' . $item['id'] . '/edit') }}" title="{{ __('account.editaddress') }}">
										<button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></button>
									</a>
									<button class="btn btn-secondary btn-xs" onClick="deleteaddress('{{$item["id"]}}')">{{ __('account.addnew') }}</button>
								</div>
							</div>
						</div>
						<div class="addresses-list__divider"></div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop