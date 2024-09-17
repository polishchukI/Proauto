@extends('inventory.layouts.app', ['page' => __('inventory.return_to_provider_edit'), 'pageSlug' => 'returns_to_provider', 'section' => 'documents', 'search' => 'returns_to_provider'])

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
                        <h4 class="card-title">{{ __('inventory.return_to_provider') }} №{{ $return_to_provider->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($return_to_provider->created_at)) }}
                                @if (!$return_to_provider->finalized_at)
                                    <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                @else
                                    <span class="text-success"><i class="far fa-check-square"></i></span>
                                @endif</h4>
                    </div>
                    <div class="col-6">
                        <div class="row text-right">
                            <!--finalize-->
                            <div class="col-1">                                
                                <button type="button" class="btn btn-success btn-sm btn-simple @if($return_to_provider->finalized_at) disabled @endif" onclick="confirm('ATTENTION: At the end of this Return from the provider you will not be able to load more products in it.') ? window.location.replace('{{ route('returns_to_provider.finalize', $return_to_provider) }}') : ''">
                                    <i class="fas fa-handshake"></i>
                                </button>
                            </div>
                            <!--pay-->
                            <div class="col-1">
                                <form action="{{ route('returns_to_provider.pay', $return_to_provider) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-pay @if(($return_to_provider->total_amount - $return_to_provider->transactions->sum('amount')) == 0) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.pay') }}"><i class="fas fa-dollar-sign"></i></button>
                                </form>
                            </div>
                            <!--print-->
                            <div class="col-1">
                                <form action="{{ route('returns_to_provider.print', $return_to_provider) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-print" data-toggle="tooltip" title="{{ __('inventory.print') }}"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            <!--delete-->
                            <div class="col-1">
                                <form action="{{ route('returns_to_provider.destroy', ['return_to_provider' => $return_to_provider]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-simple btn-sm btn-delete @if($return_to_provider->products->count() != 0) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.delete_document') }}"><i class="fas fa-times"></i></button>
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
                                <a class="btn btn-simple btn-sm" href="{{ route('returns_to_provider.index') }}" data-toggle="tooltip" title="Back to list"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---->
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row text-info">
                                <div class="col-md-3">{{ __('inventory.warehouse') }}</div><div class="col-md-9">{{ $return_to_provider->warehouse->name }}</div>
                            </div>
                            <div class="row text-info">
                                <div class="col-md-3">{{ __('inventory.user') }}</div><div class="col-md-9">{{ $return_to_provider->user->name }}</div>
                            </div>
                            <div class="row text-info">
                                <div class="col-md-3">{{ __('inventory.provider') }}</div><div class="col-md-9"><a href="{{ route('providers.show', $return_to_provider->provider) }}">{{ $return_to_provider->provider->name }}</a></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                @if($return_to_provider->provider->settlements->sum('total_amount') > 0)
                                <div class="col-9"><span class="text-success">{{ __('inventory.balance_positive') }}</span></div><div class="col-3"><span class="text-success">{{ $return_to_provider->provider->settlements->sum('total_amount') }}</span></div>
                                @elseif($return_to_provider->provider->settlements->sum('total_amount') < 0)
                                <div class="col-9"><span class="text-danger">{{ __('inventory.balance_negative') }}</span></div><div class="col-3"><span class="text-danger">{{ $return_to_provider->provider->settlements->sum('total_amount') }}</span></div>
                                @else
                                <div class="col-12"><span class="text-info">{{ __('inventory.balance_no_debt') }}</span></div>
                                @endif
                            </div>
                            @if($return_to_provider->reference_type == "receipt")
                            <div class="row text-success">
                                <div class="col-md-3">{{ __('inventory.reference_doc') }}</div>
                                <div class="col-md-9">
                                    <a href="{{ route('receipts.show', $return_to_provider->reference_id) }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        {{ __('inventory.receipt') }} №{{ $return_to_provider->reference_id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($return_to_provider->created_at)) }}
                                    </a>
                                </div>
                            </div>
                            @endif
                           @foreach($return_to_provider->transactions as $transaction)
                            <div class="row text-success">
                                <div class="col-3"></div>
                                <div class="col-9">
                                    <a href="{{ route('transactions.edit', $transaction->id) }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        {{ __('inventory.return_to_provider_transaction') }} №{{ $transaction->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($transaction->created_at)) }} {{ $transaction->amount }}
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
                                <a class="btn btn-sm btn-simple btn-selector btn-sm @if($return_to_provider->finalized_at) disabled @endif" onclick="return_to_provider_add_single_product('{{$return_to_provider->id}}');" data-toggle="tooltip" title="Add product"><i class="fas fa-plus"></i></a>                             
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-delete btn-sm @if($return_to_provider->finalized_at) disabled @endif" href="{{ route('returns_to_provider.product.clear', $return_to_provider) }}" data-toggle="tooltip" title="{{ __('inventory.clear_table') }}"><i class="fas fa-times"></i></a>
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
                            <th scope="col text-center" style="width: 5%;">{{ __('inventory.stock') }}</th>
                            <th scope="col text-center" style="width: 5%;">{{ __('inventory.quantity') }}</th>
                            <th scope="col text-center" style="width: 10%;">{{ __('inventory.price') }}</th>
                            <th scope="col text-center" style="width: 10%;">{{ __('inventory.total') }}</th>
                        </thead>
                        <tbody>
                        @foreach ($return_to_provider->products as $item)
                            <tr id="return_to_provider_selected_product-{{ $item->product_id }}" class="pointer" ondblclick="return_to_provider_edit_product('{{$return_to_provider->id}}','{{ $item->product_id }}');">
                                <td scope="col" class="article">{{ $item->product->article }}</td>
                                <td scope="col" class="brand">{{ $item->product->brand }}</td>
                                <td scope="col" class="name">{{ $item->product->name }}</td>
                                <td scope="col" class="text-center stock">{{ $item->product->stocks()->sum('quantity') ?? 0}}</td>
                                <td scope="col" class="text-center quantity">{{ $item->quantity }}</td>
                                <td scope="col" class="text-center price">{{ $item->price }}</td>
                                <td scope="col" class="text-center total_amount">{{ $item->total_amount }}</td>
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
                            <div class="col-md-3"><b><a OnClick="admincart_add_comment('{{$return_to_provider->id}}')">{{ __('inventory.comment') }}</a></b></div>
                            <div class="col-md-9" id="admincartComment">{{ $return_to_provider->comment }}</div>
                        </div>
                        <div class="row">
                            @if($return_to_provider->provider->comment)
                                <div class="col-md-3"><b>{{ __('inventory.providerComment') }}</b></div>
                                <div class="col-md-9">{{ $return_to_provider->provider->comment }}</div>
                            @endif
                        </div>                        
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-md-3"><b>{{ __('inventory.products') }} / {{ __('inventory.total_quantity') }}</b></div>
                            <div class="col-md-9">{{ $return_to_provider->products->count() }} / {{ $return_to_provider->products->sum('quantity') }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><b>{{ __('inventory.total_cost') }}</b></div>
                            <div class="col-md-9">{{ $return_to_provider->products->sum('total_amount') }} ({{ $return_to_provider->currency }})</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection