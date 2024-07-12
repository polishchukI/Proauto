@extends('inventory.layouts.app', ['page' => __('inventory.client_auto_information'), 'pageSlug' => 'client_autos', 'section' => 'inventory', 'search' => 'client_autos'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="mb-0">{{ __('inventory.client_auto_information') }}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('client_autos.edit', $client_auto) }}" class="btn btn-simple btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit_client_auto') }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('client_autos.index') }}" class="btn btn-simple btn-sm btn-back"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>VIN</th>
                        <th>Owner</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $client_auto->id }}</td>
                            <td>{{ $client_auto->name }}</td>
                            <td>{{ $client_auto->vin }}</td>
                            <td>
                                @if($client_auto->client)
                                <a href="{{ route('clients.show', $client_auto->client) }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                    {{ $client_auto->client->name }}
                                </a>
                                @else
                                <span>no client</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <> -->
<div class="row">
    <div class="col-xl-12 order-xl-1">
        <div class="card">            
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <h4 class="mb-0">{{ __('inventory.client_auto_service_parts') }}</h4>
                    </div>
                    <div class="col-2">
                        <div class="form-group{{ $errors->has('warehouse_id') ? ' has-danger' : '' }}">
                            <select name="warehouse_id" id="input-warehouse" class="form-select form-select-sm form-control-alternative{{ $errors->has('warehouse') ? ' is-invalid' : '' }}">
                                <option value="">{{ __('inventory.select_warehouse') }}</option>
                                @foreach ($warehouses as $warehouse)
                                @if(auth()->user()->default_warehouse_id != 0 && $warehouse['id'] == auth()->user()->warehouse->id)
											<option value="{{auth()->user()->warehouse->id}}" selected>{{ auth()->user()->warehouse->name }}</option>
										@else
                                    <option value="{{$warehouse['id']}}">{{$warehouse['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @include('inventory.alerts.feedback', ['field' => 'warehouse_id'])
                        </div>
                    </div>
                    <div class="col-2">						
                        <div class="form-group{{ $errors->has('currency') ? ' has-danger' : '' }}">
                            <select name="currency" id="input-currency" class="form-select form-select-sm form-control-alternative{{ $errors->has('currency') ? ' is-invalid' : '' }}">
                                <option value="">{{ __('inventory.select_currency') }}</option>
                                @foreach ($currencies as $currency)
                                @if(auth()->user()->default_currency != null && $currency['code'] == auth()->user()->default_currency)
										<option value="{{$currency['code']}}" selected>{{$currency['name']}}</option>
									@else
											<option value="{{$currency['code']}}">{{$currency['name']}}</option>
										@endif
                                @endforeach
                            </select>
                            @include('inventory.alerts.feedback', ['field' => 'currency'])
                        </div>
                    </div>
                    <div class="col-4 text-right">
                        <button id="client_auto_serviceparts_create_client_order" type="button" class="btn btn-sm btn-simple btn-client-order">{{ __('inventory.client_order') }}</button>
                        <button id="client_auto_serviceparts_create_sale" type="button" class="btn btn-sm btn-simple btn-sale">{{ __('inventory.sale') }}</button>
                    </div>
                </div>
            </div>
            <div class="card-body">				
                <input type="hidden" id="client_id" name="client_id" value="{{ $client_auto->client->id }}">
                <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                <div class="table-responsive">
                    <form id="form_client_auto_serviceparts" method="POST" action="{{ route('client_autos.servicepart.client_order.create') }}" autocomplete="off">
                    <table class="table" id="service_parts" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="display:none">{{ __('inventory.product_id') }}</th>
                                <th>{{ __('inventory.article') }}</th>
                                <th>{{ __('inventory.brand') }}</th>
                                <th>{{ __('inventory.name') }}</th>
                                <th>{{ __('inventory.stock') }}</th>
                                <th>{{ __('inventory.quantity') }}</th>
                                <th>{{ __('inventory.price') }}</th>
                                <th>{{ __('inventory.comment') }}</th>
                                <th></th>
                            </tr>
                        </thead>					
                        <tbody>								
                            @foreach($client_auto->serviceparts as $item)
                            <tr>
                                <td style="display:none"><input name="product_id" value="{{ $item->product->id }}"></td>
                                <td>{{ $item->product->article }}</td>
                                <td>{{ $item->product->brand }}</td>
                                <td>
                                    <a href="{{ route('products.show', $item->product) }}">{{ $item->product->name }}</a>
                                </td>
                                <td>{{ $item->product->stocks()->sum('quantity') ?? 0}}</td>
                                <td><input type="number" name="quantity" value="{{ $item->quantity }}" size="3" /></td>
                                <td></td>
                                <!-- <td>{{ $item->price ?? 0}}</td> -->
                                <td>{{ $item->comment }}</td>
                                <td><input type="checkbox" class="check" name="check"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection