@extends('inventory.layouts.app', ['page' => 'Manage Salary Payment', 'pageSlug' => 'salary_payments', 'section' => 'salary_management', 'search' => 'salary_payments'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-md-6">
        <div class="card" style="height:500px;position:relative;">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                    <h4 class="card-title">{{ __('inventory.employee_list') }}</h4>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th scope="col" style="width: 15%;">{{ __('inventory.lastname') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.firstname') }}</th>
                            <th scope="col" style="width: 40%;">{{ __('inventory.secondname') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.to_list') }}</th>
                        </thead>
                        <tbody>
                        @foreach ($employees as $item)
                            <tr>
                                <td scope="col" class="lastname">
                                    {{ $item->lastname }}
                                </td>
                                <td scope="col" class="firstname">
                                    {{ $item->firstname }}
                                </td>
                                <td scope="col" class="name">
                                    {{ $item->secondname }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-link btn-sm text-success" id="{{$item->id}}" OnClick="salary_payment_add_employee('{{$salary_payment->id}}','{{$item->id}}')"> <i class="fas fa-angle-double-right"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card" style="height:500px;position:relative;">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">{{ __('inventory.selected_employee_list') }}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('salary_payments.show', ['salary_payment' => $salary_payment]) }}" class="btn btn-simple btn-sm text-info"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive" id="selectedemployeesTable">
                    <table class="table">
                        <thead class=" text-primary">
                            <th scope="col" style="width: 15%;">{{ __('inventory.lastname') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.firstname') }}</th>
                            <th scope="col" style="width: 40%;">{{ __('inventory.secondname') }}</th>
                            <th scope="col text-center" style="width: 5%;">{{ __('inventory.salary') }}</th>
                        </thead>
                        <tbody>
                        @foreach ($salary_payment->employees as $item)
                            <tr id="salary_payment_selected_employee-{{ $item->employee_id }}" class="pointer" onclick="salary_payment_edit_employee('{{$salary_payment->id}}','{{ $item->employee_id }}');">
                                <td scope="col" class="lastname">
                                    {{ $item->employee->lastname }}
                                </td>
                                <td scope="col" class="firstname">
                                    {{ $item->employee->firstname }}
                                </td>
                                <td scope="col" class="name">
                                    {{ $item->employee->secondname }}
                                </td>
                                <td scope="col" class="text-center salary">
                                    {{ $item->salary ?? 0}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection