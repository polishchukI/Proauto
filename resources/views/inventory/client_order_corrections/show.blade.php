@extends('inventory.layouts.app', ['page' => __('inventory.manage_client_order_correction'), 'pageSlug' => 'client_order_corrections', 'section' => 'documents', 'search' => 'client_order_corrections'])

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
                        <h4 class="card-title">{{ __('inventory.client_order_correction') }} №{{ $client_order_correction->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($client_order_correction->created_at)) }}
                            @if (!$client_order_correction->finalized_at)
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
                                <button type="button" class="btn btn-success btn-sm btn-simple @if($client_order_correction->finalized_at) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.finalize') }}" onclick="confirm('ВНИМАНИЕ: После проведения документа, дальнейшее редактирование будет не возможно.') ? window.location.replace('{{ route('client_order_corrections.finalize', $client_order_correction) }}') : ''">
                                    <i class="fas fa-handshake"></i>
                                </button>
                            </div>
                            <!--pay-->
                            <div class="col-1">
                                <form action="{{ route('client_order_corrections.pay', $client_order_correction) }}" method="get" class="d-inline">
                                    @csrf
                                    @if(($client_order_correction->total_amount - $client_order_correction->transactions->sum('amount')) != 0)
                                    <button type="submit" class="btn btn-simple btn-sm btn-pay" data-toggle="tooltip" title="{{ __('inventory.pay') }}"><i class="fas fa-dollar-sign"></i></button>
                                    @else
                                    <button type="submit" class="btn btn-simple btn-sm btn-pay disabled" data-toggle="tooltip" title="{{ __('inventory.pay') }}"><i class="fas fa-dollar-sign"></i></button>
                                    @endif
                                </form>
                            </div>
                            <!--print-->
                            <div class="col-1">
                                <form action="{{ route('client_order_corrections.print', $client_order_correction) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-print" data-toggle="tooltip" title="{{ __('inventory.print') }}"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            <!--delete-->
                            <div class="col-1">
                                <form action="{{ route('client_order_corrections.destroy', $client_order_correction) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-simple btn-sm btn-delete @if($client_order_correction->products->count() != 0) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.delete_document') }}"><i class="fas fa-times"></i></button>
                                </form>
                            </div>
                            <!--discount-->
                            <div class="col-3">
                                <input type="hidden" id="client_order_correction" name="client_order_correction" value="{{ $client_order_correction->id }}">
                                <select name="sale_discount" id="input-discount" data-toggle="tooltip" title="{{ __('inventory.discount') }}" @if ($client_order_correction->finalized_at) disabled @endif class="form-select form-select-alternative{{ $errors->has('discount') ? ' is-invalid' : '' }}">
                                @foreach(['' => __('inventory.no_discount'), '1' => '1%', '2' => '2%', '3' => '3%', '4' => '4%', '5' => '5%', '6' => '6%', '7' => '7%', '8' => '8%', '9' => '9%', '10' => '10%'] as $key => $value)
                                    <option @if($key == $client_order_correction->discount) selected @endif value="{{$key}}">{{$value}}</option>
                                @endforeach
                                @include('inventory.alerts.feedback', ['field' => 'discount'])
                                </select>
                            </div>
                            <!--index-->
                            <div class="col-4 text-right">
                                <a class="btn btn-simple btn-sm btn-back" href="{{ route('client_order_corrections.index') }}" data-toggle="tooltip" title="{{ __('inventory.client_order_corrections') }}"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---->
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row"><input type="hidden" id="is_finalized" name="is_finalized" value="{{ $client_order_correction->finalized_at }}"></div>
                        <div class="row text-info">
                            <div class="col-3">{{ __('inventory.warehouse') }}</div><div class="col-9">{{ $client_order_correction->warehouse->name }}</div>
                        </div>
                        <div class="row text-info">
                            <div class="col-3">{{ __('inventory.user') }}</div><div class="col-9">{{ $client_order_correction->user->name }}</div>
                        </div>
                        <div class="row text-info">
                            <div class="col-3">{{ __('inventory.client') }}</div><div class="col-9"><a href="{{ route('clients.show', $client_order_correction->client) }}">{{ $client_order_correction->client->name }}</a></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            @if($client_order_correction->client->settlements->sum('total_amount') > 0)
                            <div class="col-3"><span class="text-success">{{ __('inventory.balance_positive') }}</span></div><div class="col-9"><span class="text-success">{{ $client_order_correction->client->settlements->sum('total_amount') }}</span></div>
                            @elseif($client_order_correction->client->settlements->sum('total_amount') < 0)
                            <div class="col-3"><span class="text-danger">{{ __('inventory.balance_negative') }}</span></div><div class="col-9"><span class="text-danger">{{ $client_order_correction->client->settlements->sum('total_amount') }}</span></div>
                            @else
                            <div class="col-12"><span class="text-info">{{ __('inventory.balance_no_debt') }}</span></div>
                            @endif
                        </div>
                        @if($client_order_correction->reference_type == "client_order")
                        <div class="row text-success">
                            <div class="col-3">{{ __('inventory.reference_doc') }}</div>
                            <div class="col-9">
                                <a href="{{ route('client_orders.show', $client_order_correction->reference_id) }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    {{ __('inventory.client_order') }} №{{ $client_order_correction->reference_id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($client_order_correction->created_at)) }}
                                </a>
                            </div>
                        </div>
                        @endif
                        @foreach($client_order_correction->transactions as $transaction)
                        <div class="row text-success">
                            <div class="col-3">{{ __('inventory.transactions') }}</div>
                            <div class="col-9">
                                <a href="{{ route('transactions.edit', $transaction->id) }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    {{ __('inventory.transaction') }} №{{ $transaction->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($transaction->created_at)) }} - {{ $transaction->amount }}
                                </a>
                            </div>
                        </div>
                        @endforeach
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
                                <button type="button" class="btn btn-simple btn-sm btn-selector @if($client_order_correction->finalized_at) disabled @endif" data-toggle="modal" data-target="#singleProduct"><i class="fas fa-level-down-alt"></i></button>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-selector @if($client_order_correction->finalized_at) disabled @endif" href="{{ route('client_order_corrections.product.selector', $client_order_correction) }}" data-toggle="tooltip" title="{{ __('inventory.product_selector') }}"><i class="fas fa-list-ul"></i></a>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-selector @if($client_order_correction->finalized_at) disabled @endif" href="{{ route('client_order_corrections.client.ordered.product.selector', $client_order_correction) }}" data-toggle="tooltip" title="{{ __('inventory.client_ordered_products_selector') }}"><i class="fas fa-file-download"></i></a>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-delete @if($client_order_correction->finalized_at) disabled @endif" href="{{ route('client_order_corrections.product.clear', $client_order_correction) }}" data-toggle="tooltip" title="{{ __('inventory.clear_products_table') }}"><i class="fas fa-times"></i></a> </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('inventory.client_order_corrections.products_table')
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
                            <div class="col-9">{{ $client_order_correction->comment }}</div>
                        </div>
                        <div class="row">
                        @if($client_order_correction->client->comment)
                            <div class="col-3"><b>{{ __('inventory.clientComment') }}</b></div>
                            <div class="col-9">{{ $client_order_correction->client->comment }}</div>
                            @endif
                        </div>                        
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.products') }} / {{ __('inventory.total_quantity') }}</b></div>
                            <div class="col-3"><span name="docCount">{{ number_format($client_order_correction->docCount ?? 0, 2)  }}</span> / <span name="docQuantity">{{ number_format($client_order_correction->docQuantity ?? 0, 2) }}</span></div>
                        </div>
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.discount') }} / {{ __('inventory.total_cost') }}</b></div>
                            <div class="col-3">
                                <span name="docDiscountSum">{{ number_format($client_order_correction->docDiscountSum ?? 0, 2) }}</span> / 
                                <span name="docDiscountedTotal">{{ number_format($client_order_correction->docDiscountedTotal ?? 0, 2) }}</span> ({{ $client_order_correction->currency }})
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal modal-black fade show" id="singleProduct" tabindex="-1" role="dialog" aria-labelledby="singleProductLabel" aria-hidden="true">
    <form id="client_order_correction-form-single-product-add" method="POST" action="{{ route('client_order_corrections.add.single.product.store') }}" style="width:100%;">
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
                                <input type="hidden" name="client_order_correction_id" value="{{ $client_order_correction->id }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group{{ $errors->has('productLive') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-productLive">{{ __('modal.products') }}</label>
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
                    <button type="button" id="client_order_correction-single-product-add" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
                    <button type="button" data-dismiss="modal" class="btn btn-sm btn-simple btn-delete"><i class="fas fa-times"></i> {{ __('modal.delete') }}</button>                    
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal -->
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
