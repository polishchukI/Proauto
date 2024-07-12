@extends('inventory.layouts.app', ['page' => __('inventory.new_employee'), 'pageSlug' => 'employees', 'section' => 'salary_management', 'search' => 'employees'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('inventory.new_employee') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('employees.index') }}" class="btn btn-simple btn-sm btn-back"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('employees.store') }}" autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Employee Information</h6>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-lastname">{{ __('inventory.lastname') }}</label>
                                        <input type="text" name="lastname" id="input-lastname" class="form-control form-control-alternative{{ $errors->has('lastname') ? ' is-invalid' : '' }}" placeholder="lastname" value="{{ old('lastname') }}" autofocus>
                                        @include('inventory.alerts.feedback', ['field' => 'lastname'])
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group{{ $errors->has('firstname') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-firstname">{{ __('inventory.firstname') }}</label>
                                        <input type="text" name="firstname" id="input-firstname" class="form-control form-control-alternative{{ $errors->has('firstname') ? ' is-invalid' : '' }}" placeholder="firstname" value="{{ old('firstname') }}" autofocus>
                                        @include('inventory.alerts.feedback', ['field' => 'firstname'])
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group{{ $errors->has('secondname') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-secondname">{{ __('inventory.secondname') }}</label>
                                        <input type="text" name="secondname" id="input-secondname" class="form-control form-control-alternative{{ $errors->has('secondname') ? ' is-invalid' : '' }}" placeholder="secondname" value="{{ old('secondname') }}" autofocus>
                                        @include('inventory.alerts.feedback', ['field' => 'secondname'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-control-label" for="input-isuser">{{ __('inventory.isuser') }}</label>
                                    <select name="isuser" id="input-isuser" class="form-select form-control-alternative{{ $errors->has('isuser') ? ' is-invalid' : '' }}" required>                                            
                                        @foreach (['False' => 'No', 'True' => 'Yes'] as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="form-control-label" for="input-isworker">{{ __('inventory.isworker') }}</label>
                                    <select name="isworker" id="input-isworker" class="form-select form-control-alternative{{ $errors->has('isworker') ? ' is-invalid' : '' }}" required>
                                        @foreach (['False' => 'No', 'True' => 'Yes'] as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-sm btn-simple btn-success">{{ __('inventory.save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection