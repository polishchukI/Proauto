@extends('inventory.layouts.app', ['page' => __('inventory.employees'), 'pageSlug' => 'employees', 'section' => 'salary_management', 'search' => 'employees'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory.employees') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('employees.create') }}" class="btn btn-sm btn-simple btn-success"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
					@include('inventory.alerts.success')
                    <div class="table-full-width table-responsive" id="">
                        <table class="table">
                            <thead class=" text-primary">
                                <th scope="col">#</th>
                                <th scope="col">{{ __('inventory.lastname') }}</th>
                                <th scope="col">{{ __('inventory.firstname') }}</th>
                                <th scope="col">{{ __('inventory.secondname') }}</th>
                                <th scope="col">{{ __('inventory.isfired') }}</th>
                                <th scope="col">{{ __('inventory.isuser') }}</th>
                                <th scope="col">{{ __('inventory.isworker') }}</th>
                                <th scope="col">{{ __('inventory.show') }}</th>
                                <th scope="col">{{ __('inventory.edit') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
										<td>{{ $loop->iteration }}</td>
                                        <td class="td-actions">{{ $employee->lastname }}</td>
                                        <td class="td-actions">{{ $employee->firstname }}</td>
                                        <td class="td-actions">{{ $employee->secondname }}</td>
                                        <td>
                                            @if(!$employee->fired_at)<span class="text-success"><i class="fab fa-gripfire"></i></span>
                                            @else<span class="text-danger"><i class="fab fa-gripfire"></i></span>
                                            @endif</td>
                                        <td>
                                            @if ($employee->isuser != "True")<span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else<span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif</td>
                                        <td>
                                            @if ($employee->isworker != "True")<span class="text-danger"><i class="far fa-minus-square"></i></span>
                                            @else<span class="text-success"><i class="far fa-check-square"></i></span>
                                            @endif</td>
                                        <td class="td-actions">
                                            <a href="{{ route('employees.show', $employee) }}" class="btn btn-simple btn-selector btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                <i class="fas fa-search"></i>
                                            </a>
										</td>
										<td class="td-actions">
                                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-simple btn-selector btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end">
                        {{ $employees->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
