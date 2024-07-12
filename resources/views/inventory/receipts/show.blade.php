@extends('inventory.layouts.app', ['page' => __('inventory.manage_receipt'), 'pageSlug' => 'receipts', 'section' => 'documents', 'search' => 'receipts'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
@include('inventory.alerts.info')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{ __('inventory.receipt') }} №{{ $receipt->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($receipt->created_at)) }}
						@if (!$receipt->finalized_at)
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
                                <button type="button" class="btn btn-success btn-sm btn-simple @if($receipt->finalized_at) disabled @endif" onclick="confirm('ATTENTION: At the end of this receipt you will not be able to load more products in it.') ? window.location.replace('{{ route('receipts.finalize', $receipt) }}') : ''">
                                    <i class="fas fa-handshake"></i>
                                </button>
                            </div>
                            <!--pay-->
                            <div class="col-1">
                                <form action="{{ route('receipts.pay', $receipt) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-pay @if(($receipt->total_amount + $receipt->transactions->sum('amount')) == 0) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.pay') }}"><i class="fas fa-dollar-sign"></i></button>
                                </form>
                            </div>
                            <!--print-->
                            <div class="col-1">
                                <form action="{{ route('receipts.print', $receipt) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-print" data-toggle="tooltip" title="{{ __('inventory.print') }}"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            <!--returnings -->
                            <div class="col-1">
                                <form action="{{ route('receipts.return_to_provider', $receipt) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm" data-toggle="tooltip" title="{{ __('inventory.print') }}"><i class="fas fa-redo"></i></button>
                                </form>
                            </div>
                            <!--unfinalize-->
                            @if(strcasecmp(auth()->user()->unfinalize, "on") == 0)
                            <div class="col-1">
                                <form action="{{ route('receipts.unfinalize', $receipt) }}" method="get" class="d-inline">
                                    <button type="submit" class="btn btn-simple btn-selector btn-sm @if(!$receipt->finalized_at) disabled @endif" data-toggle="tooltip" title="Unfinalize Order" onclick="confirm('ATTENTION: This action will unfinalize the order, be sure you know what are you doing!') ? window.location.replace('{{ route('receipts.unfinalize', $receipt) }}') : ''">
                                    <i class="fas fa-unlock-alt"></i></button>
                                </form>
                            </div>
                            @endif
                            <!--delete-->
                            <div class="col-1">
                                <form action="{{ route('receipts.destroy', $receipt) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-delete btn-simple btn-sm @if($receipt->products->count() != 0) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.delete') }}"><i class="fas fa-times"></i></button>
                                </form>
                            </div>
                            <!--thumb-->
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <!--index-->
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-back" href="{{ route('receipts.index') }}" data-toggle="tooltip" title="Back to list"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <div class="row"><input type="hidden" id="is_finalized" name="is_finalized" value="{{ $receipt->finalized_at }}"></div>
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.warehouse') }}</div>
                                <div class="col-9">{{ $receipt->warehouse->name }}</div>
                            </div>
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.user') }}</div>
                                <div class="col-9">{{ $receipt->user->name }}</div>
                            </div>
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.provider') }}</div>
                                <div class="col-9"><a href="{{ route('providers.show', $receipt->provider) }}">{{ $receipt->provider->name }}</a></div>
                            </div>
                            @if (!is_null($receipt->provider_doc_number))
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.provider_doc') }}</div>
                                <div class="col-9">{{ __('inventory.provider_doc_number') }} №{{ $receipt->provider_doc_number }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($receipt->provider_doc_date)) }}</div>
                            </div>
                            @endif
                            @if ($receipt->setup_prices === 1)
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.setup_prices') }}</div>
                                <div class="col-9">{{ __('inventory.surcharge') }} {{ $receipt->surcharge }} {{ __('inventory.surcharge_coefficient') }} {{ $receipt->surcharge_coefficient }}</div>
                            </div>
                            @endif
                            @if ($receipt->is_gratuitous === 1)
                            <div class="row text-success">
                                <div class="col-3">{{ __('inventory.is_gratuitous') }}</div>
                                <div class="col-9"><span class="text-success"><i class="far fa-check-square"></i></span></div>
                            </div>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="row">
                                @if($receipt->provider->settlements->sum('total_amount') > 0)
                                <div class="col-3"><span class="text-success">{{ __('inventory.balance_positive') }}</span></div><div class="col-9"><span class="text-success">{{ $receipt->provider->settlements->sum('total_amount') }}</span></div>
                                @elseif($receipt->provider->settlements->sum('total_amount') < 0)
                                <div class="col-3"><span class="text-danger">{{ __('inventory.balance_negative') }}</span></div><div class="col-9"><span class="text-danger">{{ $receipt->provider->settlements->sum('total_amount') }}</span></div>
                                @else
                                <div class="col-12"><span class="text-info">{{ __('inventory.balance_no_debt') }}</span></div>
                                @endif
                            </div>
                            @if($receipt->reference_type == "to_provider_order")
                            <div class="row text-success">
                                <div class="col-3">{{ __('inventory.reference_doc') }}</div>
                                <div class="col-9">
                                    <a href="{{ route('to_provider_orders.show', $receipt->reference_id) }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        {{ __('inventory.to_provider_order') }} №{{ $receipt->reference_id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($receipt->created_at)) }}
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
                    <div class="col-6">
                        <h4 class="card-title">{{ __('inventory.products') }}</h4>
                    </div>
                    <div class="col-6">
                        <div class="row text-right">
                            <div class="col-1">
                                <button type="button" class="btn btn-simple btn-sm btn-selector @if($receipt->finalized_at) disabled @endif" data-toggle="modal" data-target="#singleProduct"><i class="fas fa-level-down-alt"></i></button>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-selector btn-sm @if($receipt->finalized_at) disabled @endif" href="{{ route('receipts.product.selector', $receipt) }}" data-toggle="tooltip" title="{{ __('inventory.product_selector') }}"><i class="fas fa-list-ul"></i></a>                                 
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-selector btn-sm @if($receipt->finalized_at) disabled @endif" href="{{ route('receipts.to_provider.ordered.product.selector', $receipt) }}" data-toggle="tooltip" title="{{ __('inventory.ordered_product_selector') }}"><i class="fas fa-file-upload"></i></a>                                 
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-delete btn-sm @if($receipt->finalized_at) disabled @endif" href="{{ route('receipts.product.clear', $receipt) }}" data-toggle="tooltip" title="{{ __('inventory.clear_table') }}"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('inventory.receipts.products_table')
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
                            <div class="col-3"><b>{{ __('inventory.comment') }}</b></div>
                            <div class="col-9">{{ $receipt->comment }}</div>
                        </div>
                        <div class="row">
                        @if($receipt->provider->comment)
                            <div class="col-3"><b>{{ __('inventory.providerComment') }}</b></div>
                            <div class="col-9">{{ $receipt->provider->comment }}</div>
                        @endif
                        </div>                        
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.products') }} / {{ __('inventory.total_quantity') }}</b></div>
                            <div class="col-3"><span name="docCount">{{ number_format($receipt->docCount ?? 0, 2)  }}</span> / <span name="docQuantity">{{ number_format($receipt->docQuantity ?? 0, 2) }}</span></div>
                        </div>
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.total_cost') }}</b></div>
                            <div class="col-3"><span name="docTotal">{{ number_format($receipt->docTotal ?? 0, 2) }}</span> ({{ $receipt->currency }})</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <Modal> -->
<div class="modal modal-black fade show" id="singleProduct" tabindex="-1" role="dialog" aria-labelledby="singleProductLabel" aria-hidden="true">
    <form id="receipt-form-single-product-add" method="POST" action="{{ route('receipts.add.single.product.store') }}" style="width:100%;">
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
                                <input type="hidden" name="receipt_id" value="{{ $receipt->id }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group{{ $errors->has('product') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-product">{{ __('modal.products') }}</label>
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
                    <button id="receipt-single-product-add" type="button" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
                    <button type="button" class="btn btn-sm btn-simple btn-selector" data-dismiss="modal">{{ __('modal.close') }}</button>
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