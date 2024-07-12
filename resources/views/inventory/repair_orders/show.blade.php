@extends('inventory.layouts.app', ['page' => __('inventory.manage_repair_order'), 'pageSlug' => 'repair_orders', 'section' => 'documents', 'search' => 'repair_orders'])

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
                        <h4 class="card-title">{{ __('inventory.repair_order') }} №{{ $repair_order->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($repair_order->created_at)) }}
                            @if (!$repair_order->finalized_at)
                                <span class="text-danger"><i class="far fa-minus-square"></i></span>
                            @else
                                <span class="text-success"><i class="far fa-check-square"></i></span>
                            @endif
                        </h4>
                    </div>
                    <div class="col-6">
                        <div class="row text-right">
                            <!--finalize-->
                            <div class="col-1">
                                <button type="button" class="btn btn-success btn-sm btn-simple @if($repair_order->finalized_at) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.finalize') }}" onclick="confirm('ВНИМАНИЕ: После проведения документа, дальнейшее редактирование будет не возможно.') ? window.location.replace('{{ route('repair_orders.finalize', $repair_order) }}') : ''">
                                    <i class="fas fa-handshake"></i>
                                </button>
                            </div>
                            <!--pay-->
                            <div class="col-1">
                                <form action="{{ route('repair_orders.pay', $repair_order) }}" method="get" class="d-inline">
                                    @csrf
                                    @if(($repair_order->total_amount - $repair_order->transactions->sum('amount')) != 0)
                                    <button type="submit" class="btn btn-simple btn-sm btn-pay" data-toggle="tooltip" title="{{ __('inventory.pay') }}"><i class="fas fa-dollar-sign"></i></button>
                                    @else
                                    <button type="submit" class="btn btn-simple btn-sm btn-pay disabled" data-toggle="tooltip" title="{{ __('inventory.pay') }}"><i class="fas fa-dollar-sign"></i></button>
                                    @endif
                                </form>
                            </div>
                            <!--print-->
                            <div class="col-1">
                                <form action="{{ route('repair_orders.print', $repair_order) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-print" data-toggle="tooltip" title="{{ __('inventory.print') }}"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            <!--returnings -->
                            <div class="col-1">
                                <form action="{{ route('repair_orders.return_from_the_client', $repair_order) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm" data-toggle="tooltip" title="{{ __('inventory.return_from_the_client') }}"><i class="fas fa-undo"></i></button>
                                </form>
                            </div>
                            <!--delete-->
                            <div class="col-1">
                                <form action="{{ route('repair_orders.destroy', $repair_order) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-simple btn-sm btn-delete @if($repair_order->products->count() != 0) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.delete_document') }}"><i class="fas fa-times"></i></button>
                                </form>
                            </div>
                            <!--discount-->
                            <div class="col-md-3">
                                <input type="hidden" id="repair_order" name="repair_order" value="{{ $repair_order->id }}">
                                <select name="repair_order_discount" id="input-discount" data-toggle="tooltip" title="{{ __('inventory.discount') }}" @if ($repair_order->finalized_at) disabled @endif class="form-select form-select-alternative{{ $errors->has('discount') ? ' is-invalid' : '' }}">
                                @foreach(['0' => __('inventory.no_discount'), '1' => '1%', '2' => '2%', '3' => '3%', '4' => '4%', '5' => '5%', '6' => '6%', '7' => '7%', '8' => '8%', '9' => '9%', '10' => '10%'] as $key => $value)
                                    <option @if($key == $repair_order->discount) selected @endif value="{{$key}}">{{$value}}</option>
                                @endforeach
                                @include('inventory.alerts.feedback', ['field' => 'discount'])
                                </select>
                            </div>
                            <!--service_discount-->
                            <div class="col-md-3">
                                <input type="hidden" id="repair_order" name="repair_order" value="{{ $repair_order->id }}">
                                <select name="repair_order_service_discount" id="input-service_discount" data-toggle="tooltip" title="{{ __('inventory.service_discount') }}" @if ($repair_order->finalized_at) disabled @endif class="form-select form-select-alternative{{ $errors->has('service_discount') ? ' is-invalid' : '' }}">
                                @foreach(['0' => __('inventory.no_discount'), '1' => '1%', '2' => '2%', '3' => '3%', '4' => '4%', '5' => '5%', '6' => '6%', '7' => '7%', '8' => '8%', '9' => '9%', '10' => '10%'] as $key => $value)
                                    <option @if($key == $repair_order->service_discount) selected @endif value="{{$key}}">{{$value}}</option>
                                @endforeach
                                @include('inventory.alerts.feedback', ['field' => 'service_discount'])
                                </select>
                            </div>
                            <!--index-->
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-back" href="{{ route('repair_orders.index') }}" data-toggle="tooltip" title="{{ __('inventory.repair_orders') }}"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row"><input type="hidden" id="is_finalized" name="is_finalized" value="{{ $repair_order->finalized_at }}"></div>
                        <div class="row">
                            <div class="col-md-3">{{ __('inventory.warehouse') }}</div><div class="col-md-9">{{ $repair_order->warehouse->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">{{ __('inventory.user') }}</div><div class="col-md-9">{{ $repair_order->user->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">{{ __('inventory.client') }}</div><div class="col-md-9"><a href="{{ route('clients.show', $repair_order->client) }}">{{ $repair_order->client->name }}</a></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($repair_order->reference_type == "client_order")
                        <div class="row text-success">
                            <div class="col-md-3">{{ __('inventory.reference_doc') }}</div>
                            <div class="col-md-9">
                                <a href="{{ route('client_orders.show', $repair_order->reference_id) }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    {{ __('inventory.client_order') }} №{{ $repair_order->reference_id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($repair_order->created_at)) }}
                                </a>
                            </div>
                        </div>
                        @endif
                        @foreach($repair_order->transactions as $transaction)
                        <div class="row text-success">
                            <div class="col-3"></div>
                            <div class="col-9">
                                <a href="{{ route('transactions.edit', $transaction->id) }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    {{ __('inventory.transaction') }} №{{ $transaction->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($transaction->created_at)) }} - {{ $transaction->amount }}
                                </a>
                            </div>
                        </div>
                        @endforeach
                        @if($repair_order->client_auto_id)
                            <div class="row">
                                <div class="col-md-3">{{ __('inventory.auto') }}</div><div class="col-md-9"><a href="{{ route('client_autos.show', $repair_order->client_auto_id) }}">{{ $repair_order->client_auto->name ?? ''}}</a></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">{{ __('inventory.vin') }}</div><div class="col-md-9">{{ $repair_order->client_auto->vin ?? ''}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">{{ __('inventory.plate') }} - {{ __('inventory.color') }} - {{ __('inventory.year') }}</div><div class="col-md-9">{{ $repair_order->client_auto->plate ?? ''}} - {{ $repair_order->client_auto->color ?? ''}} - {{ $repair_order->client_auto->year ?? ''}}</div>
                            </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card" style="height:500px;position:relative;">
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <ul class="nav nav-pills nav-pills-primary nav-pills-icons">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#servicesTab">{{ __('inventory.services') }}</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#productsTab">{{ __('inventory.products') }}</a></li>
                </ul>
                <div class="tab-content tab-space">
                    <div class="tab-pane active" id="servicesTab">
                        <div class="row text-right">
                            <div class="col-1">
                                <button type="button" class="btn btn-simple btn-sm btn-selector @if($repair_order->finalized_at) disabled @endif" data-toggle="modal" data-target="#singleService"><i class="fas fa-level-down-alt"></i></button>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-delete @if($repair_order->finalized_at) disabled @endif" href="{{ route('repair_orders.service.clear', $repair_order) }}" data-toggle="tooltip" title="{{ __('inventory.clear_products_table') }}"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        @include('inventory.repair_orders.services_table')
                    </div>
                    <div class="tab-pane" id="productsTab">
                        <div class="row text-right">
                            <div class="col-1">
                                <button type="button" class="btn btn-simple btn-sm btn-selector @if($repair_order->finalized_at) disabled @endif" data-toggle="modal" data-target="#singleProduct"><i class="fas fa-level-down-alt"></i></button>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-selector @if($repair_order->finalized_at) disabled @endif" href="{{ route('repair_orders.product.selector', $repair_order) }}" data-toggle="tooltip" title="{{ __('inventory.product_selector') }}"><i class="fas fa-list-ul"></i></a>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-delete @if($repair_order->finalized_at) disabled @endif" href="{{ route('repair_orders.product.clear', $repair_order) }}" data-toggle="tooltip" title="{{ __('inventory.clear_products_table') }}"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        @include('inventory.repair_orders.products_table')
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
                            <div class="col-md-9">{{ $repair_order->comment }}</div>
                        </div>
                        <div class="row">
                        @if($repair_order->client->comment)
                            <div class="col-md-3"><b>{{ __('inventory.clientComment') }}</b></div>
                            <div class="col-md-9">{{ $repair_order->client->comment }}</div>
                            @endif
                        </div>                        
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3"><b>{{ __('inventory.products') }} :: </b></div>
                            <div class="col-3"><b>{{ __('inventory.total') }} / {{ __('inventory.discount') }} / {{ __('inventory.total_cost') }}</b></div>
                            <div class="col-6">
                                <span name="docCount">{{ number_format($repair_order->docCount ?? 0, 2)  }}</span> / <span name="docQuantity">{{ number_format($repair_order->docQuantity ?? 0, 2) }}</span> :: <span name="docDiscountSum">{{ number_format($repair_order->docDiscountSum ?? 0, 2) }}</span> / <span name="docDiscountedTotal">{{ number_format($repair_order->docDiscountedTotal ?? 0, 2) }}</span> ({{ $repair_order->currency }})</div>
                        </div>
                        <div class="row">
                            <div class="col-3"><b>{{ __('inventory.services') }} :: </b></div>
                            <div class="col-3"><b>{{ __('inventory.total') }} / {{ __('inventory.discount') }} / {{ __('inventory.total_cost') }}</b></div>
                            <div class="col-6"><span name="docServicesCount">{{ number_format($repair_order->docServicesCount ?? 0, 2)  }}</span> / <span name="docServicesQuantity">{{ number_format($repair_order->docServicesQuantity ?? 0, 2) }}</span> :: <span name="docServicesDiscountSum">{{ number_format($repair_order->docServicesDiscountSum ?? 0, 2) }}</span> / <span name="docServicesDiscountedTotal">{{ number_format($repair_order->docServicesDiscountedTotal ?? 0, 2) }}</span> ({{ $repair_order->currency }})</div>
                        </div>
                        <div class="row">
                            <div class="col-6"><b>{{ __('inventory.total_cost') }} :: </b></div>
                            <div class="col-6"><span name="docTotal">{{ number_format($repair_order->docTotal ?? 0, 2)  }}</span> ({{ $repair_order->currency }})</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ModalProduct-->
<div class="modal modal-black fade show" id="singleProduct" tabindex="-1" role="dialog" aria-labelledby="singleProductLabel" aria-hidden="true">
    <form id="repair_order-form-single-product-add" method="POST" action="{{ route('repair_orders.add.single.product.store') }}" style="width:100%;">
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
                                <input type="hidden" name="repair_order_id" value="{{ $repair_order->id }}">
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
                    <button id="repair_order-single-product-add" type="button" class="btn btn-sm btn-simple">{{ __('modal.add') }}</button>
                    <button type="button" class="btn btn-sm btn-simple btn-secondary" data-dismiss="modal">{{ __('modal.close') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- ModalService -->
<div class="modal modal-black fade show" id="singleService" tabindex="-1" role="dialog" aria-labelledby="singleServiceLabel" aria-hidden="true">
    <form id="repair_order-form-single-service-add" method="POST" action="{{ route('repair_orders.add.single.service.store') }}" style="width:100%;">
        <div class="addservice modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('modal.add_single_service') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" name="repair_order_id" value="{{ $repair_order->id }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group{{ $errors->has('service_id') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-service_id">{{ __('modal.services') }}</label>
                                <select name="service_id" id="service_id">
                                    <option value="">{{ __('modal.not_specified') }}</option>
                                </select>
                                @include('inventory.alerts.feedback', ['field' => 'service'])
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group{{ $errors->has('employee_id') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-employee_id">{{ __('modal.employee') }}</label>
                                <select name="employee_id" id="employee_id">
                                    <option value="">{{ __('modal.not_specified') }}</option>
                                </select>
                                @include('inventory.alerts.feedback', ['field' => 'worker'])
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="price" class="col-form-label">{{ __('modal.price') }}:</label>
                                <input type="number" class="form-control" id="price" name="price">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="repair_order-single-service-add" type="button" class="btn btn-sm btn-simple">{{ __('modal.add') }}</button>
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
///services
document.addEventListener("DOMContentLoaded", () => 
{
    const service_id = new SlimSelect({
        select: '#service_id',
        placeholder: '{{ __('inventory.search_service') }}',
        searchingText: '{{ __('inventory.search') }}',
        ajax(search, callback) {
            if (search.length < 3)
            {
                callback('Need 3 characters')
                return
            }

            fetch('/serviceLiveSearch', {
                method: 'POST',
                data: {service_id:service_id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    serviceLive:search,
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
                    data.push({value: json[i].id, text: json[i].name})
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

document.addEventListener("DOMContentLoaded", () => 
{
    const employee_id = new SlimSelect({
        select: '#employee_id',
        placeholder: '{{ __('inventory.search_worker') }}',
        searchingText: '{{ __('inventory.search') }}',
        ajax(search, callback) {
            if (search.length < 3)
            {
                callback('Need 3 characters')
                return
            }

            fetch('/workerLiveSearch', {
                method: 'POST',
                data: {employee_id:employee_id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    workerLive:search,
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
                    data.push({value: json[i].id, text: json[i].fullname})
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
