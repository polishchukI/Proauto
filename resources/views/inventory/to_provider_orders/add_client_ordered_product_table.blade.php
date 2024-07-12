@extends('inventory.layouts.app', ['page' =>  __('inventory.add_client_ordered_product_table'), 'pageSlug' => 'to_provider_orders', 'section' => 'documents', 'search' => 'to_provider_orders'])

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
                        <input type="hidden" id="to_provider_order_id" name="to_provider_order_id" value="{{ $to_provider_order->id }}">
                    </div>
                    <div class="col-6  text-right">
                        <div class="row">
                            <div class="col-1">
                                <button type="button" class="btn btn-success btn-simple btn-sm" onclick="confirm('ATTENTION: At the end of this to_provider_order you will not be able to load more products in it.') ? window.location.replace('{{ route('to_provider_orders.finalize_selection_client_ordered_products', $to_provider_order) }}') : ''">
                                    <i class="fas fa-handshake"></i>
                                </button>
                            </div>
                            <div class="col-1">
                                <a href="{{ route('to_provider_orders.show', ['to_provider_order' => $to_provider_order]) }}" class="btn btn-sm btn-simple text-success"><i class="fas fa-arrow-left"></i></a>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-delete btn-simple btn-sm" onclick="confirm('ATTENTION: This action will canсel selection of client ordered products and reset selection table. Do you wish to continue?') ? window.location.replace('{{ route('to_provider_orders.cancel_selection_client_ordered_products', $to_provider_order) }}') : ''">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive" id="unfinishedClientOrderedProductsTable">
                    <table class="table">
                        <thead class=" text-primary">
                            <th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.brand') }}</th>
                            <th scope="col" style="width: 25%;">{{ __('inventory.product') }}</th>
                            <th scope="col" style="width: 25%;">{{ __('inventory.client_order') }}</th>
                            <th scope="col" style="width: 10%;">{{ __('inventory.quantity') }}</th>
                            <th scope="col" style="width: 10%;">{{ __('inventory.order') }}</th>
                        </thead>
                        <tbody>
                        @foreach ($unfinished_client_orders as $item)
                            <tr id="unfinished_client_order_product-{{ $item->product_id }}" class="pointer">
                                <td scope="col" class="article">
                                    {{ $item->product->article }}
                                </td>
                                <td scope="col" class="brand">
                                    {{ $item->product->brand }}
                                </td>
                                <td scope="col" class="name">
                                    {{ $item->product->name }}
                                </td>
                                <td scope="col" class="client_order">
                                    {{ __('inventory.client_order') }} №{{ $item->doc_id }}
                                </td>
                                <td scope="col" class="text-quantity">
                                    {{ $item->quantity }}
                                </td>
                                <td scope="col" class="order">
                                    <button type="button" rel="tooltip" data-placement="top" title="" onclick="add_client_ordered_product('{{ $to_provider_order->id }}','{{$item->doc_id}}','{{ $item->product_id }}');" class="btn btn-sm btn-simple text-success" data-original-title="Remove item">
                                    <i class="fas fa-check"></i>
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

<div class="row">
    <div class="col-md-12">
        <div class="card" style="height:384px;position:relative;">
            <!-- finalize selection of client ordered products -->
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{ __('inventory.selected_client_ordered_products') }}</h4>
                        <input type="hidden" id="to_provider_order_id" name="to_provider_order_id" value="{{ $to_provider_order->id }}">
                    </div>
                    <div class="col-6 text-right">
                        
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive" id="selectedProductsTable">
                    <table class="table">
                        <thead class=" text-primary">
                            <th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.brand') }}</th>
                            <th scope="col" style="width: 25%;">{{ __('inventory.product') }}</th>
                            <th scope="col" style="width: 25%;">{{ __('inventory.client_order') }}</th>
                            <th scope="col" style="width: 10%;">{{ __('inventory.quantity') }}</th>
                            <th scope="col" style="width: 10%;">{{ __('inventory.delete') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($to_provider_order->client_ordered_products as $item)
                            <tr id="client_to_provider_order_selected_product-{{ $item->product_id }}" class="pointer" >
                                <td scope="col" class="article">
                                    {{ $item->product->article }}
                                </td>
                                <td scope="col" class="brand">
                                    {{ $item->product->brand }}
                                </td>
                                <td scope="col" class="name">
                                    {{ $item->product->name }}
                                </td>
                                <td scope="col" class="client_order">
                                    {{ __('inventory.client_order') }} №{{ $item->client_order_id }}
                                </td>
                                <td scope="col" class="quantity">
                                    {{ $item->quantity }}
                                </td>
                                <td scope="col" class="delete">
                                    <button type="button" rel="tooltip" data-placement="top" title="" onclick="delete_client_to_provider_order_selected_product('{{$to_provider_order->id}}','{{$item->client_order_id}}','{{ $item->product_id }}');" class="btn btn-sm btn-simple text-danger" data-original-title="Remove item">
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
@endsection

@push('js')
<script>
function add_client_ordered_product(to_provider_order_id, client_order_id, product_id)
{
	$.ajax({
		url: '/add_client_ordered_product',
        data: {to_provider_order_id:to_provider_order_id,client_order_id:client_order_id, product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'PUT',
        dataType: 'json',
        success: response => {
            if (response.status == 1)
            {
                $('#selectedProductsTable tbody').append(`
                    <tr id="client_to_provider_order_selected_product-${response.info.product_id}" class="pointer">
                        <td scope="row">
                            ${response.info.article}
                        </td>
                        <td scope="row">
                            ${response.info.brand}
                        </td>
                        <td scope="row">
                            ${response.info.name}
                        </td>
                        <td scope="row">
                            ${response.info.client_order}
                        </td>
						<td scope="row" class="quantity">
							${parseFloat(response.info.quantity).toFixed(2)}
						</td>
                        <td class="td-actions">
                            <button type="button" rel="tooltip" data-placement="top" title="" onclick="delete_client_to_provider_order_selected_product('${response.info.to_provider_order_id}','${response.info.client_order_id}','${response.info.product_id}');" class="btn btn-sm btn-simple text-danger" data-original-title="Remove item">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
                `);
                $(`#unfinishedClientOrderedProductsTable tbody #unfinished_client_order_product-${response.info.product_id}`).remove();
            }
        }
	});
};

function delete_client_to_provider_order_selected_product(to_provider_order_id, client_order_id, product_id)
{
	$.ajax({
		url: '/delete_client_to_provider_order_selected_product',
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