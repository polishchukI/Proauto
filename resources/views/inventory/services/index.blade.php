@extends('inventory.layouts.app', ['page' => 'List of services', 'pageSlug' => 'services', 'section' => 'services', 'search' => 'services'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('inventory.services') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('services.create') }}" class="btn btn-sm btn-simple">New service</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
					@include('inventory.alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">{{ __('inventory.article') }}</th>
                                <th scope="col">{{ __('inventory.service') }}</th>
                                <th scope="col">{{ __('inventory.group') }}</th>
                                <th scope="col">{{ __('inventory.comment') }}</th>

                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
										<td>{{ $service->article }}</td>
										<td>{{ $service->name }}</td>
										<td>{{ $service->group }}</td>
										<td>{{ $service->comment }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('services.show', $service) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.more_details') }}">
                                                <i class="fas fa-search"></i>
                                            </a>
                                            <a href="{{ route('services.edit', $service) }}" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('services.destroy', $service) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.delete') }}" onclick="confirm('Are you sure you want to remove this service? The records that contain it will continue to exist.') ? this.parentElement.submit() : ''">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end">
                        {{ $services->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
