@extends('inventory.layouts.app', ['page' => __('inventory.employee_info'), 'pageSlug' => 'employees', 'section' => 'salary_management', 'search' => 'employees'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
					<div class="row">
						<div class="col-8"><h4 class="card-title">{{ __('inventory.employee_info') }}</h4></div>
						<div class="col-4 text-right">
							<a href="{{ route('employees.edit', $employee) }}" class="btn btn-simple btn-selector btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
								<i class="fas fa-edit"></i>
							</a>
							<a href="{{ route('employees.index') }}" class="btn btn-simple btn-sm btn-back"><i class="fas fa-arrow-left"></i></a>
						</div>
					</div>
				</div>                
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('inventory.lastname') }}</th>
                            <th scope="col">{{ __('inventory.firstname') }}</th>
                            <th scope="col">{{ __('inventory.secondname') }}</th>
                            <th scope="col">{{ __('inventory.isfired') }}</th>
                            <th scope="col">{{ __('inventory.isuser') }}</th>
                            <th scope="col">{{ __('inventory.isworker') }}</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->lastname }}</td>
                                <td>{{ $employee->firstname }}</td>
                                <td>{{ $employee->secondname }}</td>
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
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
