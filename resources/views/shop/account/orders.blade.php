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
							<h5>{{ __('account.orderhistory') }}</h5>
						</div>
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
												<td><a href="{{ route('account.order', $item["id"]) }}">{{$item["invoice"]}}</a></td>
												<td>{{$item["date"]}}</td>
												<td>{{$item["status"]}}</td>
												<td>{{$item["total"]}}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="card-divider"></div>
						<div class="card-footer">
							<ul class="pagination">{{$orders->links()}}</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop