@extends('inventory.layouts.app', ['page' => 'Manage Receipt', 'pageSlug' => 'receipts', 'section' => 'documents', 'search' => 'receipts'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-md-12">
        <div class="card" style="height:384px;position:relative;">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">{{ __('inventory.to_provider_ordered_products') }}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('receipts.show', ['receipt' => $receipt]) }}" class="btn btn-sm btn-simple btn-sm text-success"><i class="fas fa-arrow-left"></i></a>
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
                            @foreach ($unfinished_to_provider_orders as $item)
                            <tr id="to_receipt_selected_product-{{ $item->product_id }}" class="pointer" onclick="add_to_provider_ordered_product('{{ $receipt->id }}','{{$item->doc_id}}','{{ $item->product_id }}');">
                                <td scope="col" class="article">
                                    {{ $item->product->article }}
                                </td>
                                <td scope="col" class="brand">
                                    {{ $item->product->brand }}
                                </td>
                                <td scope="col" class="name">
                                    {{ $item->product->name }}
                                    @if($item->doc_id)<br><span class="text-muted">{{ __('inventory.to_provider_order') }} №{{ $item->doc_id }}</span>@endif
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
            @include('inventory.receipts.products_table')
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
function add_to_provider_ordered_product(receipt_id, to_provider_order_id, product_id)
{
	$.ajax({
		url: '/add_to_provider_ordered_product',
        data: {receipt_id:receipt_id, to_provider_order_id:to_provider_order_id, product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'PUT',
        dataType: 'json',
        success: response => {
            if (response.status == 1)
            {
                $('#selectedProductsTable tbody').append(`
                    <tr id="client_to_provider_order_selected_product-${response.info.product_id}" class="pointer">
                        <td scope="row">${response.info.article}</td>
                        <td scope="row">${response.info.brand}</td>
                        <td scope="row">${response.info.name}<br><span class="text-muted"> @lang('inventory.client_order') №${response.info.to_provider_order_id}</span></td>
						<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
						<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
                        <td class="td-actions">
                            <button type="button" rel="tooltip" data-placement="top" title="" onclick="delete_client_ordered_product('${response.info.to_provider_order_id}','${response.info.client_order_id}','${response.info.product_id}');" class="btn btn-primary btn-link text-danger" data-original-title="Remove item">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
                `)
            }
        }
	});
};

function delete_client_ordered_product(to_provider_order_id, client_order_id, product_id)
{
	$.ajax({
		url: '/delete_client_ordered_product',
        data: {to_provider_order_id:to_provider_order_id,client_order_id:client_order_id, product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'DELETE',
        dataType: 'json',
        success: response => {
            if (response.status == 1)
            {
                $(`#selectedProductsTable tbody #client_to_provider_order_selected_product-${response.info.product_id}`).remove()
            }
        }
	});
};
</script>
@endpush