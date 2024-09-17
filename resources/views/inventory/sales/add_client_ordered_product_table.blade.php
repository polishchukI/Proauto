@extends('inventory.layouts.app', ['page' =>  __('inventory.sale_add_client_ordered_product_table'), 'pageSlug' => 'sales', 'section' => 'documents', 'search' => 'sales'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-md-12">
        <div class="card" style="height:384px;position:relative;">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{ __('inventory.client_ordered_products') }}</h4>
                    </div>
                    <div class="col-2"><input type="hidden" id="sale_id" name="sale_id" value="{{ $sale->id }}"></div>
                    <div class="col-4 text-right">
                        <a href="{{ route('sales.show', ['sale' => $sale]) }}" class="btn btn-simple btn-sm btn-back"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.brand') }}</th>
                            <th scope="col" style="width: 40%;">{{ __('inventory.product') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.quantity') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.price') }}</th>
                        </thead>
                        <tbody>
                        @foreach ($unfinished_client_orders as $item)
                            <tr id="sale_selected_product-{{ $item->product_id }}" class="pointer" onclick="sale_add_client_ordered_product('{{ $sale->id }}','{{$item->doc_id}}','{{ $item->product_id }}');">
                                <td scope="col" class="article">
                                    {{ $item->product->article }}
                                </td>
                                <td scope="col" class="brand">
                                    {{ $item->product->brand }}
                                </td>
                                <td scope="col" class="name">
                                    {{ $item->product->name }}
                                    @if($item->doc_id)<br><span class="text-muted">{{ __('inventory.client_order') }} №{{ $item->doc_id }}</span>@endif
                                </td>
                                <td scope="col" class="text-center quantity">
                                    {{ $item->quantity }}
                                </td>
                                <td scope="col" class="text-center price">
                                    {{ $item->price }}
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

<div class="row">
    <div class="col-md-12">
        <div class="card" style="height:384px;position:relative;">
        @include('inventory.sales.products_table')
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
function sale_add_client_ordered_product(sale_id, client_order_id, product_id)
{
	$.ajax({
		url: '/sale_add_client_ordered_product',
        data: {sale_id:sale_id,client_order_id:client_order_id, product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'PUT',
        dataType: 'json',
        success: response => {
            if (response.status == 1)
            {
                $('#selectedProductsTable tbody').append(`
                    <tr id="sale_selected_product-${response.info.product_id}" class="pointer">
                        <td scope="row">
                            ${response.info.article}
                        </td>
                        <td scope="row">
                            ${response.info.brand}
                        </td>
                        <td scope="row">
                            ${response.info.name}
                            <br><span class="text-muted">@lang('inventory.client_order') №${response.info.client_order_id}</span>
                        </td>
						<td scope="row" class="text-center stock">
							${parseFloat(response.info.stock).toFixed(2)}
						</td>
						<td scope="row" class="text-center quantity">
							${parseFloat(response.info.quantity).toFixed(2)}
						</td>
						<td scope="row" class="text-center price">
							${parseFloat(response.info.price).toFixed(2)}
						</td>
                        <td class="td-actions">
                            <button type="button" rel="tooltip" data-placement="top" title="" onclick="delete_client_ordered_product('${response.info.sale_id}','${response.info.client_order_id}','${response.info.product_id}');" class="btn btn-primary btn-link text-danger" data-original-title="Remove item">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
                `)
            }
        }
	});
};

function delete_client_ordered_product(sale_id, client_order_id, product_id)
{
	$.ajax({
		url: '/delete_client_ordered_product',
        data: {sale_id:sale_id,client_order_id:client_order_id, product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'DELETE',
        dataType: 'json',
        success: response => {
            if (response.status == 1)
            {
                $(`#selectedProductsTable tbody #sale_selected_product-${response.info.product_id}`).remove()
            }
        }
	});
};
</script>
@endpush