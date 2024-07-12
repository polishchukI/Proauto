@extends('inventory.layouts.app', ['page' => __('inventory.to_provider_order_manage'), 'pageSlug' => 'to_provider_orders', 'section' => 'documents', 'search' => 'to_provider_orders'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{ __('inventory.to_provider_order') }} №{{ $to_provider_order->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($to_provider_order->created_at)) }}
                            @if (!$to_provider_order->finalized_at)
                                <span class="text-danger"><i class="far fa-minus-square"></i></span>
                            @else
                                <span class="text-success"><i class="far fa-check-square"></i></span>
                            @endif
                        </h4>
                    </div>
                    <!--  -->
                    <div class="col-6">
                        <div class="row text-right">
                            <!--finalize-->
                            <div class="col-1">
                                <button type="button" class="btn btn-success btn-simple btn-sm @if($to_provider_order->finalized_at) disabled @endif" onclick="confirm('ATTENTION: At the end of this to_provider_order you will not be able to load more products in it.') ? window.location.replace('{{ route('to_provider_orders.finalize', $to_provider_order) }}') : ''">
                                    <i class="fas fa-handshake"></i>
                                </button>
                            </div>
                            <!--pay-->
                            <div class="col-1">
                                <form action="{{ route('to_provider_orders.pay', $to_provider_order) }}" method="get" class="d-inline">
                                    <button type="submit" class="btn btn-pay btn-simple btn-sm disabled" data-toggle="tooltip" title="{{ __('inventory.pay') }}"><i class="fas fa-dollar-sign"></i></button>
                                </form>
                            </div>
                            <!--to provider-->
                            <div class="col-1">
                                <button type="button" class="btn btn-simple btn-sm @if(!$to_provider_order->finalized_at) disabled @endif" OnClick="to_provider_order_receipt('{{$to_provider_order->id}}')"><i class="fas fa-receipt"></i></button>
                            </div>
                            <!--print-->
                            <div class="col-1">
                                <form action="{{ route('to_provider_orders.print', $to_provider_order) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-print btn-simple btn-sm" data-toggle="tooltip" title="{{ __('inventory.print') }}"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            <!--unfinalize-->
                            @if(strcasecmp(auth()->user()->unfinalize, "on") == 0)
                            <div class="col-1">
                                <form action="{{ route('to_provider_orders.unfinalize', $to_provider_order) }}" method="get" class="d-inline">
                                    <button type="submit" class="btn btn-simple btn-sm @if(!$to_provider_order->finalized_at) disabled @endif" data-toggle="tooltip" title="Unfinalize Order" onclick="confirm('ATTENTION: This action will unfinalize the order, be sure you know what are you doing!') ? window.location.replace('{{ route('to_provider_orders.unfinalize', $to_provider_order) }}') : ''">
                                    <i class="fas fa-unlock-alt"></i></button>
                                </form>
                            </div>
                            @endif
                            <!--delete-->
                            <div class="col-1">
                                <form action="{{ route('to_provider_orders.destroy', ['to_provider_order' => $to_provider_order]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-delete btn-simple btn-sm @if ($to_provider_order->total_quantity != 0) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.delete') }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>
                            <!--index-->
                            <div class="col-1"></div>
                            <!--index-->
                            <div class="col-1"></div>
                            <!--index-->
                            <div class="col-1"></div>
                            <!--index-->
                            <div class="col-1"></div>
                            <!--index-->
                            <div class="col-1"></div>
                            <!--index-->
                            <div class="col-1">
                                <a class="btn btn-back btn-simple btn-sm" href="{{ route('to_provider_orders.index') }}" data-toggle="tooltip" title="Back to list"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row"><input type="hidden" id="is_finalized" name="is_finalized" value="{{ $to_provider_order->finalized_at }}"></div>
                            <div class="row">
                                <div class="col-md-3">{{ __('inventory.warehouse') }}</div><div class="col-md-9">{{ $to_provider_order->warehouse->name }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">{{ __('inventory.user') }}</div><div class="col-md-9">{{ $to_provider_order->user->name }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">{{ __('inventory.provider') }}</div><div class="col-md-9"><a href="{{ route('providers.show', $to_provider_order->provider) }}">{{ $to_provider_order->provider->name }}</a></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if($to_provider_order->reference_type == "client_order")
                            <div class="row text-success">
                                <div class="col-md-3">{{ __('inventory.reference_doc') }}</div>
                                <div class="col-md-9">
                                    <a href="{{ route('client_orders.show', $to_provider_order->reference_id) }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        {{ __('inventory.client_order') }} №{{ $to_provider_order->reference_id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($to_provider_order->created_at)) }}
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- products -->
<div class="row">
    <div class="col-12">
        <div class="card" style="height:500px;position:relative;">
            <div class="card-header">
                <div class="row">
                    <div class="col-2">
                        <h4 class="card-title">{{ __('inventory.products') }}</h4>
                    </div>
                    <div class="col-4">
                        <ul class="nav nav-pills nav-pills-primary nav-pills-icons">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#products">{{ __('inventory.products') }}</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#clientOrderedProducts">{{ __('inventory.clientOrderedProducts') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <div class="row text-right">
                        <div class="col-1">
                                <button type="button" class="btn btn-simple btn-sm btn-selector @if($to_provider_order->finalized_at) disabled @endif" data-toggle="modal" data-target="#singleProduct"><i class="fas fa-level-down-alt"></i></button>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-selector btn-simple btn-sm @if($to_provider_order->finalized_at) disabled @endif" href="{{ route('to_provider_orders.product.selector', $to_provider_order) }}" data-toggle="tooltip" title="{{ __('inventory.product_selector') }}"><i class="fas fa-list-ul"></i></a>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-selector btn-simple btn-sm @if($to_provider_order->finalized_at) disabled @endif" href="{{ route('to_provider_orders.client.ordered.product.selector', $to_provider_order) }}" data-toggle="tooltip" title="Product selector"><i class="fas fa-file-download"></i></a>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-delete btn-simple btn-sm @if($to_provider_order->finalized_at) disabled @endif" href="{{ route('to_provider_orders.product.clear', $to_provider_order) }}" data-toggle="tooltip" title="{{ __('inventory.clear_table') }}"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="tab-content tab-space">
                    <!-- products -->
                    <div class="tab-pane active" id="products">
                        <div class="table-full-width table-responsive" id="selectedProductsTable">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
                                    <th scope="col" style="width: 15%;">{{ __('inventory.brand') }}</th>
                                    <th scope="col" style="width: 35%;">{{ __('inventory.product') }}</th>
                                    <th scope="col text-center" style="width: 5%;">{{ __('inventory.stock') }}</th>
                                    <th scope="col text-center" style="width: 5%;">{{ __('inventory.quantity') }}</th>
                                    <th scope="col text-center" style="width: 10%;">{{ __('inventory.price') }}</th>
                                    <th scope="col text-center" style="width: 10%;">{{ __('inventory.total') }}</th>
                                    <th scope="col text-center" style="width:5%;">{{ __('inventory.client_ordered') }}</th>
                                </thead>
                                <tbody>
                                @foreach ($to_provider_order->products as $item)
                                    <tr id="to_provider_order_selected_product-{{ $item->product_id }}" class="pointer" ondblclick="to_provider_order_edit_product('{{$to_provider_order->id}}','{{ $item->product_id }}');">
                                        <td scope="col" class="article">{{ $item->product->article }}</td>
                                        <td scope="col" class="brand">{{ $item->product->brand }}</td>
                                        <td scope="col" class="name">{{ $item->product->name }}</td>
                                        <td scope="col" class="text-center stock">{{ $item->product->stocks()->sum('quantity') ?? 0}}</td>
                                        <td scope="col" class="text-center quantity">{{ $item->quantity }}</td>
                                        <td scope="col" class="text-center price">{{ $item->price }}</td>
                                        <td scope="col" class="text-center total_amount">{{ $item->total_amount }}</td>
                                        <td scope="col" class="text-center client_ordered">
                                            @if ($item->client_ordered)
                                            <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- client Ordered Products -->
                    <div class="tab-pane" id="clientOrderedProducts">
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
                                        <td scope="col" class="article">{{ $item->product->article }}</td>
                                        <td scope="col" class="brand">{{ $item->product->brand }}</td>
                                        <td scope="col" class="name">{{ $item->product->name }}</td>
                                        <td scope="col" class="client_order">{{ __('inventory.client_order') }} №{{ $item->client_order_id }}</td>
                                        <td scope="col" class="quantity">{{ $item->quantity }}</td>
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
    </div>
</div>
<!-- document footer -->
<div class="row text-info">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-md-3"><b>{{ __('inventory.comment') }}</b></div>
                            <div class="col-md-9">{{ $to_provider_order->comment }}</div>
                        </div>
                        <div class="row">
                        @if($to_provider_order->provider->comment)
                            <div class="col-md-3"><b>{{ __('inventory.providerComment') }}</b></div>
                            <div class="col-md-9">{{ $to_provider_order->provider->comment }}</div>
                        @endif
                        </div>                        
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.products') }} / {{ __('inventory.total_quantity') }}</b></div>
                            <div class="col-3"><span name="docCount">{{ number_format($to_provider_order->docCount ?? 0, 2)  }}</span> / <span name="docQuantity">{{ number_format($to_provider_order->docQuantity ?? 0, 2) }}</span></div>
                        </div>
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.total_cost') }}</b></div>
                            <div class="col-3"><span name="docTotal">{{ number_format($to_provider_order->docTotal ?? 0, 2) }}</span> ({{ $to_provider_order->currency }})</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <Modal> -->
<div class="modal modal-black fade show" id="singleProduct" tabindex="-1" role="dialog" aria-labelledby="singleProductLabel" aria-hidden="true">
    <form id="to_provider_order-form-single-product-add" method="POST" action="{{ route('to_provider_orders.add.single.product.store') }}" style="width:100%;">
        <div class="addproduct modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('modal.add_single_product') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" name="to_provider_order_id" value="{{ $to_provider_order->id }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group{{ $errors->has('productLive') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="productLive">{{ __('modal.products') }}</label>
                                <select name="productLive" id="productLive">
                                    <option value="">{{ __('modal.not_specified') }}</option>
                                </select>
                                @include('inventory.alerts.feedback', ['field' => 'product'])
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="quantity" class="col-form-label">{{ __('modal.quantity') }}:</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="1">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="price" class="col-form-label">{{ __('modal.price') }}:</label>
                                <input type="number" class="form-control" id="price" name="price">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="to_provider_order-single-product-add" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
                    <button type="button" class="btn btn-sm btn-simple btn-secondary" data-dismiss="modal">{{ __('modal.close') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- <Modal> -->
@endsection

@push('js')
<script defer>
document.addEventListener("DOMContentLoaded", () => 
{
    const productLive = new SlimSelect({
        select: '#productLive',
        placeholder: '{{ __('inventory.search_product') }}',
        searchingText: '{{ __('inventory.search') }}',
        ajax(search, callback) {
            if (search.length < 3)
            {
                callback('Need 3 characters')
                return
            }

            fetch('/productLiveSearch', {
                method: 'POST',
                // data: {productLive:productLive},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    productLive:search,
                }),
            })
            
            .then(function (response) {
                return response.json()
            })
            .then(function(json)
            {
                let data = []
                for(let i = 0; i < json.length; i++)
                {
                    data.push({value: json[i].id, text: json[i].full_name})
                }

                callback(data)
            })
            .catch(function(error)
            {
                callback(false)
            })
        }
    })
    
});
</script>
@endpush
