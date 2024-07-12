@extends('inventory.layouts.app', ['page' => __('inventory.manage_admincart'), 'pageSlug' => 'admincarts', 'section' => 'admincarts', 'search' => 'admincarts'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{ __('inventory.admincart') }} №{{ $admincart->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($admincart->created_at)) }}
                                @if (!$admincart->finalized_at)
                                    <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                @else
                                    <span class="text-success"><i class="far fa-check-square"></i></span>
                                @endif
                            </h4>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <!--finalize-->
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
                                    <button type="submit" class="btn btn-simple btn-sm btn-print" data-toggle="tooltip" title="{{ __('inventory.print') }}"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            <!--delete-->
                            <div class="col-1">
                                <form action="{{ route('admincarts.destroy', ['admincart' => $admincart]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-simple btn-sm btn-delete @if($admincart->finalized_at) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.delete_document') }}" onclick="confirm('{{ __('inventory.document_confirm_delete') }}') ? this.parentElement.submit() : ''"><i class="fas fa-times"></i></button>
                                </form>
                            </div>
                            <!--index-->
                            <div class="col-7 text-right">
                                <a class="btn btn-simple btn-sm btn-back" href="{{ route('admincarts.index') }}" title="{{ __('inventory.back_to_list') }}"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <div class="row"><input type="hidden" id="is_finalized" name="is_finalized" value="{{ $admincart->finalized_at }}"></div>
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.warehouse') }}</div>
                                <div class="col-9">{{ $admincart->warehouse->name }}</div>
                            </div>
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.user') }}</div>
                                <div class="col-9">{{ $admincart->user->name }}</div>
                            </div>
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.client') }}</div>
                                <div class="col-9"><a href="{{ route('clients.show', $admincart->client) }}">{{ $admincart->client->name }}</a></div>
                            </div>
                        </div>
                        <div class="col-6">
                            @if($admincart->client_auto_id)
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.auto') }}</div><div class="col-9"><a href="{{ route('client_autos.show', $admincart->client_auto_id) }}">{{ $admincart->client_auto->name ?? ''}}</a></div>
                            </div>
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.vin') }}</div><div class="col-9">{{ $admincart->client_auto->vin ?? ''}}</div>
                            </div>
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.plate') }} - {{ __('inventory.color') }} - {{ __('inventory.year') }}</div><div class="col-9">{{ $admincart->client_auto->plate ?? ''}} - {{ $admincart->client_auto->color ?? ''}} - {{ $admincart->client_auto->year ?? ''}}</div>
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
                    <div class="col-6">
                        <h4 class="card-title">{{ __('inventory.products') }}</h4>
                    </div>
                    <div class="col-6">
                        <div class="row text-right">
                            <div class="col-1">
                                <button type="button" class="btn btn-simple btn-sm btn-selector @if($admincart->finalized_at) disabled @endif" data-toggle="modal" data-target="#singleProduct"><i class="fas fa-level-down-alt"></i></button>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-selector @if($admincart->finalized_at) disabled @endif btn-sm" href="{{ route('admincarts.product.search', $admincart) }}" data-toggle="tooltip" title="Product search"><i class="fas fa-search"></i></a>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-selector @if($admincart->finalized_at) disabled @endif btn-sm" href="{{ route('admincarts.product.selector', $admincart) }}" data-toggle="tooltip" title="{{ __('inventory.product_selector') }}"><i class="fas fa-list-ul"></i></a>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-delete @if($admincart->finalized_at) disabled @endif btn-sm" href="{{ route('admincarts.product.clear', $admincart) }}" data-toggle="tooltip" title="{{ __('inventory.clear_table') }}"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('inventory.admincarts.products_table')
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
                            <div class="col-3"><a OnClick="admincart_comment('{{$admincart->id}}')">{{ __('inventory.comment') }}</a></div>
                            <div class="col-9" id="admincartComment">{{ $admincart->comment }}</div>
                        </div>
                        <div class="row">
                        @if($admincart->client->comment)
                            <div class="col-3"><b>{{ __('inventory.clientComment') }}</b></div>
                            <div class="col-9">{{ $admincart->client->comment }}</div>
                            @endif
                        </div>                        
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.products') }} / {{ __('inventory.total_quantity') }}</b></div>
                            <div class="col-3"><span name="docCount">{{ number_format($admincart->docCount ?? 0, 2)  }}</span> / <span name="docQuantity">{{ number_format($admincart->docQuantity ?? 0, 2) }}</span></div>
                        </div>
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.total_cost') }}</b></div>
                            <div class="col-3"><span name="docTotal">{{ number_format($admincart->docTotal ?? 0, 2) }}</span> ({{ $admincart->currency }})</div>
                        </div>
                    </div>
                </div>
            </div>
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
                    <button type="button" class="btn btn-sm btn-simple btn-secondary" data-dismiss="modal">{{ __('modal.close') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
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

<style>
.search-ring.hidden
{
    display: none;
}
</style>
@endpush