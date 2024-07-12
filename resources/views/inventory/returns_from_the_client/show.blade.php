@extends('inventory.layouts.app', ['page' => __('inventory.return_from_the_client_edit'), 'pageSlug' => 'returns_from_the_client', 'section' => 'documents', 'search' => 'returns_from_the_client'])

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
                        <h4 class="card-title">{{ __('inventory.return_from_the_client') }} №{{ $return_from_the_client->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($return_from_the_client->created_at)) }}
                                @if (!$return_from_the_client->finalized_at)
                                    <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                @else
                                    <span class="text-success"><i class="far fa-check-square"></i></span>
                                @endif</h4>
                    </div>
                    <div class="col-6">
                        <div class="row text-right">
                            <!--finalize-->
                            <div class="col-1">                                
                                <button type="button" class="btn btn-success btn-sm btn-simple @if($return_from_the_client->finalized_at) disabled @endif" onclick="confirm('ATTENTION: At the end of this Return from the client you will not be able to load more products in it.') ? window.location.replace('{{ route('returns_from_the_client.finalize', $return_from_the_client) }}') : ''">
                                    <i class="fas fa-handshake"></i>
                                </button>
                            </div>
                            <!--pay-->
                            <div class="col-1">
                                <form action="{{ route('returns_from_the_client.pay', $return_from_the_client) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-pay @if(($return_from_the_client->total_amount + $return_from_the_client->transactions->sum('amount')) == 0) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.pay') }}"><i class="fas fa-dollar-sign"></i></button>
                                </form>
                            </div>
                            <!--print-->
                            <div class="col-1">
                                <form action="{{ route('returns_from_the_client.print', $return_from_the_client) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-print" data-toggle="tooltip" title="{{ __('inventory.print') }}"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            <!--delete-->
                            <div class="col-1">
                                <form action="{{ route('returns_from_the_client.destroy', ['return_from_the_client' => $return_from_the_client]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-simple btn-sm btn-delete @if($return_from_the_client->products->count() != 0) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.delete') }}"><i class="fas fa-times"></i></button>
                                </form>
                            </div>                            
                            <!--thumb-->
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <!--index-->
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm" href="{{ route('returns_from_the_client.index') }}" data-toggle="tooltip" title="Back to list"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---->
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                        <div class="row text-info">
                                <div class="col-3">{{ __('inventory.warehouse') }}</div><div class="col-9">{{ $return_from_the_client->warehouse->name }}</div>
                            </div>
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.user') }}</div><div class="col-9">{{ $return_from_the_client->user->name }}</div>
                            </div>
                            <div class="row text-info">
                                <div class="col-3">{{ __('inventory.client') }}</div><div class="col-9"><a href="{{ route('clients.show', $return_from_the_client->client) }}">{{ $return_from_the_client->client->name }}</a></div>
                            </div>
                        </div>
                        <div class="col-6">
                            @if($return_from_the_client->reference_type == "sale")
                            <div class="row text-success">
                                <div class="col-3">{{ __('inventory.reference_doc') }}</div>
                                <div class="col-9">
                                    <a href="{{ route('sales.show', $return_from_the_client->reference_id) }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        {{ __('inventory.sale') }} №{{ $return_from_the_client->reference_id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($return_from_the_client->created_at)) }}
                                    </a>
                                </div>
                            </div>
                            @endif
                           @foreach($return_from_the_client->transactions as $transaction)
                            <div class="row text-success">
                                <div class="col-3"></div>
                                <div class="col-9">
                                    <a href="{{ route('transactions.edit', $transaction->id) }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        {{ __('inventory.return_from_the_client_transaction') }} №{{ $transaction->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($transaction->created_at)) }} {{ $transaction->amount }}
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
</div>
<!-- products -->
<div class="row">
    <div class="col-12">
        <div class="card" style="height:560px;position:relative;">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{ __('inventory.products') }}</h4>
                    </div>
                    <div class="col-6">
                        <div class="row text-right">
                            <div class="col-1">
                                <a class="btn btn-sm btn-simple btn-selector btn-sm @if($return_from_the_client->finalized_at) disabled @endif" onclick="return_from_the_client_add_single_product('{{$return_from_the_client->id}}');" data-toggle="tooltip" title="Add product"><i class="fas fa-plus"></i></a>                             
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-delete btn-sm @if($return_from_the_client->finalized_at) disabled @endif" href="{{ route('returns_from_the_client.product.clear', $return_from_the_client) }}" data-toggle="tooltip" title="{{ __('inventory.clear_table') }}"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive" id="selectedProductsTable">
                    <table class="table">
                        <thead class=" text-primary">
                            <th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.brand') }}</th>
                            <th scope="col" style="width: 40%;">{{ __('inventory.product') }}</th>
                            <th scope="col" class="text-center" style="width: 5%;">{{ __('inventory.stock') }}</th>
                            <th scope="col" class="text-center" style="width: 5%;">{{ __('inventory.quantity') }}</th>
                            <th scope="col" class="text-center" style="width: 10%;">{{ __('inventory.price') }}</th>
                            <th scope="col" class="text-center" style="width: 10%;">{{ __('inventory.total') }}</th>
                        </thead>
                        <tbody>
                        @foreach ($return_from_the_client->products as $item)
                            <tr id="return_from_the_client_selected_product-{{ $item->product_id }}" class="pointer" ondblclick="return_from_the_client_edit_product('{{$return_from_the_client->id}}','{{ $item->product_id }}');">
                                <td scope="col" class="article">{{ $item->product->article }}</td>
                                <td scope="col" class="brand">{{ $item->product->brand }}</td>
                                <td scope="col" class="name">{{ $item->product->name }}</td>
                                <td scope="col" class="text-center stock">{{ number_format($item->product->stocks()->sum('quantity') ?? 0, 2) }}</td>
                                <td scope="col" class="text-center quantity">{{ number_format($item->quantity ?? 0, 2)}}</td>
                                <td scope="col" class="text-center price">{{ number_format($item->price ?? 0, 2)}}</td>
                                <td scope="col" class="text-center total_amount">{{ number_format($item->total_amount ?? 0, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                            <div class="col-3"><b><a OnClick="admincart_add_comment('{{$return_from_the_client->id}}')">{{ __('inventory.comment') }}</a></b></div>
                            <div class="col-9" id="admincartComment">{{ $return_from_the_client->comment }}</div>
                        </div>
                        <div class="row">
                            @if($return_from_the_client->client->comment)
                                <div class="col-3"><b>{{ __('inventory.clientComment') }}</b></div>
                                <div class="col-9">{{ $return_from_the_client->client->comment }}</div>
                            @endif
                        </div>                        
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.products') }} / {{ __('inventory.total_quantity') }}</b></div>
                            <div class="col-3"><span name="docCount">{{ number_format($return_from_the_client->docCount ?? 0, 2)  }}</span> / <span name="docQuantity">{{ number_format($return_from_the_client->docQuantity ?? 0, 2) }}</span></div>
                        </div>
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.total_cost') }}</b></div>                            
                            <div class="col-3"><span name="docTotal">{{ number_format($return_from_the_client->docTotal ?? 0, 2) }}</span> ({{ $return_from_the_client->currency }})</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection