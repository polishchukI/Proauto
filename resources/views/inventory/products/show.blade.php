@extends('inventory.layouts.app', ['page' => __('inventory.product_information'), 'pageSlug' => 'products', 'section' => 'inventory', 'search' => 'products'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!------>
                <div class="card-body">
                    <!-- <image> -->
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-9">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('inventory.name') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.name') }}" value="{{ old('name', $product->name) }}" disabled>
                                        </div>
                                </div>
                                <div class="col-3">                                    
                                    <div class="form-group{{ $errors->has('article') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-article">{{ __('inventory.article') }}</label>
                                        <input type="text" name="article" id="input-article" class="form-control form-control-alternative{{ $errors->has('article') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.article') }}" value="{{ $product->article }}" disabled>
                                       </div>
                                </div>		
                            </div>
                            <div class="row">
                                <div class="col-9">
                                    <div class="form-group{{ $errors->has('full_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-full_name">{{ __('inventory.full_name') }}</label>
                                        <input type="text" name="full_name" id="input-full_name" class="form-control form-control-alternative" placeholder="{{ __('inventory.full_name') }}" value="{{ $product->full_name }}" disabled>
                                        @include('inventory.alerts.feedback', ['field' => 'full_name'])
                                    </div>
                                </div>
                                <div class="col-3">                                    
                                    <div class="form-group{{ $errors->has('article') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-article">{{ __('inventory.id') }}</label>
                                        <input type="text" name="article" id="input-article" class="form-control form-control-alternative{{ $errors->has('article') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.article') }}" value="{{ $product->id }}" disabled>
                                    </div>
                                </div>			
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <label class="form-control-label" for="input-name">{{ __('inventory.product_category') }}</label>
                                    <input type="text" name="full_name" id="input-full_name" class="form-control form-control-alternative" placeholder="{{ __('inventory.product_category') }}" value="{{ $product->category->name }}" disabled>
                                </div>
                                <div class="col-3">
                                    <label class="form-control-label" for="input-name">{{ __('inventory.group') }}</label>
                                    <input type="text" name="full_name" id="input-full_name" class="form-control form-control-alternative" placeholder="{{ __('inventory.group') }}" value="{{ $product->group->id }} - {{ $product->group->name }}" disabled>
                                </div>
                                <div class="col-3">
                                    <label class="form-control-label" for="input-product_price_group">{{ __('inventory.product_price_group') }}</label>
                                    <input type="text" name="full_name" id="input-full_name" class="form-control form-control-alternative" placeholder="{{ __('inventory.product_price_group') }}" value="{{ $product->product_price_group->name ?? ''}}" disabled>
                                </div>
                                <div class="col-3">
                                    <label class="form-control-label" for="input-brand">{{ __('inventory.brand') }}</label>
                                    <input type="text" name="full_name" id="input-full_name" class="form-control form-control-alternative" placeholder="{{ __('inventory.brand') }}" value="{{ $product->brand }}" disabled>
                                </div>	
                            </div>
                            <div class="row">
                                <div class="col-9">
                                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-description">{{ __('inventory.description') }}</label>
                                        <input type="text" name="description" id="input-description" class="form-control form-control-alternative" placeholder="{{ __('inventory.description') }}" value="{{ $product->description }}" disabled>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group{{ $errors->has('weight') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-weight">{{ __('inventory.weight') }}</label>
                                        <input type="text" name="weight" id="input-weight" class="form-control form-control-alternative" placeholder="{{ __('inventory.weight') }}" value="{{ $product->weight }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ __('inventory.stock') }}</th>
                                                <th scope="col">{{ __('inventory.base_price') }}</th>
                                                <th scope="col">{{ __('inventory.retail_price') }}</th>
                                                <th scope="col">{{ __('inventory.total_sales') }}</th>
                                                <th scope="col">{{ __('inventory.income_produced') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ number_format($product->stocks()->sum('quantity') ?? 0, 2)}}</td>
                                                <td>{{ number_format($product->price_in ?? 0, 2)}}</td>
                                                <td>{{ number_format($product->price_out ?? 0, 2)}}</td>
                                                <td>{{ number_format($product->solds->sum('quantity') ?? 0, 2)}}</td>
                                                <td>{{ number_format($product->solds->sum('total_amount') ?? 0, 2)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-simple btn-selector btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit_product') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('products.index') }}" class="btn btn-simple btn-sm btn-back"><i class="fas fa-arrow-left"></i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ $product->image }}" alt="...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
    </div>
	<!---->
    <div class="row">
        <div class="col-12">
            <div class="card" style="height:560px;position:relative;">
                <div class="card-body" style="max-height:100%;overflow:auto;">
					<ul class="nav nav-pills nav-pills-primary nav-pills-icons">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#nav-provider_prices">{{ __('inventory.provider_prices') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-sales">{{ __('inventory.sales') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-receipts">{{ __('inventory.receipts') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-crosses">{{ __('inventory.crosses') }}</a></li>

						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-min_stocks">{{ __('inventory.min_stocks') }}</a></li>
                        @if($product->product_category_id !== 1)
                            @if($product->product_category_id == 2)
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-bulbs">{{ __('inventory.bulbs') }}</a></li>
                            @endif
                            @if($product->product_category_id == 3)
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-batteries">{{ __('inventory.batteries') }}</a></li>
                            @endif
                            @if($product->product_category_id == 4)
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-tyres">{{ __('inventory.tyres') }}</a></li>
                            @endif
                            @if($product->product_category_id == 5)
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-oils">{{ __('inventory.oils') }}</a></li>
                            @endif
                            @if($product->product_category_id == 6)
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-rims">{{ __('inventory.rims') }}</a></li>
                            @endif
                            @if($product->product_category_id == 7)
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-tools">{{ __('inventory.tools') }}</a></li>
                            @endif
                            @if($product->product_category_id == 8)
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-alternators">{{ __('inventory.alternators') }}</a></li>
                            @endif
                            @if($product->product_category_id == 9)
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#nav-starters">{{ __('inventory.starters') }}</a></li>
                            @endif
                        @endif						
					</ul>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-provider_prices" role="tabpanel" aria-labelledby="nav-provider_prices-tab">
                            <table class="table">
                                <thead>
                                    <th>{{ __('inventory.provider') }}</th>
                                    <th>{{ __('inventory.stock') }}</th>
                                    <th>{{ __('inventory.available') }}</th>
                                    <th>{{ __('inventory.provider_days') }}</th>
                                    <th>{{ __('inventory.income_price') }}</th>
                                    <th>{{ __('inventory.price') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($product->provider_prices as $price)
                                        <tr>
                                            <td>{{ $price->provider }}</td>
                                            <td>{{ $price->stock }}</td>
                                            <td>{{ $price->available }}</td>
                                            <td>{{ $price->day }}</td>
                                            <td>{{ $price->src }}</td>
                                            <td>{{ $price->price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-sales" role="tabpanel" aria-labelledby="nav-sales-tab">
                            <table class="table">
                                <thead>
                                    <th>{{ __('inventory.sale') }}</th>
                                    <th>{{ __('inventory.client') }}</th>
                                    <th>{{ __('inventory.quantity') }}</th>
                                    <th>{{ __('inventory.price') }}</th>
                                    <th>{{ __('inventory.total_amount') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($solds as $sold)
                                        <tr>
                                        <td><a href="{{ route('sales.show', $sold->sale) }}">{{ __('inventory.sale') }} №{{ $sold->sale_id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($sold->created_at)) }}</a></td>
                                            <td style="max-width:150px;">{{ $sold->sale->client->full_name }}</td>
                                            <td>{{ $sold->quantity }}</td>
                                            <td>{{ $sold->price }}</td>
                                            <td>{{ $sold->total_amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-receipts" role="tabpanel" aria-labelledby="nav-receipts-tab">
                            <table class="table">
                                <thead>
                                    <th>{{ __('inventory.receipt') }}</th>
                                    <th>{{ __('inventory.provider') }}</th>
                                    <th>{{ __('inventory.quantity') }}</th>
                                    <th>{{ __('inventory.price') }}</th>
                                    <th>{{ __('inventory.total_amount') }}</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($receiveds as $received)
                                        <tr>
                                            <td><a href="{{ route('receipts.show', $received->receipt) }}">{{ __('inventory.receipt') }} №{{ $received->receipt_id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($received->created_at)) }}</a></td>
                                            <td style="max-width:150px;">{{ $received->receipt->provider->name }}</td>
                                            <td>{{ $received->quantity }}</td>
                                            <td>{{ $received->price }}</td>
                                            <td>{{ $received->total_amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-crosses" role="tabpanel" aria-labelledby="nav-crosses-tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
                                        <th scope="col" style="width: 15%;">{{ __('inventory.brand') }}</th>
                                        <th scope="col" style="width: 40%;">{{ __('inventory.name') }}</th>
                                        <th scope="col" style="width: 15%;">{{ __('modal.main_by_group') }}</th>
                                        <th scope="col" style="width: 15%;">{{ __('modal.main_by_brand') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($crosses as $cross)
                                    <tr>
                                        <td>{{ $cross->article }}</td>
                                        <td>{{ $cross->brand }}</td>
                                        <td>
                                        @if(!is_null($cross->product))
                                            <a href="{{ route('products.show', $cross->product) }}" data-toggle="tooltip" data-placement="bottom" title="Show cross product">
                                                {{ $product->name}}
                                            </a>
                                            @else
                                            Part not present in base
                                            @endif</td>
                                        <td>
                                            @if ($cross->main_by_group == 0)
                                            <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else
                                            <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif                                        
                                        </td>
                                        <td>
                                            @if ($cross->main_by_brand == 0)
                                            <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else
                                            <span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif                                        
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-min_stocks" role="tabpanel" aria-labelledby="nav-min_stocks-tab">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('inventory.date') }}</th>
                                            <th>{{ __('inventory.warehouse') }}</th>
                                            <th>{{ __('inventory.min_stock') }}</th>                                            
                                        </tr>
                                    </thead>
                                <tbody>
                                @foreach($product->minimal_stocks as $min_stock)
                                    <tr>
                                        @if($min_stock->updated_at)
                                        <td>{{ $min_stock->updated_at }}</td>
                                        @else
                                        <td>{{ $min_stock->created_at }}</td>
                                        @endif
                                        <td>{{ $min_stock->warehouse->name }}</td>
                                        <td>{{ $min_stock->quantity }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--  -->
                    @if($product->product_category_id !== 1)
                            @if($product->product_category_id == 2)
                            <div class="tab-pane fade" id="nav-bulbs" role="tabpanel" aria-labelledby="nav-bulbs-tab">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('inventory.param') }}</th>
                                                <th>{{ __('inventory.value') }}</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                            @if($product->product_category_id == 3)
                            <div class="tab-pane fade" id="nav-batteries" role="tabpanel" aria-labelledby="nav-batteries-tab">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('inventory.param') }}</th>
                                                <th>{{ __('inventory.value') }}</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>                            
                                            <tr><td>{{ __('inventory.battery_width') }}</td><td>{{ $product->battery->width }}</td></tr>
                                            <tr><td>{{ __('inventory.battery_height') }}</td><td>{{ $product->battery->height }}</td></tr>
                                            <tr><td>{{ __('inventory.battery_length') }}</td><td>{{ $product->battery->length }}</td></tr>
                                            @if($product->battery->voltage) <tr><td>{{ __('inventory.battery_voltage') }}</td><td>{{ $product->battery->voltage }}</td></tr> @endif
                                            @if($product->battery->capacity) <tr><td>{{ __('inventory.battery_capacity') }}</td><td>{{ $product->battery->capacity }}</td></tr> @endif
                                            @if($product->battery->polarity) <tr><td>{{ __('inventory.battery_polarity') }}</td><td>{{ $product->battery->polarity }}</td></tr> @endif
                                            @if($product->battery->starting_current) <tr><td>{{ __('inventory.battery_starting_current') }}</td><td>{{ $product->battery->starting_current }}</td></tr> @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                            @if($product->product_category_id == 4)
                            <div class="tab-pane fade" id="nav-tyres" role="tabpanel" aria-labelledby="nav-tyres-tab">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('inventory.param') }}</th>
                                                <th>{{ __('inventory.value') }}</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>                            
                                            <tr><td>{{ __('inventory.tyre_width') }}</td><td>{{ $product->tyre->width }}</td></tr>
                                            <tr><td>{{ __('inventory.tyre_height') }}</td><td>{{ $product->tyre->height }}</td></tr>
                                            <tr><td>{{ __('inventory.tyre_size') }}</td><td>{{ $product->tyre->size }}</td></tr>
                                            @if($product->tyre->type) <tr><td>{{ __('inventory.tyre_type') }}</td><td>{{ $product->tyre->type }}</td></tr> @endif
                                            @if($product->tyre->load_index) <tr><td>{{ __('inventory.tyre_load_index') }}</td><td>{{ $product->tyre->load_index }}</td></tr> @endif
                                            @if($product->tyre->speed_rating) <tr><td>{{ __('inventory.tyre_speed_rating') }}</td><td>{{ $product->tyre->speed_rating }}</td></tr> @endif
                                            @if($product->tyre->car_type) <tr><td>{{ __('inventory.tyre_car_type') }}</td><td>{{ $product->tyre->car_type }}</td></tr> @endif
                                            @if($product->tyre->season) <tr><td>{{ __('inventory.tyre_season') }}</td><td>{{ $product->tyre->season }}</td></tr> @endif
                                            @if($product->tyre->rim_protection) <tr><td>{{ __('inventory.tyre_rim_protection') }}</td><td>{{ $product->tyre->rim_protection }}</td></tr> @endif
                                            @if($product->tyre->run_flat) <tr><td>{{ __('inventory.tyre_run_flat') }}</td><td>{{ $product->tyre->run_flat }}</td></tr> @endif
                                            @if($product->tyre->spikes) <tr><td>{{ __('inventory.tyre_spikes') }}</td><td>{{ $product->tyre->spikes }}</td></tr> @endif
                                            @if($product->tyre->extra_load_reinforced) <tr><td>{{ __('inventory.tyre_extra_load_reinforced') }}</td><td>{{ $product->tyre->extra_load_reinforced }}</td></tr> @endif
                                            @if($product->tyre->c_type) <tr><td>{{ __('inventory.tyre_c_type') }}</td><td>{{ $product->tyre->c_type }}</td></tr> @endif
                                            @if($product->tyre->model) <tr><td>{{ __('inventory.tyre_model') }}</td><td>{{ $product->tyre->model }}</td></tr> @endif
                                            @if($product->tyre->name) <tr><td>{{ __('inventory.tyre_name') }}</td><td>{{ $product->tyre->name }}</td></tr> @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                            @if($product->product_category_id == 5)
                            <div class="tab-pane fade" id="nav-oils" role="tabpanel" aria-labelledby="nav-oils-tab">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('inventory.param') }}</th>
                                                <th>{{ __('inventory.value') }}</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>                            
                                            {{-- <tr><td>{{ __('inventory.tyre_width') }}</td><td>{{ $product->tyre->width }}</td></tr>
                                            <tr><td>{{ __('inventory.tyre_height') }}</td><td>{{ $product->tyre->height }}</td></tr>
                                            <tr><td>{{ __('inventory.tyre_size') }}</td><td>{{ $product->tyre->size }}</td></tr>
                                            @if($product->tyre->type) <tr><td>{{ __('inventory.tyre_type') }}</td><td>{{ $product->tyre->type }}</td></tr> @endif
                                            @if($product->tyre->load_index) <tr><td>{{ __('inventory.tyre_load_index') }}</td><td>{{ $product->tyre->load_index }}</td></tr> @endif
                                            @if($product->tyre->speed_rating) <tr><td>{{ __('inventory.tyre_speed_rating') }}</td><td>{{ $product->tyre->speed_rating }}</td></tr> @endif
                                            @if($product->tyre->car_type) <tr><td>{{ __('inventory.tyre_car_type') }}</td><td>{{ $product->tyre->car_type }}</td></tr> @endif
                                            @if($product->tyre->season) <tr><td>{{ __('inventory.tyre_season') }}</td><td>{{ $product->tyre->season }}</td></tr> @endif
                                            @if($product->tyre->rim_protection) <tr><td>{{ __('inventory.tyre_rim_protection') }}</td><td>{{ $product->tyre->rim_protection }}</td></tr> @endif
                                            @if($product->tyre->run_flat) <tr><td>{{ __('inventory.tyre_run_flat') }}</td><td>{{ $product->tyre->run_flat }}</td></tr> @endif
                                            @if($product->tyre->spikes) <tr><td>{{ __('inventory.tyre_spikes') }}</td><td>{{ $product->tyre->spikes }}</td></tr> @endif
                                            @if($product->tyre->extra_load_reinforced) <tr><td>{{ __('inventory.tyre_extra_load_reinforced') }}</td><td>{{ $product->tyre->extra_load_reinforced }}</td></tr> @endif
                                            @if($product->tyre->c_type) <tr><td>{{ __('inventory.tyre_c_type') }}</td><td>{{ $product->tyre->c_type }}</td></tr> @endif
                                            @if($product->tyre->model) <tr><td>{{ __('inventory.tyre_model') }}</td><td>{{ $product->tyre->model }}</td></tr> @endif
                                            @if($product->tyre->name) <tr><td>{{ __('inventory.tyre_name') }}</td><td>{{ $product->tyre->name }}</td></tr> @endif --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                            @if($product->product_category_id == 6)
                            
                            @endif
                            @if($product->product_category_id == 7)
                            
                            @endif
                            @if($product->product_category_id == 8)
                            
                            @endif
                            @if($product->product_category_id == 9)
                            
                            @endif
                        @endif
                    <!--  -->                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
