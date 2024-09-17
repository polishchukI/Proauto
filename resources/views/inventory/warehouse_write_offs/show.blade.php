@extends('inventory.layouts.app', ['page' => __('inventory.manage_warehouse_write_off'), 'pageSlug' => 'warehouse_write_offs', 'section' => 'documents', 'search' => 'warehouse_write_offs'])

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
                        <h4 class="card-title">{{ __('inventory.warehouse_write_off') }} №{{ $warehouse_write_off->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($warehouse_write_off->created_at)) }}
                            @if (!$warehouse_write_off->finalized_at)
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
                                <button type="button" class="btn btn-success btn-sm btn-simple @if($warehouse_write_off->finalized_at) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.finalize') }}" onclick="confirm('ВНИМАНИЕ: После проведения документа, дальнейшее редактирование будет не возможно.') ? window.location.replace('{{ route('warehouse_write_offs.finalize', $warehouse_write_off) }}') : ''">
                                    <i class="fas fa-handshake"></i>
                                </button>
                            </div>
                            <!--print-->
                            <div class="col-1">
                                <form action="{{ route('warehouse_write_offs.print', $warehouse_write_off) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-print" data-toggle="tooltip" title="{{ __('inventory.print') }}"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            <!--delete-->
                            <div class="col-1">
                                <form action="{{ route('warehouse_write_offs.destroy', $warehouse_write_off) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-simple btn-sm btn-delete @if($warehouse_write_off->products->count() != 0) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.delete_document') }}"><i class="fas fa-times"></i></button>
                                </form>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>

                            <!--index-->
                            <div class="col-4 text-right">
                                <a class="btn btn-simple btn-sm btn-back" href="{{ route('warehouse_write_offs.index') }}" data-toggle="tooltip" title="{{ __('inventory.warehouse_write_offs') }}"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---->
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row"><input type="hidden" id="is_finalized" name="is_finalized" value="{{ $warehouse_write_off->finalized_at }}"></div>
                        <div class="row text-info">
                            <div class="col-3">{{ __('inventory.warehouse') }}</div><div class="col-9">{{ $warehouse_write_off->warehouse->name }}</div>
                        </div>
                        <div class="row text-info">
                            <div class="col-3">{{ __('inventory.user') }}</div><div class="col-9">{{ $warehouse_write_off->user->name }}</div>
                        </div>
                    </div>
                    <div class="col-6"></div>
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
                                <button type="button" class="btn btn-simple btn-sm btn-selector @if($warehouse_write_off->finalized_at) disabled @endif" data-toggle="modal" data-target="#singleProduct"><i class="fas fa-level-down-alt"></i></button>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-selector @if($warehouse_write_off->finalized_at) disabled @endif" href="{{ route('warehouse_write_offs.product.selector', $warehouse_write_off) }}" data-toggle="tooltip" title="{{ __('inventory.product_selector') }}"><i class="fas fa-list-ul"></i></a>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-delete @if($warehouse_write_off->finalized_at) disabled @endif" href="{{ route('warehouse_write_offs.product.clear', $warehouse_write_off) }}" data-toggle="tooltip" title="{{ __('inventory.clear_products_table') }}"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('inventory.warehouse_write_offs.products_table')
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
                        <div class="col-3"><a OnClick="warehouse_write_off_comment('{{$warehouse_write_off->id}}')">{{ __('inventory.comment') }}</a></div>
                            <div class="col-9" id="warehouse_write_offComment">{{ $warehouse_write_off->comment }}</div>
                        </div>          
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.products') }} / {{ __('inventory.total_quantity') }}</b></div>
                            <div class="col-3"><span name="docCount">{{ number_format($warehouse_write_off->docCount ?? 0, 2)  }}</span> / <span name="docQuantity">{{ number_format($warehouse_write_off->docQuantity ?? 0, 2) }}</span></div>
                        </div>
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.total_cost') }}</b></div>
                            <div class="col-3"><span name="docTotal">{{ number_format($warehouse_write_off->docTotal ?? 0, 2) }}</span> ({{ $warehouse_write_off->currency }})</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal modal-black fade show" id="singleProduct" tabindex="-1" role="dialog" aria-labelledby="singleProductLabel" aria-hidden="true">
    <form id="warehouse_write_off-form-single-product-add" method="POST" action="{{ route('warehouse_write_offs.add.single.product.store') }}" style="width:100%;">
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
                                <input type="hidden" name="warehouse_write_off_id" value="{{ $warehouse_write_off->id }}">
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
                        <div class="col-12">
                            <div class="form-group">
                                <label for="quantity" class="col-form-label">{{ __('modal.quantity') }}:</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="warehouse_write_off-single-product-add" class="btn btn-sm btn-simple btn-success">{{ __('modal.add') }}</button>
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
