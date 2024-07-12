@extends('inventory.layouts.app', ['page' => 'New Order status', 'pageSlug' => 'order_statuses', 'section' => 'orders', 'search' => 'order_statuses'])

@section('content')
    
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Order status</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('order_statuses.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('order_statuses.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Order Status Information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
									<div class="col-4">                                    
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">Name</label>
                                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="Name" required>
                                            @include('inventory.alerts.feedback', ['field' => 'name'])
                                        </div>
                                    </div>
									<div class="col-4">                                    
                                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-description">Description</label>
                                            <input type="text" name="description" id="input-description" class="form-control form-control-alternative" placeholder="Description" required>
                                            @include('inventory.alerts.feedback', ['field' => 'description'])
                                        </div>
                                    </div>
									<div class="col-4">                                    
                                        <div class="form-group{{ $errors->has('status_color') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-status_color">Status color</label>
                                            <input type="text" name="status_color" id="input-status_color" class="form-control form-control-alternative" placeholder="Status color" required>
                                            @include('inventory.alerts.feedback', ['field' => 'status_color'])
                                        </div>
                                    </div>
								</div>
                                <div class="row">
                                    <div class="col-4">                                    
                                        <div class="form-group{{ $errors->has('telegram_notifications') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-telegram_notifications">Telegram notifications</label>
                                            <select name="telegram_notifications" id="input-telegram_notifications" class="form-control form-control-alternative{{ $errors->has('telegram_notifications') ? ' is-invalid' : '' }}" required>
                                            @foreach (['0'=>'No', '1'=>'Yes'] as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
									<div class="col-4">                                    
                                        <div class="form-group{{ $errors->has('status_notification') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-status_notification">Status notification</label>
                                            <select name="status_notification" id="input-status_notification" class="form-control form-control-alternative{{ $errors->has('status_notification') ? ' is-invalid' : '' }}" required>
                                            @foreach (['0'=>'No', '1'=>'Yes'] as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
									<div class="col-4">                                    
                                        <div class="form-group{{ $errors->has('order_status_subject') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-order_status_subject">Order status subject</label>
                                            <input type="text" name="order_status_subject" id="input-order_status_subject" class="form-control form-control-alternative" placeholder="Order status subject">
                                            @include('inventory.alerts.feedback', ['field' => 'order_status_subject'])
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                                    
                                    <div class="col-12">                                    
                                        <div class="form-group{{ $errors->has('template') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-template">Template</label>
                                            <input type="text" name="template" id="input-template" class="form-control form-control-alternative" placeholder="Template" >
                                            @include('inventory.alerts.feedback', ['field' => 'template'])
                                        </div>
                                    </div>
								</div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection