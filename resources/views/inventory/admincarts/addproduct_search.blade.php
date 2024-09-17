@extends('inventory.layouts.app', ['page' => __('inventory.admincart_product_search'), 'pageSlug' => 'admincarts', 'section' => 'documents', 'search' => 'admincarts'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-3">
        <div class="card" style="height:400px;position:relative;">
            <div class="card-header text-info">
                <div class="row">
                    <div class="col-10"><b>{{ __('inventory.product_search') }}</b></div>
                    <div class="col-1"><div id="admin_search_loader" class="search-ring hidden" style="width:15px;height:15px;"><img src="/images/admincart-search.gif"></div></div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8 mt-2">
                        <input type="hidden" id="admincart_id" name="admincart_id" value="{{ $admincart->id }}" />
                        <input type="search" id="admincart_product_search_input" name="admincart_product_search_input" class="form-control-sm" />
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn btn-simple btn-sm btn-selector" OnClick="admincart_search()"><i class="fas fa-search"></i></button>
                    </div>

                </div>
                <div class="form-check mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="catalog_search" id="catalog_search">
                        <span class="form-check-sign"></span>
                        {{ __('inventory.admincart_catalog_search') }}
                    </label>
                </div>

                <div class="form-check mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="ws_search" id="ws_search">
                        <span class="form-check-sign"></span>
                        {{ __('inventory.admincart_ws_search') }}
                    </label>
                </div>

                <div class="form-check mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="prices_search" id="prices_search">
                        <span class="form-check-sign"></span>
                        {{ __('inventory.admincart_prices_search') }}
                    </label>
                </div>

                <div class="form-check mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="oem_search" id="oem_search">
                        <span class="form-check-sign"></span>
                        {{ __('inventory.admincart_oem_search') }}
                    </label>
                </div>
                <!--  -->
                

            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="card" style="height:400px;position:relative;">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                    <div class="row">
                    <div class="col-2"><button type="button" class="btn btn-simple btn-sm btn-selector" OnClick="catalog_product_create('{{ $admincart->id }}')"><i class="far fa-plus-square"></i></button></div>

                    <div class="col-2">
                        <button type="button" class="btn btn-simple btn-sm btn-selector @if($admincart->finalized_at) disabled @endif" data-toggle="modal" data-target="#singleProduct"><i class="fas fa-level-down-alt"></i></button>
                    </div>
                </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-1">
                                <button type="button" class="btn btn-success btn-sm btn-simple @if($admincart->finalized_at) disabled @endif" onclick="confirm('{{ __('inventory.document_confirm_finalize') }}') ? window.location.replace('{{ route('admincarts.finalize', $admincart) }}') : ''">
                                    <i class="fas fa-handshake"></i>
                                </button>
                            </div>
                            <!--sale-->
                            <div class="col-1">
                                <form method="post" action="{{ route('sales.store') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="client_id" value="{{ $admincart->client_id }}">
                                    <input type="hidden" name="warehouse_id" value="{{ auth()->user()->default_warehouse_id }}">
                                    <input type="hidden" name="currency" value="{{ auth()->user()->default_currency }}">
                                    <input type="hidden" name="reference_id" value="{{ $admincart->id }}">
                                    <input type="hidden" name="reference_type" value="admincart">
                                    <button type="submit" title="{{ __('inventory.sale') }}" class="btn btn-simple btn-sm btn-sale @if(!$admincart->finalized_at) disabled @endif"><i class="fas fa-file-invoice"></i></button>
                                </form>
                            </div>
                            <!--client_order-->
                            <div class="col-1">
                                <form method="post" action="{{ route('client_orders.store') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="client_id" value="{{ $admincart->client_id }}">
                                    <input type="hidden" name="warehouse_id" value="{{ auth()->user()->default_warehouse_id }}">
                                    <input type="hidden" name="currency" value="{{ auth()->user()->default_currency }}">
                                    <input type="hidden" name="reference_id" value="{{ $admincart->id }}">
                                    <input type="hidden" name="reference_type" value="admincart">
                                    <button type="submit" title="{{ __('inventory.client_order') }}" class="btn btn-simple btn-sm btn-sale @if(!$admincart->finalized_at) disabled @endif"><i class="fas fa-file-download"></i></button>
                                </form>
                            </div>
                            <!--print-->
                            <div class="col-1">
                                <form action="{{ route('admincarts.print', $admincart) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-print" title="{{ __('inventory.print') }}"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            <div class="col-8 text-right">
                                <a href="{{ route('admincarts.show', ['admincart' => $admincart]) }}" class="btn btn-sm btn-simple btn-sm btn-back"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive">
                    <table class="table">
                        <thead>
                            <th scope="col" style="width: 10%;">{{ __('inventory.article') }}</th>
                            <th scope="col" style="width: 10%;">{{ __('inventory.brand') }}</th>
                            <th scope="col" style="width: 35%;">{{ __('inventory.product') }}</th>
                            <th scope="col" style="width: 10%;">{{ __('inventory.stock') }}</th>
                            <th scope="col" style="width: 10%;">{{ __('inventory.price') }}</th>
                            <th scope="col" style="width: 5%;">{{ __('inventory.info') }}</th>
                            <th scope="col" style="width: 5%;">{{ __('inventory.to_base') }}</th>
                            <th scope="col" style="width: 5%;">{{ __('inventory.to_cart') }}</th>
                        </thead>
                        <tbody name="searchTable"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <div class="card" style="height:350px;position:relative;">
            <div class="card-body text-info">
                <div class="row">
                    <div class="col-4">{{ __('inventory.client') }}</div>
                    <div class="col-8"><a href="{{ route('clients.show', $admincart->client) }}">{{ $admincart->client->name }}</a></div>
                </div>
                @if($admincart->client_auto_id)
                <div class="row">
                    <div class="col-4">{{ __('inventory.auto') }}</div><div class="col-8"><a href="{{ route('client_autos.show', $admincart->client_auto_id) }}">{{ $admincart->client_auto->name }}</a></div>
                </div>
                <div class="row">
                    <div class="col-4">{{ __('inventory.vin') }}</div><div class="col-8">{{ $admincart->client_auto->vin }}</div>
                </div>
                <div class="row">
                    <div class="col-4">{{ __('inventory.plate') }}</div><div class="col-8">{{ $admincart->client_auto->plate }}</div>
                </div>
                <div class="row">
                    <div class="col-4">{{ __('inventory.color') }}</div><div class="col-8">{{ $admincart->client_auto->color }}</div>
                </div>
                <div class="row">
                    <div class="col-4">{{ __('inventory.year') }}</div><div class="col-8">{{ $admincart->client_auto->year }}</div>
                </div>
                @endif
                <div class="row">
                    <div class="col-4"><b><a OnClick="admincart_comment('{{$admincart->id}}')">{{ __('inventory.comment') }}</a></b></div>
                        <div class="col-8" id="admincartComment">{{ $admincart->comment }}</div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="card" style="height:350px;position:relative;">
            @include('inventory.admincarts.products_table')
        </div>
    </div>
</div>

<!-- <Modal> -->
<div class="modal modal-black fade show" id="singleProduct" tabindex="-1" role="dialog" aria-labelledby="singleProductLabel" aria-hidden="true">
    <form id="admincart-form-single-product-add" method="POST" action="{{ route('admincarts.add.single.product.store') }}" style="width:100%;">
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
                                <input type="hidden" name="admincart_id" value="{{ $admincart->id }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group{{ $errors->has('singleProduct') ? ' has-danger' : '' }}">
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
                    <button id="admincart-single-product-add" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
                    <button type="button" class="btn btn-sm btn-simple btn-delete" data-dismiss="modal">{{ __('modal.close') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
<style>
.search-ring.hidden
{
    display: none;
}
</style>
<script defer>
admincart_product_search_input.addEventListener('keyup', function(event) {
    if (event.keyCode === 13) {
        admincart_search();
    }
});
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
            console.log(`search` , search);
            
            fetch('/productLiveSearch', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    productLive:search,
                }),
            })

            .then(function (response) 
            {
                return response.json()
            })
            .then(function(json)
            {
                console.log(`json` , json);
                let data = []
                for(let i = 0; i < json.length; i++)
                {
                    data.push({value: json[i].id, text: json[i].full_name})
                }
                console.log(`data` , data);
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