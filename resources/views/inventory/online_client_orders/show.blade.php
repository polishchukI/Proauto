@extends('inventory.layouts.app', ['page' => __('inventory.manage_online_client_order'), 'pageSlug' => 'online_client_orders', 'section' => 'documents', 'search' => 'online_client_orders'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{ __('inventory.online_client_order') }} №{{ $online_client_order->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($online_client_order->created_at)) }}
                            @if (!$online_client_order->finalized_at)
                                <span class="text-danger"><i class="far fa-minus-square"></i></span>
                            @else
                                <span class="text-success"><i class="far fa-check-square"></i></span>
                            @endif
                        </h4>
                    </div>
                    <div class="col-6">
                        <div class="row text-right">
                            <!--pay-->
                            <div class="col-1">
                                <form action="{{ route('online_client_orders.pay', $online_client_order) }}" method="get" class="d-inline">
                                    <button type="submit" class="btn btn-simple btn-sm btn-pay disabled" data-toggle="tooltip" title="{{ __('inventory.pay') }}"><i class="fas fa-dollar-sign"></i></button>
                                </form>
                            </div>
                            <div class="col-1">
                            <a href="{{ route('online_client_orders.client_order', ['online_client_order' => $online_client_order]) }}" class="btn btn-simple btn-sm @if($online_client_order->finalized_at) disabled @endif" data-toggle="tooltip" data-placement="bottom" title="Client order" target="_blank">
                                    <i class="fas fa-file-download"></i>
                                </a>
                            </div>
                            <!--print-->
                            <div class="col-1">
                                <form action="{{ route('online_client_orders.print', $online_client_order) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-print" data-toggle="tooltip" title="{{ __('inventory.print') }}"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            <!--unfinalize-->
                            @if(strcasecmp(auth()->user()->unfinalize, "on") == 0)
                                <div class="col-1">
                                    <form action="{{ route('online_client_orders.unfinalize', $online_client_order) }}" method="get" class="d-inline">
                                        <button type="submit" class="btn btn-simple btn-selector btn-sm @if(!$online_client_order->finalized_at) disabled @endif" data-toggle="tooltip" title="Unfinalize Order" onclick="confirm('ATTENTION: This action will unfinalize the order, be sure you know what are you doing!') ? window.location.replace('{{ route('online_client_orders.unfinalize', $online_client_order) }}') : ''">
                                            <i class="fas fa-unlock-alt"></i>
                                        </button>
                                    </form>
                                </div>
                                @endif
                            <!--delete-->
                            <div class="col-1">
                                <form action="{{ route('online_client_orders.destroy', ['online_client_order' => $online_client_order]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-simple btn-sm btn-delete @if ($online_client_order->products->count() != 0) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.delete') }}"><i class="fas fa-times"></i></button>
                                </form>
                            </div>
                            <!--index-->
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <!--index-->
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-back" href="{{ route('online_client_orders.index') }}" data-toggle="tooltip" title="Back to list"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.client') }}</div><div class="col-9"><a href="{{ route('clients.show', $online_client_order->client) }}">{{ $online_client_order->client->name }}</a></div>
                            </div>
                        </div>
                        <div class="col-6">
                            @if($online_client_order->reference_type == "admincart")
                            <div class="row text-success">
                                <div class="col-3">{{ __('inventory.reference_doc') }}</div>
                                <div class="col-9">
                                    <a href="{{ route('admincarts.show', $online_client_order->reference_id) }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        {{ __('inventory.admincart') }} №{{ $online_client_order->reference_id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($online_client_order->created_at)) }}
                                    </a>
                                </div>
                            </div>
                            @endif
                            @if($online_client_order->reference_type == "online_order")
                            <div class="row text-danger">
                                <div class="col-3">{{ __('inventory.online_order') }} №{{ $online_order->reference_id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($online_client_order->created_at)) }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  -->
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
                                <!-- <a class="btn btn-simple btn-sm btn-delete @if($online_client_order->finalized_at) disabled @endif" href="{{ route('online_client_orders.product.clear', $online_client_order) }}" data-toggle="tooltip" title="{{ __('inventory.clear_table') }}"><i class="fas fa-times"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <table class="table">
                    <thead>
                        <th>№</th>
                        <th>{{ __('inventory.article') }}</th>
                        <th>{{ __('inventory.brand') }}</th>
                        <th>{{ __('inventory.product') }}</th>
                        <th>{{ __('inventory.quantity') }}</th>
                        <th>{{ __('inventory.price') }}</th>
                        <th>{{ __('inventory.total') }}</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($online_client_order->products as $product_ordered)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product_ordered->article }}</td>
                                <td>{{ $product_ordered->brand }}</td>							
                                <td>
                                    @if($product_ordered->product)
                                    <a href="{{ route('products.show', $product_ordered->product->id) }}" data-toggle="tooltip" title="Product info" target="_blank">
                                        {{ $product_ordered->product->full_name }}
                                    </a>
                                    @else
                                    <button type="button" class="btn btn-success btn-sm btn-simple" onclick="online_client_orders_product_create('{{$online_client_order->id}}','{{ $product_ordered->id }}')">
                                        <span><i class="fas fa-plus"></i></span>
                                    </button>
                                    {{ $product_ordered->name }}
                                    @endif
                                </td>
                                <td>{{ number_format($product_ordered->quantity ?? 0, 2) }}</td>
                                <td>{{ number_format($product_ordered->price ?? 0, 2)  }}</td>
                                <td>{{ number_format($product_ordered->quantity * $product_ordered->price ?? 0, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                            <div class="col-3"><b>{{ __('inventory.comment') }}</b></div>
                            <div class="col-9">{{ $online_client_order->comment }}</div>
                        </div>
                        <div class="row">
                        @if($online_client_order->client->comment)
                            <div class="col-3"><b>{{ __('inventory.clientComment') }}</b></div>
                            <div class="col-9">{{ $online_client_order->client->comment }}</div>
                            @endif
                        </div>                        
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.products') }} / {{ __('inventory.total_quantity') }}</b></div>
                            <div class="col-3"><span name="docCount">{{ number_format($online_client_order->docCount ?? 0, 2)  }}</span> / <span name="docQuantity">{{ number_format($online_client_order->docQuantity ?? 0, 2) }}</span></div>
                        </div>
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.discount') }} / {{ __('inventory.total_cost') }}</b></div>
                            <div class="col-3">
                                <span name="docDiscountSum">{{ number_format($online_client_order->docDiscountSum ?? 0, 2) }}</span> / 
                                <span name="docDiscountedTotal">{{ number_format($online_client_order->docDiscountedTotal ?? 0, 2) }}</span> ({{ $online_client_order->currency }})
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection