@extends('inventory.layouts.app', ['page' => __('inventory.manage_payroll'), 'pageSlug' => 'payrolls', 'section' => 'salary_management', 'search' => 'payrolls'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">
                            {{ __('inventory.payroll') }} №{{ $payroll->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($payroll->created_at)) }}
                            @if (!$payroll->finalized_at)
                                <span class="text-danger"><i class="far fa-minus-square"></i></span>
                            @else
                                <span class="text-success"><i class="far fa-check-square"></i></span>
                            @endif</h4>
                    </div>
                    <div class="col-6">
                        <div class="row text-right">
                            <!--finalize-->
                            <div class="col-1">
                                <button type="button" class="btn btn-success btn-sm btn-simple @if($payroll->finalized_at) disabled @endif" onclick="confirm('ATTENTION: At the end of this payroll you will not be able to load more employees in it.') ? window.location.replace('{{ route('payrolls.finalize', $payroll) }}') : ''">
                                    <i class="fas fa-handshake"></i>
                                </button>
                            </div>
                            <!--pay-->
                            <div class="col-1">
                                <form method="post" action="{{ route('salary_payments.store') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="payroll_id" value="{{ $payroll->id }}">
                                    <input type="hidden" name="currency" value="{{ $payroll->currency }}">
                                    <button type="submit" class="btn btn-simple btn-sm"><i class="fas fa-plus"></i></button>
                                </form>
                            </div>
                            <!--print-->
                            <div class="col-1">
                                <form action="{{ route('payrolls.print', $payroll) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-print" data-toggle="tooltip" title="{{ __('inventory.print') }}"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            <!--delete-->
                            <div class="col-1">
                                <form action="{{ route('payrolls.destroy', $payroll) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-delete btn-sm btn-simple @if($payroll->finalized_at) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.delete') }}"><i class="fas fa-times"></i></button>
                                </form>
                            </div>
                            <!--index-->
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <!--index-->
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-back" href="{{ route('payrolls.index') }}" data-toggle="tooltip" title="Back to list"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row text-info"><div class="col-md-3">{{ __('inventory.user') }}</div><div class="col-md-9">{{ $payroll->user->name }}</div></div>
                            <div class="row text-info"><div class="col-md-3">{{ __('inventory.employees') }} / {{ __('inventory.salary') }}</div><div class="col-md-9">{{ $payroll->employees->count() }} / {{ $payroll->employees->sum('salary') }}</div></div>
                            <div class="row text-info"><div class="col-md-3">{{ __('inventory.total_cost') }}</div><div class="col-md-9">{{ $payroll->employees->sum('salary') }} ({{ $payroll->currency }})</div></div>
                        </div>
                        <div class="col-md-6">
                            @if($payroll->reference_type == "to_provider_order")
                            <div class="row text-success">
                                <div class="col-md-3">{{ __('inventory.reference_doc') }}</div>
                                <div class="col-md-9">
                                    <a href="{{ route('to_provider_orders.show', $payroll->reference_id) }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        {{ __('inventory.to_provider_order') }} №{{ $payroll->reference_id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($payroll->created_at)) }}
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">{{ __('inventory.employees') }}</h4>
                    </div>
                    <div class="col-6">
                        <div class="row text-right">
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-selector @if ($payroll->finalized_at) disabled @endif" href="{{ route('payrolls.employees.selector', $payroll) }}" data-toggle="tooltip" title="{{ __('inventory.employee_selector') }}"><i class="fas fa-list-ul"></i></a>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-delete @if ($payroll->finalized_at) disabled @endif" href="{{ route('payrolls.employees.clear', $payroll) }}" data-toggle="tooltip" title="{{ __('inventory.clear_table') }}"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>№</th>
                        <th>{{ __('inventory.employee') }}</th>
                        <th>{{ __('inventory.currency') }}</th>
                        <th>{{ __('inventory.total') }}</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($payroll->employees as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><a href="{{ route('employees.show', $item) }}">{{ $item->employee->lastname }} {{ $item->employee->firstname }} {{ $item->employee->secondname }}</a></td>
                                <td>{{ $item->currency }}</td>
                                <td>{{ $item->salary }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection