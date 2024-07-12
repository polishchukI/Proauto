@extends('inventory.layouts.app', ['page' => __('inventory.manage_services_receipt'), 'pageSlug' => 'services_receipts', 'section' => 'services', 'search' => 'services_receipts'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{ __('inventory.services_receipt') }} №{{ $services_receipt->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($services_receipt->created_at)) }}
                                @if (!$services_receipt->finalized_at)
                                    <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                @else
                                    <span class="text-success"><i class="far fa-check-square"></i></span>
                                @endif</h4>
                    </div>
                    <div class="col-6">
                        <div class="row text-right">
                            <!--finalize-->
                            <div class="col-1">
                                <button type="button" class="btn btn-success btn-sm btn-simple @if($services_receipt->finalized_at) disabled @endif" onclick="confirm('ATTENTION: At the end of this receipt you will not be able to load more products in it.') ? window.location.replace('{{ route('services_receipts.finalize', $services_receipt) }}') : ''">
                                    <i class="fas fa-handshake"></i>
                                </button>
                            </div>
                            <!--pay-->
                            <div class="col-1">
                            <form action="{{ route('services_receipts.pay', $services_receipt) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-pay @if(($services_receipt->total_amount + $services_receipt->transactions->sum('amount')) != 0) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.pay') }}"><i class="fas fa-dollar-sign"></i></button>
                                </form>
                            </div>
                            <!--print-->
                            <div class="col-1">
                                <form action="{{ route('services_receipts.print', $services_receipt) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-print" data-toggle="tooltip" title="{{ __('inventory.print') }}"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            <!--delete-->

                            <div class="col-1">
                                <form action="{{ route('services_receipts.destroy', $services_receipt) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-delete btn-simple btn-sm @if (!$services_receipt->services->count() === 0) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.delete') }}"><i class="fas fa-times"></i></button>
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
                                <a class="btn btn-simple btn-sm btn-back" href="{{ route('services_receipts.index') }}" data-toggle="tooltip" title="Back to list"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">{{ __('inventory.warehouse') }}</div>
                                <div class="col-md-9">{{ $services_receipt->warehouse->name }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">{{ __('inventory.user') }}</div>
                                <div class="col-md-9">{{ $services_receipt->user->name }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">{{ __('inventory.provider') }}</div>
                                <div class="col-md-9"><a href="{{ route('providers.show', $services_receipt->provider) }}">{{ $services_receipt->provider->name }}</a></div>
                            </div>
                            @if (!is_null($services_receipt->provider_doc_number))
                            <div class="row text-success">
                                <div class="col-md-3">{{ __('inventory.provider_doc') }}</div>
                                <div class="col-md-9">{{ __('inventory.provider_doc_number') }} №{{ $services_receipt->provider_doc_number }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($services_receipt->provider_doc_date)) }}</div>
                            </div>
                            @endif
                            @if ($services_receipt->setup_prices === 1)
                            <div class="row text-success">
                                <div class="col-md-3">{{ __('inventory.setup_prices') }}</div>
                                <div class="col-md-9">{{ __('inventory.surcharge') }} {{ $services_receipt->surcharge }} {{ __('inventory.surcharge_coefficient') }} {{ $services_receipt->surcharge_coefficient }}</div>
                            </div>
                            @endif
                            @if ($services_receipt->is_gratuitous === 1)
                            <div class="row text-success">
                                <div class="col-md-3">{{ __('inventory.is_gratuitous') }}</div>
                                <div class="col-md-9"><span class="text-success"><i class="far fa-check-square"></i></span></div>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($services_receipt->reference_type == "to_provider_order")
                            <div class="row text-success">
                                <div class="col-md-3">{{ __('inventory.reference_doc') }}</div>
                                <div class="col-md-9">
                                    <a href="{{ route('to_provider_orders.show', $services_receipt->reference_id) }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        {{ __('inventory.to_provider_order') }} №{{ $services_receipt->reference_id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($services_receipt->created_at)) }}
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

<!-- services -->
<div class="row">
    <div class="col-12">
        <div class="card" style="height:500px;position:relative;">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{ __('inventory.services') }}</h4>
                    </div>
                    <div class="col-6">
                        <div class="row text-right">
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-selector @if($services_receipt->finalized_at) disabled @endif" onclick="services_receipt_add_service('{{$services_receipt->id}}');" data-toggle="tooltip" title="{{ __('inventory.service_selector') }}"><i class="fas fa-plus"></i></a>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-delete @if($services_receipt->finalized_at) disabled @endif" href="{{ route('services_receipts.service.clear', $services_receipt) }}" data-toggle="tooltip" title="{{ __('inventory.clear_table') }}"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive" id="selectedServicesTable">
                    <table class="table">
                        <thead class=" text-primary">
                            <th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
                            <th scope="col" style="width: 40%;">{{ __('inventory.service') }}</th>
                            <th scope="col text-center" style="width: 5%;">{{ __('inventory.quantity') }}</th>
                            <th scope="col text-center" style="width: 10%;">{{ __('inventory.price') }}</th>
                            <th scope="col text-center" style="width: 10%;">{{ __('inventory.total') }}</th>
                        </thead>
                        <tbody>
                        @foreach ($services_receipt->services as $item)
                            <tr id="services_receipt_selected_service-{{ $item->service_id }}" class="pointer" ondblclick="services_receipt_edit_service('{{$services_receipt->id}}','{{ $item->service_id }}');">
                                <td scope="col" class="article">{{ $item->service->article }}</td>
                                <td scope="col" class="name">{{ $item->service->name }}</td>
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
{{-- <div class="row text-success">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">{{ __('inventory.products') }}</div>
                    <div class="col-md-2"><span name="docCount">{{ number_format($services_receipt->docCount ?? 0, 2)  }}</span></div>
                    <div class="col-md-2">{{ __('inventory.total_quantity') }}</div>
                    <div class="col-md-2"><span name="docQuantity">{{ number_format($services_receipt->docQuantity ?? 0, 2) }}</span></div>
                    <div class="col-md-2">{{ __('inventory.total_cost') }}</div>
                    <div class="col-md-2"><span name="docTotal">{{ number_format($services_receipt->docTotal ?? 0, 2) }}</span> ({{ $services_receipt->currency }})</div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- document footer -->
<div class="row text-info">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-md-3"><b>{{ __('inventory.comment') }}</b></div>
                            <div class="col-md-9">{{ $services_receipt->comment }}</div>
                        </div>
                        <div class="row">
                        @if($services_receipt->provider->comment)
                            <div class="col-md-3"><b>{{ __('inventory.providerComment') }}</b></div>
                            <div class="col-md-9">{{ $services_receipt->provider->comment }}</div>
                        @endif
                        </div>                        
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.products') }} / {{ __('inventory.total_quantity') }}</b></div>
                            <div class="col-3"><span name="docCount">{{ number_format($services_receipt->docCount ?? 0, 2)  }}</span> / <span name="docQuantity">{{ number_format($services_receipt->docQuantity ?? 0, 2) }}</span></div>
                        </div>
                        <div class="row">
                            <div class="col-9"><b>{{ __('inventory.total_cost') }}</b></div>
                            <div class="col-3"><span name="docTotal">{{ number_format($services_receipt->docTotal ?? 0, 2) }}</span> ({{ $services_receipt->currency }})</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection