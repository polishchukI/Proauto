@extends('inventory.layouts.app', ['page' => 'Edit Employee', 'pageSlug' => 'employees', 'section' => 'salary_management', 'search' => 'employees'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <h3 class="mb-0">Edit Employee</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('employees.index') }}" class="btn btn-sm btn-simple"><i class="fas fa-arrow-left"></i></a>
                            </div>
                            <a href="{{ route('employees.fire', $employee) }}" class="btn btn-sm btn-simple" data-toggle="tooltip" data-placement="bottom" title="Fire Employee">
                                <i class="fab fa-gripfire"></i>
							</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('employees.update', $employee) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">Employee Information</h6>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-lastname">lastname</label>
                                        <input type="text" name="lastname" id="input-lastname" class="form-control form-control-alternative{{ $errors->has('lastname') ? ' is-invalid' : '' }}" placeholder="lastname" value="{{ old('lastname', $employee->lastname) }}" autofocus>
                                        @include('inventory.alerts.feedback', ['field' => 'lastname'])
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group{{ $errors->has('firstname') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-firstname">firstname</label>
                                        <input type="text" name="firstname" id="input-firstname" class="form-control form-control-alternative{{ $errors->has('firstname') ? ' is-invalid' : '' }}" placeholder="firstname" value="{{ old('firstname', $employee->firstname) }}" autofocus>
                                        @include('inventory.alerts.feedback', ['field' => 'firstname'])
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group{{ $errors->has('secondname') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-secondname">secondname</label>
                                        <input type="text" name="secondname" id="input-secondname" class="form-control form-control-alternative{{ $errors->has('secondname') ? ' is-invalid' : '' }}" placeholder="secondname" value="{{ old('secondname', $employee->secondname) }}">
                                        @include('inventory.alerts.feedback', ['field' => 'secondname'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-control-label" for="input-isuser">Is user</label>
                                    <select name="isuser" id="input-isuser" class="form-select form-control-alternative{{ $errors->has('isuser') ? ' is-invalid' : '' }}" required>                                            
                                        @foreach (['False' => 'No', 'True' => 'Yes'] as $key=>$value)
                                        @if($key == old('isuser') or $key == $employee->isuser)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="form-control-label" for="input-isworker">Is worker</label>
                                    <select name="isworker" id="input-isworker" class="form-select form-control-alternative{{ $errors->has('isworker') ? ' is-invalid' : '' }}" required>                                            
                                        @foreach (['False' => 'No', 'True' => 'Yes'] as $key=>$value)
                                        @if($key == old('isworker') or $key == $employee->isworker)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="form-control-label" for="input-user_id">Is user</label>
                                    <select name="user_id" id="input-user_id" class="form-select form-control-alternative{{ $errors->has('user_id') ? ' is-invalid' : '' }}">
                                        <option value="">{{ __('inventory.not_specified') }}</option>
                                        @foreach ($users as $user)
                                        @if($user->id == old('user_id') or $user->id == $employee->user_id)
                                        <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                        @else
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endif
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