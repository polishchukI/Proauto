@extends('inventory.layouts.app', ['page' => __('inventory.new_client'), 'pageSlug' => 'clients-create', 'section' => 'clients', 'search' => 'clients'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{__('inventory.new_client')}}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('clients.index') }}" class="btn btn-sm btn-simple btn-back"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('clients.store') }}" autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{__('inventory.client_information')}}</h6>
                            <div class="pl-lg-4">
								<div class="row">
                                    <div class="col-3">
										<div class="form-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-lastname">{{__('inventory.lastname')}}</label>
											<input type="text" name="lastname" id="input-lastname" class="form-control form-control-alternative{{ $errors->has('lastname') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.lastname')}}" autofocus>
											@include('inventory.alerts.feedback', ['field' => 'lastname'])
										</div>
									</div>
                                    <div class="col-3">
										<div class="form-group{{ $errors->has('firstname') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-firstname">{{__('inventory.firstname')}}</label>
											<input type="text" name="firstname" id="input-firstname" class="form-control form-control-alternative{{ $errors->has('firstname') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.firstname')}}" autofocus>
											@include('inventory.alerts.feedback', ['field' => 'firstname'])
										</div>
                                    </div>
                                    <div class="col-3">
										<div class="form-group{{ $errors->has('secondname') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-secondname">{{__('inventory.secondname')}}</label>
											<input type="text" name="secondname" id="input-secondname" class="form-control form-control-alternative{{ $errors->has('secondname') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.secondname')}}" autofocus>
											@include('inventory.alerts.feedback', ['field' => 'secondname'])
										</div>
									</div>
									<div class="col-3">
										<div class="form-group{{ $errors->has('birthday') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-birthday">{{__('inventory.birthday')}}</label>
											<input type="date" name="birthday" id="input-birthday" class="form-control form-control-alternative{{ $errors->has('birthday') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.birthday')}}">
											@include('inventory.alerts.feedback', ['field' => 'birthday'])
										</div>
									</div>
                                </div>
								<div class="row">
									<div class="col-6">
										<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-name">{{__('inventory.name')}}</label>
											<input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.name')}}" autofocus>
											@include('inventory.alerts.feedback', ['field' => 'name'])
										</div>
									</div>
									<div class="col-2">
										<div class="form-group{{ $errors->has('product_discount') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-product_discount">{{__('inventory.product_discount')}}</label>
											<input type="number" name="product_discount" id="input-product_discount" max="10" class="form-control form-control-alternative{{ $errors->has('product_discount') ? ' is-invalid' : '' }}" value="0" placeholder="{{__('inventory.product_discount')}}">
											@include('inventory.alerts.feedback', ['field' => 'product_discount'])
										</div>
									</div>
									<div class="col-2">
										<div class="form-group{{ $errors->has('service_discount') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-service_discount">{{__('inventory.service_discount')}}</label>
											<input type="number" name="service_discount" id="input-service_discount" max="10" class="form-control form-control-alternative{{ $errors->has('service_discount') ? ' is-invalid' : '' }}" value="0" placeholder="{{__('inventory.service_discount')}}">
											@include('inventory.alerts.feedback', ['field' => 'service_discount'])
										</div>
									</div>
                                    <div class="col-2">
										<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-email">{{__('inventory.email')}}</label>
											<input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.email')}}">
											@include('inventory.alerts.feedback', ['field' => 'email'])
										</div>
									</div>
                                </div>
								<div class="row">									
									<div class="col-10">
										<div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
											<label class="form-control-label" for="input-comment">{{__('inventory.comment')}}</label>
											<input type="text" name="comment" id="input-comment" class="form-control form-control-alternative{{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="{{__('inventory.comment')}}">
											@include('inventory.alerts.feedback', ['field' => 'comment'])
										</div>
									</div>
									<div class="col-2 mt-4">
										<button type="submit" class="btn btn-sm btn-simple btn-success">{{__('inventory.save')}}</button>
									</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
