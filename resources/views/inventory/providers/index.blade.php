@extends('inventory.layouts.app', ['page' => __('inventory.providers'), 'pageSlug' => 'providers', 'section' => 'contragents', 'search' => 'providers'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
	<div class="col-md-12">
		<div class="card ">
			<div class="card-header">
				<div class="row">
					<div class="col-8">
						<h4 class="card-title">{{__('inventory.providers')}}</h4>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('providers.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="">
					<table class="table tablesorter" id="dataTable" width="100%" cellspacing="0">
						<thead class=" text-primary">
							<th scope="col">{{__('inventory.provider_name')}}</th>
							<th scope="col">{{__('inventory.provider_code')}}</th>
							<th scope="col">{{__('inventory.price_engine')}}</th>
							<th scope="col">{{__('inventory.price_quantity')}}</th>
							<th scope="col">{{__('inventory.import_price')}}</th>                                
							<th scope="col">{{__('inventory.delete_prices')}}</th>
							<th scope="col">{{__('inventory.balance')}}</th>
							<th scope="col"></th>
							<th scope="col"></th>
						</thead>
						<tbody>
							@foreach ($providers as $provider)
								<tr>
									<td>
										<a href="{{ route('providers.show', $provider) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
										{{ $provider->name }}
										</a>
									</td>
									<td>{{ $provider->provider_code }}</td>
									<td>{{ $provider->hasprice }}</td>
									<td>{{ $provider->supplierprices->count() }}</td>
									<td>
									@if($provider->hasprice =="Price")
										<button class="btn btn-simple btn-sm btn-selector" title="Import Price" OnClick="import_price('{{$provider->provider_code}}')">
											<i class="fas fa-file-import"></i>
										</button>
										@endif
									</td>
									
									<td>
										<button class="btn btn-simple btn-sm btn-delete" title="{{ __('inventory.delete_prices') }}" OnClick="delete_prices('{{$provider->provider_code}}')">
											<i class="fas fa-eraser"></i>
										</button>
									</td>
									{{-- <td><a href="mailto:{{ $provider->email }}">{{ $provider->email }}</a></td>
									<td>{{ $provider->phone }}</td> --}}
									<td>
										@if(($provider->receipts->sum('total_amount') + $provider->service_receipts->sum('total_amount') - $provider->returns_to_provider->sum('total_amount') + $provider->transactions->sum('amount')) == 0)
										<span><i class="fas fa-dollar-sign">0</i></span>										
										@elseif(($provider->receipts->sum('total_amount') + $provider->service_receipts->sum('total_amount') - $provider->returns_to_provider->sum('total_amount') + $provider->transactions->sum('amount')) != 0)
										@if (($provider->receipts->sum('total_amount') + $provider->service_receipts->sum('total_amount') - $provider->returns_to_provider->sum('total_amount') + $provider->transactions->sum('amount')) > 0)
										<span class="text-success"><i class="fas fa-dollar-sign">
											{{$provider->receipts->sum('total_amount') + $provider->service_receipts->sum('total_amount') - $provider->returns_to_provider->sum('total_amount') + $provider->transactions->sum('amount')}}
										</i></span>
										@else
										<span class="text-danger"><i class="fas fa-dollar-sign">
										{{$provider->receipts->sum('total_amount') + $provider->service_receipts->sum('total_amount') - $provider->returns_to_provider->sum('total_amount') + $provider->transactions->sum('amount')}}
										</i></span>
										@endif
										@endif
									</td>
									<td class="td-actions">
										<a href="{{ route('providers.edit', $provider) }}" class="btn btn-simple btn-sm btn-selector" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
											<i class="fas fa-edit"></i>
										</a>
									</td>
									<td class="td-actions">											
										<form action="{{ route('providers.destroy', $provider) }}" method="post" class="d-inline">
											@csrf
											@method('delete')
											<button type="button" class="btn btn-simple btn-sm btn-delete" data-toggle="tooltip" data-placement="bottom" title="Delete Provider" onclick="confirm('Are you sure you want to delete this provider? Records of payments made to him will not be deleted.') ? this.parentElement.submit() : ''">
												<i class="fas fa-times"></i>
											</button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer py-4">
				<nav class="d-flex justify-content-end" aria-label="...">
					{{ $providers->links() }}
				</nav>
			</div>
		</div>
	</div>
</div>
@include('inventory.providers.progress_bar')
@endsection
@push('js')
<script defer>
	function import_price(provider_code)
	{
		const modal = $('#modaledit');
		$.ajax({
			url: '/providers/import_price',
			type: 'POST',
			data: {provider_code:provider_code},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				modal.html(data);
				modal.find('.modaledit__close').on('click', function()
				{
					modal.modal('hide');
				});
				modal.modal('show');
			}
		});
	};
	/////////////////////
	function delete_prices(provider_code)
	{
		let route = '{{ route('providers.delete_prices') }}';
		$.ajax({
			url: route,
			type: 'POST',
			dataType: 'json',
			data: {provider_code: provider_code},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(flashmessage)
			{
				$('.flashmessage').html('');
				var html="";
				$.each(flashmessage,function(key,value)
				{
					html += "<tr><td>" + value + "</td></tr>";
				})
				$('.flashmessage').append(html)
			}
		});
	}

</script>
@endpush
