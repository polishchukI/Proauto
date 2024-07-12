@extends('inventory.layouts.app', ['page' => __('inventory.new_client_order'), 'pageSlug' => 'client_orders-create', 'section' => 'documents', 'search' => 'client_orders'])

@section('content')
    
    @include('inventory.alerts.error')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('inventory.new_client_order') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('client_orders.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('client_orders.store') }}" autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('inventory.client_information') }}</h6>
							<div class="row">
								<div class="col-lg-3">
									<input type="hidden" name="user_id" value="{{ Auth::id() }}">
									<div class="form-group{{ $errors->has('clientLive') ? ' has-danger' : '' }}">
										<label class="form-control-label" for="clientLive">{{ __('inventory.client') }}</label>
										<select name="clientLive" id="clientLive">
											<option value="">{{ __('modal.not_specified') }}</option>
										</select>
										@include('inventory.alerts.feedback', ['field' => 'client_id'])
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group{{ $errors->has('currency') ? ' has-danger' : '' }}">
										<label class="form-control-label" for="input-currency">{{ __('inventory.currency') }}</label>
										<select name="currency" id="input-currency" class="form-select form-control-alternative{{ $errors->has('client') ? ' is-invalid' : '' }}">
											<option value="">{{ __('modal.not_specified') }}</option>
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
								<div class="col-lg-3">
									<input type="hidden" name="user_id" value="{{ Auth::id() }}">
									<div class="form-group{{ $errors->has('warehouse') ? ' has-danger' : '' }}">
										<label class="form-control-label" for="input-warehouse">{{ __('inventory.warehouse') }}</label>
										<select name="warehouse_id" id="input-warehouse" class="form-select form-control-alternative{{ $errors->has('client') ? ' is-invalid' : '' }}">
											<option value="">{{ __('modal.not_specified') }}</option>
											@foreach ($warehouses as $warehouse)
												@if(auth()->user()->default_warehouse_id != 0 && $warehouse['id'] == auth()->user()->warehouse->id)
													<option value="{{auth()->user()->warehouse->id}}" selected>{{ auth()->user()->warehouse->name }}</option>
												@else
													<option value="{{$warehouse['id']}}">{{$warehouse['name']}}</option>
												@endif
											@endforeach
										</select>
										@include('inventory.alerts.feedback', ['field' => 'warehouse'])
									</div>
								</div>
								<div class="col-lg-3">
									<div class="text-center">
										<button type="submit" class="btn btn-success btn-simple btn-sm mt-4">{{ __('inventory.save') }}</button>
									</div>
								</div>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection


@push('js')
<script defer>
document.addEventListener("DOMContentLoaded", () => 
{
    const clientLive = new SlimSelect({
        select: '#clientLive',
        placeholder: '{{ __('inventory.search_product') }}',
        searchingText: '{{ __('inventory.search') }}',
        ajax(search, callback) {
			// console.log(search);
            if (search.length < 3)
            {
                callback('Need 3 characters')
                return
            }

            fetch('/clientLiveSearch', {
                method: 'POST',
                data: {clientLive:clientLive},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    clientLive:search,
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
</script>
@endpush