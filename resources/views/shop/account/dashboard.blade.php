@extends('shop.template')

@section('content')
<div class="site__body">
	<div class="block-space block-space--layout--after-header"></div>
	<div class="block">
		<div class="container container-xl">
			<div class="row">
				@include('shop.block.profileNav')
				<div class="col-12 col-lg-9 mt-4 mt-lg-0">
					<div class="dashboard">
						<div class="dashboard__profile card profile-card">
							<div class="card-body profile-card__body">
								<div class="profile-card__avatar">
									<img src="{{ Auth::guard('clients')->user()->avatar }}" alt="{{ Auth::guard('clients')->user()->firstname }} {{ Auth::guard('clients')->user()->lastname }}">
								</div>
								<div class="profile-card__name">{{ Auth::guard('clients')->user()->firstname }} {{ Auth::guard('clients')->user()->lastname }}</div>
								<div class="profile-card__email">{{ Auth::guard('clients')->user()->email }}</div>
								<div class="profile-card__edit"><a href="{{ route('account.profile') }}" class="btn btn-secondary btn-sm">{{ __('account.editprofile') }}</a></div>
							</div>
						</div>
						<div class="dashboard__address card address-card address-card--featured">
							<div class="address-card__body">
								<!--div class="mt-3">
									<div class="address-card__row-title">{{ __('account.pricetype') }}</div>
									<div class="status-badge status-badge--style--warning status-badge--has-text">
										<div class="status-badge__body">
											<div class="status-badge__text">$price_type["price_type"] %</div>
											<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="" data-original-title=" $price_type["price_type"]  %"></div>
										</div>
									</div>
								</div-->
								<div class="mt-3">
									<div class="address-card__row-title">{{ __('account.pricediscount') }}</div>
									<div class="status-badge status-badge--style--success status-badge--has-text">
										<div class="status-badge__body">
											<div class="status-badge__text">{{ Auth::guard('clients')->user()->product_discount }} %</div>
											<div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="" data-original-title="{{ Auth::guard('clients')->user()->product_discount }} %"></div>
										</div>
									</div>
								</div>
								<div class="mt-3">
									<div class="address-card__row">
										<div class="address-card__row-title">{{ __('account.phonenumber') }}</div>
										<div class="address-card__row-content">{{ Auth::guard('clients')->user()->telephone }}</div>
									</div>
								</div>
								<div class="mt-3">
									<div class="address-card__row">
										<div class="address-card__row-title">{{ __('account.emailaddress') }}</div>
										<div class="address-card__row-content">{{ Auth::guard('clients')->user()->email }}</div>
									</div>
								</div>
							</div>
						</div>
						<div class="dashboard__orders card">
							<div class="card-header"><h5>{{ __('account.recentorders') }}</h5></div>
							<div class="card-divider"></div>
							<div class="card-table">
								<div class="table-responsive-sm">
									<table>
										<thead>
											<tr>
												<th>{{ __('account.order') }}</th>
												<th>{{ __('account.date') }}</th>
												<th>{{ __('account.status') }}</th>
												<th>{{ __('account.total') }}</th>
											</tr>
										</thead>
										<tbody>
										@foreach ($orders as $item)
											<tr>												
												<td><a href="{{ route('account.order', $item["id"]) }}">{{$item["invoice"]}}-{{$item["id"]}}</a></td>
												<td>{{$item["date"]}}</td>
												<td>{{$item["status"]}}</td>
												<td>{{$item["total"]}}</td>
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
</div>
@stop