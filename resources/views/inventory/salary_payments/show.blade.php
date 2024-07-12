@extends('inventory.layouts.app', ['page' => __('inventory.manage_salary_payment'), 'pageSlug' => 'salary_payments', 'section' => 'salary_management', 'search' => 'salary_payments'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">
                            {{ __('inventory.salary_payment') }} №{{ $salary_payment->id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($salary_payment->created_at)) }}
                                @if (!$salary_payment->finalized_at)
                                    <span class="text-danger"><i class="far fa-minus-square"></i></span>
                                @else
                                    <span class="text-success"><i class="far fa-check-square"></i></span>
                                @endif</h4>
                    </div>
                    <div class="col-6">
                        <div class="row text-right">
                            <!--finalize-->
                            <div class="col-1">
                                
                                <button type="button" class="btn btn-simple btn-sm btn-success @if($salary_payment->finalized_at) disabled @endif" onclick="confirm('ATTENTION: At the end of this salary_payment you will not be able to load more employees in it.') ? window.location.replace('{{ route('salary_payments.finalize', $salary_payment) }}') : ''">
                                    <i class="fas fa-handshake"></i>
                                </button>
                               
                            </div>
                            <!--pay-->
                            <div class="col-1">
                                <form action="{{ route('salary_payments.pay', $salary_payment) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-pay" data-toggle="tooltip" title="{{ __('inventory.pay') }}"><i class="fas fa-dollar-sign"></i></button>
                                </form>
                            </div>
                            <!--print-->
                            <div class="col-1">
                                <form action="{{ route('salary_payments.print', $salary_payment) }}" method="get" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-simple btn-sm btn-print" data-toggle="tooltip" title="{{ __('inventory.print') }}"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            <!--delete-->
                            <div class="col-1">
                                <form action="{{ route('salary_payments.destroy', $salary_payment) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-simple btn-sm btn-delete @if($salary_payment->finalized_at) disabled @endif" data-toggle="tooltip" title="{{ __('inventory.delete') }}"><i class="fas fa-times"></i></button>
                                    
                                </form>
                            </div>
                            <!--thumb-->
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <!--index-->
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-back" href="{{ route('salary_payments.index') }}" data-toggle="tooltip" title="Back to list"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">{{ __('inventory.user') }}</div>
                                <div class="col-md-9">{{ $salary_payment->user->name }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">{{ __('inventory.employees') }} / {{ __('inventory.salary') }}</div>
                                <div class="col-md-9">{{ $salary_payment->employees->count() }} / {{ $salary_payment->employees->sum('salary') }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">{{ __('inventory.total_cost') }}</div>
                                <div class="col-md-9">{{ $salary_payment->employees->sum('salary') }} ({{ $salary_payment->currency }})</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if($salary_payment->reference_type == "to_provider_order")
                            <div class="row text-success">
                                <div class="col-md-3">{{ __('inventory.reference_doc') }}</div>
                                <div class="col-md-9">
                                    <a href="{{ route('to_provider_orders.show', $salary_payment->reference_id) }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        {{ __('inventory.to_provider_order') }} №{{ $salary_payment->reference_id }} {{ __('inventory.from_date') }} {{ date('d-m-y', strtotime($salary_payment->created_at)) }}
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
                                <a class="btn btn-simple btn-sm btn-delete @if($salary_payment->finalized_at) disabled @endif" href="{{ route('salary_payments.employees.clear', $salary_payment) }}" data-toggle="tooltip" title="{{ __('inventory.clear_table') }}"><i class="fas fa-times"></i></a>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-simple btn-sm btn-selector @if($salary_payment->finalized_at) disabled @endif" href="{{ route('salary_payments.employees.selector', $salary_payment) }}" data-toggle="tooltip" title="Product selector"><i class="fas fa-list-ul"></i></a>
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
                        @foreach ($salary_payment->employees as $item)
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