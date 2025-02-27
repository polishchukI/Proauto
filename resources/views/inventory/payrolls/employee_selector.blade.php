@extends('inventory.layouts.app', ['page' => __('inventory.employee_selector'), 'pageSlug' => 'payrolls', 'section' => 'salary_management', 'search' => 'payrolls'])

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
                                <td scope="col" class="lastname">{{ $item->lastname }}</td>
                                <td scope="col" class="firstname">{{ $item->firstname }}</td>
                                <td scope="col" class="name">{{ $item->secondname }}</td>
                                <td>
                                    <button type="button" class="btn btn-simple btn-sm btn-success" id="{{$item->id}}" OnClick="payroll_add_employee('{{$payroll->id}}','{{$item->id}}')"><i class="fas fa-angle-double-right"></i></button>
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
                        <a href="{{ route('payrolls.show', ['payroll' => $payroll]) }}" class="btn btn-simple btn-sm btn-back"><i class="fas fa-arrow-left"></i></a>
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
                        @foreach ($payroll->employees as $item)
                            <tr id="payroll_selected_employee-{{ $item->employee_id }}" class="pointer" onclick="payroll_edit_employee('{{$payroll->id}}','{{ $item->employee_id }}');">
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