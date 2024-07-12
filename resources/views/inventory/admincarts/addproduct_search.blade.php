@extends('inventory.layouts.app', ['page' => __('inventory.admincart_product_search'), 'pageSlug' => 'admincarts', 'section' => 'documents', 'search' => 'admincarts'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-12">
        <div class="card" style="height:400px;position:relative;">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-2"><b>{{ __('inventory.product_search') }}</b></div>
                            <div class="col-4">                        
                                <input type="search" id="admincart_product_search_input" name="admincart_product_search_input" class="form-control-sm" />
                                <button type="button" class="btn btn-simple btn-sm btn-selector" OnClick="admincart_search()"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="col-1 mt-4">
                                <div id="admin_search_loader" class="search-ring hidden" style="width:15px;height:15px;"><img src="/images/admincart-search.gif"></div>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-simple btn-sm btn-selector" OnClick="catalog_product_create('{{ $admincart->id }}')"><i class="far fa-plus-square"></i></button>
                            </div>
                            <div class="col-1">
                                <input type="hidden" id="admincart_id" name="admincart_id" value="{{ $admincart->id }}">
                            </div>
                            <div class="col-2"></div>
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
</script>
@endpush